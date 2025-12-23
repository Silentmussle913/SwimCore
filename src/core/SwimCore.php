<?php

namespace core;

use CameraAPI\CameraHandler;
use core\communicator\Communicator;
use core\communicator\packet\types\DisconnectReason;
use core\custom\blocks\CustomBlock;
use core\database\SwimDB;
use core\listeners\AntiCheatListener;
use core\listeners\PlayerListener;
use core\listeners\WorldListener;
use core\systems\SystemManager;
use core\tasks\RandomMessageTask;
use core\tasks\SystemUpdateTask;
use core\utils\loaders\CommandLoader;
use core\utils\config\ConfigMapper;
use core\utils\config\RegionInfo;
use core\utils\config\SwimConfig;
use core\utils\loaders\CustomItemLoader;
use core\utils\raklib\RaklibSetup;
use core\utils\raklib\SwimSkinAdapter;
use core\utils\raklib\SwimTypeConverter;
use core\utils\loaders\WorldLoader;
use core\utils\security\ParseIP;
use core\utils\VoidGenerator;
use CortexPE\Commando\exception\HookAlreadyRegistered;
use Exception;
use FilesystemIterator;
use JsonException;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\ServerKiller;
use pocketmine\utils\SignalHandler;
use pocketmine\utils\TextFormat;
use pocketmine\world\generator\GeneratorManager;
use pocketmine\world\World;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Filesystem\Path;

class SwimCore extends PluginBase
{

  public static bool $AC = true;
  public static bool $DEBUG = false;
  public static bool $SKINFORALL = true; // if true, the skin fixes we have for old versions apply to new version too
  public static bool $REPLAYER = false;
  public static bool $RANKED = true;

  public static string $assetFolder; // holds our assets for our custom loaded entities geometry and skin
  public static string $dataFolder; // the plug-in data folder that gets generated
  public static string $rootFolder;
  public static string $customDataFolder;
  public static bool $isNetherGames = false;
  public bool $shuttingDown = false;
  public static bool $blobCacheOn = false;
  public bool $deltaOn = false;
  private string $nethernetId = "";

  private SystemManager $systemManager;
  private CommandLoader $commandLoader;
  private SwimConfig $swimConfig;
  private RegionInfo $regionInfo;

  private AntiCheatListener $antiCheatListener;
  private WorldListener $worldListener;
  private PlayerListener $playerListener;

  private Communicator $communicator;

  /**
   * @throws JsonException
   * @throws HookAlreadyRegistered
   * @throws ReflectionException
   */
  public function onEnable(): void
  {
    self::$isNetherGames = method_exists(NetworkSession::class, "getProtocolId");
    // set instance
    SwimCoreInstance::setInstance($this);

    // set up the server appearance on the main menu based on whitelisted or not
    $this->MenuAppearance();

    // set up the config
    $this->swimConfig = new SwimConfig;
    $confMapper = new ConfigMapper($this, $this->swimConfig);
    $confMapper->load();
    $confMapper->save(); // add missing fields to config

    $this->regionInfo = new RegionInfo;
    $regionConfFile = Path::join(SwimCore::$dataFolder, "region.yml");
    $regionInfoConf = new Config($regionConfFile);
    $regionMapper = new ConfigMapper($regionInfoConf, $this->regionInfo);
    $regionMapper->load();
    $regionMapper->save();

    // set up our rak lib interface
    $this->setUpRakLib();

    // load the worlds
    WorldLoader::loadWorlds(self::$rootFolder);

    // set up the system manager
    $this->systemManager = new SystemManager($this);
    $this->systemManager->init();

    // set up the command loader and load the commands we want and don't want
    $this->commandLoader = new CommandLoader($this);
    $this->commandLoader->setUpCommands();

    // Load all of our custom items and vanilla replacements and removals too for edu items
    CustomItemLoader::registerCustoms();

    // set the database connection
    SwimDB::initialize($this);

    // set the server's listeners
    $this->setListeners();

    // schedule server's tasks
    $this->registerTasks();

    // register inv menu (thanks muqsit)
    if (!InvMenuHandler::isRegistered()) {
      InvMenuHandler::register($this);
    }

    // Register our camera handler (thanks kaxyum)
    if (!CameraHandler::isRegistered()) {
      CameraHandler::register($this);
    }

    // Set up our skin adapter
    if (self::$isNetherGames) {
      foreach (ProtocolInfo::ACCEPTED_PROTOCOL as $protocol) {
        $typeConverter = SwimTypeConverter::make($protocol);
        $typeConverter->setSkinAdapter(new SwimSkinAdapter());
      }
    } else {
      SwimTypeConverter::make(ProtocolInfo::CURRENT_PROTOCOL);
      SwimTypeConverter::getInstance()->setSkinAdapter(new SwimSkinAdapter());
    }

    // set up signal handler
    $this->setUpSignalHandler();

    $this->communicator = new Communicator($this);

    // Disable the garbage collector, this is a HUGE performance boost that literally made Divinity playable and relatively a smooth server.
    // We are really going to have to make sure we collect our resources properly.
    gc_disable();

    // $this->registerCustomBlocks();
  }

  // We gave up on this, we need a forked version of Customies for our pm fork to actually be able to do anything
  private function registerCustomBlocks(): void
  {
    // Iterate all classes in core/custom/blocks directory that are not abstract and derive from CustomBlock
    $directory = Path::canonicalize(Path::join(__DIR__, 'custom', 'blocks'));
    if (!is_dir($directory)) {
      echo "Error: $directory not found\n";
      return;
    }

    $startPath = 'core\\custom\\blocks\\';

    echo("Loading custom blocks from $directory\n");

    try {
      $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS));
      foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
          $relativePath = Path::makeRelative($file->getPathname(), $directory);
          $relativePath = str_replace('/', '\\', $relativePath); // Ensure correct namespace separators
          $relativePath = str_replace('.php', '', $relativePath); // Remove the .php extension
          // Construct the full class name with the appropriate namespace
          $fullClassName = $startPath . $relativePath;
          if (class_exists($fullClassName)) {
            $reflectionClass = new ReflectionClass($fullClassName);
            // must derive from CustomBlock and not be abstract (fully implemented custom block)
            if (($reflectionClass->isSubclassOf(CustomBlock::class)) && !$reflectionClass->isAbstract()) {
              echo "Registering Custom Block: $fullClassName\n";
              CustomBlock::registerCustomBlock($fullClassName);
            }
          } else {
            echo "Error: Custom block class failed to register: $fullClassName\n";
          }
        }
      }
    } catch (Exception $e) {
      echo "Error while loading custom blocks: {$e->getMessage()}\n";
    }
  }

  private function registerTasks(): void
  {
    $this->getScheduler()->scheduleRepeatingTask(new SystemUpdateTask($this), 1); // update system every tick
    $this->getScheduler()->scheduleRepeatingTask(new RandomMessageTask, 2400); // random message in server every 2 minutes
  }

  public function getHubWorld(): ?World
  {
    // return $this->getServer()->getWorldManager()->getWorldByName($this->getRegionInfo()->isHub() ? "lobby" : "hub");
    return $this->getServer()->getWorldManager()->getWorldByName("hub");
  }

  private function setUpSignalHandler(): void
  {
    new SignalHandler(function () {

      $this->getLogger()->info("got signal, shutting down...");
      $this->getLogger()->info("disconnecting players...");
      $this->shuttingDown = true;

      foreach ($this->getServer()->getOnlinePlayers() as $player) {
        $player->kick(TextFormat::RED . "Server was shutdown by an admin.");
      }

      $this->getScheduler()->scheduleDelayedTask(new class($this) extends Task {

        private SwimCore $swimCore;

        public function __construct(SwimCore $xenonCore)
        {
          $this->swimCore = $xenonCore;
        }

        public function onRun(): void
        {
          $this->swimCore->getLogger()->info("stopping server...");
          $this->swimCore->getServer()->shutdown();
        }

      }, 5); // give clients time to disconnect
    });
  }

  /**
   * @throws ReflectionException
   */
  private function setUpRakLib(): void
  {
    $listenAddresses = [
      Server::getInstance()->getIp() . ":" . Server::getInstance()->getPort(),
      "[" . Server::getInstance()->getIpV6() . "]:" . Server::getInstance()->getPortV6()
    ];
    $rakRouterSocketPath = "";
    new RaklibSetup($this, $listenAddresses, $rakRouterSocketPath);
  }

  public function setNethernetId(string $nethernetId): void
  {
    /* Divinity does this for rotating messages in chat to advertise the nether net ip
    if ($this->nethernetId === "") {
      InfoBeta::addNethernetMessage();
    }
    */
    $this->nethernetId = $nethernetId;
    $this->getLogger()->info("NetherNet ID: $nethernetId");
  }

  public function getNethernetId(): string
  {
    return $this->nethernetId;
  }

  public function isNethernetEnabled(): bool
  {
    return $this->nethernetId != "";
  }

  public function onLoad(): void
  {
    $this->setDataAssetFolderPaths();

    // we like the void
    $gm = GeneratorManager::getInstance();
    $gm->addGenerator(VoidGenerator::class, "void", fn(string $preset) => null, true, true);
    $gm->addGenerator(VoidGenerator::class, "normal", fn(string $preset) => null, true, true);
    $gm->addGenerator(VoidGenerator::class, "flat", fn(string $preset) => null, true, true);
    $gm->addGenerator(VoidGenerator::class, "nether", fn(string $preset) => null, true, true);
    $gm->addGenerator(VoidGenerator::class, "default", fn(string $preset) => null, true, true);
    $gm->addGenerator(VoidGenerator::class, "hell", fn(string $preset) => null, true, true);
  }

  // close the connection to the database
  protected function onDisable(): void
  {
    $this->communicator->close($this->shuttingDown ? DisconnectReason::SERVER_SHUTDOWN : DisconnectReason::SERVER_CRASH);
    if (!$this->shuttingDown) {
      $this->shuttingDown = true;
      foreach ($this->getServer()->getOnlinePlayers() as $p) {
        $serverAddr = $p->getPlayerInfo()->getExtraData()["ServerAddress"] ?? "0.0.0.0:1";
        $parsedIp = ParseIP::sepIpFromPort($serverAddr);
        $p->getNetworkSession()->transfer($parsedIp[0], $parsedIp[1]);
      }
    }

    SwimDB::close();

    $this->getLogger()->info("-disabled");
    // something is getting stuck so this is a hack fix to force close after 5 seconds
    $killer = new ServerKiller(5);
    $killer->start(0);
    $this->getServer()->getLogger()->setLogDebug(true);
  }

  public function getCommunicator(): Communicator
  {
    return $this->communicator;
  }

  private function setListeners(): void
  {
    $this->playerListener = new PlayerListener($this);
    $this->worldListener = new WorldListener($this);
    $this->antiCheatListener = new AntiCheatListener($this);
    Server::getInstance()->getPluginManager()->registerEvents($this->playerListener, $this);
    Server::getInstance()->getPluginManager()->registerEvents($this->worldListener, $this);
    Server::getInstance()->getPluginManager()->registerEvents($this->antiCheatListener, $this);
  }

  private function setDataAssetFolderPaths(): void
  {
    self::$assetFolder = str_replace("\\", DIRECTORY_SEPARATOR,
      str_replace("/", DIRECTORY_SEPARATOR,
        Path::join($this->getFile(), "assets")));

    self::$dataFolder = str_replace("\\", DIRECTORY_SEPARATOR,
      str_replace("/", DIRECTORY_SEPARATOR,
        Path::join($this->getDataFolder())));

    self::$customDataFolder = str_replace("\\", DIRECTORY_SEPARATOR,
      str_replace("/", DIRECTORY_SEPARATOR,
        Path::join($this->getFile(), "data")));

    self::$rootFolder = dirname(self::$assetFolder, 3);
    echo("SwimCore asset folder: " . self::$assetFolder . "\n");
    echo("SwimCore data folder: " . self::$dataFolder . "\n");
    echo("SwimCore root folder: " . self::$rootFolder . "\n");
  }

  // toggles menu appearance based on white list
  private function MenuAppearance(): void
  {
    if (Server::getInstance()->hasWhitelist()) {
      Server::getInstance()->getNetwork()->setName("§r§cMaintenance");
    } else {
      Server::getInstance()->getNetwork()->setName(TextFormat::DARK_AQUA . TextFormat::BOLD . "SCRIMS");
    }
  }

  public function getSystemManager(): SystemManager
  {
    return $this->systemManager;
  }

  public function getCommandLoader(): CommandLoader
  {
    return $this->commandLoader;
  }

  public function getSwimConfig(): SwimConfig
  {
    return $this->swimConfig;
  }

  public function getRegionInfo(): RegionInfo
  {
    return $this->regionInfo;
  }

  public function getAntiCheatListener(): AntiCheatListener
  {
    return $this->antiCheatListener;
  }

  public function getPlayerListener(): PlayerListener
  {
    return $this->playerListener;
  }

  public function getWorldListener(): WorldListener
  {
    return $this->worldListener;
  }

}

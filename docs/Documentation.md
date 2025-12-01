# SwimCore - Generated API Documentation

## Table of Contents

- [core\SwimCore](#class-coreswimcore)
- [core\SwimCoreInstance](#class-coreswimcoreinstance)
- [core\commands\AcceptSceneJoinCommand](#class-corecommandsacceptscenejoincommand)
- [core\commands\DiscordCmd](#class-corecommandsdiscordcmd)
- [core\commands\DuelCommand](#class-corecommandsduelcommand)
- [core\commands\FlyCmd](#class-corecommandsflycmd)
- [core\commands\HubCmd](#class-corecommandshubcmd)
- [core\commands\InfoCommand](#class-corecommandsinfocommand)
- [core\commands\KickCommand](#class-corecommandskickcommand)
- [core\commands\ListCommand](#class-corecommandslistcommand)
- [core\commands\NickCmd](#class-corecommandsnickcmd)
- [core\commands\PartyCommand](#class-corecommandspartycommand)
- [core\commands\PingCmd](#class-corecommandspingcmd)
- [core\commands\QuickBan](#class-corecommandsquickban)
- [core\commands\RankCmd](#class-corecommandsrankcmd)
- [core\commands\RegionCommand](#class-corecommandsregioncommand)
- [core\commands\ReplyCommand](#class-corecommandsreplycommand)
- [core\commands\SeeNick](#class-corecommandsseenick)
- [core\commands\SettingsCommand](#class-corecommandssettingscommand)
- [core\commands\SpectateCommand](#class-corecommandsspectatecommand)
- [core\commands\StaffTP](#class-corecommandsstafftp)
- [core\commands\StopCommand](#class-corecommandsstopcommand)
- [core\commands\TebexAlert](#class-corecommandstebexalert)
- [core\commands\TebexRank](#class-corecommandstebexrank)
- [core\commands\TellCmd](#class-corecommandstellcmd)
- [core\commands\cosmetic\ChatColorCommand](#class-corecommandscosmeticchatcolorcommand)
- [core\commands\cosmetic\CosmeticsCommand](#class-corecommandscosmeticcosmeticscommand)
- [core\commands\cosmetic\KillMessageCommand](#class-corecommandscosmetickillmessagecommand)
- [core\commands\cosmetic\ParticleTrailCommand](#class-corecommandscosmeticparticletrailcommand)
- [core\commands\cosmetic\TagCommand](#class-corecommandscosmetictagcommand)
- [core\commands\debugCommands\CallBot](#class-corecommandsdebugcommandscallbot)
- [core\commands\debugCommands\CrashServerCommand](#class-corecommandsdebugcommandscrashservercommand)
- [core\commands\debugCommands\DebugReplayCommand](#class-corecommandsdebugcommandsdebugreplaycommand)
- [core\commands\debugCommands\DebugSG](#class-corecommandsdebugcommandsdebugsg)
- [core\commands\debugCommands\DumpEvents](#class-corecommandsdebugcommandsdumpevents)
- [core\commands\debugCommands\EnableScrimsCommand](#class-corecommandsdebugcommandsenablescrimscommand)
- [core\commands\debugCommands\EntityStatus](#class-corecommandsdebugcommandsentitystatus)
- [core\commands\debugCommands\EventStartCommand](#class-corecommandsdebugcommandseventstartcommand)
- [core\commands\debugCommands\ForceEvent](#class-corecommandsdebugcommandsforceevent)
- [core\commands\debugCommands\GodCmd](#class-corecommandsdebugcommandsgodcmd)
- [core\commands\debugCommands\InstaWin](#class-corecommandsdebugcommandsinstawin)
- [core\commands\debugCommands\LogPosition](#class-corecommandsdebugcommandslogposition)
- [core\commands\debugCommands\MapDebug](#class-corecommandsdebugcommandsmapdebug)
- [core\commands\debugCommands\NukeTest](#class-corecommandsdebugcommandsnuketest)
- [core\commands\debugCommands\PlaySoundCmd](#class-corecommandsdebugcommandsplaysoundcmd)
- [core\commands\debugCommands\PositionCommand](#class-corecommandsdebugcommandspositioncommand)
- [core\commands\debugCommands\RestartCommand](#class-corecommandsdebugcommandsrestartcommand)
- [core\commands\debugCommands\SceneDump](#class-corecommandsdebugcommandsscenedump)
- [core\commands\debugCommands\ScenesCommand](#class-corecommandsdebugcommandsscenescommand)
- [core\commands\debugCommands\ShopWarsToggler](#class-corecommandsdebugcommandsshopwarstoggler)
- [core\commands\debugCommands\SpawnEntityCmd](#class-corecommandsdebugcommandsspawnentitycmd)
- [core\commands\debugCommands\SwimCoreEditor](#class-corecommandsdebugcommandsswimcoreeditor)
- [core\commands\debugCommands\TestCmd](#class-corecommandsdebugcommandstestcmd)
- [core\commands\debugCommands\ToggleAC](#class-corecommandsdebugcommandstoggleac)
- [core\commands\debugCommands\ToggleDebug](#class-corecommandsdebugcommandstoggledebug)
- [core\commands\debugCommands\ToggleRanked](#class-corecommandsdebugcommandstoggleranked)
- [core\commands\debugCommands\WorldTP](#class-corecommandsdebugcommandsworldtp)
- [core\commands\debugCommands\name](#class-corecommandsdebugcommandsname)
- [core\commands\debugCommands\similar](#class-corecommandsdebugcommandssimilar)
- [core\commands\punish\BanCmd](#class-corecommandspunishbancmd)
- [core\commands\punish\MuteCmd](#class-corecommandspunishmutecmd)
- [core\commands\punish\PunishCmd](#class-corecommandspunishpunishcmd)
- [core\commands\unpunish\UnPunishCmd](#class-corecommandsunpunishunpunishcmd)
- [core\commands\unpunish\UnbanCmd](#class-corecommandsunpunishunbancmd)
- [core\commands\unpunish\UnmuteCmd](#class-corecommandsunpunishunmutecmd)
- [core\communicator\Communicator](#class-corecommunicatorcommunicator)
- [core\communicator\CommunicatorThread](#class-corecommunicatorcommunicatorthread)
- [core\communicator\DiscordCommandSender](#class-corecommunicatordiscordcommandsender)
- [core\communicator\DiscordInfo](#class-corecommunicatordiscordinfo)
- [core\communicator\packet\DisconnectPacket](#class-corecommunicatorpacketdisconnectpacket)
- [core\communicator\packet\DiscordCommandExecutePacket](#class-corecommunicatorpacketdiscordcommandexecutepacket)
- [core\communicator\packet\DiscordCommandMessagePacket](#class-corecommunicatorpacketdiscordcommandmessagepacket)
- [core\communicator\packet\DiscordEmbedSendPacket](#class-corecommunicatorpacketdiscordembedsendpacket)
- [core\communicator\packet\DiscordInfoPacket](#class-corecommunicatorpacketdiscordinfopacket)
- [core\communicator\packet\DiscordLinkInfoPacket](#class-corecommunicatorpacketdiscordlinkinfopacket)
- [core\communicator\packet\DiscordLinkRequestPacket](#class-corecommunicatorpacketdiscordlinkrequestpacket)
- [core\communicator\packet\DiscordUserRequestPacket](#class-corecommunicatorpacketdiscorduserrequestpacket)
- [core\communicator\packet\DiscordUserResponsePacket](#class-corecommunicatorpacketdiscorduserresponsepacket)
- [core\communicator\packet\OtherRegionsPacket](#class-corecommunicatorpacketotherregionspacket)
- [core\communicator\packet\Packet](#class-corecommunicatorpacketpacket)
- [core\communicator\packet\PacketDecoder](#class-corecommunicatorpacketpacketdecoder)
- [core\communicator\packet\PacketPool](#class-corecommunicatorpacketpacketpool)
- [core\communicator\packet\PacketSerializer](#class-corecommunicatorpacketpacketserializer)
- [core\communicator\packet\PlayerListRequestPacket](#class-corecommunicatorpacketplayerlistrequestpacket)
- [core\communicator\packet\PlayerListResponsePacket](#class-corecommunicatorpacketplayerlistresponsepacket)
- [core\communicator\packet\ServerInfoPacket](#class-corecommunicatorpacketserverinfopacket)
- [core\communicator\packet\UpdateDiscordRolesPacket](#class-corecommunicatorpacketupdatediscordrolespacket)
- [core\communicator\packet\types\CrashInfo](#class-corecommunicatorpackettypescrashinfo)
- [core\communicator\packet\types\Region](#class-corecommunicatorpackettypesregion)
- [core\communicator\packet\types\embed\Author](#class-corecommunicatorpackettypesembedauthor)
- [core\communicator\packet\types\embed\Embed](#class-corecommunicatorpackettypesembedembed)
- [core\communicator\packet\types\embed\Field](#class-corecommunicatorpackettypesembedfield)
- [core\communicator\packet\types\embed\Footer](#class-corecommunicatorpackettypesembedfooter)
- [core\communicator\packet\types\embed\Image](#class-corecommunicatorpackettypesembedimage)
- [core\communicator\packet\types\embed\Provider](#class-corecommunicatorpackettypesembedprovider)
- [core\communicator\packet\types\embed\Video](#class-corecommunicatorpackettypesembedvideo)
- [core\custom\bases\ItemHolderActor](#class-corecustombasesitemholderactor)
- [core\custom\bases\MainHandInventory](#class-corecustombasesmainhandinventory)
- [core\custom\behaviors\entity_behaviors\AnimationCycler](#class-corecustombehaviorsentity_behaviorsanimationcycler)
- [core\custom\behaviors\entity_behaviors\FaceNearest](#class-corecustombehaviorsentity_behaviorsfacenearest)
- [core\custom\behaviors\player_event_behaviors\DoubleJump](#class-corecustombehaviorsplayer_event_behaviorsdoublejump)
- [core\custom\behaviors\player_event_behaviors\MaxDistance](#class-corecustombehaviorsplayer_event_behaviorsmaxdistance)
- [core\custom\behaviors\player_event_behaviors\NoFall](#class-corecustombehaviorsplayer_event_behaviorsnofall)
- [core\custom\behaviors\player_event_behaviors\ParticleEmitter](#class-corecustombehaviorsplayer_event_behaviorsparticleemitter)
- [core\custom\behaviors\player_event_behaviors\kit_sg\ArabKitBehavior](#class-corecustombehaviorsplayer_event_behaviorskit_sgarabkitbehavior)
- [core\custom\behaviors\player_event_behaviors\kit_sg\ArcherKitBehavior](#class-corecustombehaviorsplayer_event_behaviorskit_sgarcherkitbehavior)
- [core\custom\behaviors\player_event_behaviors\kit_sg\BruteKitBehavior](#class-corecustombehaviorsplayer_event_behaviorskit_sgbrutekitbehavior)
- [core\custom\behaviors\player_event_behaviors\kit_sg\SouperManKitBehavior](#class-corecustombehaviorsplayer_event_behaviorskit_sgsoupermankitbehavior)
- [core\custom\behaviors\player_event_behaviors\kit_sg\WizardManKitBehavior](#class-corecustombehaviorsplayer_event_behaviorskit_sgwizardmankitbehavior)
- [core\custom\blocks\BoomBoxBlock](#class-corecustomblocksboomboxblock)
- [core\custom\blocks\CustomBlock](#class-corecustomblockscustomblock)
- [core\custom\blocks\CustomBlockData](#class-corecustomblockscustomblockdata)
- [core\custom\prefabs\apples\FullHealApple](#class-corecustomprefabsapplesfullhealapple)
- [core\custom\prefabs\apples\GoldHead](#class-corecustomprefabsapplesgoldhead)
- [core\custom\prefabs\apples\GoldHeadListener](#class-corecustomprefabsapplesgoldheadlistener)
- [core\custom\prefabs\apples\SwimApple](#class-corecustomprefabsapplesswimapple)
- [core\custom\prefabs\apples\UsableBlock](#class-corecustomprefabsapplesusableblock)
- [core\custom\prefabs\boombox\BaseBox](#class-corecustomprefabsboomboxbasebox)
- [core\custom\prefabs\boombox\BlockBreakerBox](#class-corecustomprefabsboomboxblockbreakerbox)
- [core\custom\prefabs\boombox\CustomExplosion](#class-corecustomprefabsboomboxcustomexplosion)
- [core\custom\prefabs\boombox\KnockerBox](#class-corecustomprefabsboomboxknockerbox)
- [core\custom\prefabs\boombox\KnockerBoxEntity](#class-corecustomprefabsboomboxknockerboxentity)
- [core\custom\prefabs\boombox\KnockerBoxExplosion](#class-corecustomprefabsboomboxknockerboxexplosion)
- [core\custom\prefabs\boombox\SmoothPrimedTNT](#class-corecustomprefabsboomboxsmoothprimedtnt)
- [core\custom\prefabs\boombox\TNT_Listener](#class-corecustomprefabsboomboxtnt_listener)
- [core\custom\prefabs\boombox\ThrowableBlock](#class-corecustomprefabsboomboxthrowableblock)
- [core\custom\prefabs\boombox\ThrowingTNT](#class-corecustomprefabsboomboxthrowingtnt)
- [core\custom\prefabs\bots\ArmorHelper](#class-corecustomprefabsbotsarmorhelper)
- [core\custom\prefabs\bots\BotInventoryEditor](#class-corecustomprefabsbotsbotinventoryeditor)
- [core\custom\prefabs\bots\BotPlayer](#class-corecustomprefabsbotsbotplayer)
- [core\custom\prefabs\bots\SimpleFollow](#class-corecustomprefabsbotssimplefollow)
- [core\custom\prefabs\bots\SimpleMover](#class-corecustomprefabsbotssimplemover)
- [core\custom\prefabs\bots\has](#class-corecustomprefabsbotshas)
- [core\custom\prefabs\bow\SwimArrow](#class-corecustomprefabsbowswimarrow)
- [core\custom\prefabs\bow\SwimBow](#class-corecustomprefabsbowswimbow)
- [core\custom\prefabs\carrot\SpeedCarrot](#class-corecustomprefabscarrotspeedcarrot)
- [core\custom\prefabs\fireball\DummyCharge](#class-corecustomprefabsfireballdummycharge)
- [core\custom\prefabs\fireball\FireBallEntity](#class-corecustomprefabsfireballfireballentity)
- [core\custom\prefabs\fireball\FireBallItem](#class-corecustomprefabsfireballfireballitem)
- [core\custom\prefabs\hub\FinnEntity](#class-corecustomprefabshubfinnentity)
- [core\custom\prefabs\hub\HubEntities](#class-corecustomprefabshubhubentities)
- [core\custom\prefabs\hub\ServerSelectorCompass](#class-corecustomprefabshubserverselectorcompass)
- [core\custom\prefabs\pearl\SwimPearl](#class-corecustomprefabspearlswimpearl)
- [core\custom\prefabs\pearl\SwimPearlItem](#class-corecustomprefabspearlswimpearlitem)
- [core\custom\prefabs\pot\SwimDrinkPot](#class-corecustomprefabspotswimdrinkpot)
- [core\custom\prefabs\pot\SwimPot](#class-corecustomprefabspotswimpot)
- [core\custom\prefabs\pot\SwimPotItem](#class-corecustomprefabspotswimpotitem)
- [core\custom\prefabs\props\MovieActor](#class-corecustomprefabspropsmovieactor)
- [core\custom\prefabs\rod\CustomFishingRod](#class-corecustomprefabsrodcustomfishingrod)
- [core\custom\prefabs\rod\FishingHook](#class-corecustomprefabsrodfishinghook)
- [core\custom\prefabs\rod\GrapplingHook](#class-corecustomprefabsrodgrapplinghook)
- [core\custom\prefabs\snowball\SnowBall_Item](#class-corecustomprefabssnowballsnowball_item)
- [core\custom\prefabs\soup\HealSoup](#class-corecustomprefabssouphealsoup)
- [core\database\KeepAlive](#class-coredatabasekeepalive)
- [core\database\SwimDB](#class-coredatabaseswimdb)
- [core\database\queries\ConnectionHandler](#class-coredatabasequeriesconnectionhandler)
- [core\database\queries\TableManager](#class-coredatabasequeriestablemanager)
- [core\failed](#class-corefailed)
- [core\forms\hub\FormDuelRequests](#class-coreformshubformduelrequests)
- [core\forms\hub\FormDuels](#class-coreformshubformduels)
- [core\forms\hub\FormEvents](#class-coreformshubformevents)
- [core\forms\hub\FormFFA](#class-coreformshubformffa)
- [core\forms\hub\FormServerSelector](#class-coreformshubformserverselector)
- [core\forms\hub\FormSettings](#class-coreformshubformsettings)
- [core\forms\hub\FormSpectate](#class-coreformshubformspectate)
- [core\forms\parties\CombinedPartyForms](#class-coreformspartiescombinedpartyforms)
- [core\forms\parties\FormPartyCreate](#class-coreformspartiesformpartycreate)
- [core\forms\parties\FormPartyDuels](#class-coreformspartiesformpartyduels)
- [core\forms\parties\FormPartyExit](#class-coreformspartiesformpartyexit)
- [core\forms\parties\FormPartyInvite](#class-coreformspartiesformpartyinvite)
- [core\forms\parties\FormPartyManagePlayers](#class-coreformspartiesformpartymanageplayers)
- [core\forms\parties\FormPartySettings](#class-coreformspartiesformpartysettings)
- [core\listeners\AntiCheatListener](#class-corelistenersanticheatlistener)
- [core\listeners\PlayerListener](#class-corelistenersplayerlistener)
- [core\listeners\WorldListener](#class-corelistenersworldlistener)
- [core\maps\info\FourTeamMapInfo](#class-coremapsinfofourteammapinfo)
- [core\maps\pool\BasicDuelMaps](#class-coremapspoolbasicduelmaps)
- [core\name](#class-corename)
- [core\scenes\duel\Boxing](#class-corescenesduelboxing)
- [core\scenes\duel\Duel](#class-corescenesduelduel)
- [core\scenes\duel\IconHelper](#class-corescenesdueliconhelper)
- [core\scenes\duel\Midfight](#class-corescenesduelmidfight)
- [core\scenes\duel\Nodebuff](#class-corescenesduelnodebuff)
- [core\scenes\duel\SkyGoalGame](#class-corescenesduelskygoalgame)
- [core\scenes\duel\behaviors\ArrowRecharge](#class-corescenesduelbehaviorsarrowrecharge)
- [core\scenes\duel\behaviors\AttackProtection](#class-corescenesduelbehaviorsattackprotection)
- [core\scenes\duel\behaviors\RespawnTimer](#class-corescenesduelbehaviorsrespawntimer)
- [core\scenes\duel\behaviors\is](#class-corescenesduelbehaviorsis)
- [core\scenes\ffas\FFA](#class-corescenesffasffa)
- [core\scenes\ffas\MidFightFFA](#class-corescenesffasmidfightffa)
- [core\scenes\ffas\NodebuffFFA](#class-corescenesffasnodebuffffa)
- [core\scenes\for](#class-corescenesfor)
- [core\scenes\hub\EventQueue](#class-coresceneshubeventqueue)
- [core\scenes\hub\GodMode](#class-coresceneshubgodmode)
- [core\scenes\hub\Hub](#class-coresceneshubhub)
- [core\scenes\hub\Loading](#class-coresceneshubloading)
- [core\scenes\hub\Queue](#class-coresceneshubqueue)
- [core\scenes\hub\exists](#class-coresceneshubexists)
- [core\scenes\hub\not](#class-coresceneshubnot)
- [core\systems\System](#class-coresystemssystem)
- [core\systems\SystemManager](#class-coresystemssystemmanager)
- [core\systems\entity\Behavior](#class-coresystemsentitybehavior)
- [core\systems\entity\EntityBehaviorManager](#class-coresystemsentityentitybehaviormanager)
- [core\systems\entity\EntitySystem](#class-coresystemsentityentitysystem)
- [core\systems\entity\entities\ClientEntity](#class-coresystemsentityentitiescliententity)
- [core\systems\entity\entities\DeltaSupportTrait](#class-coresystemsentityentitiesdeltasupporttrait)
- [core\systems\entity\entities\EasierPickUpItemEntity](#class-coresystemsentityentitieseasierpickupitementity)
- [core\systems\entity\entities\FloatingText](#class-coresystemsentityentitiesfloatingtext)
- [core\systems\entity\entities\intended](#class-coresystemsentityentitiesintended)
- [core\systems\entity\entities\only](#class-coresystemsentityentitiesonly)
- [core\systems\entity\failed](#class-coresystemsentityfailed)
- [core\systems\entity\name](#class-coresystemsentityname)
- [core\systems\entity\name](#class-coresystemsentityname)
- [core\systems\entity\on](#class-coresystemsentityon)
- [core\systems\event\EventForms](#class-coresystemseventeventforms)
- [core\systems\event\EventSystem](#class-coresystemseventeventsystem)
- [core\systems\event\EventTeam](#class-coresystemseventeventteam)
- [core\systems\event\and](#class-coresystemseventand)
- [core\systems\event\must](#class-coresystemseventmust)
- [core\systems\map\MapInfo](#class-coresystemsmapmapinfo)
- [core\systems\map\MapPool](#class-coresystemsmapmappool)
- [core\systems\map\MapsData](#class-coresystemsmapmapsdata)
- [core\systems\party\PartiesSystem](#class-coresystemspartypartiessystem)
- [core\systems\party\Party](#class-coresystemspartyparty)
- [core\systems\player\Component](#class-coresystemsplayercomponent)
- [core\systems\player\SwimPlayer](#class-coresystemsplayerswimplayer)
- [core\systems\player\bool](#class-coresystemsplayerbool)
- [core\systems\player\components\AckHandler](#class-coresystemsplayercomponentsackhandler)
- [core\systems\player\components\AntiCheatData](#class-coresystemsplayercomponentsanticheatdata)
- [core\systems\player\components\Attributes](#class-coresystemsplayercomponentsattributes)
- [core\systems\player\components\ChatHandler](#class-coresystemsplayercomponentschathandler)
- [core\systems\player\components\ClickHandler](#class-coresystemsplayercomponentsclickhandler)
- [core\systems\player\components\CombatLogger](#class-coresystemsplayercomponentscombatlogger)
- [core\systems\player\components\Cosmetics](#class-coresystemsplayercomponentscosmetics)
- [core\systems\player\components\DiscordLinkHandler](#class-coresystemsplayercomponentsdiscordlinkhandler)
- [core\systems\player\components\Invites](#class-coresystemsplayercomponentsinvites)
- [core\systems\player\components\Kits](#class-coresystemsplayercomponentskits)
- [core\systems\player\components\NetworkStackLatencyHandler](#class-coresystemsplayercomponentsnetworkstacklatencyhandler)
- [core\systems\player\components\Nicks](#class-coresystemsplayercomponentsnicks)
- [core\systems\player\components\Rank](#class-coresystemsplayercomponentsrank)
- [core\systems\player\components\Settings](#class-coresystemsplayercomponentssettings)
- [core\systems\player\components\behaviors\BetterBlockBreaker](#class-coresystemsplayercomponentsbehaviorsbetterblockbreaker)
- [core\systems\player\components\behaviors\EventBehaviorComponent](#class-coresystemsplayercomponentsbehaviorseventbehaviorcomponent)
- [core\systems\player\components\behaviors\EventBehaviorComponentManager](#class-coresystemsplayercomponentsbehaviorseventbehaviorcomponentmanager)
- [core\systems\player\components\detections\Detection](#class-coresystemsplayercomponentsdetectionsdetection)
- [core\systems\player\components\field](#class-coresystemsplayercomponentsfield)
- [core\systems\player\components\fields](#class-coresystemsplayercomponentsfields)
- [core\systems\player\components\fields](#class-coresystemsplayercomponentsfields)
- [core\systems\player\components\holds](#class-coresystemsplayercomponentsholds)
- [core\systems\player\components\to](#class-coresystemsplayercomponentsto)
- [core\systems\player\since](#class-coresystemsplayersince)
- [core\systems\player\to](#class-coresystemsplayerto)
- [core\systems\scene\DuelInfo](#class-coresystemssceneduelinfo)
- [core\systems\scene\FFAInfo](#class-coresystemssceneffainfo)
- [core\systems\scene\Scene](#class-coresystemsscenescene)
- [core\systems\scene\SceneSystem](#class-coresystemsscenescenesystem)
- [core\systems\scene\failed](#class-coresystemsscenefailed)
- [core\systems\scene\like](#class-coresystemsscenelike)
- [core\systems\scene\loading](#class-coresystemssceneloading)
- [core\systems\scene\managers\BlockEntry](#class-coresystemsscenemanagersblockentry)
- [core\systems\scene\managers\BlocksManager](#class-coresystemsscenemanagersblocksmanager)
- [core\systems\scene\managers\ChestLootManager](#class-coresystemsscenemanagerschestlootmanager)
- [core\systems\scene\managers\DroppedItemManager](#class-coresystemsscenemanagersdroppeditemmanager)
- [core\systems\scene\managers\JoinRequestManager](#class-coresystemsscenemanagersjoinrequestmanager)
- [core\systems\scene\managers\TeamManager](#class-coresystemsscenemanagersteammanager)
- [core\systems\scene\managers\must](#class-coresystemsscenemanagersmust)
- [core\systems\scene\managers\to](#class-coresystemsscenemanagersto)
- [core\systems\scene\misc\LootTable](#class-coresystemsscenemiscloottable)
- [core\systems\scene\misc\SpectatorCompass](#class-coresystemsscenemiscspectatorcompass)
- [core\systems\scene\misc\Team](#class-coresystemsscenemiscteam)
- [core\systems\scene\misc\implements](#class-coresystemsscenemiscimplements)
- [core\systems\scene\misc\is](#class-coresystemsscenemiscis)
- [core\systems\scene\misc\will](#class-coresystemsscenemiscwill)
- [core\systems\scene\name](#class-coresystemsscenename)
- [core\systems\scene\name](#class-coresystemsscenename)
- [core\systems\scene\path](#class-coresystemsscenepath)
- [core\systems\scene\replay\MovieScene](#class-coresystemsscenereplaymoviescene)
- [core\systems\scene\replay\ReplaySelectionDebugUI](#class-coresystemsscenereplayreplayselectiondebugui)
- [core\systems\scene\replay\SceneRecorder](#class-coresystemsscenereplayscenerecorder)
- [core\systems\scene\replay\SceneReplay](#class-coresystemsscenereplayscenereplay)
- [core\systems\scene\will](#class-coresystemsscenewill)
- [core\systems\scene\will](#class-coresystemsscenewill)
- [core\tasks\RandomMessageTask](#class-coretasksrandommessagetask)
- [core\tasks\SystemUpdateTask](#class-coretaskssystemupdatetask)
- [core\utils\AABB](#class-coreutilsaabb)
- [core\utils\AcData](#class-coreutilsacdata)
- [core\utils\ArrayEnumArgument](#class-coreutilsarrayenumargument)
- [core\utils\AsyncQuery](#class-coreutilsasyncquery)
- [core\utils\BehaviorEventEnums](#class-coreutilsbehavioreventenums)
- [core\utils\CoolAnimations](#class-coreutilscoolanimations)
- [core\utils\CustomDamage](#class-coreutilscustomdamage)
- [core\utils\FileUtil](#class-coreutilsfileutil)
- [core\utils\FilterHelper](#class-coreutilsfilterhelper)
- [core\utils\ImageData](#class-coreutilsimagedata)
- [core\utils\InventoryUtil](#class-coreutilsinventoryutil)
- [core\utils\MathUtils](#class-coreutilsmathutils)
- [core\utils\PacketsHelper](#class-coreutilspacketshelper)
- [core\utils\PlayerInfoHelper](#class-coreutilsplayerinfohelper)
- [core\utils\PositionHelper](#class-coreutilspositionhelper)
- [core\utils\ProtocolIdToVersion](#class-coreutilsprotocolidtoversion)
- [core\utils\ServerSounds](#class-coreutilsserversounds)
- [core\utils\SkinHelper](#class-coreutilsskinhelper)
- [core\utils\SkinInfo](#class-coreutilsskininfo)
- [core\utils\StackTracer](#class-coreutilsstacktracer)
- [core\utils\SteveSkin](#class-coreutilssteveskin)
- [core\utils\SwimCoreInstance](#class-coreutilsswimcoreinstance)
- [core\utils\TargetArgument](#class-coreutilstargetargument)
- [core\utils\TaskUtils](#class-coreutilstaskutils)
- [core\utils\TimeHelper](#class-coreutilstimehelper)
- [core\utils\VoidGenerator](#class-coreutilsvoidgenerator)
- [core\utils\WorldCollisionAccessorCacheHack](#class-coreutilsworldcollisionaccessorcachehack)
- [core\utils\WorldCollisionBoxHelper](#class-coreutilsworldcollisionboxhelper)
- [core\utils\acktypes\EntityPositionAck](#class-coreutilsacktypesentitypositionack)
- [core\utils\acktypes\EntityRemovalAck](#class-coreutilsacktypesentityremovalack)
- [core\utils\acktypes\GamemodeChangeAck](#class-coreutilsacktypesgamemodechangeack)
- [core\utils\acktypes\KnockbackAck](#class-coreutilsacktypesknockbackack)
- [core\utils\acktypes\MultiAckWithTimestamp](#class-coreutilsacktypesmultiackwithtimestamp)
- [core\utils\acktypes\NoAiAck](#class-coreutilsacktypesnoaiack)
- [core\utils\acktypes\NslAck](#class-coreutilsacktypesnslack)
- [core\utils\config\CommunicatorConfig](#class-coreutilsconfigcommunicatorconfig)
- [core\utils\config\ConfigMapper](#class-coreutilsconfigconfigmapper)
- [core\utils\config\DatabaseConfig](#class-coreutilsconfigdatabaseconfig)
- [core\utils\config\RegionInfo](#class-coreutilsconfigregioninfo)
- [core\utils\config\SwimConfig](#class-coreutilsconfigswimconfig)
- [core\utils\cordhook\CordHook](#class-coreutilscordhookcordhook)
- [core\utils\is](#class-coreutilsis)
- [core\utils\is](#class-coreutilsis)
- [core\utils\libpmquery\PMQuery](#class-coreutilslibpmquerypmquery)
- [core\utils\libpmquery\PmQueryException](#class-coreutilslibpmquerypmqueryexception)
- [core\utils\loaders\CommandLoader](#class-coreutilsloaderscommandloader)
- [core\utils\loaders\CustomItemLoader](#class-coreutilsloaderscustomitemloader)
- [core\utils\loaders\WorldLoader](#class-coreutilsloadersworldloader)
- [core\utils\loaders\failed](#class-coreutilsloadersfailed)
- [core\utils\loaders\name](#class-coreutilsloadersname)
- [core\utils\particles\ColorFlameParticle](#class-coreutilsparticlescolorflameparticle)
- [core\utils\particles\ParticleTrails](#class-coreutilsparticlesparticletrails)
- [core\utils\particles\SonicBoomParticle](#class-coreutilsparticlessonicboomparticle)
- [core\utils\particles\SparklerParticle](#class-coreutilsparticlessparklerparticle)
- [core\utils\particles\TotemParticle](#class-coreutilsparticlestotemparticle)
- [core\utils\particles\WindExplosionParticle](#class-coreutilsparticleswindexplosionparticle)
- [core\utils\raklib\DdosEvent](#class-coreutilsraklibddosevent)
- [core\utils\raklib\KickMessageOverridePacket](#class-coreutilsraklibkickmessageoverridepacket)
- [core\utils\raklib\LogKickPacket](#class-coreutilsrakliblogkickpacket)
- [core\utils\raklib\MTUOpenConnectionReply2](#class-coreutilsraklibmtuopenconnectionreply2)
- [core\utils\raklib\MultiProtocolAcceptor](#class-coreutilsraklibmultiprotocolacceptor)
- [core\utils\raklib\NetherNetIdPacket](#class-coreutilsraklibnethernetidpacket)
- [core\utils\raklib\NetherNetNoticePacket](#class-coreutilsraklibnethernetnoticepacket)
- [core\utils\raklib\NoFreeIncomingConnections](#class-coreutilsraklibnofreeincomingconnections)
- [core\utils\raklib\QueryInfoPacket](#class-coreutilsraklibqueryinfopacket)
- [core\utils\raklib\RakRouterRaklibServer](#class-coreutilsraklibrakrouterraklibserver)
- [core\utils\raklib\RaklibSetup](#class-coreutilsraklibraklibsetup)
- [core\utils\raklib\SecureOpenConnectionReply1](#class-coreutilsraklibsecureopenconnectionreply1)
- [core\utils\raklib\SecureOpenConnectionRequest2](#class-coreutilsraklibsecureopenconnectionrequest2)
- [core\utils\raklib\SecureUnconnectedMessageHandler](#class-coreutilsraklibsecureunconnectedmessagehandler)
- [core\utils\raklib\StubLogger](#class-coreutilsraklibstublogger)
- [core\utils\raklib\SwimNetworkSession](#class-coreutilsraklibswimnetworksession)
- [core\utils\raklib\SwimRakLibInterface](#class-coreutilsraklibswimraklibinterface)
- [core\utils\raklib\SwimRakLibRawServer](#class-coreutilsraklibswimraklibrawserver)
- [core\utils\raklib\SwimRakLibServer](#class-coreutilsraklibswimraklibserver)
- [core\utils\raklib\SwimServerSession](#class-coreutilsraklibswimserversession)
- [core\utils\raklib\SwimSkinAdapter](#class-coreutilsraklibswimskinadapter)
- [core\utils\raklib\SwimTypeConverter](#class-coreutilsraklibswimtypeconverter)
- [core\utils\raklib\instanceof](#class-coreutilsraklibinstanceof)
- [core\utils\security\AsyncIPLookup](#class-coreutilssecurityasynciplookup)
- [core\utils\security\KickMessageFix](#class-coreutilssecuritykickmessagefix)
- [core\utils\security\ParseIP](#class-coreutilssecurityparseip)
- [core\utils\security\SqlInjectCheck](#class-coreutilssecuritysqlinjectcheck)
- [core\utils\security\TouchMode](#class-coreutilssecuritytouchmode)
- [core\utils\security\runs](#class-coreutilssecurityruns)

---

## Class: core\SwimCore

**Defined in**: `src\core\SwimCore.php`


### Methods

#### onEnable

`public function onEnable(): void`

> @throws JsonException


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->onEnable();
```


---

#### registerCustomBlocks

`private function registerCustomBlocks(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->registerCustomBlocks();
```


---

#### registerTasks

`private function registerTasks(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->registerTasks();
```


---

#### getHubWorld

`public function getHubWorld(): ?World`


**Returns**: ?World


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getHubWorld();
```


---

#### setUpSignalHandler

`private function setUpSignalHandler(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->setUpSignalHandler();
```


---

#### __construct

`public function __construct(SwimCore $xenonCore)`


**Parameters**:

- `$xenonCore` (SwimCore) — 

**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->onRun();
```


---

#### setUpRakLib

`private function setUpRakLib(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->setUpRakLib();
```


---

#### setNethernetId

`public function setNethernetId(string $nethernetId): void`


**Parameters**:

- `$nethernetId` (string) — 

**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->setNethernetId("example");
```


---

#### getNethernetId

`public function getNethernetId(): string`


**Returns**: string


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getNethernetId();
```


---

#### isNethernetEnabled

`public function isNethernetEnabled(): bool`


**Returns**: bool


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->isNethernetEnabled();
```


---

#### onLoad

`public function onLoad(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->onLoad();
```


---

#### onDisable

`protected function onDisable(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->onDisable();
```


---

#### getCommunicator

`public function getCommunicator(): Communicator`


**Returns**: Communicator


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getCommunicator();
```


---

#### setListeners

`private function setListeners(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->setListeners();
```


---

#### setDataAssetFolderPaths

`private function setDataAssetFolderPaths(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->setDataAssetFolderPaths();
```


---

#### MenuAppearance

`private function MenuAppearance(): void`


**Returns**: void


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->MenuAppearance();
```


---

#### getSystemManager

`public function getSystemManager(): SystemManager`


**Returns**: SystemManager


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getSystemManager();
```


---

#### getCommandLoader

`public function getCommandLoader(): CommandLoader`


**Returns**: CommandLoader


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getCommandLoader();
```


---

#### getSwimConfig

`public function getSwimConfig(): SwimConfig`


**Returns**: SwimConfig


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getSwimConfig();
```


---

#### getRegionInfo

`public function getRegionInfo(): RegionInfo`


**Returns**: RegionInfo


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getRegionInfo();
```


---

#### getAntiCheatListener

`public function getAntiCheatListener(): AntiCheatListener`


**Returns**: AntiCheatListener


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getAntiCheatListener();
```


---

#### getPlayerListener

`public function getPlayerListener(): PlayerListener`


**Returns**: PlayerListener


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getPlayerListener();
```


---

#### getWorldListener

`public function getWorldListener(): WorldListener`


**Returns**: WorldListener


**Example**:

```php
$swimCore = new SwimCore(new SwimCore());
$swimCore->getWorldListener();
```


---

## Class: core\name

**Defined in**: `src\core\SwimCore.php`

* @throws JsonException
   * @throws HookAlreadyRegistered
   * @throws ReflectionException


### Methods

_No methods found_

## Class: core\failed

**Defined in**: `src\core\SwimCore.php`

* @throws JsonException
   * @throws HookAlreadyRegistered
   * @throws ReflectionException


### Methods

_No methods found_

## Class: core\SwimCoreInstance

**Defined in**: `src\core\SwimCoreInstance.php`


### Methods

#### setInstance

`public static function setInstance(SwimCore $core): void`


**Parameters**:

- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
SwimCoreInstance::setInstance(new SwimCore());
```


---

#### getInstance

`public static function getInstance(): SwimCore`


**Returns**: SwimCore


**Example**:

```php
SwimCoreInstance::getInstance();
```


---

## Class: core\commands\AcceptSceneJoinCommand

**Defined in**: `src\core\commands\AcceptSceneJoinCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$acceptSceneJoinCommand = new AcceptSceneJoinCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$acceptSceneJoinCommand = new AcceptSceneJoinCommand(new SwimCore());
$acceptSceneJoinCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$acceptSceneJoinCommand = new AcceptSceneJoinCommand(new SwimCore());
$acceptSceneJoinCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): string`


**Returns**: string


**Example**:

```php
$acceptSceneJoinCommand = new AcceptSceneJoinCommand(new SwimCore());
$acceptSceneJoinCommand->getPermission();
```


---

## Class: core\commands\DiscordCmd

**Defined in**: `src\core\commands\DiscordCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$discordCmd = new DiscordCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$discordCmd = new DiscordCmd(new SwimCore());
$discordCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$discordCmd = new DiscordCmd(new SwimCore());
$discordCmd->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$discordCmd = new DiscordCmd(new SwimCore());
$discordCmd->getPermission();
```


---

## Class: core\commands\DuelCommand

**Defined in**: `src\core\commands\DuelCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$duelCommand = new DuelCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$duelCommand = new DuelCommand(new SwimCore());
$duelCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$duelCommand = new DuelCommand(new SwimCore());
$duelCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$duelCommand = new DuelCommand(new SwimCore());
$duelCommand->getPermission();
```


---

## Class: core\commands\FlyCmd

**Defined in**: `src\core\commands\FlyCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$flyCmd = new FlyCmd(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$flyCmd = new FlyCmd(new SwimCore());
$flyCmd->execute(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$flyCmd = new FlyCmd(new SwimCore());
$flyCmd->getPermission();
```


---

## Class: core\commands\HubCmd

**Defined in**: `src\core\commands\HubCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$hubCmd = new HubCmd(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`

> @throws ScoreFactoryException


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$hubCmd = new HubCmd(new SwimCore());
$hubCmd->execute(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$hubCmd = new HubCmd(new SwimCore());
$hubCmd->getPermission();
```


---

## Class: core\commands\InfoCommand

**Defined in**: `src\core\commands\InfoCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$infoCommand = new InfoCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$infoCommand = new InfoCommand(new SwimCore());
$infoCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$infoCommand = new InfoCommand(new SwimCore());
$infoCommand->onRun(new CommandSender(), "example", []);
```


---

#### commandLogic

`private function commandLogic(CommandSender $sender, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$infoCommand = new InfoCommand(new SwimCore());
$infoCommand->commandLogic(new CommandSender(), []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$infoCommand = new InfoCommand(new SwimCore());
$infoCommand->getPermission();
```


---

## Class: core\commands\KickCommand

**Defined in**: `src\core\commands\KickCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $swimCore)`


**Parameters**:

- `$swimCore` (SwimCore) — 

**Example**:

```php
$kickCommand = new KickCommand(new SwimCore());
```


---

#### prepare

`public function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$kickCommand = new KickCommand(new SwimCore());
$kickCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$kickCommand = new KickCommand(new SwimCore());
$kickCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$kickCommand = new KickCommand(new SwimCore());
$kickCommand->getPermission();
```


---

## Class: core\commands\ListCommand

**Defined in**: `src\core\commands\ListCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$listCommand = new ListCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$listCommand = new ListCommand(new SwimCore());
$listCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\NickCmd

**Defined in**: `src\core\commands\NickCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$nickCmd = new NickCmd(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$nickCmd = new NickCmd(new SwimCore());
$nickCmd->execute(new CommandSender(), "example", []);
```


---

#### timeCheck

`private function timeCheck(int $rankLevel, SwimPlayer $sender): bool`


**Parameters**:

- `$rankLevel` (int) — 
- `$sender` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$nickCmd = new NickCmd(new SwimCore());
$nickCmd->timeCheck(123, new SwimPlayer());
```


---

#### staffAlert

`private function staffAlert(SwimPlayer $plr): void`


**Parameters**:

- `$plr` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nickCmd = new NickCmd(new SwimCore());
$nickCmd->staffAlert(new SwimPlayer());
```


---

## Class: core\commands\PartyCommand

**Defined in**: `src\core\commands\PartyCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$partyCommand = new PartyCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$partyCommand = new PartyCommand(new SwimCore());
$partyCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$partyCommand = new PartyCommand(new SwimCore());
$partyCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$partyCommand = new PartyCommand(new SwimCore());
$partyCommand->getPermission();
```


---

## Class: core\commands\PingCmd

**Defined in**: `src\core\commands\PingCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$pingCmd = new PingCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$pingCmd = new PingCmd(new SwimCore());
$pingCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$pingCmd = new PingCmd(new SwimCore());
$pingCmd->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$pingCmd = new PingCmd(new SwimCore());
$pingCmd->getPermission();
```


---

## Class: core\commands\QuickBan

**Defined in**: `src\core\commands\QuickBan.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$quickBan = new QuickBan(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$quickBan = new QuickBan(new SwimCore());
$quickBan->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$quickBan = new QuickBan(new SwimCore());
$quickBan->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$quickBan = new QuickBan(new SwimCore());
$quickBan->getPermission();
```


---

## Class: core\commands\RankCmd

**Defined in**: `src\core\commands\RankCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$rankCmd = new RankCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$rankCmd = new RankCmd(new SwimCore());
$rankCmd->prepare();
```


---

#### rankCommandLogic

`private function rankCommandLogic(CommandSender $sender, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$rankCmd = new RankCmd(new SwimCore());
$rankCmd->rankCommandLogic(new CommandSender(), []);
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$rankCmd = new RankCmd(new SwimCore());
$rankCmd->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$rankCmd = new RankCmd(new SwimCore());
$rankCmd->getPermission();
```


---

## Class: core\commands\RegionCommand

**Defined in**: `src\core\commands\RegionCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$regionCommand = new RegionCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$regionCommand = new RegionCommand(new SwimCore());
$regionCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\ReplyCommand

**Defined in**: `src\core\commands\ReplyCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$replyCommand = new ReplyCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$replyCommand = new ReplyCommand(new SwimCore());
$replyCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$replyCommand = new ReplyCommand(new SwimCore());
$replyCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$replyCommand = new ReplyCommand(new SwimCore());
$replyCommand->getPermission();
```


---

## Class: core\commands\SeeNick

**Defined in**: `src\core\commands\SeeNick.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$seeNick = new SeeNick(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$seeNick = new SeeNick(new SwimCore());
$seeNick->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$seeNick = new SeeNick(new SwimCore());
$seeNick->onRun(new CommandSender(), "example", []);
```


---

#### getPlayerFromNick

`public static function getPlayerFromNick(string $nick): ?SwimPlayer`


**Parameters**:

- `$nick` (string) — 

**Returns**: ?SwimPlayer


**Example**:

```php
SeeNick::getPlayerFromNick("example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$seeNick = new SeeNick(new SwimCore());
$seeNick->getPermission();
```


---

## Class: core\commands\SettingsCommand

**Defined in**: `src\core\commands\SettingsCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$settingsCommand = new SettingsCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$settingsCommand = new SettingsCommand(new SwimCore());
$settingsCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\SpectateCommand

**Defined in**: `src\core\commands\SpectateCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$spectateCommand = new SpectateCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$spectateCommand = new SpectateCommand(new SwimCore());
$spectateCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\StaffTP

**Defined in**: `src\core\commands\StaffTP.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$staffTP = new StaffTP(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$staffTP = new StaffTP(new SwimCore());
$staffTP->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$staffTP = new StaffTP(new SwimCore());
$staffTP->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$staffTP = new StaffTP(new SwimCore());
$staffTP->getPermission();
```


---

## Class: core\commands\StopCommand

**Defined in**: `src\core\commands\StopCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $swimCore)`


**Parameters**:

- `$swimCore` (SwimCore) — 

**Example**:

```php
$stopCommand = new StopCommand(new SwimCore());
```


---

#### prepare

`public function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$stopCommand = new StopCommand(new SwimCore());
$stopCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$stopCommand = new StopCommand(new SwimCore());
$stopCommand->onRun(new CommandSender(), "example", []);
```


---

#### __construct

`public function __construct(SwimCore $SwimCore)`


**Parameters**:

- `$SwimCore` (SwimCore) — 

**Example**:

```php
$stopCommand = new StopCommand(new SwimCore());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$stopCommand = new StopCommand(new SwimCore());
$stopCommand->onRun();
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$stopCommand = new StopCommand(new SwimCore());
$stopCommand->getPermission();
```


---

## Class: core\commands\TebexAlert

**Defined in**: `src\core\commands\TebexAlert.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$tebexAlert = new TebexAlert(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$tebexAlert = new TebexAlert(new SwimCore());
$tebexAlert->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$tebexAlert = new TebexAlert(new SwimCore());
$tebexAlert->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$tebexAlert = new TebexAlert(new SwimCore());
$tebexAlert->getPermission();
```


---

## Class: core\commands\TebexRank

**Defined in**: `src\core\commands\TebexRank.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$tebexRank = new TebexRank(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$tebexRank = new TebexRank(new SwimCore());
$tebexRank->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$tebexRank = new TebexRank(new SwimCore());
$tebexRank->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$tebexRank = new TebexRank(new SwimCore());
$tebexRank->getPermission();
```


---

## Class: core\commands\TellCmd

**Defined in**: `src\core\commands\TellCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$tellCmd = new TellCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$tellCmd = new TellCmd(new SwimCore());
$tellCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$tellCmd = new TellCmd(new SwimCore());
$tellCmd->onRun(new CommandSender(), "example", []);
```


---

#### messageLogic

`public static function messageLogic(CommandSender $sender, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
TellCmd::messageLogic(new CommandSender(), []);
```


---

#### staffMessage

`private static function staffMessage(SwimPlayer $sender, SwimPlayer $receiver, string $msg): void`


**Parameters**:

- `$sender` (SwimPlayer) — 
- `$receiver` (SwimPlayer) — 
- `$msg` (string) — 

**Returns**: void


**Example**:

```php
TellCmd::staffMessage(new SwimPlayer(), new SwimPlayer(), "example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$tellCmd = new TellCmd(new SwimCore());
$tellCmd->getPermission();
```


---

## Class: core\commands\cosmetic\ChatColorCommand

**Defined in**: `src\core\commands\cosmetic\ChatColorCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $swimCore)`


**Parameters**:

- `$swimCore` (SwimCore) — 

**Example**:

```php
$chatColorCommand = new ChatColorCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$chatColorCommand = new ChatColorCommand(new SwimCore());
$chatColorCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$chatColorCommand = new ChatColorCommand(new SwimCore());
$chatColorCommand->onRun(new CommandSender(), "example", []);
```


---

#### chatColorForm

`public static function chatColorForm(SwimPlayer $SwimPlayer): void`


**Parameters**:

- `$SwimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
ChatColorCommand::chatColorForm(new SwimPlayer());
```


---

#### handleChatColor

`private static function handleChatColor(SwimPlayer $sender, string $color): void`


**Parameters**:

- `$sender` (SwimPlayer) — 
- `$color` (string) — 

**Returns**: void


**Example**:

```php
ChatColorCommand::handleChatColor(new SwimPlayer(), "example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$chatColorCommand = new ChatColorCommand(new SwimCore());
$chatColorCommand->getPermission();
```


---

## Class: core\commands\cosmetic\CosmeticsCommand

**Defined in**: `src\core\commands\cosmetic\CosmeticsCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$cosmeticsCommand = new CosmeticsCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$cosmeticsCommand = new CosmeticsCommand(new SwimCore());
$cosmeticsCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$cosmeticsCommand = new CosmeticsCommand(new SwimCore());
$cosmeticsCommand->onRun(new CommandSender(), "example", []);
```


---

#### cosmeticsForm

`public static function cosmeticsForm(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
CosmeticsCommand::cosmeticsForm(new SwimPlayer());
```


---

#### checkInappropriateCosmetic

`public static function checkInappropriateCosmetic(string $in): bool`


**Parameters**:

- `$in` (string) — 

**Returns**: bool


**Example**:

```php
CosmeticsCommand::checkInappropriateCosmetic("example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$cosmeticsCommand = new CosmeticsCommand(new SwimCore());
$cosmeticsCommand->getPermission();
```


---

## Class: core\commands\cosmetic\KillMessageCommand

**Defined in**: `src\core\commands\cosmetic\KillMessageCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $swimCore)`


**Parameters**:

- `$swimCore` (SwimCore) — 

**Example**:

```php
$killMessageCommand = new KillMessageCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`


**Returns**: void


**Example**:

```php
$killMessageCommand = new KillMessageCommand(new SwimCore());
$killMessageCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$killMessageCommand = new KillMessageCommand(new SwimCore());
$killMessageCommand->onRun(new CommandSender(), "example", []);
```


---

#### setKillMessage

`public static function setKillMessage(SwimPlayer $divinityPlayer): void`


**Parameters**:

- `$divinityPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
KillMessageCommand::setKillMessage(new SwimPlayer());
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$killMessageCommand = new KillMessageCommand(new SwimCore());
$killMessageCommand->getPermission();
```


---

## Class: core\commands\cosmetic\ParticleTrailCommand

**Defined in**: `src\core\commands\cosmetic\ParticleTrailCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $swimCore)`


**Parameters**:

- `$swimCore` (SwimCore) — 

**Example**:

```php
$particleTrailCommand = new ParticleTrailCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$particleTrailCommand = new ParticleTrailCommand(new SwimCore());
$particleTrailCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$particleTrailCommand = new ParticleTrailCommand(new SwimCore());
$particleTrailCommand->onRun(new CommandSender(), "example", []);
```


---

#### particleTrailForm

`public static function particleTrailForm(SwimPlayer $SwimPlayer): void`


**Parameters**:

- `$SwimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
ParticleTrailCommand::particleTrailForm(new SwimPlayer());
```


---

#### handleParticleTrail

`private static function handleParticleTrail(SwimPlayer $sender, string $particle): void`


**Parameters**:

- `$sender` (SwimPlayer) — 
- `$particle` (string) — 

**Returns**: void


**Example**:

```php
ParticleTrailCommand::handleParticleTrail(new SwimPlayer(), "example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$particleTrailCommand = new ParticleTrailCommand(new SwimCore());
$particleTrailCommand->getPermission();
```


---

## Class: core\commands\cosmetic\TagCommand

**Defined in**: `src\core\commands\cosmetic\TagCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $xenonCore)`


**Parameters**:

- `$xenonCore` (SwimCore) — 

**Example**:

```php
$tagCommand = new TagCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$tagCommand = new TagCommand(new SwimCore());
$tagCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$tagCommand = new TagCommand(new SwimCore());
$tagCommand->onRun(new CommandSender(), "example", []);
```


---

#### tagForm

`public static function tagForm(SwimPlayer $SwimPlayer): void`


**Parameters**:

- `$SwimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
TagCommand::tagForm(new SwimPlayer());
```


---

#### handleTag

`private static function handleTag(SwimPlayer $sender, string $tag): void`


**Parameters**:

- `$sender` (SwimPlayer) — 
- `$tag` (string) — 

**Returns**: void


**Example**:

```php
TagCommand::handleTag(new SwimPlayer(), "example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$tagCommand = new TagCommand(new SwimCore());
$tagCommand->getPermission();
```


---

## Class: core\commands\debugCommands\CallBot

**Defined in**: `src\core\commands\debugCommands\CallBot.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$callBot = new CallBot(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`

> @throws ReflectionException


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$callBot = new CallBot(new SwimCore());
$callBot->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\CrashServerCommand

**Defined in**: `src\core\commands\debugCommands\CrashServerCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$crashServerCommand = new CrashServerCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$crashServerCommand = new CrashServerCommand(new SwimCore());
$crashServerCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\DebugReplayCommand

**Defined in**: `src\core\commands\debugCommands\DebugReplayCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$debugReplayCommand = new DebugReplayCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$debugReplayCommand = new DebugReplayCommand(new SwimCore());
$debugReplayCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\DebugSG

**Defined in**: `src\core\commands\debugCommands\DebugSG.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`


**Returns**: void


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->onRun(new CommandSender(), "example", []);
```


---

#### debugSG

`private function debugSG(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->debugSG(new SwimPlayer());
```


---

#### writeToJson

`private function writeToJson(array $foundBlocks): void`


**Parameters**:

- `$foundBlocks` (array) — 

**Returns**: void


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->writeToJson([]);
```


---

#### replace

`private function replace(SwimPlayer $swimPlayer, World $world, Block $block, int $x, int $y, int $z): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$world` (World) — 
- `$block` (Block) — 
- `$x` (int) — 
- `$y` (int) — 
- `$z` (int) — 

**Returns**: void


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->replace(new SwimPlayer(), new World(), new Block(), 123, 123, 123);
```


---

#### __construct

`public function __construct(Player $player, Vector3 $vecBlock, Block $block)`


**Parameters**:

- `$player` (Player) — 
- `$vecBlock` (Vector3) — 
- `$block` (Block) — 

**Example**:

```php
$debugSG = new DebugSG(new Player(), new Vector3(), new Block());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->onRun();
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$debugSG = new DebugSG(new SwimCore());
$debugSG->getPermission();
```


---

## Class: core\commands\debugCommands\DumpEvents

**Defined in**: `src\core\commands\debugCommands\DumpEvents.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$dumpEvents = new DumpEvents(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$dumpEvents = new DumpEvents(new SwimCore());
$dumpEvents->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$dumpEvents = new DumpEvents(new SwimCore());
$dumpEvents->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$dumpEvents = new DumpEvents(new SwimCore());
$dumpEvents->getPermission();
```


---

## Class: core\commands\debugCommands\EnableScrimsCommand

**Defined in**: `src\core\commands\debugCommands\EnableScrimsCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$enableScrimsCommand = new EnableScrimsCommand(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$enableScrimsCommand = new EnableScrimsCommand(new SwimCore());
$enableScrimsCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\EntityStatus

**Defined in**: `src\core\commands\debugCommands\EntityStatus.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$entityStatus = new EntityStatus();
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$entityStatus = new EntityStatus();
$entityStatus->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\name

**Defined in**: `src\core\commands\debugCommands\EntityStatus.php`

* @inheritDoc


### Methods

_No methods found_

## Class: core\commands\debugCommands\EventStartCommand

**Defined in**: `src\core\commands\debugCommands\EventStartCommand.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$eventStartCommand = new EventStartCommand();
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args)`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Example**:

```php
$eventStartCommand = new EventStartCommand();
$eventStartCommand->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\ForceEvent

**Defined in**: `src\core\commands\debugCommands\ForceEvent.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$forceEvent = new ForceEvent(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$forceEvent = new ForceEvent(new SwimCore());
$forceEvent->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$forceEvent = new ForceEvent(new SwimCore());
$forceEvent->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$forceEvent = new ForceEvent(new SwimCore());
$forceEvent->getPermission();
```


---

## Class: core\commands\debugCommands\GodCmd

**Defined in**: `src\core\commands\debugCommands\GodCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$godCmd = new GodCmd(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`

> @throws ScoreFactoryException


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$godCmd = new GodCmd(new SwimCore());
$godCmd->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\InstaWin

**Defined in**: `src\core\commands\debugCommands\InstaWin.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$instaWin = new InstaWin();
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args)`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Example**:

```php
$instaWin = new InstaWin();
$instaWin->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\LogPosition

**Defined in**: `src\core\commands\debugCommands\LogPosition.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$logPosition = new LogPosition(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$logPosition = new LogPosition(new SwimCore());
$logPosition->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$logPosition = new LogPosition(new SwimCore());
$logPosition->onRun(new CommandSender(), "example", []);
```


---

#### updatePositions

`private function updatePositions(SwimPlayer $sender): void`


**Parameters**:

- `$sender` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$logPosition = new LogPosition(new SwimCore());
$logPosition->updatePositions(new SwimPlayer());
```


---

#### write

`private function write(SwimPlayer $sender): void`


**Parameters**:

- `$sender` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$logPosition = new LogPosition(new SwimCore());
$logPosition->write(new SwimPlayer());
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$logPosition = new LogPosition(new SwimCore());
$logPosition->getPermission();
```


---

## Class: core\commands\debugCommands\MapDebug

**Defined in**: `src\core\commands\debugCommands\MapDebug.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$mapDebug = new MapDebug(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$mapDebug = new MapDebug(new SwimCore());
$mapDebug->execute(new CommandSender(), "example", []);
```


---

#### openMapTypesForm

`private function openMapTypesForm(SwimPlayer $player): void`

> Open the initial form to select a map type.


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$mapDebug = new MapDebug(new SwimCore());
$mapDebug->openMapTypesForm(new SwimPlayer());
```


---

#### openMapListForm

`private function openMapListForm(SwimPlayer $player, string $mapPoolKey, string $mapPoolName): void`

> Open the form that lists all maps from the selected map pool.


**Parameters**:

- `$player` (SwimPlayer) — 
- `$mapPoolKey` (string) — 
- `$mapPoolName` (string) — 

**Returns**: void


**Example**:

```php
$mapDebug = new MapDebug(new SwimCore());
$mapDebug->openMapListForm(new SwimPlayer(), "example", "example");
```


---

#### teleportPlayerToMap

`private function teleportPlayerToMap(SwimPlayer $player, string $mode, MapInfo $map): void`

> Teleports the player to the spawn position of the selected map.


**Parameters**:

- `$player` (SwimPlayer) — 
- `$mode` (string) — 
- `$map` (MapInfo) — 

**Returns**: void


**Example**:

```php
$mapDebug = new MapDebug(new SwimCore());
$mapDebug->teleportPlayerToMap(new SwimPlayer(), "example", new MapInfo());
```


---

#### getWorldBasedOnMode

`private function getWorldBasedOnMode(string $mode): World`

> Get the world based on the mode.


**Parameters**:

- `$mode` (string) — 

**Returns**: World


**Example**:

```php
$mapDebug = new MapDebug(new SwimCore());
$mapDebug->getWorldBasedOnMode("example");
```


---

## Class: core\commands\debugCommands\NukeTest

**Defined in**: `src\core\commands\debugCommands\NukeTest.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$nukeTest = new NukeTest(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$nukeTest = new NukeTest(new SwimCore());
$nukeTest->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$nukeTest = new NukeTest(new SwimCore());
$nukeTest->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$nukeTest = new NukeTest(new SwimCore());
$nukeTest->getPermission();
```


---

## Class: core\commands\debugCommands\PlaySoundCmd

**Defined in**: `src\core\commands\debugCommands\PlaySoundCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$playSoundCmd = new PlaySoundCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$playSoundCmd = new PlaySoundCmd(new SwimCore());
$playSoundCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$playSoundCmd = new PlaySoundCmd(new SwimCore());
$playSoundCmd->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$playSoundCmd = new PlaySoundCmd(new SwimCore());
$playSoundCmd->getPermission();
```


---

## Class: core\commands\debugCommands\PositionCommand

**Defined in**: `src\core\commands\debugCommands\PositionCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$positionCommand = new PositionCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$positionCommand = new PositionCommand(new SwimCore());
$positionCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$positionCommand = new PositionCommand(new SwimCore());
$positionCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$positionCommand = new PositionCommand(new SwimCore());
$positionCommand->getPermission();
```


---

## Class: core\commands\debugCommands\RestartCommand

**Defined in**: `src\core\commands\debugCommands\RestartCommand.php`


### Methods

#### __construct

`public function __construct(swimCore $swimCore)`


**Parameters**:

- `$swimCore` (swimCore) — 

**Example**:

```php
$restartCommand = new RestartCommand(new swimCore());
```


---

#### prepare

`public function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$restartCommand = new RestartCommand(new swimCore());
$restartCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$restartCommand = new RestartCommand(new swimCore());
$restartCommand->onRun(new CommandSender(), "example", []);
```


---

#### restartServer

`public function restartServer()`


**Example**:

```php
$restartCommand = new RestartCommand(new swimCore());
$restartCommand->restartServer();
```


---

#### __construct

`public function __construct(SwimCore $swimCore)`


**Parameters**:

- `$swimCore` (SwimCore) — 

**Example**:

```php
$restartCommand = new RestartCommand(new SwimCore());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$restartCommand = new RestartCommand(new swimCore());
$restartCommand->onRun();
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$restartCommand = new RestartCommand(new swimCore());
$restartCommand->getPermission();
```


---

## Class: core\commands\debugCommands\SceneDump

**Defined in**: `src\core\commands\debugCommands\SceneDump.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$sceneDump = new SceneDump(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$sceneDump = new SceneDump(new SwimCore());
$sceneDump->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$sceneDump = new SceneDump(new SwimCore());
$sceneDump->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$sceneDump = new SceneDump(new SwimCore());
$sceneDump->getPermission();
```


---

## Class: core\commands\debugCommands\ScenesCommand

**Defined in**: `src\core\commands\debugCommands\ScenesCommand.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$scenesCommand = new ScenesCommand(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$scenesCommand = new ScenesCommand(new SwimCore());
$scenesCommand->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$scenesCommand = new ScenesCommand(new SwimCore());
$scenesCommand->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$scenesCommand = new ScenesCommand(new SwimCore());
$scenesCommand->getPermission();
```


---

## Class: core\commands\debugCommands\similar

**Defined in**: `src\core\commands\debugCommands\ScrimboCommand.php`


### Methods

#### prepare

`protected function prepare(): void`

> Define all possible fields, plus the special "save" & "clear".


**Returns**: void


**Example**:

```php
$similar = new similar();
$similar->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> Main command logic.


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$similar = new similar();
$similar->onRun(new CommandSender(), "example", []);
```


---

#### addPosition

`private function addPosition(SwimPlayer $player, array &$data, string $field): void`

> Adds the player's current (floor) position to an array field.


**Parameters**:

- `$player` (SwimPlayer) — 
- `&$data` (array) — 
- `$field` (string) — 

**Returns**: void


**Example**:

```php
$similar = new similar();
$similar->addPosition(new SwimPlayer(), [], "example");
```


---

#### setPosition

`private function setPosition(SwimPlayer $player, array &$data, string $field): void`

> Sets the player's current (floor) position in a single field.


**Parameters**:

- `$player` (SwimPlayer) — 
- `&$data` (array) — 
- `$field` (string) — 

**Returns**: void


**Example**:

```php
$similar = new similar();
$similar->setPosition(new SwimPlayer(), [], "example");
```


---

#### saveData

`private function saveData(SwimPlayer $player, array $data): void`

> Saves the data to a JSON file in the plugin's data folder.


**Parameters**:

- `$player` (SwimPlayer) — 
- `$data` (array) — 

**Returns**: void


**Example**:

```php
$similar = new similar();
$similar->saveData(new SwimPlayer(), []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$similar = new similar();
$similar->getPermission();
```


---

## Class: core\commands\debugCommands\ShopWarsToggler

**Defined in**: `src\core\commands\debugCommands\ShopWarsToggler.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$shopWarsToggler = new ShopWarsToggler(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`


**Returns**: void


**Example**:

```php
$shopWarsToggler = new ShopWarsToggler(new SwimCore());
$shopWarsToggler->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$shopWarsToggler = new ShopWarsToggler(new SwimCore());
$shopWarsToggler->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$shopWarsToggler = new ShopWarsToggler(new SwimCore());
$shopWarsToggler->getPermission();
```


---

## Class: core\commands\debugCommands\SpawnEntityCmd

**Defined in**: `src\core\commands\debugCommands\SpawnEntityCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$spawnEntityCmd = new SpawnEntityCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$spawnEntityCmd = new SpawnEntityCmd(new SwimCore());
$spawnEntityCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @throws ReflectionException


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$spawnEntityCmd = new SpawnEntityCmd(new SwimCore());
$spawnEntityCmd->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$spawnEntityCmd = new SpawnEntityCmd(new SwimCore());
$spawnEntityCmd->getPermission();
```


---

## Class: core\commands\debugCommands\SwimCoreEditor

**Defined in**: `src\core\commands\debugCommands\SwimCoreEditor.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->onRun(new CommandSender(), "example", []);
```


---

#### openSceneInspectorForm

`private function openSceneInspectorForm(SwimPlayer $swimPlayer, Scene $scene): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openSceneInspectorForm(new SwimPlayer(), new Scene());
```


---

#### openPlayerListForm

`private function openPlayerListForm(SwimPlayer $swimPlayer, Scene $scene): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openPlayerListForm(new SwimPlayer(), new Scene());
```


---

#### openPlayerComponentsForm

`private function openPlayerComponentsForm(SwimPlayer $swimPlayer, SwimPlayer $targetPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$targetPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openPlayerComponentsForm(new SwimPlayer(), new SwimPlayer());
```


---

#### openClassFieldsForm

`private function openClassFieldsForm(SwimPlayer $swimPlayer, $object, $objectName = ''): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$object` (mixed) — 
- `$objectName` (mixed) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openClassFieldsForm(new SwimPlayer(), null, '');
```


---

#### getPropertyProtectionLevel

`private function getPropertyProtectionLevel(\ReflectionProperty $property): string`

> Helper function to determine the protection level of a property.


**Parameters**:

- `$property` (\ReflectionProperty) — 

**Returns**: string


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->getPropertyProtectionLevel(new \ReflectionProperty());
```


---

#### openObjectFieldsForm

`private function openObjectFieldsForm(SwimPlayer $swimPlayer, $object, $objectName = ''): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$object` (mixed) — 
- `$objectName` (mixed) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openObjectFieldsForm(new SwimPlayer(), null, '');
```


---

#### openObjectInspectorForm

`private function openObjectInspectorForm(SwimPlayer $swimPlayer, $object, $objectName = ''): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$object` (mixed) — 
- `$objectName` (mixed) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openObjectInspectorForm(new SwimPlayer(), null, '');
```


---

#### openArrayInspectorForm

`private function openArrayInspectorForm(SwimPlayer $swimPlayer, array $array, $arrayName = ''): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$array` (array) — 
- `$arrayName` (mixed) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openArrayInspectorForm(new SwimPlayer(), [], '');
```


---

#### openPrimitiveValueEditorForm

`private function openPrimitiveValueEditorForm(SwimPlayer $swimPlayer, array &$array, $key, $fieldName = ''): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `&$array` (array) — 
- `$key` (mixed) — 
- `$fieldName` (mixed) — 

**Returns**: void


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->openPrimitiveValueEditorForm(new SwimPlayer(), [], null, '');
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$swimCoreEditor = new SwimCoreEditor(new SwimCore());
$swimCoreEditor->getPermission();
```


---

## Class: core\commands\debugCommands\TestCmd

**Defined in**: `src\core\commands\debugCommands\TestCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$testCmd = new TestCmd(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$testCmd = new TestCmd(new SwimCore());
$testCmd->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\ToggleAC

**Defined in**: `src\core\commands\debugCommands\ToggleAC.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$toggleAC = new ToggleAC(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$toggleAC = new ToggleAC(new SwimCore());
$toggleAC->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\ToggleDebug

**Defined in**: `src\core\commands\debugCommands\ToggleDebug.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$toggleDebug = new ToggleDebug(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$toggleDebug = new ToggleDebug(new SwimCore());
$toggleDebug->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\ToggleRanked

**Defined in**: `src\core\commands\debugCommands\ToggleRanked.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$toggleRanked = new ToggleRanked(new SwimCore());
```


---

#### execute

`public function execute(CommandSender $sender, string $commandLabel, array $args): bool`


**Parameters**:

- `$sender` (CommandSender) — 
- `$commandLabel` (string) — 
- `$args` (array) — 

**Returns**: bool


**Example**:

```php
$toggleRanked = new ToggleRanked(new SwimCore());
$toggleRanked->execute(new CommandSender(), "example", []);
```


---

## Class: core\commands\debugCommands\WorldTP

**Defined in**: `src\core\commands\debugCommands\WorldTP.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$worldTP = new WorldTP(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @inheritDoc


**Returns**: void


**Example**:

```php
$worldTP = new WorldTP(new SwimCore());
$worldTP->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`

> @inheritDoc


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$worldTP = new WorldTP(new SwimCore());
$worldTP->onRun(new CommandSender(), "example", []);
```


---

#### getPermission

`public function getPermission(): string`


**Returns**: string


**Example**:

```php
$worldTP = new WorldTP(new SwimCore());
$worldTP->getPermission();
```


---

## Class: core\commands\punish\BanCmd

**Defined in**: `src\core\commands\Punish\BanCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$banCmd = new BanCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$banCmd = new BanCmd(new SwimCore());
$banCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$banCmd = new BanCmd(new SwimCore());
$banCmd->onRun(new CommandSender(), "example", []);
```


---

## Class: core\commands\punish\MuteCmd

**Defined in**: `src\core\commands\Punish\MuteCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$muteCmd = new MuteCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$muteCmd = new MuteCmd(new SwimCore());
$muteCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$muteCmd = new MuteCmd(new SwimCore());
$muteCmd->onRun(new CommandSender(), "example", []);
```


---

## Class: core\commands\punish\PunishCmd

**Defined in**: `src\core\commands\Punish\PunishCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$punishCmd = new PunishCmd(new SwimCore());
```


---

#### prepare

`public function prepare(): void`


**Returns**: void


**Example**:

```php
$punishCmd = new PunishCmd(new SwimCore());
$punishCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$punishCmd = new PunishCmd(new SwimCore());
$punishCmd->onRun(new CommandSender(), "example", []);
```


---

#### punishmentLogic

`public static function punishmentLogic(CommandSender $sender, string $punishment, array $args, SwimCore $core): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$punishment` (string) — 
- `$args` (array) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
PunishCmd::punishmentLogic(new CommandSender(), "example", [], new SwimCore());
```


---

#### applyPunishment

`private static function applyPunishment(CommandSender $sender, string $playerName, int $severity, string $reason, string $type, SwimCore $core): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$playerName` (string) — 
- `$severity` (int) — 
- `$reason` (string) — 
- `$type` (string) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
PunishCmd::applyPunishment(new CommandSender(), "example", 123, "example", "example", new SwimCore());
```


---

#### setPunishmentData

`private static function setPunishmentData(string $playerName, string $xuid, int $timeOffset, string $reason, string $type): void`


**Parameters**:

- `$playerName` (string) — 
- `$xuid` (string) — 
- `$timeOffset` (int) — 
- `$reason` (string) — 
- `$type` (string) — 

**Returns**: void


**Example**:

```php
PunishCmd::setPunishmentData("example", "example", 123, "example", "example");
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$punishCmd = new PunishCmd(new SwimCore());
$punishCmd->getPermission();
```


---

## Class: core\commands\unpunish\UnbanCmd

**Defined in**: `src\core\commands\Unpunish\UnbanCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$unbanCmd = new UnbanCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$unbanCmd = new UnbanCmd(new SwimCore());
$unbanCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$unbanCmd = new UnbanCmd(new SwimCore());
$unbanCmd->onRun(new CommandSender(), "example", []);
```


---

## Class: core\commands\unpunish\UnmuteCmd

**Defined in**: `src\core\commands\Unpunish\UnmuteCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$unmuteCmd = new UnmuteCmd(new SwimCore());
```


---

#### prepare

`protected function prepare(): void`

> @throws ArgumentOrderException


**Returns**: void


**Example**:

```php
$unmuteCmd = new UnmuteCmd(new SwimCore());
$unmuteCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$unmuteCmd = new UnmuteCmd(new SwimCore());
$unmuteCmd->onRun(new CommandSender(), "example", []);
```


---

## Class: core\commands\unpunish\UnPunishCmd

**Defined in**: `src\core\commands\Unpunish\UnPunishCmd.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$unPunishCmd = new UnPunishCmd(new SwimCore());
```


---

#### prepare

`public function prepare(): void`


**Returns**: void


**Example**:

```php
$unPunishCmd = new UnPunishCmd(new SwimCore());
$unPunishCmd->prepare();
```


---

#### onRun

`public function onRun(CommandSender $sender, string $aliasUsed, array $args): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$aliasUsed` (string) — 
- `$args` (array) — 

**Returns**: void


**Example**:

```php
$unPunishCmd = new UnPunishCmd(new SwimCore());
$unPunishCmd->onRun(new CommandSender(), "example", []);
```


---

#### punishmentLogic

`public static function punishmentLogic(CommandSender $sender, string $playerName, string $punishment, SwimCore $core): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$playerName` (string) — 
- `$punishment` (string) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
UnPunishCmd::punishmentLogic(new CommandSender(), "example", "example", new SwimCore());
```


---

#### removePunishment

`private static function removePunishment(CommandSender $sender, string $playerName, string $type): void`


**Parameters**:

- `$sender` (CommandSender) — 
- `$playerName` (string) — 
- `$type` (string) — 

**Returns**: void


**Example**:

```php
UnPunishCmd::removePunishment(new CommandSender(), "example", "example");
```


---

#### unmuteInGame

`private static function unmuteInGame(string $playerName, SwimCore $core): void`


**Parameters**:

- `$playerName` (string) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
UnPunishCmd::unmuteInGame("example", new SwimCore());
```


---

#### getPermission

`public function getPermission(): ?string`


**Returns**: ?string


**Example**:

```php
$unPunishCmd = new UnPunishCmd(new SwimCore());
$unPunishCmd->getPermission();
```


---

## Class: core\communicator\Communicator

**Defined in**: `src\core\communicator\Communicator.php`


### Methods

#### getOtherRegions

`public function getOtherRegions(): array`

> @var Region[] */


**Returns**: array


**Example**:

```php
$communicator = new Communicator();
$communicator->getOtherRegions();
```


---

## Class: core\communicator\CommunicatorThread

**Defined in**: `src\core\communicator\CommunicatorThread.php`


### Methods

#### __construct

`public function __construct(protected ThreadSafeArray         $mainToThreadBuffer, protected ThreadSafeArray         $threadToMainBuffer, protected SleeperHandlerEntry     $sleeperEntry, private readonly ThreadSafeLogger $logger, private readonly string           $regionName, private readonly string           $serverIp, private readonly int              $serverPort)`


**Parameters**:

- `protected ThreadSafeArray         $mainToThreadBuffer` (mixed) — 
- `protected ThreadSafeArray         $threadToMainBuffer` (mixed) — 
- `protected SleeperHandlerEntry     $sleeperEntry` (mixed) — 
- `private readonly ThreadSafeLogger $logger` (mixed) — 
- `private readonly string           $regionName` (mixed) — 
- `private readonly string           $serverIp` (mixed) — 
- `private readonly int              $serverPort` (mixed) — 

**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
```


---

#### onRun

`protected function onRun(): void`


**Returns**: void


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->onRun();
```


---

#### connect

`private function connect()`


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->connect();
```


---

#### runClient

`private function runClient(PthreadsChannelReader $pthreadReader, SnoozeAwarePthreadsChannelWriter $pthreadWriter): void`


**Parameters**:

- `$pthreadReader` (PthreadsChannelReader) — 
- `$pthreadWriter` (SnoozeAwarePthreadsChannelWriter) — 

**Returns**: void


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->runClient(new PthreadsChannelReader(), new SnoozeAwarePthreadsChannelWriter());
```


---

#### tickProcesser

`private function tickProcesser(PthreadsChannelReader $pthreadReader, SnoozeAwarePthreadsChannelWriter $pthreadWriter): void`


**Parameters**:

- `$pthreadReader` (PthreadsChannelReader) — 
- `$pthreadWriter` (SnoozeAwarePthreadsChannelWriter) — 

**Returns**: void


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->tickProcesser(new PthreadsChannelReader(), new SnoozeAwarePthreadsChannelWriter());
```


---

#### close

`public function close(): void`


**Returns**: void


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->close();
```


---

#### reconnect

`private function reconnect(string $data, bool $wait = false): void`


**Parameters**:

- `$data` (string) — 
- `$wait` (bool) — 

**Returns**: void


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->reconnect("example", false);
```


---

#### tick

`private function tick(PthreadsChannelReader $pthreadReader, SnoozeAwarePthreadsChannelWriter $pthreadWriter): void`


**Parameters**:

- `$pthreadReader` (PthreadsChannelReader) — 
- `$pthreadWriter` (SnoozeAwarePthreadsChannelWriter) — 

**Returns**: void


**Example**:

```php
$communicatorThread = new CommunicatorThread(null, null, null, null, "example", "example", null);
$communicatorThread->tick(new PthreadsChannelReader(), new SnoozeAwarePthreadsChannelWriter());
```


---

## Class: core\communicator\DiscordCommandSender

**Defined in**: `src\core\communicator\DiscordCommandSender.php`


### Methods

#### __construct

`public function __construct(private readonly Communicator $communicator, private readonly Language     $language, private readonly SwimCore     $core, private readonly string       $requestId, private readonly array|null   $userPerms, private readonly array        $roles, private readonly string       $senderName, private readonly string       $channelId, private readonly string       $userId)`


**Parameters**:

- `private readonly Communicator $communicator` (mixed) — 
- `private readonly Language     $language` (mixed) — 
- `private readonly SwimCore     $core` (mixed) — 
- `private readonly string       $requestId` (mixed) — 
- `private readonly array|null   $userPerms` (mixed) — 
- `private readonly array        $roles` (mixed) — 
- `private readonly string       $senderName` (mixed) — 
- `private readonly string       $channelId` (mixed) — 
- `private readonly string       $userId` (mixed) — 

**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
```


---

#### getServer

`public function getServer(): Server`


**Returns**: Server


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->getServer();
```


---

#### getLanguage

`public function getLanguage(): Language`


**Returns**: Language


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->getLanguage();
```


---

#### getName

`public function getName(): string`


**Returns**: string


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->getName();
```


---

#### getPermLevel

`public function getPermLevel(): int`


**Returns**: int


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->getPermLevel();
```


---

#### getScreenLineHeight

`public function getScreenLineHeight(): int`


**Returns**: int


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->getScreenLineHeight();
```


---

#### setScreenLineHeight

`public function setScreenLineHeight(?int $height): void`


**Parameters**:

- `$height` (?int) — 

**Returns**: void


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->setScreenLineHeight(123);
```


---

#### sendMessage

`public function sendMessage(Translatable|string $message): void`


**Parameters**:

- `$message` (Translatable|string) — 

**Returns**: void


**Example**:

```php
$discordCommandSender = new DiscordCommandSender(null, null, null, "example", null, null, "example", "example", "example");
$discordCommandSender->sendMessage(new Translatable());
```


---

## Class: core\communicator\DiscordInfo

**Defined in**: `src\core\communicator\DiscordInfo.php`


### Methods

#### __construct

`public function __construct(public string $boosterRole = "", public string $youtubeRole = "", public string $helperRole = "", public string $modRole = "", public string $ownerRole = "", public string $acChannel = "", public string $linkAlertsChannel = "")`


**Parameters**:

- `public string $boosterRole = ""` (mixed) — 
- `public string $youtubeRole = ""` (mixed) — 
- `public string $helperRole = ""` (mixed) — 
- `public string $modRole = ""` (mixed) — 
- `public string $ownerRole = ""` (mixed) — 
- `public string $acChannel = ""` (mixed) — 
- `public string $linkAlertsChannel = ""` (mixed) — 

**Example**:

```php
$discordInfo = new DiscordInfo("example", "example", "example", "example", "example", "example", "example");
```


---

## Class: core\communicator\packet\DisconnectPacket

**Defined in**: `src\core\communicator\packet\DisconnectPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$disconnectPacket = new DisconnectPacket();
$disconnectPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$disconnectPacket = new DisconnectPacket();
$disconnectPacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\DiscordCommandExecutePacket

**Defined in**: `src\core\communicator\packet\DiscordCommandExecutePacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordCommandExecutePacket = new DiscordCommandExecutePacket();
$discordCommandExecutePacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordCommandExecutePacket = new DiscordCommandExecutePacket();
$discordCommandExecutePacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$discordCommandExecutePacket = new DiscordCommandExecutePacket();
$discordCommandExecutePacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\DiscordCommandMessagePacket

**Defined in**: `src\core\communicator\packet\DiscordCommandMessagePacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordCommandMessagePacket = new DiscordCommandMessagePacket();
$discordCommandMessagePacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordCommandMessagePacket = new DiscordCommandMessagePacket();
$discordCommandMessagePacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\DiscordEmbedSendPacket

**Defined in**: `src\core\communicator\packet\DiscordEmbedSendPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordEmbedSendPacket = new DiscordEmbedSendPacket();
$discordEmbedSendPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordEmbedSendPacket = new DiscordEmbedSendPacket();
$discordEmbedSendPacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\DiscordInfoPacket

**Defined in**: `src\core\communicator\packet\DiscordInfoPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordInfoPacket = new DiscordInfoPacket();
$discordInfoPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordInfoPacket = new DiscordInfoPacket();
$discordInfoPacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$discordInfoPacket = new DiscordInfoPacket();
$discordInfoPacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\DiscordLinkInfoPacket

**Defined in**: `src\core\communicator\packet\DiscordLinkInfoPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordLinkInfoPacket = new DiscordLinkInfoPacket();
$discordLinkInfoPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordLinkInfoPacket = new DiscordLinkInfoPacket();
$discordLinkInfoPacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$discordLinkInfoPacket = new DiscordLinkInfoPacket();
$discordLinkInfoPacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\DiscordLinkRequestPacket

**Defined in**: `src\core\communicator\packet\DiscordLinkRequestPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordLinkRequestPacket = new DiscordLinkRequestPacket();
$discordLinkRequestPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordLinkRequestPacket = new DiscordLinkRequestPacket();
$discordLinkRequestPacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\DiscordUserRequestPacket

**Defined in**: `src\core\communicator\packet\DiscordUserRequestPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordUserRequestPacket = new DiscordUserRequestPacket();
$discordUserRequestPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordUserRequestPacket = new DiscordUserRequestPacket();
$discordUserRequestPacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\DiscordUserResponsePacket

**Defined in**: `src\core\communicator\packet\DiscordUserResponsePacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordUserResponsePacket = new DiscordUserResponsePacket();
$discordUserResponsePacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$discordUserResponsePacket = new DiscordUserResponsePacket();
$discordUserResponsePacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$discordUserResponsePacket = new DiscordUserResponsePacket();
$discordUserResponsePacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\OtherRegionsPacket

**Defined in**: `src\core\communicator\packet\OtherRegionsPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$otherRegionsPacket = new OtherRegionsPacket();
$otherRegionsPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$otherRegionsPacket = new OtherRegionsPacket();
$otherRegionsPacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$otherRegionsPacket = new OtherRegionsPacket();
$otherRegionsPacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\Packet

**Defined in**: `src\core\communicator\packet\Packet.php`


### Methods

#### pid

`public function pid(): PacketId`


**Returns**: PacketId


**Example**:

```php
$packet = new Packet();
$packet->pid();
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$packet = new Packet();
$packet->encode(new PacketSerializer());
```


---

#### getName

`public function getName(): string`


**Returns**: string


**Example**:

```php
$packet = new Packet();
$packet->getName();
```


---

#### decode

`public static function decode(PacketSerializer $serializer, Communicator $communicator): ?self`


**Parameters**:

- `$serializer` (PacketSerializer) — 
- `$communicator` (Communicator) — 

**Returns**: ?self


**Example**:

```php
Packet::decode(new PacketSerializer(), new Communicator());
```


---

#### encodeToString

`public function encodeToString(): string`


**Returns**: string


**Example**:

```php
$packet = new Packet();
$packet->encodeToString();
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$packet = new Packet();
$packet->encodePayload(new PacketSerializer());
```


---

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$packet = new Packet();
$packet->decodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$packet = new Packet();
$packet->handle(new Communicator());
```


---

## Class: core\communicator\packet\PacketDecoder

**Defined in**: `src\core\communicator\packet\PacketDecoder.php`


### Methods

#### decodeFromString

`public function decodeFromString(string $buf): array`


**Parameters**:

- `$buf` (string) — 

**Returns**: array


**Example**:

```php
$packetDecoder = new PacketDecoder();
$packetDecoder->decodeFromString("example");
```


---

#### decodeFromStringCommunicator

`public function decodeFromStringCommunicator(string $buf, Communicator $communicator): array`


**Parameters**:

- `$buf` (string) — 
- `$communicator` (Communicator) — 

**Returns**: array


**Example**:

```php
$packetDecoder = new PacketDecoder();
$packetDecoder->decodeFromStringCommunicator("example", new Communicator());
```


---

## Class: core\communicator\packet\PacketPool

**Defined in**: `src\core\communicator\packet\PacketPool.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$packetPool = new PacketPool();
```


---

#### registerPacket

`public function registerPacket(Packet $packet): void`


**Parameters**:

- `$packet` (Packet) — 

**Returns**: void


**Example**:

```php
$packetPool = new PacketPool();
$packetPool->registerPacket(new Packet());
```


---

#### getPacketById

`public function getPacketById(int $id): ?Packet`


**Parameters**:

- `$id` (int) — 

**Returns**: ?Packet


**Example**:

```php
$packetPool = new PacketPool();
$packetPool->getPacketById(123);
```


---

## Class: core\communicator\packet\PacketSerializer

**Defined in**: `src\core\communicator\packet\PacketSerializer.php`


### Methods

#### putString

`public function putString(string $str): void`


**Parameters**:

- `$str` (string) — 

**Returns**: void


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->putString("example");
```


---

#### getString

`public function getString(): string`


**Returns**: string


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->getString();
```


---

#### putArray

`public function putArray(array $arr, Closure $writer): void`


**Parameters**:

- `$arr` (array) — 
- `$writer` (Closure) — 

**Returns**: void


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->putArray([], new Closure());
```


---

#### getArray

`public function getArray(Closure $reader): array`


**Parameters**:

- `$reader` (Closure) — 

**Returns**: array


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->getArray(new Closure());
```


---

#### putMap

`public function putMap(array $map, Closure $keyWriter, Closure $valueWriter): void`


**Parameters**:

- `$map` (array) — 
- `$keyWriter` (Closure) — 
- `$valueWriter` (Closure) — 

**Returns**: void


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->putMap([], new Closure(), new Closure());
```


---

#### getMap

`public function getMap(Closure $keyReader, Closure $valueReader): array`


**Parameters**:

- `$keyReader` (Closure) — 
- `$valueReader` (Closure) — 

**Returns**: array


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->getMap(new Closure(), new Closure());
```


---

#### getOptional

`public function getOptional(Closure $reader): mixed`

> @phpstan-template T


**Parameters**:

- `$reader` (Closure) — 

**Returns**: mixed


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->getOptional(new Closure());
```


---

#### putOptional

`public function putOptional(mixed $value, Closure $writer): void`

> @phpstan-template T


**Parameters**:

- `$value` (mixed) — 
- `$writer` (Closure) — 

**Returns**: void


**Example**:

```php
$packetSerializer = new PacketSerializer();
$packetSerializer->putOptional(new mixed(), new Closure());
```


---

## Class: core\communicator\packet\PlayerListRequestPacket

**Defined in**: `src\core\communicator\packet\PlayerListRequestPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$playerListRequestPacket = new PlayerListRequestPacket();
$playerListRequestPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$playerListRequestPacket = new PlayerListRequestPacket();
$playerListRequestPacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$playerListRequestPacket = new PlayerListRequestPacket();
$playerListRequestPacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\PlayerListResponsePacket

**Defined in**: `src\core\communicator\packet\PlayerListResponsePacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$playerListResponsePacket = new PlayerListResponsePacket();
$playerListResponsePacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$playerListResponsePacket = new PlayerListResponsePacket();
$playerListResponsePacket->encodePayload(new PacketSerializer());
```


---

#### handle

`protected function handle(Communicator $communicator): void`


**Parameters**:

- `$communicator` (Communicator) — 

**Returns**: void


**Example**:

```php
$playerListResponsePacket = new PlayerListResponsePacket();
$playerListResponsePacket->handle(new Communicator());
```


---

## Class: core\communicator\packet\ServerInfoPacket

**Defined in**: `src\core\communicator\packet\ServerInfoPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$serverInfoPacket = new ServerInfoPacket();
$serverInfoPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$serverInfoPacket = new ServerInfoPacket();
$serverInfoPacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\UpdateDiscordRolesPacket

**Defined in**: `src\core\communicator\packet\UpdateDiscordRolesPacket.php`


### Methods

#### decodePayload

`protected function decodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$updateDiscordRolesPacket = new UpdateDiscordRolesPacket();
$updateDiscordRolesPacket->decodePayload(new PacketSerializer());
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$updateDiscordRolesPacket = new UpdateDiscordRolesPacket();
$updateDiscordRolesPacket->encodePayload(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\CrashInfo

**Defined in**: `src\core\communicator\packet\types\CrashInfo.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$crashInfo = new CrashInfo();
```


---

#### create

`public static function create(string $type, string $message, string $file, int $line, array $trace): self`


**Parameters**:

- `$type` (string) — 
- `$message` (string) — 
- `$file` (string) — 
- `$line` (int) — 
- `$trace` (array) — 

**Returns**: self


**Example**:

```php
CrashInfo::create("example", "example", "example", 123, []);
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$crashInfo = new CrashInfo();
$crashInfo->encode(new PacketSerializer());
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$crashInfo = new CrashInfo();
$crashInfo->decode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\Region

**Defined in**: `src\core\communicator\packet\types\Region.php`


### Methods

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$region = new Region();
$region->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$region = new Region();
$region->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Author

**Defined in**: `src\core\communicator\packet\types\embed\Author.php`


### Methods

#### __construct

`public function __construct(public string $name = "", public string $url = "", public string $iconUrl = "", public string $proxyIconUrl = "")`


**Parameters**:

- `public string $name = ""` (mixed) — 
- `public string $url = ""` (mixed) — 
- `public string $iconUrl = ""` (mixed) — 
- `public string $proxyIconUrl = ""` (mixed) — 

**Example**:

```php
$author = new Author("example", "example", "example", "example");
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$author = new Author("example", "example", "example", "example");
$author->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$author = new Author("example", "example", "example", "example");
$author->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Embed

**Defined in**: `src\core\communicator\packet\types\embed\Embed.php`


### Methods

#### __construct

`public function __construct(public string    $title = "", public string    $description = "", public string    $url = "", public string    $type = "", public string    $timestamp = "", public int       $color = 0, public ?Footer   $footer = null, public ?Image    $image = null, public ?Image    $thumbnail = null, public ?Video    $video = null, public ?Provider $provider = null, public ?Author   $author = null, private array    $fields = [])`


**Parameters**:

- `public string    $title = ""` (mixed) — 
- `public string    $description = ""` (mixed) — 
- `public string    $url = ""` (mixed) — 
- `public string    $type = ""` (mixed) — 
- `public string    $timestamp = ""` (mixed) — 
- `public int       $color = 0` (mixed) — 
- `public ?Footer   $footer = null` (mixed) — 
- `public ?Image    $image = null` (mixed) — 
- `public ?Image    $thumbnail = null` (mixed) — 
- `public ?Video    $video = null` (mixed) — 
- `public ?Provider $provider = null` (mixed) — 
- `public ?Author   $author = null` (mixed) — 
- `private array    $fields = []` (mixed) — 

**Example**:

```php
$embed = new Embed("example", "example", "example", "example", "example", null, null, null, null, 123, 123, null, null);
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$embed = new Embed("example", "example", "example", "example", "example", null, null, null, null, 123, 123, null, null);
$embed->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$embed = new Embed("example", "example", "example", "example", "example", null, null, null, null, 123, 123, null, null);
$embed->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Field

**Defined in**: `src\core\communicator\packet\types\embed\Field.php`


### Methods

#### __construct

`public function __construct(public string $name = "", public string $value = "", public bool   $inline = false)`


**Parameters**:

- `public string $name = ""` (mixed) — 
- `public string $value = ""` (mixed) — 
- `public bool   $inline = false` (mixed) — 

**Example**:

```php
$field = new Field("example", "example", null);
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$field = new Field("example", "example", null);
$field->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$field = new Field("example", "example", null);
$field->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Footer

**Defined in**: `src\core\communicator\packet\types\embed\Footer.php`


### Methods

#### __construct

`public function __construct(public string $text = "", public string $iconUrl = "", public string $proxyIconUrl = "")`


**Parameters**:

- `public string $text = ""` (mixed) — 
- `public string $iconUrl = ""` (mixed) — 
- `public string $proxyIconUrl = ""` (mixed) — 

**Example**:

```php
$footer = new Footer("example", "example", "example");
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$footer = new Footer("example", "example", "example");
$footer->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$footer = new Footer("example", "example", "example");
$footer->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Image

**Defined in**: `src\core\communicator\packet\types\embed\Image.php`


### Methods

#### __construct

`public function __construct(public string $url = "", public string $proxyUrl = "", public int    $width = 0, public int    $height = 0)`


**Parameters**:

- `public string $url = ""` (mixed) — 
- `public string $proxyUrl = ""` (mixed) — 
- `public int    $width = 0` (mixed) — 
- `public int    $height = 0` (mixed) — 

**Example**:

```php
$image = new Image("example", "example", 123, null);
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$image = new Image("example", "example", 123, null);
$image->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$image = new Image("example", "example", 123, null);
$image->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Provider

**Defined in**: `src\core\communicator\packet\types\embed\Provider.php`


### Methods

#### __construct

`public function __construct(public string $name = "", public string $url = "")`


**Parameters**:

- `public string $name = ""` (mixed) — 
- `public string $url = ""` (mixed) — 

**Example**:

```php
$provider = new Provider("example", "example");
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$provider = new Provider("example", "example");
$provider->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$provider = new Provider("example", "example");
$provider->encode(new PacketSerializer());
```


---

## Class: core\communicator\packet\types\embed\Video

**Defined in**: `src\core\communicator\packet\types\embed\Video.php`


### Methods

#### __construct

`public function __construct(public string $url = "", public int    $width = 0, public int    $height = 0)`


**Parameters**:

- `public string $url = ""` (mixed) — 
- `public int    $width = 0` (mixed) — 
- `public int    $height = 0` (mixed) — 

**Example**:

```php
$video = new Video("example", 123, null);
```


---

#### decode

`public function decode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$video = new Video("example", 123, null);
$video->decode(new PacketSerializer());
```


---

#### encode

`public function encode(PacketSerializer $serializer): void`


**Parameters**:

- `$serializer` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$video = new Video("example", 123, null);
$video->encode(new PacketSerializer());
```


---

## Class: core\custom\bases\ItemHolderActor

**Defined in**: `src\core\custom\bases\ItemHolderActor.php`


### Methods

#### __construct

`public function __construct(Location $location, ?Scene $parentScene = null, int $inventorySize = 1, ?CompoundTag $nbt = null, ?Skin $skin = null)`


**Parameters**:

- `$location` (Location) — 
- `$parentScene` (?Scene) — 
- `$inventorySize` (int) — 
- `$nbt` (?CompoundTag) — 
- `$skin` (?Skin) — 

**Example**:

```php
$itemHolderActor = new ItemHolderActor(new Location(), null, 1, null, null);
```


---

#### initEntity

`protected function initEntity(CompoundTag $nbt): void`

> @throws ReflectionException


**Parameters**:

- `$nbt` (CompoundTag) — 

**Returns**: void


**Example**:

```php
$itemHolderActor = new ItemHolderActor(new Location(), null, 1, null, null);
$itemHolderActor->initEntity(new CompoundTag());
```


---

#### syncMainHandInventory

`public function syncMainHandInventory(?array $targets = null): void`


**Parameters**:

- `$targets` (?array) — 

**Returns**: void


**Example**:

```php
$itemHolderActor = new ItemHolderActor(new Location(), null, 1, null, null);
$itemHolderActor->syncMainHandInventory(null);
```


---

#### sendSpawnPacket

`protected function sendSpawnPacket(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$itemHolderActor = new ItemHolderActor(new Location(), null, 1, null, null);
$itemHolderActor->sendSpawnPacket(new Player());
```


---

#### saveNBT

`public function saveNBT(): CompoundTag`


**Returns**: CompoundTag


**Example**:

```php
$itemHolderActor = new ItemHolderActor(new Location(), null, 1, null, null);
$itemHolderActor->saveNBT();
```


---

#### getMainHandInventory

`public function getMainHandInventory(): MainHandInventory`


**Returns**: MainHandInventory


**Example**:

```php
$itemHolderActor = new ItemHolderActor(new Location(), null, 1, null, null);
$itemHolderActor->getMainHandInventory();
```


---

## Class: core\custom\bases\MainHandInventory

**Defined in**: `src\core\custom\bases\MainHandInventory.php`


### Methods

#### __construct

`public function __construct(Actor $holder, int $size = 1)`


**Parameters**:

- `$holder` (Actor) — 
- `$size` (int) — 

**Example**:

```php
$mainHandInventory = new MainHandInventory(new Actor(), 1);
```


---

#### getHolder

`public function getHolder(): Actor`


**Returns**: Actor


**Example**:

```php
$mainHandInventory = new MainHandInventory(new Actor(), 1);
$mainHandInventory->getHolder();
```


---

## Class: core\custom\behaviors\entity_behaviors\AnimationCycler

**Defined in**: `src\core\custom\behaviors\entity_behaviors\AnimationCycler.php`


### Methods

#### setAnimations

`public function setAnimations(array $animations): void`


**Parameters**:

- `$animations` (array) — 

**Returns**: void


**Example**:

```php
$animationCycler = new AnimationCycler();
$animationCycler->setAnimations([]);
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$animationCycler = new AnimationCycler();
$animationCycler->init();
```


---

#### setDelay

`public function setDelay(int $d): void`


**Parameters**:

- `$d` (int) — 

**Returns**: void


**Example**:

```php
$animationCycler = new AnimationCycler();
$animationCycler->setDelay(123);
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$animationCycler = new AnimationCycler();
$animationCycler->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$animationCycler = new AnimationCycler();
$animationCycler->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$animationCycler = new AnimationCycler();
$animationCycler->exit();
```


---

## Class: core\custom\behaviors\entity_behaviors\FaceNearest

**Defined in**: `src\core\custom\behaviors\entity_behaviors\FaceNearest.php`


### Methods

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$faceNearest = new FaceNearest();
$faceNearest->init();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$faceNearest = new FaceNearest();
$faceNearest->updateSecond();
```


---

#### look

`private function look(): void`


**Returns**: void


**Example**:

```php
$faceNearest = new FaceNearest();
$faceNearest->look();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$faceNearest = new FaceNearest();
$faceNearest->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$faceNearest = new FaceNearest();
$faceNearest->exit();
```


---

#### findNearest

`private function findNearest(): void`

> Finds the nearest non-spectator player to this entity


**Returns**: void


**Example**:

```php
$faceNearest = new FaceNearest();
$faceNearest->findNearest();
```


---

## Class: core\custom\behaviors\player_event_behaviors\DoubleJump

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\DoubleJump.php`


### Methods

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$doubleJump = new DoubleJump();
$doubleJump->init();
```


---

#### eventUpdateTick

`public function eventUpdateTick(): void`


**Returns**: void


**Example**:

```php
$doubleJump = new DoubleJump();
$doubleJump->eventUpdateTick();
```


---

#### dataPacketReceiveEvent

`protected function dataPacketReceiveEvent(DataPacketReceiveEvent $event): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$doubleJump = new DoubleJump();
$doubleJump->dataPacketReceiveEvent(new DataPacketReceiveEvent());
```


---

#### jump

`private function jump(): void`


**Returns**: void


**Example**:

```php
$doubleJump = new DoubleJump();
$doubleJump->jump();
```


---

#### isCanJumpAgain

`public function isCanJumpAgain(): bool`


**Returns**: bool


**Example**:

```php
$doubleJump = new DoubleJump();
$doubleJump->isCanJumpAgain();
```


---

## Class: core\custom\behaviors\player_event_behaviors\MaxDistance

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\MaxDistance.php`


### Methods

#### eventUpdateSecond

`public function eventUpdateSecond(): void`


**Returns**: void


**Example**:

```php
$maxDistance = new MaxDistance();
$maxDistance->eventUpdateSecond();
```


---

## Class: core\custom\behaviors\player_event_behaviors\NoFall

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\NoFall.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer, bool $hasLifeTime = true, int $tickLifeTime = 120)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$hasLifeTime` (bool) — 
- `$tickLifeTime` (int) — 

**Example**:

```php
$noFall = new NoFall(new SwimCore(), new SwimPlayer(), true, 120);
```


---

#### entityDamageEvent

`protected function entityDamageEvent(EntityDamageEvent $event): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 

**Returns**: void


**Example**:

```php
$noFall = new NoFall(new SwimCore(), new SwimPlayer(), true, 120);
$noFall->entityDamageEvent(new EntityDamageEvent());
```


---

## Class: core\custom\behaviors\player_event_behaviors\ParticleEmitter

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\ParticleEmitter.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer, bool $hasLifeTime = false, int $tickLifeTime = 120)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$hasLifeTime` (bool) — 
- `$tickLifeTime` (int) — 

**Example**:

```php
$particleEmitter = new ParticleEmitter(new SwimCore(), new SwimPlayer(), false, 120);
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$particleEmitter = new ParticleEmitter(new SwimCore(), new SwimPlayer(), false, 120);
$particleEmitter->init();
```


---

#### eventUpdateTick

`public function eventUpdateTick(): void`


**Returns**: void


**Example**:

```php
$particleEmitter = new ParticleEmitter(new SwimCore(), new SwimPlayer(), false, 120);
$particleEmitter->eventUpdateTick();
```


---

## Class: core\custom\behaviors\player_event_behaviors\kit_sg\ArabKitBehavior

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\kit_sg\ArabKitBehavior.php`


### Methods

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$arabKitBehavior = new ArabKitBehavior();
$arabKitBehavior->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### eventMessage

`public function eventMessage(Event $event, string $message, mixed $args)`


**Parameters**:

- `$event` (Event) — 
- `$message` (string) — 
- `$args` (mixed) — 

**Example**:

```php
$arabKitBehavior = new ArabKitBehavior();
$arabKitBehavior->eventMessage(new Event(), "example", new mixed());
```


---

#### kit

`private function kit(): void`


**Returns**: void


**Example**:

```php
$arabKitBehavior = new ArabKitBehavior();
$arabKitBehavior->kit();
```


---

## Class: core\custom\behaviors\player_event_behaviors\kit_sg\ArcherKitBehavior

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\kit_sg\ArcherKitBehavior.php`


### Methods

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$archerKitBehavior = new ArcherKitBehavior();
$archerKitBehavior->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### eventMessage

`public function eventMessage(Event $event, string $message, mixed $args)`


**Parameters**:

- `$event` (Event) — 
- `$message` (string) — 
- `$args` (mixed) — 

**Example**:

```php
$archerKitBehavior = new ArcherKitBehavior();
$archerKitBehavior->eventMessage(new Event(), "example", new mixed());
```


---

#### kit

`private function kit(): void`


**Returns**: void


**Example**:

```php
$archerKitBehavior = new ArcherKitBehavior();
$archerKitBehavior->kit();
```


---

## Class: core\custom\behaviors\player_event_behaviors\kit_sg\BruteKitBehavior

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\kit_sg\BruteKitBehavior.php`


### Methods

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$bruteKitBehavior = new BruteKitBehavior();
$bruteKitBehavior->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### eventMessage

`public function eventMessage(Event $event, string $message, mixed $args)`


**Parameters**:

- `$event` (Event) — 
- `$message` (string) — 
- `$args` (mixed) — 

**Example**:

```php
$bruteKitBehavior = new BruteKitBehavior();
$bruteKitBehavior->eventMessage(new Event(), "example", new mixed());
```


---

#### kit

`private function kit(): void`


**Returns**: void


**Example**:

```php
$bruteKitBehavior = new BruteKitBehavior();
$bruteKitBehavior->kit();
```


---

## Class: core\custom\behaviors\player_event_behaviors\kit_sg\SouperManKitBehavior

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\kit_sg\SouperManKitBehavior.php`


### Methods

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$souperManKitBehavior = new SouperManKitBehavior();
$souperManKitBehavior->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### eventMessage

`public function eventMessage(Event $event, string $message, mixed $args)`


**Parameters**:

- `$event` (Event) — 
- `$message` (string) — 
- `$args` (mixed) — 

**Example**:

```php
$souperManKitBehavior = new SouperManKitBehavior();
$souperManKitBehavior->eventMessage(new Event(), "example", new mixed());
```


---

#### kit

`private function kit(): void`


**Returns**: void


**Example**:

```php
$souperManKitBehavior = new SouperManKitBehavior();
$souperManKitBehavior->kit();
```


---

## Class: core\custom\behaviors\player_event_behaviors\kit_sg\WizardManKitBehavior

**Defined in**: `src\core\custom\behaviors\player_event_behaviors\kit_sg\WizardManKitBehavior.php`


### Methods

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$wizardManKitBehavior = new WizardManKitBehavior();
$wizardManKitBehavior->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### eventMessage

`public function eventMessage(Event $event, string $message, mixed $args)`


**Parameters**:

- `$event` (Event) — 
- `$message` (string) — 
- `$args` (mixed) — 

**Example**:

```php
$wizardManKitBehavior = new WizardManKitBehavior();
$wizardManKitBehavior->eventMessage(new Event(), "example", new mixed());
```


---

#### kit

`protected function kit(): void`


**Returns**: void


**Example**:

```php
$wizardManKitBehavior = new WizardManKitBehavior();
$wizardManKitBehavior->kit();
```


---

## Class: core\custom\blocks\BoomBoxBlock

**Defined in**: `src\core\custom\blocks\BoomBoxBlock.php`


### Methods

#### getCustomBlockData

`public static function getCustomBlockData(): CustomBlockData`


**Returns**: CustomBlockData


**Example**:

```php
BoomBoxBlock::getCustomBlockData();
```


---

## Class: core\custom\blocks\CustomBlock

**Defined in**: `src\core\custom\blocks\CustomBlock.php`


### Methods

#### __construct

`public function __construct(BlockIdentifier $idInfo, string $name, BlockTypeInfo $typeInfo)`


**Parameters**:

- `$idInfo` (BlockIdentifier) — 
- `$name` (string) — 
- `$typeInfo` (BlockTypeInfo) — 

**Example**:

```php
$customBlock = new CustomBlock(new BlockIdentifier(), "example", new BlockTypeInfo());
```


---

#### getCustomBlockData

`public static function getCustomBlockData(): CustomBlockData`


**Returns**: CustomBlockData


**Example**:

```php
CustomBlock::getCustomBlockData();
```


---

## Class: core\custom\blocks\CustomBlockData

**Defined in**: `src\core\custom\blocks\CustomBlockData.php`


### Methods

#### __construct

`public function __construct(public string   $customName, public string   $customTexture, public string   $customIdentifier, public string   $customGeo, public Vector3 $origin = new Vector3(-8, 0, -8)`


**Parameters**:

- `public string   $customName` (mixed) — 
- `public string   $customTexture` (mixed) — 
- `public string   $customIdentifier` (mixed) — 
- `public string   $customGeo` (mixed) — 
- `public Vector3 $origin = new Vector3(-8, 0, -8` (mixed) — 

**Example**:

```php
$customBlockData = new CustomBlockData("example", "example", "example", "example", null);
```


---

## Class: core\custom\prefabs\apples\FullHealApple

**Defined in**: `src\core\custom\prefabs\apples\FullHealApple.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$fullHealApple = new FullHealApple(new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE);
```


---

#### onConsume

`public function onConsume(Living $consumer): void`


**Parameters**:

- `$consumer` (Living) — 

**Returns**: void


**Example**:

```php
$fullHealApple = new FullHealApple(new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE);
$fullHealApple->onConsume(new Living());
```


---

## Class: core\custom\prefabs\apples\GoldHead

**Defined in**: `src\core\custom\prefabs\apples\GoldHead.php`


### Methods

#### __construct

`public function __construct(BlockIdentifier $idInfo = new BlockIdentifier(BlockTypeIds::MOB_HEAD)`


**Parameters**:

- `$idInfo` (BlockIdentifier) — 

**Example**:

```php
$goldHead = new GoldHead(new BlockIdentifier(BlockTypeIds::MOB_HEAD);
```


---

#### place

`public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool`


**Parameters**:

- `$tx` (BlockTransaction) — 
- `$item` (Item) — 
- `$blockReplace` (Block) — 
- `$blockClicked` (Block) — 
- `$face` (int) — 
- `$clickVector` (Vector3) — 
- `$player` (?Player) — 

**Returns**: bool


**Example**:

```php
$goldHead = new GoldHead(new BlockIdentifier(BlockTypeIds::MOB_HEAD);
$goldHead->place(new BlockTransaction(), new Item(), new Block(), new Block(), 123, new Vector3(), null);
```


---

## Class: core\custom\prefabs\apples\GoldHeadListener

**Defined in**: `src\core\custom\prefabs\apples\GoldHead.php`


### Methods

_No methods found_

## Class: core\custom\prefabs\apples\UsableBlock

**Defined in**: `src\core\custom\prefabs\apples\GoldHead.php`

* @priority LOWEST


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$usableBlock = new UsableBlock();
```


---

## Class: core\custom\prefabs\apples\SwimApple

**Defined in**: `src\core\custom\prefabs\apples\SwimApple.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$swimApple = new SwimApple(new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE);
```


---

#### getAdditionalEffects

`public function getAdditionalEffects(): array`


**Returns**: array


**Example**:

```php
$swimApple = new SwimApple(new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE);
$swimApple->getAdditionalEffects();
```


---

#### onConsume

`public function onConsume(Living $consumer): void`


**Parameters**:

- `$consumer` (Living) — 

**Returns**: void


**Example**:

```php
$swimApple = new SwimApple(new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE);
$swimApple->onConsume(new Living());
```


---

## Class: core\custom\prefabs\boombox\BaseBox

**Defined in**: `src\core\custom\prefabs\boombox\BaseBox.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$baseBox = new BaseBox();
```


---

#### prepareTNT

`public function prepareTNT(Block $blockReplace, SwimPlayer $player): SmoothPrimedTNT`


**Parameters**:

- `$blockReplace` (Block) — 
- `$player` (SwimPlayer) — 

**Returns**: SmoothPrimedTNT


**Example**:

```php
$baseBox = new BaseBox();
$baseBox->prepareTNT(new Block(), new SwimPlayer());
```


---

## Class: core\custom\prefabs\boombox\BlockBreakerBox

**Defined in**: `src\core\custom\prefabs\boombox\BlockBreakerBox.php`


### Methods

#### place

`public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool`


**Parameters**:

- `$tx` (BlockTransaction) — 
- `$item` (Item) — 
- `$blockReplace` (Block) — 
- `$blockClicked` (Block) — 
- `$face` (int) — 
- `$clickVector` (Vector3) — 
- `$player` (?Player) — 

**Returns**: bool


**Example**:

```php
$blockBreakerBox = new BlockBreakerBox();
$blockBreakerBox->place(new BlockTransaction(), new Item(), new Block(), new Block(), 123, new Vector3(), null);
```


---

## Class: core\custom\prefabs\boombox\CustomExplosion

**Defined in**: `src\core\custom\prefabs\boombox\CustomExplosion.php`


### Methods

#### __construct

`public function __construct(public Position                    $source, public float                       $radius, private readonly Entity|Block|null $what = null)`


**Parameters**:

- `public Position                    $source` (mixed) — 
- `public float                       $radius` (mixed) — 
- `private readonly Entity|Block|null $what = null` (mixed) — 

**Example**:

```php
$customExplosion = new CustomExplosion(null, null, null);
```


---

#### explodeB

`public function explodeB(): bool`


**Returns**: bool


**Example**:

```php
$customExplosion = new CustomExplosion(null, null, null);
$customExplosion->explodeB();
```


---

#### blowUpEntities

`private function blowUpEntities(): void`


**Returns**: void


**Example**:

```php
$customExplosion = new CustomExplosion(null, null, null);
$customExplosion->blowUpEntities();
```


---

## Class: core\custom\prefabs\boombox\KnockerBox

**Defined in**: `src\core\custom\prefabs\boombox\KnockerBox.php`


### Methods

#### place

`public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool`


**Parameters**:

- `$tx` (BlockTransaction) — 
- `$item` (Item) — 
- `$blockReplace` (Block) — 
- `$blockClicked` (Block) — 
- `$face` (int) — 
- `$clickVector` (Vector3) — 
- `$player` (?Player) — 

**Returns**: bool


**Example**:

```php
$knockerBox = new KnockerBox();
$knockerBox->place(new BlockTransaction(), new Item(), new Block(), new Block(), 123, new Vector3(), null);
```


---

## Class: core\custom\prefabs\boombox\KnockerBoxEntity

**Defined in**: `src\core\custom\prefabs\boombox\KnockerBoxEntity.php`


### Methods

#### __construct

`public function __construct(Location $location, SwimPlayer $target)`


**Parameters**:

- `$location` (Location) — 
- `$target` (SwimPlayer) — 

**Example**:

```php
$knockerBoxEntity = new KnockerBoxEntity(new Location(), new SwimPlayer());
```


---

#### explode

`public function explode(): void`


**Returns**: void


**Example**:

```php
$knockerBoxEntity = new KnockerBoxEntity(new Location(), new SwimPlayer());
$knockerBoxEntity->explode();
```


---

## Class: core\custom\prefabs\boombox\KnockerBoxExplosion

**Defined in**: `src\core\custom\prefabs\boombox\KnockerBoxExplosion.php`


### Methods

#### __construct

`public function __construct(Position $source, SwimPlayer $target, bool $noFall = true)`


**Parameters**:

- `$source` (Position) — 
- `$target` (SwimPlayer) — 
- `$noFall` (bool) — 

**Example**:

```php
$knockerBoxExplosion = new KnockerBoxExplosion(new Position(), new SwimPlayer(), true);
```


---

#### explodeB

`public function explodeB(): bool`


**Returns**: bool


**Example**:

```php
$knockerBoxExplosion = new KnockerBoxExplosion(new Position(), new SwimPlayer(), true);
$knockerBoxExplosion->explodeB();
```


---

## Class: core\custom\prefabs\boombox\SmoothPrimedTNT

**Defined in**: `src\core\custom\prefabs\boombox\SmoothPrimedTNT.php`


### Methods

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
SmoothPrimedTNT::getNetworkTypeId();
```


---

#### __construct

`public function __construct(SwimPlayer $owner, Location $location, bool $breakBlocks = false, float $blastRadius = 3.5, ?CompoundTag $nbt = null)`


**Parameters**:

- `$owner` (SwimPlayer) — 
- `$location` (Location) — 
- `$breakBlocks` (bool) — 
- `$blastRadius` (float) — 
- `$nbt` (?CompoundTag) — 

**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
```


---

#### sendSpawnPacket

`protected function sendSpawnPacket(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
$smoothPrimedTNT->sendSpawnPacket(new Player());
```


---

#### explode

`public function explode(): void`


**Returns**: void


**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
$smoothPrimedTNT->explode();
```


---

#### getOffsetPosition

`public function getOffsetPosition(Vector3 $vector3): Vector3`


**Parameters**:

- `$vector3` (Vector3) — 

**Returns**: Vector3


**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
$smoothPrimedTNT->getOffsetPosition(new Vector3());
```


---

#### syncNetworkData

`protected function syncNetworkData(EntityMetadataCollection $properties): void`


**Parameters**:

- `$properties` (EntityMetadataCollection) — 

**Returns**: void


**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
$smoothPrimedTNT->syncNetworkData(new EntityMetadataCollection());
```


---

#### setFuse

`public function setFuse(int $fuse): void`


**Parameters**:

- `$fuse` (int) — 

**Returns**: void


**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
$smoothPrimedTNT->setFuse(123);
```


---

#### onUpdate

`public function onUpdate(int $currentTick): bool`


**Parameters**:

- `$currentTick` (int) — 

**Returns**: bool


**Example**:

```php
$smoothPrimedTNT = new SmoothPrimedTNT(new SwimPlayer(), new Location(), false, 3.5, null);
$smoothPrimedTNT->onUpdate(123);
```


---

## Class: core\custom\prefabs\boombox\ThrowingTNT

**Defined in**: `src\core\custom\prefabs\boombox\ThrowingTNT.php`


### Methods

#### place

`public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool`


**Parameters**:

- `$tx` (BlockTransaction) — 
- `$item` (Item) — 
- `$blockReplace` (Block) — 
- `$blockClicked` (Block) — 
- `$face` (int) — 
- `$clickVector` (Vector3) — 
- `$player` (?Player) — 

**Returns**: bool


**Example**:

```php
$throwingTNT = new ThrowingTNT();
$throwingTNT->place(new BlockTransaction(), new Item(), new Block(), new Block(), 123, new Vector3(), null);
```


---

## Class: core\custom\prefabs\boombox\TNT_Listener

**Defined in**: `src\core\custom\prefabs\boombox\ThrowingTNT.php`


### Methods

_No methods found_

## Class: core\custom\prefabs\boombox\ThrowableBlock

**Defined in**: `src\core\custom\prefabs\boombox\ThrowingTNT.php`

* @priority LOWEST


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$throwableBlock = new ThrowableBlock();
```


---

## Class: core\custom\prefabs\bots\ArmorHelper

**Defined in**: `src\core\custom\prefabs\bots\ArmorHelper.php`


### Methods

#### getArmorScore

`public static function getArmorScore(Item $item): int`


**Parameters**:

- `$item` (Item) — 

**Returns**: int


**Example**:

```php
ArmorHelper::getArmorScore(new Item());
```


---

#### getArmorType

`public static function getArmorType(Item $item): ArmorType`


**Parameters**:

- `$item` (Item) — 

**Returns**: ArmorType


**Example**:

```php
ArmorHelper::getArmorType(new Item());
```


---

## Class: core\custom\prefabs\bots\BotInventoryEditor

**Defined in**: `src\core\custom\prefabs\bots\BotInventoryEditor.php`


### Methods

#### setBotPlayer

`public function setBotPlayer(BotPlayer $botPlayer): void`


**Parameters**:

- `$botPlayer` (BotPlayer) — 

**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->setBotPlayer(new BotPlayer());
```


---

#### allowEditing

`public function allowEditing(bool $value): void`


**Parameters**:

- `$value` (bool) — 

**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->allowEditing(true);
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->init();
```


---

#### itemEditHandler

`private function itemEditHandler(): void`


**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->itemEditHandler();
```


---

#### onCloseHandler

`private function onCloseHandler(): void`


**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->onCloseHandler();
```


---

#### eventMessage

`public function eventMessage(string $message, ...$args): void`


**Parameters**:

- `$message` (string) — 
- `...$args` (mixed) — 

**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->eventMessage("example", null);
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$botInventoryEditor = new BotInventoryEditor();
$botInventoryEditor->exit();
```


---

## Class: core\custom\prefabs\bots\BotPlayer

**Defined in**: `src\core\custom\prefabs\bots\BotPlayer.php`


### Methods

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
BotPlayer::getNetworkTypeId();
```


---

#### getInitialSizeInfo

`public function getInitialSizeInfo(): EntitySizeInfo`


**Returns**: EntitySizeInfo


**Example**:

```php
$botPlayer = new BotPlayer(new Location(), null, null, null, "");
$botPlayer->getInitialSizeInfo();
```


---

#### __construct

`public function __construct(Location $location, ?Scene $parentScene = null, ?CompoundTag $nbt = null, ?Skin $skin = null, string $name = "")`


**Parameters**:

- `$location` (Location) — 
- `$parentScene` (?Scene) — 
- `$nbt` (?CompoundTag) — 
- `$skin` (?Skin) — 
- `$name` (string) — 

**Example**:

```php
$botPlayer = new BotPlayer(new Location(), null, null, null, "");
```


---

#### playerInteract

`protected function playerInteract(SwimPlayer $player, Vector3 $clickPos): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$clickPos` (Vector3) — 

**Returns**: void


**Example**:

```php
$botPlayer = new BotPlayer(new Location(), null, null, null, "");
$botPlayer->playerInteract(new SwimPlayer(), new Vector3());
```


---

#### attackedByPlayer

`protected function attackedByPlayer(EntityDamageByEntityEvent $source, SwimPlayer $player): void`


**Parameters**:

- `$source` (EntityDamageByEntityEvent) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$botPlayer = new BotPlayer(new Location(), null, null, null, "");
$botPlayer->attackedByPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

## Class: core\custom\prefabs\bots\has

**Defined in**: `src\core\custom\prefabs\bots\SimpleCombat.php`


### Methods

#### setBotPlayer

`public function setBotPlayer(BotPlayer $botPlayer): void`


**Parameters**:

- `$botPlayer` (BotPlayer) — 

**Returns**: void


**Example**:

```php
$has = new has();
$has->setBotPlayer(new BotPlayer());
```


---

#### compareAndUpdatePiecesByRef

`private function compareAndUpdatePiecesByRef(int $currentScore, int &$bestScore, int &$bestSlot, int $scoreToCompare, int $slot): void`


**Parameters**:

- `$currentScore` (int) — The current equipped armor item in the armor inventory.
- `&$bestScore` (int) — 
- `&$bestSlot` (int) — 
- `$scoreToCompare` (int) — The score we are checking.
- `$slot` (int) — And what slot that item comes from that we are checking.

**Returns**: void


**Example**:

```php
$has = new has();
$has->compareAndUpdatePiecesByRef(123, 123, 123, 123, 123);
```


---

#### selectAndEquipBestItems

`public function selectAndEquipBestItems(): void`


**Returns**: void


**Example**:

```php
$has = new has();
$has->selectAndEquipBestItems();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$has = new has();
$has->init();
```


---

#### eventMessage

`public function eventMessage(string $message, ...$args): void`


**Parameters**:

- `$message` (string) — 
- `...$args` (mixed) — 

**Returns**: void


**Example**:

```php
$has = new has();
$has->eventMessage("example", null);
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$has = new has();
$has->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$has = new has();
$has->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$has = new has();
$has->exit();
```


---

## Class: core\custom\prefabs\bots\SimpleFollow

**Defined in**: `src\core\custom\prefabs\bots\SimpleFollow.php`


### Methods

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->init();
```


---

#### getMover

`private function getMover(bool $cache = true): ?SimpleMover`


**Parameters**:

- `$cache` (bool) — 

**Returns**: ?SimpleMover


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->getMover(true);
```


---

#### goTo

`private function goTo(): void`


**Returns**: void


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->goTo();
```


---

#### getNearestPlayer

`protected function getNearestPlayer(): ?Player`


**Returns**: ?Player


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->getNearestPlayer();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$simpleFollow = new SimpleFollow();
$simpleFollow->exit();
```


---

## Class: core\custom\prefabs\bots\SimpleMover

**Defined in**: `src\core\custom\prefabs\bots\SimpleMover.php`


### Methods

#### init

`public function init(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->init();
```


---

#### setTargetPosition

`public function setTargetPosition(Vector3 $position, ?float $pitch = null, ?float $yaw = null): void`


**Parameters**:

- `$position` (Vector3) — 
- `$pitch` (?float) — 
- `$yaw` (?float) — 

**Returns**: void


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->setTargetPosition(new Vector3(), null, null);
```


---

#### stop

`public function stop(): void`


**Returns**: void


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->stop();
```


---

#### actorBaseEntityTickCallback

`public function actorBaseEntityTickCallback(int $tickDiff): bool`


**Parameters**:

- `$tickDiff` (int) — 

**Returns**: bool


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->actorBaseEntityTickCallback(123);
```


---

#### needsStepUpOneBlock

`private function needsStepUpOneBlock(): bool`

> Step-up detection at foot/knee with clear headroom


**Returns**: bool


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->needsStepUpOneBlock();
```


---

#### hasObstacleInFrontAtHeight

`private function hasObstacleInFrontAtHeight(float $h): bool`

> Check small box in front at a given local height


**Parameters**:

- `$h` (float) — 

**Returns**: bool


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->hasObstacleInFrontAtHeight(1.23);
```


---

#### hasCeilingAhead

`private function hasCeilingAhead(): bool`

> Ceiling two blocks above in front


**Returns**: bool


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->hasCeilingAhead();
```


---

#### hasBlockAbove

`private function hasBlockAbove(): bool`


**Returns**: bool


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->hasBlockAbove();
```


---

#### isAboutToFall

`private function isAboutToFall(float $maxAllowedFallDist = 3.0): bool`

> Don’t run off cliffs / into holes. This seems to not work.


**Parameters**:

- `$maxAllowedFallDist` (float) — 

**Returns**: bool


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->isAboutToFall(3.0);
```


---

#### approachAngle

`private function approachAngle(float $current, float $target, float $step): array`

> Move current angle toward target by at most $step degrees, wrapping correctly.


**Parameters**:

- `$current` (float) — 
- `$target` (float) — 
- `$step` (float) — 

**Returns**: array


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->approachAngle(1.23, 1.23, 1.23);
```


---

#### wrapDegrees

`private function wrapDegrees(float $deg): float`


**Parameters**:

- `$deg` (float) — 

**Returns**: float


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->wrapDegrees(1.23);
```


---

#### clamp

`private function clamp(float $v, float $lo, float $hi): float`


**Parameters**:

- `$v` (float) — 
- `$lo` (float) — 
- `$hi` (float) — 

**Returns**: float


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->clamp(1.23, 1.23, 1.23);
```


---

#### getDirectionVector2

`private function getDirectionVector2(float $yawDeg): Vector2`

> Vector2 from yaw (deg)


**Parameters**:

- `$yawDeg` (float) — 

**Returns**: Vector2


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->getDirectionVector2(1.23);
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$simpleMover = new SimpleMover();
$simpleMover->exit();
```


---

## Class: core\custom\prefabs\bow\SwimArrow

**Defined in**: `src\core\custom\prefabs\bow\SwimArrow.php`


### Methods

#### initEntity

`public function initEntity(CompoundTag $nbt): void`


**Parameters**:

- `$nbt` (CompoundTag) — 

**Returns**: void


**Example**:

```php
$swimArrow = new SwimArrow();
$swimArrow->initEntity(new CompoundTag());
```


---

#### getResultDamage

`public function getResultDamage(): int`


**Returns**: int


**Example**:

```php
$swimArrow = new SwimArrow();
$swimArrow->getResultDamage();
```


---

#### onHitBlock

`public function onHitBlock(Block $blockHit, RayTraceResult $hitResult): void`


**Parameters**:

- `$blockHit` (Block) — 
- `$hitResult` (RayTraceResult) — 

**Returns**: void


**Example**:

```php
$swimArrow = new SwimArrow();
$swimArrow->onHitBlock(new Block(), new RayTraceResult());
```


---

#### onHitEntity

`protected function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void`


**Parameters**:

- `$entityHit` (Entity) — 
- `$hitResult` (RayTraceResult) — 

**Returns**: void


**Example**:

```php
$swimArrow = new SwimArrow();
$swimArrow->onHitEntity(new Entity(), new RayTraceResult());
```


---

## Class: core\custom\prefabs\bow\SwimBow

**Defined in**: `src\core\custom\prefabs\bow\SwimBow.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$swimBow = new SwimBow();
```


---

#### onReleaseUsing

`public function onReleaseUsing(Player $player, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$swimBow = new SwimBow();
$swimBow->onReleaseUsing(new Player(), []);
```


---

## Class: core\custom\prefabs\carrot\SpeedCarrot

**Defined in**: `src\core\custom\prefabs\carrot\SpeedCarrot.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::GOLDEN_CARROT)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$speedCarrot = new SpeedCarrot(new ItemIdentifier(ItemTypeIds::GOLDEN_CARROT);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$speedCarrot = new SpeedCarrot(new ItemIdentifier(ItemTypeIds::GOLDEN_CARROT);
$speedCarrot->onClickAir(new Player(), new Vector3(), []);
```


---

## Class: core\custom\prefabs\fireball\DummyCharge

**Defined in**: `src\core\custom\prefabs\fireball\DummyCharge.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FIRE_CHARGE)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$dummyCharge = new DummyCharge(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
```


---

#### onInteractBlock

`public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$blockReplace` (Block) — 
- `$blockClicked` (Block) — 
- `$face` (int) — 
- `$clickVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$dummyCharge = new DummyCharge(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
$dummyCharge->onInteractBlock(new Player(), new Block(), new Block(), 123, new Vector3(), []);
```


---

## Class: core\custom\prefabs\fireball\FireBallEntity

**Defined in**: `src\core\custom\prefabs\fireball\FireBallEntity.php`


### Methods

#### getInitialDragMultiplier

`protected function getInitialDragMultiplier(): float`


**Returns**: float


**Example**:

```php
$fireBallEntity = new FireBallEntity();
$fireBallEntity->getInitialDragMultiplier();
```


---

#### getInitialGravity

`protected function getInitialGravity(): float`


**Returns**: float


**Example**:

```php
$fireBallEntity = new FireBallEntity();
$fireBallEntity->getInitialGravity();
```


---

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
FireBallEntity::getNetworkTypeId();
```


---

#### entityBaseTick

`public function entityBaseTick(int $tickDiff = 1): bool`


**Parameters**:

- `$tickDiff` (int) — 

**Returns**: bool


**Example**:

```php
$fireBallEntity = new FireBallEntity();
$fireBallEntity->entityBaseTick(1);
```


---

#### onHitBlock

`protected function onHitBlock(Block $blockHit, RayTraceResult $hitResult): void`


**Parameters**:

- `$blockHit` (Block) — 
- `$hitResult` (RayTraceResult) — 

**Returns**: void


**Example**:

```php
$fireBallEntity = new FireBallEntity();
$fireBallEntity->onHitBlock(new Block(), new RayTraceResult());
```


---

#### doExplosion

`private function doExplosion(RayTraceResult $hitResult): void`


**Parameters**:

- `$hitResult` (RayTraceResult) — 

**Returns**: void


**Example**:

```php
$fireBallEntity = new FireBallEntity();
$fireBallEntity->doExplosion(new RayTraceResult());
```


---

#### onHitEntity

`protected function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void`


**Parameters**:

- `$entityHit` (Entity) — 
- `$hitResult` (RayTraceResult) — 

**Returns**: void


**Example**:

```php
$fireBallEntity = new FireBallEntity();
$fireBallEntity->onHitEntity(new Entity(), new RayTraceResult());
```


---

## Class: core\custom\prefabs\fireball\FireBallItem

**Defined in**: `src\core\custom\prefabs\fireball\FireBallItem.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FIRE_CHARGE)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$fireBallItem = new FireBallItem(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$fireBallItem = new FireBallItem(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
$fireBallItem->onClickAir(new Player(), new Vector3(), []);
```


---

#### createEntity

`protected function createEntity(Location $location, Player $thrower): Throwable`


**Parameters**:

- `$location` (Location) — 
- `$thrower` (Player) — 

**Returns**: Throwable


**Example**:

```php
$fireBallItem = new FireBallItem(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
$fireBallItem->createEntity(new Location(), new Player());
```


---

#### getThrowForce

`public function getThrowForce(): float`


**Returns**: float


**Example**:

```php
$fireBallItem = new FireBallItem(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
$fireBallItem->getThrowForce();
```


---

#### getCooldownTicks

`public function getCooldownTicks(): int`


**Returns**: int


**Example**:

```php
$fireBallItem = new FireBallItem(new ItemIdentifier(ItemTypeIds::FIRE_CHARGE);
$fireBallItem->getCooldownTicks();
```


---

## Class: core\custom\prefabs\hub\FinnEntity

**Defined in**: `src\core\custom\prefabs\hub\FinnEntity.php`


### Methods

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
FinnEntity::getNetworkTypeId();
```


---

#### __construct

`public function __construct(Location $location, ?Scene $parentScene = null)`


**Parameters**:

- `$location` (Location) — 
- `$parentScene` (?Scene) — 

**Example**:

```php
$finnEntity = new FinnEntity(new Location(), null);
```


---

#### attackedByPlayer

`protected function attackedByPlayer(EntityDamageByEntityEvent $source, SwimPlayer $player)`


**Parameters**:

- `$source` (EntityDamageByEntityEvent) — 
- `$player` (SwimPlayer) — 

**Example**:

```php
$finnEntity = new FinnEntity(new Location(), null);
$finnEntity->attackedByPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### playerInteract

`protected function playerInteract(SwimPlayer $player, Vector3 $clickPos): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$clickPos` (Vector3) — 

**Returns**: void


**Example**:

```php
$finnEntity = new FinnEntity(new Location(), null);
$finnEntity->playerInteract(new SwimPlayer(), new Vector3());
```


---

#### interact

`private function interact(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$finnEntity = new FinnEntity(new Location(), null);
$finnEntity->interact(new SwimPlayer());
```


---

## Class: core\custom\prefabs\hub\HubEntities

**Defined in**: `src\core\custom\prefabs\hub\HubEntities.php`


### Methods

#### spawnToScene

`public static function spawnToScene(Scene $scene): void`

> @throws ReflectionException


**Parameters**:

- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
HubEntities::spawnToScene(new Scene());
```


---

## Class: core\custom\prefabs\hub\ServerSelectorCompass

**Defined in**: `src\core\custom\prefabs\hub\ServerSelectorCompass.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::COMPASS)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$serverSelectorCompass = new ServerSelectorCompass(new ItemIdentifier(ItemTypeIds::COMPASS);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$serverSelectorCompass = new ServerSelectorCompass(new ItemIdentifier(ItemTypeIds::COMPASS);
$serverSelectorCompass->onClickAir(new Player(), new Vector3(), []);
```


---

## Class: core\custom\prefabs\pearl\SwimPearl

**Defined in**: `src\core\custom\prefabs\pearl\SwimPearl.php`


### Methods

#### __construct

`public function __construct(bool $animated, Location $location, ?Entity $shootingEntity, ?CompoundTag $nbt = null)`


**Parameters**:

- `$animated` (bool) — 
- `$location` (Location) — 
- `$shootingEntity` (?Entity) — 
- `$nbt` (?CompoundTag) — 

**Example**:

```php
$swimPearl = new SwimPearl(true, new Location(), new Entity(), null);
```


---

#### onHit

`public function onHit(ProjectileHitEvent $event): void`


**Parameters**:

- `$event` (ProjectileHitEvent) — 

**Returns**: void


**Example**:

```php
$swimPearl = new SwimPearl(true, new Location(), new Entity(), null);
$swimPearl->onHit(new ProjectileHitEvent());
```


---

## Class: core\custom\prefabs\pearl\SwimPearlItem

**Defined in**: `src\core\custom\prefabs\pearl\SwimPearlItem.php`


### Methods

#### __construct

`public function __construct(?SwimPlayer $swimPlayer = null, int $count = 1)`


**Parameters**:

- `$swimPlayer` (?SwimPlayer) — 
- `$count` (int) — 

**Example**:

```php
$swimPearlItem = new SwimPearlItem(null, 1);
```


---

#### createEntity

`protected function createEntity(Location $location, Player $thrower): Throwable`


**Parameters**:

- `$location` (Location) — 
- `$thrower` (Player) — 

**Returns**: Throwable


**Example**:

```php
$swimPearlItem = new SwimPearlItem(null, 1);
$swimPearlItem->createEntity(new Location(), new Player());
```


---

## Class: core\custom\prefabs\pot\SwimDrinkPot

**Defined in**: `src\core\custom\prefabs\pot\SwimDrinkPot.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::POTION)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$swimDrinkPot = new SwimDrinkPot(new ItemIdentifier(ItemTypeIds::POTION);
```


---

#### getResidue

`public function getResidue(): Item`


**Returns**: Item


**Example**:

```php
$swimDrinkPot = new SwimDrinkPot(new ItemIdentifier(ItemTypeIds::POTION);
$swimDrinkPot->getResidue();
```


---

## Class: core\custom\prefabs\pot\SwimPot

**Defined in**: `src\core\custom\prefabs\pot\SwimPot.php`


### Methods

#### __construct

`public function __construct(Location $location, ?Entity $shootingEntity, PotionType $potionType, ?CompoundTag $nbt = null)`


**Parameters**:

- `$location` (Location) — 
- `$shootingEntity` (?Entity) — 
- `$potionType` (PotionType) — 
- `$nbt` (?CompoundTag) — 

**Example**:

```php
$swimPot = new SwimPot(new Location(), new Entity(), new PotionType(), null);
```


---

#### onHit

`protected function onHit(ProjectileHitEvent $event): void`


**Parameters**:

- `$event` (ProjectileHitEvent) — 

**Returns**: void


**Example**:

```php
$swimPot = new SwimPot(new Location(), new Entity(), new PotionType(), null);
$swimPot->onHit(new ProjectileHitEvent());
```


---

## Class: core\custom\prefabs\pot\SwimPotItem

**Defined in**: `src\core\custom\prefabs\pot\SwimPotItem.php`


### Methods

#### __construct

`public function __construct(string $name = "")`


**Parameters**:

- `$name` (string) — 

**Example**:

```php
$swimPotItem = new SwimPotItem("");
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$swimPotItem = new SwimPotItem("");
$swimPotItem->onClickAir(new Player(), new Vector3(), []);
```


---

## Class: core\custom\prefabs\props\MovieActor

**Defined in**: `src\core\custom\prefabs\props\MovieActor.php`


### Methods

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
MovieActor::getNetworkTypeId();
```


---

#### getInitialSizeInfo

`public function getInitialSizeInfo(): EntitySizeInfo`


**Returns**: EntitySizeInfo


**Example**:

```php
$movieActor = new MovieActor("example", new Location(), null, null, null);
$movieActor->getInitialSizeInfo();
```


---

#### __construct

`public function __construct(string $name, Location $location, ?Scene $scene = null, ?CompoundTag $nbt = null, ?Skin $skin = null)`

> @throws ReflectionException


**Parameters**:

- `$name` (string) — 
- `$location` (Location) — 
- `$scene` (?Scene) — 
- `$nbt` (?CompoundTag) — 
- `$skin` (?Skin) — 

**Example**:

```php
$movieActor = new MovieActor("example", new Location(), null, null, null);
```


---

#### move

`public function move(float $dx, float $dy, float $dz): void`


**Parameters**:

- `$dx` (float) — 
- `$dy` (float) — 
- `$dz` (float) — 

**Returns**: void


**Example**:

```php
$movieActor = new MovieActor("example", new Location(), null, null, null);
$movieActor->move(1.23, 1.23, 1.23);
```


---

## Class: core\custom\prefabs\rod\CustomFishingRod

**Defined in**: `src\core\custom\prefabs\rod\CustomFishingRod.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FISHING_ROD)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$customFishingRod = new CustomFishingRod(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
```


---

#### getMaxDurability

`public function getMaxDurability(): int`


**Returns**: int


**Example**:

```php
$customFishingRod = new CustomFishingRod(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
$customFishingRod->getMaxDurability();
```


---

#### serializeCompoundTag

`protected function serializeCompoundTag(CompoundTag $tag): void`


**Parameters**:

- `$tag` (CompoundTag) — 

**Returns**: void


**Example**:

```php
$customFishingRod = new CustomFishingRod(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
$customFishingRod->serializeCompoundTag(new CompoundTag());
```


---

#### setInUse

`public function setInUse(bool $inUse): void`


**Parameters**:

- `$inUse` (bool) — 

**Returns**: void


**Example**:

```php
$customFishingRod = new CustomFishingRod(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
$customFishingRod->setInUse(true);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$customFishingRod = new CustomFishingRod(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
$customFishingRod->onClickAir(new Player(), new Vector3(), []);
```


---

## Class: core\custom\prefabs\rod\FishingHook

**Defined in**: `src\core\custom\prefabs\rod\FishingHook.php`


### Methods

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
FishingHook::getNetworkTypeId();
```


---

#### getInitialDragMultiplier

`protected function getInitialDragMultiplier(): float`


**Returns**: float


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->getInitialDragMultiplier();
```


---

#### getInitialGravity

`protected function getInitialGravity(): float`


**Returns**: float


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->getInitialGravity();
```


---

#### getInitialSizeInfo

`protected function getInitialSizeInfo(): EntitySizeInfo`


**Returns**: EntitySizeInfo


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->getInitialSizeInfo();
```


---

#### __construct

`public function __construct(Location $location, ?Entity $shootingEntity, private readonly CustomFishingRod $item, ?CompoundTag $nbt = null)`


**Parameters**:

- `$location` (Location) — 
- `$shootingEntity` (?Entity) — 
- `private readonly CustomFishingRod $item` (mixed) — 
- `$nbt` (?CompoundTag) — 

**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
```


---

#### onHitEntity

`public function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void`


**Parameters**:

- `$entityHit` (Entity) — 
- `$hitResult` (RayTraceResult) — 

**Returns**: void


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->onHitEntity(new Entity(), new RayTraceResult());
```


---

#### entityBaseTick

`protected function entityBaseTick(int $tickDiff = 1): bool`


**Parameters**:

- `$tickDiff` (int) — 

**Returns**: bool


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->entityBaseTick(1);
```


---

#### flagForDespawn

`public function flagForDespawn(): void`


**Returns**: void


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->flagForDespawn();
```


---

#### handleHookCasting

`public function handleHookCasting(Vector3 $vec): void`


**Parameters**:

- `$vec` (Vector3) — 

**Returns**: void


**Example**:

```php
$fishingHook = new FishingHook(new Location(), new Entity(), null, null);
$fishingHook->handleHookCasting(new Vector3());
```


---

## Class: core\custom\prefabs\rod\GrapplingHook

**Defined in**: `src\core\custom\prefabs\rod\GrapplingHook.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FISHING_ROD)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$grapplingHook = new GrapplingHook(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$grapplingHook = new GrapplingHook(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
$grapplingHook->onClickAir(new Player(), new Vector3(), []);
```


---

#### grapple

`private function grapple(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$grapplingHook = new GrapplingHook(new ItemIdentifier(ItemTypeIds::FISHING_ROD);
$grapplingHook->grapple(new SwimPlayer());
```


---

## Class: core\custom\prefabs\snowball\SnowBall_Item

**Defined in**: `src\core\custom\prefabs\snowball\SnowBall_Item.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::SNOWBALL)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$snowBall_Item = new SnowBall_Item(new ItemIdentifier(ItemTypeIds::SNOWBALL);
```


---

#### getMaxStackSize

`public function getMaxStackSize(): int`


**Returns**: int


**Example**:

```php
$snowBall_Item = new SnowBall_Item(new ItemIdentifier(ItemTypeIds::SNOWBALL);
$snowBall_Item->getMaxStackSize();
```


---

#### createEntity

`protected function createEntity(Location $location, Player $thrower): Throwable`


**Parameters**:

- `$location` (Location) — 
- `$thrower` (Player) — 

**Returns**: Throwable


**Example**:

```php
$snowBall_Item = new SnowBall_Item(new ItemIdentifier(ItemTypeIds::SNOWBALL);
$snowBall_Item->createEntity(new Location(), new Player());
```


---

#### getThrowForce

`public function getThrowForce(): float`


**Returns**: float


**Example**:

```php
$snowBall_Item = new SnowBall_Item(new ItemIdentifier(ItemTypeIds::SNOWBALL);
$snowBall_Item->getThrowForce();
```


---

#### getCooldownTicks

`public function getCooldownTicks(): int`


**Returns**: int


**Example**:

```php
$snowBall_Item = new SnowBall_Item(new ItemIdentifier(ItemTypeIds::SNOWBALL);
$snowBall_Item->getCooldownTicks();
```


---

## Class: core\custom\prefabs\soup\HealSoup

**Defined in**: `src\core\custom\prefabs\soup\HealSoup.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::BEETROOT_SOUP)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$healSoup = new HealSoup(new ItemIdentifier(ItemTypeIds::BEETROOT_SOUP);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$healSoup = new HealSoup(new ItemIdentifier(ItemTypeIds::BEETROOT_SOUP);
$healSoup->onClickAir(new Player(), new Vector3(), []);
```


---

## Class: core\database\KeepAlive

**Defined in**: `src\core\database\KeepAlive.php`


### Methods

#### __construct

`public function __construct(DataConnector $DBC)`


**Parameters**:

- `$DBC` (DataConnector) — 

**Example**:

```php
$keepAlive = new KeepAlive(new DataConnector());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$keepAlive = new KeepAlive(new DataConnector());
$keepAlive->onRun();
```


---

## Class: core\database\SwimDB

**Defined in**: `src\core\database\SwimDB.php`


### Methods

#### initialize

`public static function initialize(SwimCore $core): void`


**Parameters**:

- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
SwimDB::initialize(new SwimCore());
```


---

#### getDatabase

`public static function getDatabase(): DataConnector`


**Returns**: DataConnector


**Example**:

```php
SwimDB::getDatabase();
```


---

#### close

`public static function close(): void`


**Returns**: void


**Example**:

```php
SwimDB::close();
```


---

## Class: core\database\queries\ConnectionHandler

**Defined in**: `src\core\database\queries\ConnectionHandler.php`


### Methods

#### handlePlayerJoin

`public static function handlePlayerJoin(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
ConnectionHandler::handlePlayerJoin(new SwimPlayer());
```


---

#### updateDiscordLink

`public static function updateDiscordLink(string $xuid, string $discordId): void`


**Parameters**:

- `$xuid` (string) — 
- `$discordId` (string) — 

**Returns**: void


**Example**:

```php
ConnectionHandler::updateDiscordLink("example", "example");
```


---

#### removeDiscordLink

`public static function removeDiscordLink(string $xuid): void`


**Parameters**:

- `$xuid` (string) — 

**Returns**: void


**Example**:

```php
ConnectionHandler::removeDiscordLink("example");
```


---

#### getDiscordLink

`public static function getDiscordLink(string $xuid, callable $cb): void`


**Parameters**:

- `$xuid` (string) — 
- `$cb` (callable) — 

**Returns**: void


**Example**:

```php
ConnectionHandler::getDiscordLink("example", function() {});
```


---

#### checkPunishments

`private static function checkPunishments(SwimPlayer $swimPlayer, string $xuid): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$xuid` (string) — 

**Returns**: void


**Example**:

```php
ConnectionHandler::checkPunishments(new SwimPlayer(), "example");
```


---

#### checkMute

`private static function checkMute($row): bool`


**Parameters**:

- `$row` (mixed) — 

**Returns**: bool


**Example**:

```php
ConnectionHandler::checkMute(null);
```


---

#### checkBan

`private static function checkBan($row): bool`


**Parameters**:

- `$row` (mixed) — 

**Returns**: bool


**Example**:

```php
ConnectionHandler::checkBan(null);
```


---

## Class: core\database\queries\TableManager

**Defined in**: `src\core\database\queries\TableManager.php`


### Methods

#### createTables

`public static function createTables(): void`


**Returns**: void


**Example**:

```php
TableManager::createTables();
```


---

## Class: core\forms\hub\FormDuelRequests

**Defined in**: `src\core\forms\hub\FormDuelRequests.php`


### Methods

#### duelSelectionBase

`public static function duelSelectionBase(SwimCore $core, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::duelSelectionBase(new SwimCore(), new SwimPlayer());
```


---

#### viewDuelRequests

`private static function viewDuelRequests(SwimCore $core, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::viewDuelRequests(new SwimCore(), new SwimPlayer());
```


---

#### startDuel

`private static function startDuel(SwimCore $core, SwimPlayer $user, SwimPlayer $inviter, $inviteData): void`

> @throws ScoreFactoryException


**Parameters**:

- `$core` (SwimCore) — 
- `$user` (SwimPlayer) — 
- `$inviter` (SwimPlayer) — 
- `$inviteData` (mixed) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::startDuel(new SwimCore(), new SwimPlayer(), new SwimPlayer(), null);
```


---

#### viewPossibleOpponents

`private static function viewPossibleOpponents(SwimCore $core, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::viewPossibleOpponents(new SwimCore(), new SwimPlayer());
```


---

#### duelSelection

`private static function duelSelection(SwimCore $core, SwimPlayer $user, SwimPlayer $invited): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$user` (SwimPlayer) — 
- `$invited` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::duelSelection(new SwimCore(), new SwimPlayer(), new SwimPlayer());
```


---

#### selectMapForMode

`private static function selectMapForMode(SwimCore $core, SwimPlayer $user, SwimPlayer $invited, string $mode): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$user` (SwimPlayer) — 
- `$invited` (SwimPlayer) — 
- `$mode` (string) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::selectMapForMode(new SwimCore(), new SwimPlayer(), new SwimPlayer(), "example");
```


---

#### collectUniqueMapNames

`public static function collectUniqueMapNames(MapsData $mapsData, string $mode): array`

> Merge unique map base names for a mode (adds misc when using basic pool).


**Parameters**:

- `$mapsData` (MapsData) — 
- `$mode` (string) — 

**Returns**: array


**Example**:

```php
FormDuelRequests::collectUniqueMapNames(new MapsData(), "example");
```


---

#### sendMapSelectForm

`public static function sendMapSelectForm(array $names, callable $onPick, callable $onRandom, SwimPlayer $to): void`

> Build and send a "Select a Map" form.


**Parameters**:

- `$names` (array) — 
- `$onPick` (callable) — 
- `$onRandom` (callable) — 
- `$to` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuelRequests::sendMapSelectForm([], function() {}, function() {}, new SwimPlayer());
```


---

#### buildDuelFormWithButtons

`public static function buildDuelFormWithButtons(SimpleForm $form, array $buttons, SwimPlayer $player): array`


**Parameters**:

- `$form` (SimpleForm) — 
- `$buttons` (array) — 
- `$player` (SwimPlayer) — 

**Returns**: array


**Example**:

```php
FormDuelRequests::buildDuelFormWithButtons(new SimpleForm(), [], new SwimPlayer());
```


---

## Class: core\forms\hub\FormDuels

**Defined in**: `src\core\forms\hub\FormDuels.php`


### Methods

#### duelBaseForm

`public static function duelBaseForm(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuels::duelBaseForm(new SwimPlayer());
```


---

#### duelSelectionForm

`public static function duelSelectionForm(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormDuels::duelSelectionForm(new SwimPlayer());
```


---

#### formatModePlayerCounts

`private static function formatModePlayerCounts(string $mode, string $sceneClassPath, Queue $queue, SceneSystem $sceneSystem): string`


**Parameters**:

- `$mode` (string) — 
- `$sceneClassPath` (string) — 
- `$queue` (Queue) — 
- `$sceneSystem` (SceneSystem) — 

**Returns**: string


**Example**:

```php
FormDuels::formatModePlayerCounts("example", "example", new Queue(), new SceneSystem());
```


---

#### getQueuedCountOfMode

`private static function getQueuedCountOfMode(string $mode, Queue $queue): int`


**Parameters**:

- `$mode` (string) — 
- `$queue` (Queue) — 

**Returns**: int


**Example**:

```php
FormDuels::getQueuedCountOfMode("example", new Queue());
```


---

## Class: core\forms\hub\FormEvents

**Defined in**: `src\core\forms\hub\FormEvents.php`


### Methods

#### eventForm

`public static function eventForm(SwimCore $core, SwimPlayer $player): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormEvents::eventForm(new SwimCore(), new SwimPlayer());
```


---

#### joinEventsForm

`private static function joinEventsForm(SwimPlayer $swimPlayer, SwimCore $core): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
FormEvents::joinEventsForm(new SwimPlayer(), new SwimCore());
```


---

#### createEventsForm

`private static function createEventsForm(SwimPlayer $swimPlayer, SwimCore $core, EventSystem $eventSystem): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$core` (SwimCore) — 
- `$eventSystem` (EventSystem) — 

**Returns**: void


**Example**:

```php
FormEvents::createEventsForm(new SwimPlayer(), new SwimCore(), new EventSystem());
```


---

#### moddedSGForm

`private static function moddedSGForm(SwimPlayer $swimPlayer, SwimCore $core, EventSystem $eventSystem): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$core` (SwimCore) — 
- `$eventSystem` (EventSystem) — 

**Returns**: void


**Example**:

```php
FormEvents::moddedSGForm(new SwimPlayer(), new SwimCore(), new EventSystem());
```


---

## Class: core\forms\hub\FormFFA

**Defined in**: `src\core\forms\hub\FormFFA.php`


### Methods

#### ffaSelectionForm

`public static function ffaSelectionForm(SwimPlayer $player): void`

> Displays a selection form for FFA arenas to a player.


**Parameters**:

- `$player` (SwimPlayer) — The player to display the form to.

**Returns**: void


**Example**:

```php
FormFFA::ffaSelectionForm(new SwimPlayer());
```


---

## Class: core\forms\hub\FormServerSelector

**Defined in**: `src\core\forms\hub\FormServerSelector.php`


### Methods

#### serverSelectorForm

`public static function serverSelectorForm(SwimPlayer $player, SwimCore $core): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
FormServerSelector::serverSelectorForm(new SwimPlayer(), new SwimCore());
```


---

## Class: core\forms\hub\FormSettings

**Defined in**: `src\core\forms\hub\FormSettings.php`


### Methods

#### settingsForm

`public static function settingsForm(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormSettings::settingsForm(new SwimPlayer());
```


---

#### regularSettings

`public static function regularSettings(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormSettings::regularSettings(new SwimPlayer());
```


---

#### scrimSettings

`public static function scrimSettings(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormSettings::scrimSettings(new SwimPlayer());
```


---

## Class: core\forms\hub\FormSpectate

**Defined in**: `src\core\forms\hub\FormSpectate.php`


### Methods

#### spectateSelectionForm

`public static function spectateSelectionForm(SwimCore $core, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormSpectate::spectateSelectionForm(new SwimCore(), new SwimPlayer());
```


---

## Class: core\forms\parties\CombinedPartyForms

**Defined in**: `src\core\forms\parties\CombinedPartyForms.php`


### Methods

#### combinedJoinInviteRequestForm

`public static function combinedJoinInviteRequestForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
CombinedPartyForms::combinedJoinInviteRequestForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### combinedDuelRequestForm

`public static function combinedDuelRequestForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
CombinedPartyForms::combinedDuelRequestForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### combinedPartyManagementForm

`public static function combinedPartyManagementForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
CombinedPartyForms::combinedPartyManagementForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

## Class: core\forms\parties\FormPartyCreate

**Defined in**: `src\core\forms\parties\FormPartyCreate.php`


### Methods

#### partyBaseForm

`public static function partyBaseForm(SwimCore $core, SwimPlayer $player): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormPartyCreate::partyBaseForm(new SwimCore(), new SwimPlayer());
```


---

#### viewPartyInvitesForm

`private static function viewPartyInvitesForm(SwimCore $core, SwimPlayer $player): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormPartyCreate::viewPartyInvitesForm(new SwimCore(), new SwimPlayer());
```


---

#### partyCreateForm

`private static function partyCreateForm(SwimCore $core, SwimPlayer $player): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormPartyCreate::partyCreateForm(new SwimCore(), new SwimPlayer());
```


---

#### partyJoinForm

`private static function partyJoinForm(SwimCore $core, SwimPlayer $player): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
FormPartyCreate::partyJoinForm(new SwimCore(), new SwimPlayer());
```


---

## Class: core\forms\parties\FormPartyDuels

**Defined in**: `src\core\forms\parties\FormPartyDuels.php`


### Methods

#### baseForm

`public static function baseForm(SwimCore $core, SwimPlayer $swimPlayer, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::baseForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### selfPartyDuel

`private static function selfPartyDuel(SwimCore $core, SwimPlayer $swimPlayer, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::selfPartyDuel(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### pickOtherPartyToDuel

`public static function pickOtherPartyToDuel(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::pickOtherPartyToDuel(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### choosePartyDuelType

`private static function choosePartyDuelType(SwimCore $core, SwimPlayer $player, Party $senderParty, Party $otherParty): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$senderParty` (Party) — 
- `$otherParty` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::choosePartyDuelType(new SwimCore(), new SwimPlayer(), new Party(), new Party());
```


---

#### blockInPracticeForm

`private static function blockInPracticeForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::blockInPracticeForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### playgroundForm

`private static function playgroundForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::playgroundForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### sendPartyDuelRequest

`private static function sendPartyDuelRequest(SwimCore $core, SwimPlayer $player, Party $senderParty, Party $otherParty): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$senderParty` (Party) — 
- `$otherParty` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::sendPartyDuelRequest(new SwimCore(), new SwimPlayer(), new Party(), new Party());
```


---

#### selectMapForMode

`private static function selectMapForMode(SwimCore $core, SwimPlayer $player, Party $party, string $mode, bool $isSelfDuel, ?Party $otherParty = null): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 
- `$mode` (string) — 
- `$isSelfDuel` (bool) — 
- `$otherParty` (?Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::selectMapForMode(new SwimCore(), new SwimPlayer(), new Party(), "example", true, null);
```


---

#### acceptPartyDuelRequests

`public static function acceptPartyDuelRequests(SwimPlayer $player, Party $party): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyDuels::acceptPartyDuelRequests(new SwimPlayer(), new Party());
```


---

## Class: core\forms\parties\FormPartyExit

**Defined in**: `src\core\forms\parties\FormPartyExit.php`


### Methods

#### formPartyDisband

`public static function formPartyDisband(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyExit::formPartyDisband(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### formPartyLeave

`public static function formPartyLeave(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyExit::formPartyLeave(new SwimCore(), new SwimPlayer(), new Party());
```


---

## Class: core\forms\parties\FormPartyInvite

**Defined in**: `src\core\forms\parties\FormPartyInvite.php`


### Methods

#### formPartyInvite

`public static function formPartyInvite(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyInvite::formPartyInvite(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### formPartyRequests

`public static function formPartyRequests(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyInvite::formPartyRequests(new SwimCore(), new SwimPlayer(), new Party());
```


---

## Class: core\forms\parties\FormPartyManagePlayers

**Defined in**: `src\core\forms\parties\FormPartyManagePlayers.php`


### Methods

#### listPlayers

`public static function listPlayers(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyManagePlayers::listPlayers(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### manageForm

`private static function manageForm(SwimCore $core, SwimPlayer $selected, SwimPlayer $mod, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$selected` (SwimPlayer) — 
- `$mod` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartyManagePlayers::manageForm(new SwimCore(), new SwimPlayer(), new SwimPlayer(), new Party());
```


---

## Class: core\forms\parties\FormPartySettings

**Defined in**: `src\core\forms\parties\FormPartySettings.php`


### Methods

#### baseSelection

`public static function baseSelection(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartySettings::baseSelection(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### partyPvpSettingsForm

`public static function partyPvpSettingsForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartySettings::partyPvpSettingsForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

#### partySettingsForm

`public static function partySettingsForm(SwimCore $core, SwimPlayer $player, Party $party): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (SwimPlayer) — 
- `$party` (Party) — 

**Returns**: void


**Example**:

```php
FormPartySettings::partySettingsForm(new SwimCore(), new SwimPlayer(), new Party());
```


---

## Class: core\listeners\AntiCheatListener

**Defined in**: `src\core\listeners\AntiCheatListener.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
```


---

#### onDeath

`public function onDeath(PlayerDeathEvent $event)`


**Parameters**:

- `$event` (PlayerDeathEvent) — 

**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->onDeath(new PlayerDeathEvent());
```


---

#### onLogin

`public function onLogin(PlayerLoginEvent $event)`

> @var SwimPlayer $player */


**Parameters**:

- `$event` (PlayerLoginEvent) — 

**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->onLogin(new PlayerLoginEvent());
```


---

#### onPacketReceive

`public function onPacketReceive(DataPacketReceiveEvent $event)`

> @priority LOWEST


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->onPacketReceive(new DataPacketReceiveEvent());
```


---

#### enableBlobCacheOnClient

`private function enableBlobCacheOnClient(DataPacketReceiveEvent $event): void`

> @throws ReflectionException


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->enableBlobCacheOnClient(new DataPacketReceiveEvent());
```


---

#### updateExactPosition

`private function updateExactPosition(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->updateExactPosition(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

#### handleInput

`private function handleInput(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->handleInput(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

#### processNSL

`private function processNSL(DataPacketReceiveEvent $event, SwimPlayer $player): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->processNSL(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

#### processSwing

`private function processSwing(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$antiCheatListener = new AntiCheatListener(new SwimCore());
$antiCheatListener->processSwing(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

## Class: core\listeners\PlayerListener

**Defined in**: `src\core\listeners\PlayerListener.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
```


---

#### onPlayerConstructed

`public function onPlayerConstructed(PlayerCreationEvent $event)`


**Parameters**:

- `$event` (PlayerCreationEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->onPlayerConstructed(new PlayerCreationEvent());
```


---

#### onJoin

`public function onJoin(PlayerJoinEvent $event)`

> @throws ScoreFactoryException


**Parameters**:

- `$event` (PlayerJoinEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->onJoin(new PlayerJoinEvent());
```


---

#### itemDropCallback

`public function itemDropCallback(PlayerDropItemEvent $event)`

> @var SwimPlayer $player */


**Parameters**:

- `$event` (PlayerDropItemEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->itemDropCallback(new PlayerDropItemEvent());
```


---

#### itemUseCallback

`public function itemUseCallback(PlayerItemUseEvent $event)`

> @priority HIGHEST


**Parameters**:

- `$event` (PlayerItemUseEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->itemUseCallback(new PlayerItemUseEvent());
```


---

#### inventoryUseCallback

`public function inventoryUseCallback(InventoryTransactionEvent $event)`


**Parameters**:

- `$event` (InventoryTransactionEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->inventoryUseCallback(new InventoryTransactionEvent());
```


---

#### onCraft

`public function onCraft(CraftItemEvent $event): void`


**Parameters**:

- `$event` (CraftItemEvent) — 

**Returns**: void


**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->onCraft(new CraftItemEvent());
```


---

#### chestOpenEvent

`public function chestOpenEvent(PlayerInteractEvent $event): void`


**Parameters**:

- `$event` (PlayerInteractEvent) — 

**Returns**: void


**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->chestOpenEvent(new PlayerInteractEvent());
```


---

#### signEdit

`public function signEdit(SignChangeEvent $event): void`


**Parameters**:

- `$event` (SignChangeEvent) — 

**Returns**: void


**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->signEdit(new SignChangeEvent());
```


---

#### entityTeleportCallback

`public function entityTeleportCallback(EntityTeleportEvent $event)`


**Parameters**:

- `$event` (EntityTeleportEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->entityTeleportCallback(new EntityTeleportEvent());
```


---

#### playerConsumeCallback

`public function playerConsumeCallback(PlayerItemConsumeEvent $event)`


**Parameters**:

- `$event` (PlayerItemConsumeEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->playerConsumeCallback(new PlayerItemConsumeEvent());
```


---

#### playerPickupItem

`public function playerPickupItem(EntityItemPickupEvent $event)`


**Parameters**:

- `$event` (EntityItemPickupEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->playerPickupItem(new EntityItemPickupEvent());
```


---

#### projectileLaunchCallback

`public function projectileLaunchCallback(ProjectileLaunchEvent $event)`


**Parameters**:

- `$event` (ProjectileLaunchEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->projectileLaunchCallback(new ProjectileLaunchEvent());
```


---

#### projectileHitCallback

`public function projectileHitCallback(ProjectileHitEvent $event)`


**Parameters**:

- `$event` (ProjectileHitEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->projectileHitCallback(new ProjectileHitEvent());
```


---

#### entityRegainHealthCallback

`public function entityRegainHealthCallback(EntityRegainHealthEvent $event)`


**Parameters**:

- `$event` (EntityRegainHealthEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->entityRegainHealthCallback(new EntityRegainHealthEvent());
```


---

#### projectileHitEntityCallback

`public function projectileHitEntityCallback(ProjectileHitEntityEvent $event)`


**Parameters**:

- `$event` (ProjectileHitEntityEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->projectileHitEntityCallback(new ProjectileHitEntityEvent());
```


---

#### playerInteractCallback

`public function playerInteractCallback(PlayerInteractEvent $event)`


**Parameters**:

- `$event` (PlayerInteractEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->playerInteractCallback(new PlayerInteractEvent());
```


---

#### entitySpawnCallback

`public function entitySpawnCallback(EntitySpawnEvent $event)`


**Parameters**:

- `$event` (EntitySpawnEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->entitySpawnCallback(new EntitySpawnEvent());
```


---

#### blockPlaceCallback

`public function blockPlaceCallback(BlockPlaceEvent $event)`


**Parameters**:

- `$event` (BlockPlaceEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->blockPlaceCallback(new BlockPlaceEvent());
```


---

#### blockBreakCallback

`public function blockBreakCallback(BlockBreakEvent $event)`


**Parameters**:

- `$event` (BlockBreakEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->blockBreakCallback(new BlockBreakEvent());
```


---

#### bucketEmpty

`public function bucketEmpty(PlayerBucketEmptyEvent $event)`


**Parameters**:

- `$event` (PlayerBucketEmptyEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->bucketEmpty(new PlayerBucketEmptyEvent());
```


---

#### bucketFill

`public function bucketFill(PlayerBucketFillEvent $event)`


**Parameters**:

- `$event` (PlayerBucketFillEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->bucketFill(new PlayerBucketFillEvent());
```


---

#### blockSpread

`public function blockSpread(BlockSpreadEvent $event)`


**Parameters**:

- `$event` (BlockSpreadEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->blockSpread(new BlockSpreadEvent());
```


---

#### blockForm

`public function blockForm(BlockFormEvent $event)`


**Parameters**:

- `$event` (BlockFormEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->blockForm(new BlockFormEvent());
```


---

#### handleNaturalEvent

`private function handleNaturalEvent(BlockSpreadEvent|BlockFormEvent $event): void`


**Parameters**:

- `$event` (BlockSpreadEvent|BlockFormEvent) — 

**Returns**: void


**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->handleNaturalEvent(new BlockSpreadEvent());
```


---

#### getSceneFromBlockEvent

`private function getSceneFromBlockEvent(BlockSpreadEvent|BlockFormEvent $event): ?Scene`


**Parameters**:

- `$event` (BlockSpreadEvent|BlockFormEvent) — 

**Returns**: ?Scene


**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->getSceneFromBlockEvent(new BlockSpreadEvent());
```


---

#### startFlying

`public function startFlying(PlayerToggleFlightEvent $event)`


**Parameters**:

- `$event` (PlayerToggleFlightEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->startFlying(new PlayerToggleFlightEvent());
```


---

#### jumped

`public function jumped(PlayerJumpEvent $event)`


**Parameters**:

- `$event` (PlayerJumpEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->jumped(new PlayerJumpEvent());
```


---

#### dataPacketReceiveEvent

`public function dataPacketReceiveEvent(DataPacketReceiveEvent $event)`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Example**:

```php
$playerListener = new PlayerListener(new SwimCore());
$playerListener->dataPacketReceiveEvent(new DataPacketReceiveEvent());
```


---

## Class: core\listeners\WorldListener

**Defined in**: `src\core\listeners\WorldListener.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
```


---

#### openTable

`public function openTable(InventoryOpenEvent $e): void`


**Parameters**:

- `$e` (InventoryOpenEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->openTable(new InventoryOpenEvent());
```


---

#### closeTable

`public function closeTable(InventoryCloseEvent $event): void`


**Parameters**:

- `$event` (InventoryCloseEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->closeTable(new InventoryCloseEvent());
```


---

#### onDropItem

`public function onDropItem(PlayerDropItemEvent $event): void`


**Parameters**:

- `$event` (PlayerDropItemEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onDropItem(new PlayerDropItemEvent());
```


---

#### onEnchantInv

`public function onEnchantInv(InventoryTransactionEvent $event): void`


**Parameters**:

- `$event` (InventoryTransactionEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onEnchantInv(new InventoryTransactionEvent());
```


---

#### cacheArmorSounds

`public function cacheArmorSounds(): void`


**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->cacheArmorSounds();
```


---

#### onWorldLoad

`public function onWorldLoad(WorldLoadEvent $event): void`

> @throws ReflectionException


**Parameters**:

- `$event` (WorldLoadEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onWorldLoad(new WorldLoadEvent());
```


---

#### disableWorldLogging

`public static function disableWorldLogging(World $world): void`

> @throws ReflectionException


**Parameters**:

- `$world` (World) — 

**Returns**: void


**Example**:

```php
WorldListener::disableWorldLogging(new World());
```


---

#### onEntityVoid

`public function onEntityVoid(EntityDamageEvent $event)`


**Parameters**:

- `$event` (EntityDamageEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onEntityVoid(new EntityDamageEvent());
```


---

#### onLeavesDecay

`public function onLeavesDecay(LeavesDecayEvent $event)`


**Parameters**:

- `$event` (LeavesDecayEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onLeavesDecay(new LeavesDecayEvent());
```


---

#### onGrow

`public function onGrow(BlockGrowEvent $event): void`


**Parameters**:

- `$event` (BlockGrowEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onGrow(new BlockGrowEvent());
```


---

#### onBurn

`public function onBurn(BlockBurnEvent $event): void`


**Parameters**:

- `$event` (BlockBurnEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onBurn(new BlockBurnEvent());
```


---

#### onMelt

`public function onMelt(BlockMeltEvent $event): void`


**Parameters**:

- `$event` (BlockMeltEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onMelt(new BlockMeltEvent());
```


---

#### hubBlockInteract

`public function hubBlockInteract(PlayerInteractEvent $event)`


**Parameters**:

- `$event` (PlayerInteractEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->hubBlockInteract(new PlayerInteractEvent());
```


---

#### preventOffHanding

`public function preventOffHanding(InventoryTransactionEvent $event)`


**Parameters**:

- `$event` (InventoryTransactionEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->preventOffHanding(new InventoryTransactionEvent());
```


---

#### onDataPacketSendEvent

`public function onDataPacketSendEvent(DataPacketSendEvent $event): void`


**Parameters**:

- `$event` (DataPacketSendEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onDataPacketSendEvent(new DataPacketSendEvent());
```


---

#### onPlayerDeath

`public function onPlayerDeath(PlayerDeathEvent $event)`


**Parameters**:

- `$event` (PlayerDeathEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onPlayerDeath(new PlayerDeathEvent());
```


---

#### onEntityDamagedByEntity

`public function onEntityDamagedByEntity(EntityDamageByEntityEvent $event)`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onEntityDamagedByEntity(new EntityDamageByEntityEvent());
```


---

#### onBlockInteract

`public function onBlockInteract(PlayerInteractEvent $event)`


**Parameters**:

- `$event` (PlayerInteractEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onBlockInteract(new PlayerInteractEvent());
```


---

#### onBlockFall

`public function onBlockFall(EntitySpawnEvent $event)`


**Parameters**:

- `$event` (EntitySpawnEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onBlockFall(new EntitySpawnEvent());
```


---

#### onExhaust

`public function onExhaust(PlayerExhaustEvent $event)`


**Parameters**:

- `$event` (PlayerExhaustEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onExhaust(new PlayerExhaustEvent());
```


---

#### onSwim

`public function onSwim(PlayerToggleSwimEvent $event)`


**Parameters**:

- `$event` (PlayerToggleSwimEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onSwim(new PlayerToggleSwimEvent());
```


---

#### onBlockBreak

`public function onBlockBreak(BlockBreakEvent $event)`


**Parameters**:

- `$event` (BlockBreakEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onBlockBreak(new BlockBreakEvent());
```


---

#### onDataPacketReceive

`public function onDataPacketReceive(DataPacketReceiveEvent $event): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onDataPacketReceive(new DataPacketReceiveEvent());
```


---

#### handleReceive

`private function handleReceive(ServerboundPacket $packet, SwimPlayer $player, DataPacketReceiveEvent $event): void`

> @var SwimPlayer $player */


**Parameters**:

- `$packet` (ServerboundPacket) — 
- `$player` (SwimPlayer) — 
- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleReceive(new ServerboundPacket(), new SwimPlayer(), new DataPacketReceiveEvent());
```


---

#### onDataPacketSend

`public function onDataPacketSend(DataPacketSendEvent $event): void`

> @var InventoryTransactionPacket $packet */


**Parameters**:

- `$event` (DataPacketSendEvent) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onDataPacketSend(new DataPacketSendEvent());
```


---

#### handleSetTimePacket

`private function handleSetTimePacket($packet, &$packets, $key): void`

> @var $packet ResourcePacksInfoPacket */


**Parameters**:

- `$packet` (mixed) — 
- `&$packets` (mixed) — 
- `$key` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleSetTimePacket(null, null, null);
```


---

#### handlePlayerListPacket

`private function handlePlayerListPacket($packet): void`

> @var SetTimePacket $packet */


**Parameters**:

- `$packet` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handlePlayerListPacket(null);
```


---

#### handleStartGamePacket

`private function handleStartGamePacket($packet, $event, $key): void`

> @var PlayerListPacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `$event` (mixed) — 
- `$key` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleStartGamePacket(null, null, null);
```


---

#### handleCreativeContentPacket

`private function handleCreativeContentPacket($packet, $event, $key): void`

> @var StartGamePacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `$event` (mixed) — 
- `$key` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleCreativeContentPacket(null, null, null);
```


---

#### handleSetPlayerGameTypePacket

`private function handleSetPlayerGameTypePacket($packet, $event, $key): void`

> @var CreativeContentPacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `$event` (mixed) — 
- `$key` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleSetPlayerGameTypePacket(null, null, null);
```


---

#### handleLevelSoundEventPacket

`private function handleLevelSoundEventPacket($packet, &$packets, $key): void`

> @var SetPlayerGameTypePacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `&$packets` (mixed) — 
- `$key` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleLevelSoundEventPacket(null, null, null);
```


---

#### handleBlockEventPacket

`private function handleBlockEventPacket($packet, &$packets, $key): void`

> @var LevelSoundEventPacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `&$packets` (mixed) — 
- `$key` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleBlockEventPacket(null, null, null);
```


---

#### handleActorPackets

`private function handleActorPackets($packet, &$packets, $key, $event): void`

> @var BlockEventPacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `&$packets` (mixed) — 
- `$key` (mixed) — 
- `$event` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleActorPackets(null, null, null, null);
```


---

#### handleRemoveActorPacket

`private function handleRemoveActorPacket($packet, $event): void`

> @var MoveActorAbsolutePacket|AddActorPacket|AddPlayerPacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `$event` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleRemoveActorPacket(null, null);
```


---

#### handleSetActorMotionPacket

`private function handleSetActorMotionPacket($packet, $event): void`

> @var RemoveActorPacket $packet */


**Parameters**:

- `$packet` (mixed) — 
- `$event` (mixed) — 

**Returns**: void


**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->handleSetActorMotionPacket(null, null);
```


---

#### onQueryRegenerate

`public function onQueryRegenerate(QueryRegenerateEvent $ev)`

> @var SetActorMotionPacket $packet */


**Parameters**:

- `$ev` (QueryRegenerateEvent) — 

**Example**:

```php
$worldListener = new WorldListener(new SwimCore());
$worldListener->onQueryRegenerate(new QueryRegenerateEvent());
```


---

## Class: core\maps\info\FourTeamMapInfo

**Defined in**: `src\core\maps\info\FourTeamMapInfo.php`


### Methods

#### getSpawnPos3

`public function getSpawnPos3(): Vector3`

> @var Vector3[] */


**Returns**: Vector3


**Example**:

```php
$fourTeamMapInfo = new FourTeamMapInfo();
$fourTeamMapInfo->getSpawnPos3();
```


---

#### getSpawnPos4

`public function getSpawnPos4(): Vector3`


**Returns**: Vector3


**Example**:

```php
$fourTeamMapInfo = new FourTeamMapInfo();
$fourTeamMapInfo->getSpawnPos4();
```


---

## Class: core\maps\pool\BasicDuelMaps

**Defined in**: `src\core\maps\pool\BasicDuelMaps.php`


### Methods

#### loadMapData

`protected function loadMapData(): void`


**Returns**: void


**Example**:

```php
$basicDuelMaps = new BasicDuelMaps();
$basicDuelMaps->loadMapData();
```


---

## Class: core\scenes\for

**Defined in**: `src\core\scenes\PvP.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, string $name)`


**Parameters**:

- `$core` (SwimCore) — 
- `$name` (string) — 

**Example**:

```php
$for = new for(new SwimCore(), "example");
```


---

#### sceneEntityDamageEvent

`public function sceneEntityDamageEvent(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->sceneEntityDamageEvent(new EntityDamageEvent(), new SwimPlayer());
```


---

#### playerTakesMiscDamage

`protected function playerTakesMiscDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->playerTakesMiscDamage(new EntityDamageEvent(), new SwimPlayer());
```


---

#### playerDiedToMiscDamage

`protected function playerDiedToMiscDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->playerDiedToMiscDamage(new EntityDamageEvent(), new SwimPlayer());
```


---

#### adjustFallDamage

`private function adjustFallDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->adjustFallDamage(new EntityDamageEvent(), new SwimPlayer());
```


---

#### sceneProjectileLaunchEvent

`public function sceneProjectileLaunchEvent(ProjectileLaunchEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (ProjectileLaunchEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->sceneProjectileLaunchEvent(new ProjectileLaunchEvent(), new SwimPlayer());
```


---

#### sceneEntityDamageByChildEntityEvent

`public function sceneEntityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->sceneEntityDamageByChildEntityEvent(new EntityDamageByChildEntityEvent(), new SwimPlayer());
```


---

#### playerDiedToChildEntity

`protected function playerDiedToChildEntity(EntityDamageByChildEntityEvent $event, SwimPlayer $victim, SwimPlayer $attacker, Entity $childEntity): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 
- `$victim` (SwimPlayer) — 
- `$attacker` (SwimPlayer) — 
- `$childEntity` (Entity) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->playerDiedToChildEntity(new EntityDamageByChildEntityEvent(), new SwimPlayer(), new SwimPlayer(), new Entity());
```


---

#### hitByProjectile

`protected function hitByProjectile(SwimPlayer $hitPlayer, SwimPlayer $hitter, Entity $projectile, EntityDamageByChildEntityEvent $event): void`


**Parameters**:

- `$hitPlayer` (SwimPlayer) — 
- `$hitter` (SwimPlayer) — 
- `$projectile` (Entity) — 
- `$event` (EntityDamageByChildEntityEvent) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->hitByProjectile(new SwimPlayer(), new SwimPlayer(), new Entity(), new EntityDamageByChildEntityEvent());
```


---

#### arrowDamageMessage

`protected function arrowDamageMessage(SwimPlayer $hitter, SwimPlayer $hitPlayer, EntityDamageByChildEntityEvent $event, bool $doSound = true): void`


**Parameters**:

- `$hitter` (SwimPlayer) — 
- `$hitPlayer` (SwimPlayer) — 
- `$event` (EntityDamageByChildEntityEvent) — 
- `$doSound` (bool) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->arrowDamageMessage(new SwimPlayer(), new SwimPlayer(), new EntityDamageByChildEntityEvent(), true);
```


---

#### playerHit

`protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->playerHit(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### sceneEntityRegainHealthEvent

`public function sceneEntityRegainHealthEvent(EntityRegainHealthEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityRegainHealthEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->sceneEntityRegainHealthEvent(new EntityRegainHealthEvent(), new SwimPlayer());
```


---

#### scenePlayerSpawnChildEvent

`public function scenePlayerSpawnChildEvent(EntitySpawnEvent $event, SwimPlayer $swimPlayer, Entity $spawnedEntity): void`


**Parameters**:

- `$event` (EntitySpawnEvent) — 
- `$swimPlayer` (SwimPlayer) — 
- `$spawnedEntity` (Entity) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->scenePlayerSpawnChildEvent(new EntitySpawnEvent(), new SwimPlayer(), new Entity());
```


---

#### scenePlayerPickupItem

`public function scenePlayerPickupItem(EntityItemPickupEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityItemPickupEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->scenePlayerPickupItem(new EntityItemPickupEvent(), new SwimPlayer());
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$for = new for(new SwimCore(), "example");
$for->exit();
```


---

## Class: core\scenes\duel\Boxing

**Defined in**: `src\core\scenes\duel\Boxing.php`


### Methods

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
Boxing::getIcon();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->init();
```


---

#### applyKit

`protected function applyKit(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->applyKit(new SwimPlayer());
```


---

#### duelStart

`protected function duelStart(): void`


**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->duelStart();
```


---

#### playerHit

`protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`

> @throws ScoreFactoryException


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->playerHit(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### duelOver

`protected function duelOver(Team $winners, Team $losers): void`


**Parameters**:

- `$winners` (Team) — 
- `$losers` (Team) — 

**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->duelOver(new Team(), new Team());
```


---

#### partyWin

`private function partyWin(string $winnerTeamName): void`


**Parameters**:

- `$winnerTeamName` (string) — 

**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->partyWin("example");
```


---

#### spectatorBoxingScoreboard

`private function spectatorBoxingScoreboard(SwimPlayer $player): void`

> @throws ScoreFactoryException


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->spectatorBoxingScoreboard(new SwimPlayer());
```


---

#### duelScoreboard

`public function duelScoreboard(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$boxing = new Boxing();
$boxing->duelScoreboard(new SwimPlayer());
```


---

## Class: core\scenes\duel\Duel

**Defined in**: `src\core\scenes\duel\Duel.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, string $name, World $world, string $modeName)`


**Parameters**:

- `$core` (SwimCore) — 
- `$name` (string) — 
- `$world` (World) — 
- `$modeName` (string) — 

**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
```


---

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
Duel::getIcon();
```


---

#### isFinished

`public function isFinished(): bool`


**Returns**: bool


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->isFinished();
```


---

#### alwaysAllowSpectators

`public function alwaysAllowSpectators(): bool`


**Returns**: bool


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->alwaysAllowSpectators();
```


---

#### getNonSpecsPlayerCount

`public function getNonSpecsPlayerCount(): int`


**Returns**: int


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->getNonSpecsPlayerCount();
```


---

#### sceneEntityDamageByEntityEvent

`public function sceneEntityDamageByEntityEvent(EntityDamageByEntityEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->sceneEntityDamageByEntityEvent(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### playerDiedToMiscDamage

`protected function playerDiedToMiscDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->playerDiedToMiscDamage(new EntityDamageEvent(), new SwimPlayer());
```


---

#### playerDiedToChildEntity

`protected function playerDiedToChildEntity(EntityDamageByChildEntityEvent $event, SwimPlayer $victim, SwimPlayer $attacker, Entity $childEntity): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 
- `$victim` (SwimPlayer) — 
- `$attacker` (SwimPlayer) — 
- `$childEntity` (Entity) — 

**Returns**: void


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->playerDiedToChildEntity(new EntityDamageByChildEntityEvent(), new SwimPlayer(), new SwimPlayer(), new Entity());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### defaultDeathHandle

`protected function defaultDeathHandle(SwimPlayer $attacker, SwimPlayer $victim): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->defaultDeathHandle(new SwimPlayer(), new SwimPlayer());
```


---

#### deathEffect

`protected function deathEffect(SwimPlayer $swimPlayer, bool $blood = true, bool $explode = false, bool $bolt = false): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$blood` (bool) — 
- `$explode` (bool) — 
- `$bolt` (bool) — 

**Returns**: void


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->deathEffect(new SwimPlayer(), true, false, false);
```


---

#### getLoserByXuid

`protected function getLoserByXuid(string $xuid): ?SwimPlayer`


**Parameters**:

- `$xuid` (string) — 

**Returns**: ?SwimPlayer


**Example**:

```php
$duel = new Duel(new SwimCore(), "example", new World(), "example");
$duel->getLoserByXuid("example");
```


---

## Class: core\scenes\duel\IconHelper

**Defined in**: `src\core\scenes\duel\IconHelper.php`


### Methods

#### getIcon

`public static function getIcon(string $string): ?string`


**Parameters**:

- `$string` (string) — 

**Returns**: ?string


**Example**:

```php
IconHelper::getIcon("example");
```


---

## Class: core\scenes\duel\Midfight

**Defined in**: `src\core\scenes\duel\Midfight.php`


### Methods

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
Midfight::getIcon();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->init();
```


---

#### playerHit

`protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->playerHit(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`

> @throws ScoreFactoryException


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### teamCheck

`private function teamCheck(Team $killerTeam, Team $victimTeam): void`

> @throws ScoreFactoryException


**Parameters**:

- `$killerTeam` (Team) — 
- `$victimTeam` (Team) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->teamCheck(new Team(), new Team());
```


---

#### duelScoreboard

`public function duelScoreboard(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->duelScoreboard(new SwimPlayer());
```


---

#### kit

`private function kit(int $enum): void`


**Parameters**:

- `$enum` (int) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->kit(123);
```


---

#### applyKit

`protected function applyKit(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->applyKit(new SwimPlayer());
```


---

#### duelStart

`protected function duelStart(): void`


**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->duelStart();
```


---

#### duelOver

`protected function duelOver(Team $winners, Team $losers): void`


**Parameters**:

- `$winners` (Team) — 
- `$losers` (Team) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->duelOver(new Team(), new Team());
```


---

#### partyWin

`private function partyWin(string $winnerTeamName): void`


**Parameters**:

- `$winnerTeamName` (string) — 

**Returns**: void


**Example**:

```php
$midfight = new Midfight();
$midfight->partyWin("example");
```


---

## Class: core\scenes\duel\Nodebuff

**Defined in**: `src\core\scenes\duel\Nodebuff.php`


### Methods

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
Nodebuff::getIcon();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$nodebuff = new Nodebuff();
$nodebuff->init();
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nodebuff = new Nodebuff();
$nodebuff->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### applyKit

`protected function applyKit(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nodebuff = new Nodebuff();
$nodebuff->applyKit(new SwimPlayer());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$nodebuff = new Nodebuff();
$nodebuff->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### duelOver

`protected function duelOver(Team $winners, Team $losers): void`


**Parameters**:

- `$winners` (Team) — 
- `$losers` (Team) — 

**Returns**: void


**Example**:

```php
$nodebuff = new Nodebuff();
$nodebuff->duelOver(new Team(), new Team());
```


---

#### partyWin

`private function partyWin(string $winnerTeamName): void`


**Parameters**:

- `$winnerTeamName` (string) — 

**Returns**: void


**Example**:

```php
$nodebuff = new Nodebuff();
$nodebuff->partyWin("example");
```


---

## Class: core\scenes\duel\SkyGoalGame

**Defined in**: `src\core\scenes\duel\SkyGoalGame.php`


### Methods

#### duelUpdateSecond

`public function duelUpdateSecond(): void`


**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->duelUpdateSecond();
```


---

#### duelScoreboard

`public function duelScoreboard(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->duelScoreboard(new SwimPlayer());
```


---

#### sceneBlockBreakEvent

`public function sceneBlockBreakEvent(BlockBreakEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (BlockBreakEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->sceneBlockBreakEvent(new BlockBreakEvent(), new SwimPlayer());
```


---

#### sceneBlockPlaceEvent

`public function sceneBlockPlaceEvent(BlockPlaceEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (BlockPlaceEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->sceneBlockPlaceEvent(new BlockPlaceEvent(), new SwimPlayer());
```


---

#### checkBlocksForWater

`private function checkBlocksForWater(int|float $x, int|float $y, int|float $z, int $checks = 4): bool`


**Parameters**:

- `$x` (int|float) — 
- `$y` (int|float) — 
- `$z` (int|float) — 
- `$checks` (int) — 

**Returns**: bool


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->checkBlocksForWater(123, 123, 123, 4);
```


---

#### updateTick

`public function updateTick(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->updateTick();
```


---

#### jumpedInGoal

`private function jumpedInGoal(SwimPlayer $swimPlayer): bool`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->jumpedInGoal(new SwimPlayer());
```


---

#### scored

`private function scored(SwimPlayer $scorer, Team $scorerTeam, Team $scoredOnTeam): void`

> @throws ScoreFactoryException


**Parameters**:

- `$scorer` (SwimPlayer) — 
- `$scorerTeam` (Team) — 
- `$scoredOnTeam` (Team) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->scored(new SwimPlayer(), new Team(), new Team());
```


---

#### sendTeamBackToSpawnAndFreeze

`private function sendTeamBackToSpawnAndFreeze(Team $team, Position $position): void`


**Parameters**:

- `$team` (Team) — 
- `$position` (Position) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->sendTeamBackToSpawnAndFreeze(new Team(), new Position());
```


---

#### playerHit

`protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->playerHit(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### playerDiedToMiscDamage

`protected function playerDiedToMiscDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->playerDiedToMiscDamage(new EntityDamageEvent(), new SwimPlayer());
```


---

#### playerDiedToChildEntity

`protected function playerDiedToChildEntity(EntityDamageByChildEntityEvent $event, SwimPlayer $victim, SwimPlayer $attacker, Entity $childEntity): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 
- `$victim` (SwimPlayer) — 
- `$attacker` (SwimPlayer) — 
- `$childEntity` (Entity) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->playerDiedToChildEntity(new EntityDamageByChildEntityEvent(), new SwimPlayer(), new SwimPlayer(), new Entity());
```


---

#### defaultDeathHandle

`protected function defaultDeathHandle(SwimPlayer $attacker, SwimPlayer $victim): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->defaultDeathHandle(new SwimPlayer(), new SwimPlayer());
```


---

#### deathHandle

`private function deathHandle(SwimPlayer $swimPlayer, Team $team, ?SwimPlayer $attacker = null): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$team` (Team) — 
- `$attacker` (?SwimPlayer) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->deathHandle(new SwimPlayer(), new Team(), null);
```


---

#### processKillFromPlayer

`private function processKillFromPlayer(SwimPlayer $attacker, SwimPlayer $victim, Team $victimTeam): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$victimTeam` (Team) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->processKillFromPlayer(new SwimPlayer(), new SwimPlayer(), new Team());
```


---

#### respawn

`private function respawn(SwimPlayer $swimPlayer, Team $team): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$team` (Team) — 

**Returns**: void


**Example**:

```php
$skyGoalGame = new SkyGoalGame();
$skyGoalGame->respawn(new SwimPlayer(), new Team());
```


---

## Class: core\scenes\duel\behaviors\ArrowRecharge

**Defined in**: `src\core\scenes\duel\behaviors\ArrowRecharge.php`


### Methods

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$arrowRecharge = new ArrowRecharge();
$arrowRecharge->init();
```


---

#### eventUpdateTick

`public function eventUpdateTick(): void`


**Returns**: void


**Example**:

```php
$arrowRecharge = new ArrowRecharge();
$arrowRecharge->eventUpdateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$arrowRecharge = new ArrowRecharge();
$arrowRecharge->exit();
```


---

## Class: core\scenes\duel\behaviors\AttackProtection

**Defined in**: `src\core\scenes\duel\behaviors\AttackProtection.php`


### Methods

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->init();
```


---

#### isDestroyOnAttack

`public function isDestroyOnAttack(): bool`


**Returns**: bool


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->isDestroyOnAttack();
```


---

#### setDestroyOnAttack

`public function setDestroyOnAttack(bool $destroyOnAttack): void`


**Parameters**:

- `$destroyOnAttack` (bool) — 

**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->setDestroyOnAttack(true);
```


---

#### entityDamageByEntityEvent

`protected function entityDamageByEntityEvent(EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->entityDamageByEntityEvent(new EntityDamageByEntityEvent());
```


---

#### entityDamageByChildEntityEvent

`protected function entityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 

**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->entityDamageByChildEntityEvent(new EntityDamageByChildEntityEvent());
```


---

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### loseSpawnProtection

`private function loseSpawnProtection(): void`


**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->loseSpawnProtection();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$attackProtection = new AttackProtection();
$attackProtection->exit();
```


---

## Class: core\scenes\duel\behaviors\RespawnTimer

**Defined in**: `src\core\scenes\duel\behaviors\RespawnTimer.php`


### Methods

#### message

`private function message(): void`


**Returns**: void


**Example**:

```php
$respawnTimer = new RespawnTimer();
$respawnTimer->message();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$respawnTimer = new RespawnTimer();
$respawnTimer->init();
```


---

#### setDuel

`public function setDuel(Duel $duel): void`


**Parameters**:

- `$duel` (Duel) — 

**Returns**: void


**Example**:

```php
$respawnTimer = new RespawnTimer();
$respawnTimer->setDuel(new Duel());
```


---

#### setTeam

`public function setTeam(Team $team): void`


**Parameters**:

- `$team` (Team) — 

**Returns**: void


**Example**:

```php
$respawnTimer = new RespawnTimer();
$respawnTimer->setTeam(new Team());
```


---

#### eventUpdateSecond

`public function eventUpdateSecond(): void`


**Returns**: void


**Example**:

```php
$respawnTimer = new RespawnTimer();
$respawnTimer->eventUpdateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$respawnTimer = new RespawnTimer();
$respawnTimer->exit();
```


---

## Class: core\scenes\duel\behaviors\is

**Defined in**: `src\core\scenes\duel\behaviors\RespawnTimer.php`


### Methods

_No methods found_

## Class: core\scenes\ffas\FFA

**Defined in**: `src\core\scenes\ffas\FFA.php`


### Methods

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
FFA::getIcon();
```


---

#### AutoLoad

`public static function AutoLoad(): bool`


**Returns**: bool


**Example**:

```php
FFA::AutoLoad();
```


---

#### isFFA

`public function isFFA(): bool`


**Returns**: bool


**Example**:

```php
$fFA = new FFA();
$fFA->isFFA();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->init();
```


---

#### teleportToArena

`protected function teleportToArena(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->teleportToArena(new SwimPlayer());
```


---

#### cleanUpItemEntities

`public function cleanUpItemEntities(int $seconds): void`


**Parameters**:

- `$seconds` (int) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->cleanUpItemEntities(123);
```


---

#### sceneEntityDamageByEntityEvent

`public function sceneEntityDamageByEntityEvent(EntityDamageByEntityEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->sceneEntityDamageByEntityEvent(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### defaultDeathHandle

`protected function defaultDeathHandle(?SwimPlayer $attacker, SwimPlayer $victim, bool $explode = true, bool $useTeamColorForKillStreak = false): void`


**Parameters**:

- `$attacker` (?SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$explode` (bool) — 
- `$useTeamColorForKillStreak` (bool) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->defaultDeathHandle(new SwimPlayer(), new SwimPlayer(), true, false);
```


---

#### ffaNameTag

`protected function ffaNameTag(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->ffaNameTag(new SwimPlayer());
```


---

#### ffaScoreTag

`protected function ffaScoreTag(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->ffaScoreTag(new SwimPlayer());
```


---

#### ffaScoreboard

`protected function ffaScoreboard(SwimPlayer $player): void`

> @throws ScoreFactoryException


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->ffaScoreboard(new SwimPlayer());
```


---

#### killMessage

`protected function killMessage(SwimPlayer $attacker, SwimPlayer $victim): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$fFA = new FFA();
$fFA->killMessage(new SwimPlayer(), new SwimPlayer());
```


---

## Class: core\scenes\ffas\MidFightFFA

**Defined in**: `src\core\scenes\ffas\MidFightFFA.php`


### Methods

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
MidFightFFA::getIcon();
```


---

#### __construct

`public function __construct(SwimCore $core, string $name)`


**Parameters**:

- `$core` (SwimCore) — 
- `$name` (string) — 

**Example**:

```php
$midFightFFA = new MidFightFFA(new SwimCore(), "example");
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$midFightFFA = new MidFightFFA(new SwimCore(), "example");
$midFightFFA->playerAdded(new SwimPlayer());
```


---

#### restart

`public function restart(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$midFightFFA = new MidFightFFA(new SwimCore(), "example");
$midFightFFA->restart(new SwimPlayer());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$midFightFFA = new MidFightFFA(new SwimCore(), "example");
$midFightFFA->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### playerHit

`protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$midFightFFA = new MidFightFFA(new SwimCore(), "example");
$midFightFFA->playerHit(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### updateSecond

`public function updateSecond(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$midFightFFA = new MidFightFFA(new SwimCore(), "example");
$midFightFFA->updateSecond();
```


---

## Class: core\scenes\ffas\NodebuffFFA

**Defined in**: `src\core\scenes\ffas\NodebuffFFA.php`


### Methods

#### getIcon

`public static function getIcon(): string`


**Returns**: string


**Example**:

```php
NodebuffFFA::getIcon();
```


---

#### __construct

`public function __construct(SwimCore $core, string $name)`


**Parameters**:

- `$core` (SwimCore) — 
- `$name` (string) — 

**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
$nodebuffFFA->playerAdded(new SwimPlayer());
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
$nodebuffFFA->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### playerKilled

`protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 
- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
$nodebuffFFA->playerKilled(new SwimPlayer(), new SwimPlayer(), new EntityDamageByEntityEvent());
```


---

#### potKillMessage

`private function potKillMessage(SwimPlayer $attacker, SwimPlayer $victim): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
$nodebuffFFA->potKillMessage(new SwimPlayer(), new SwimPlayer());
```


---

#### updateSecond

`public function updateSecond(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
$nodebuffFFA->updateSecond();
```


---

#### restart

`public function restart(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$nodebuffFFA = new NodebuffFFA(new SwimCore(), "example");
$nodebuffFFA->restart(new SwimPlayer());
```


---

## Class: core\scenes\hub\EventQueue

**Defined in**: `src\core\scenes\hub\EventQueue.php`


### Methods

#### AutoLoad

`public static function AutoLoad(): bool`


**Returns**: bool


**Example**:

```php
EventQueue::AutoLoad();
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`

> @throws ReflectionException


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventQueue = new EventQueue();
$eventQueue->playerAdded(new SwimPlayer());
```


---

#### restart

`public function restart(SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventQueue = new EventQueue();
$eventQueue->restart(new SwimPlayer());
```


---

#### teleportToHub

`private function teleportToHub(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventQueue = new EventQueue();
$eventQueue->teleportToHub(new SwimPlayer());
```


---

#### kit

`public static function kit(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
EventQueue::kit(new SwimPlayer());
```


---

#### setHubTags

`private function setHubTags(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventQueue = new EventQueue();
$eventQueue->setHubTags(new SwimPlayer());
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventQueue = new EventQueue();
$eventQueue->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### hubBoard

`private function hubBoard(SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventQueue = new EventQueue();
$eventQueue->hubBoard(new SwimPlayer());
```


---

## Class: core\scenes\hub\GodMode

**Defined in**: `src\core\scenes\hub\GodMode.php`


### Methods

#### AutoLoad

`public static function AutoLoad(): bool`


**Returns**: bool


**Example**:

```php
GodMode::AutoLoad();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$godMode = new GodMode();
$godMode->init();
```


---

#### movementKit

`private function movementKit(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$godMode = new GodMode();
$godMode->movementKit(new Player());
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$godMode = new GodMode();
$godMode->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### sceneEntityDamageEvent

`public function sceneEntityDamageEvent(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$godMode = new GodMode();
$godMode->sceneEntityDamageEvent(new EntityDamageEvent(), new SwimPlayer());
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$godMode = new GodMode();
$godMode->playerAdded(new SwimPlayer());
```


---

#### playerRemoved

`public function playerRemoved(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$godMode = new GodMode();
$godMode->playerRemoved(new SwimPlayer());
```


---

## Class: core\scenes\hub\Hub

**Defined in**: `src\core\scenes\hub\Hub.php`


### Methods

#### AutoLoad

`public static function AutoLoad(): bool`


**Returns**: bool


**Example**:

```php
Hub::AutoLoad();
```


---

#### hubBoard

`private function hubBoard(SwimPlayer $swimPlayer): void`

> @throws ReflectionException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$hub = new Hub();
$hub->hubBoard(new SwimPlayer());
```


---

#### sceneBlockPlaceEvent

`public function sceneBlockPlaceEvent(BlockPlaceEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (BlockPlaceEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$hub = new Hub();
$hub->sceneBlockPlaceEvent(new BlockPlaceEvent(), new SwimPlayer());
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$hub = new Hub();
$hub->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### editKitConfirm

`public static function editKitConfirm(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
Hub::editKitConfirm(new SwimPlayer());
```


---

## Class: core\scenes\hub\Loading

**Defined in**: `src\core\scenes\hub\Loading.php`


### Methods

#### AutoLoad

`public static function AutoLoad(): bool`


**Returns**: bool


**Example**:

```php
Loading::AutoLoad();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->init();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->exit();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->updateSecond();
```


---

#### goHubAndWait

`private function goHubAndWait(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->goHubAndWait(new Player());
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->playerAdded(new SwimPlayer());
```


---

#### playerRemoved

`public function playerRemoved(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->playerRemoved(new SwimPlayer());
```


---

#### restart

`public function restart(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$loading = new Loading();
$loading->restart(new SwimPlayer());
```


---

## Class: core\scenes\hub\Queue

**Defined in**: `src\core\scenes\hub\Queue.php`


### Methods

#### init

`public function init(): void`

> @var array<string, DuelInfo> mode => DuelInfo */


**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->init();
```


---

#### deserialize

`protected function deserialize(): void`


**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->deserialize();
```


---

#### buildScenesClassIndex

`private function buildScenesClassIndex(string $scenesRoot): array`


**Parameters**:

- `$scenesRoot` (string) — 

**Returns**: array


**Example**:

```php
$queue = new Queue();
$queue->buildScenesClassIndex("example");
```


---

#### checkQueues

`protected function checkQueues(): void`

> @var SplFileInfo $file */


**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->checkQueues();
```


---

#### getWorldBasedOnMode

`public function getWorldBasedOnMode(string $mode): World`


**Parameters**:

- `$mode` (string) — 

**Returns**: World


**Example**:

```php
$queue = new Queue();
$queue->getWorldBasedOnMode("example");
```


---

#### getWorldBasedOnMode

`public function getWorldBasedOnMode(string $mode): World`


**Parameters**:

- `$mode` (string) — 

**Returns**: World


**Example**:

```php
$queue = new Queue();
$queue->getWorldBasedOnMode("example");
```


---

#### startDuel

`private function startDuel(Team $team): void`

> @throws ScoreFactoryException


**Parameters**:

- `$team` (Team) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->startDuel(new Team());
```


---

#### makeDuelSceneFromMode

`public function makeDuelSceneFromMode(string $mode, string $duelName, string $mapName): ?Duel`


**Parameters**:

- `$mode` (string) — 
- `$duelName` (string) — 
- `$mapName` (string) — 

**Returns**: ?Duel


**Example**:

```php
$queue = new Queue();
$queue->makeDuelSceneFromMode("example", "example", "example");
```


---

#### worldFix

`public function worldFix(World &$world, string $mode, string $mapName): void`


**Parameters**:

- `&$world` (World) — 
- `$mode` (string) — 
- `$mapName` (string) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->worldFix(new World(), "example", "example");
```


---

#### publicDuelStart

`public function publicDuelStart(SwimPlayer $playerOne, SwimPlayer $playerTwo, string $mode, string $mapName = 'random'): void`

> @throws ScoreFactoryException


**Parameters**:

- `$playerOne` (SwimPlayer) — 
- `$playerTwo` (SwimPlayer) — 
- `$mode` (string) — 
- `$mapName` (string) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->publicDuelStart(new SwimPlayer(), new SwimPlayer(), "example", 'random');
```


---

#### updateSecond

`public function updateSecond(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->updateSecond();
```


---

#### queueBoard

`private function queueBoard(SwimPlayer $swimPlayer, string $mode): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$mode` (string) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->queueBoard(new SwimPlayer(), "example");
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->playerAdded(new SwimPlayer());
```


---

#### queueKit

`private function queueKit(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->queueKit(new Player());
```


---

#### queueTag

`protected function queueTag(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$queue = new Queue();
$queue->queueTag(new SwimPlayer());
```


---

## Class: core\scenes\hub\exists

**Defined in**: `src\core\scenes\hub\Queue.php`

@var array<string, DuelInfo> mode => DuelInfo


### Methods

_No methods found_

## Class: core\scenes\hub\not

**Defined in**: `src\core\scenes\hub\Queue.php`

@var array<string, DuelInfo> mode => DuelInfo


### Methods

_No methods found_

## Class: core\systems\System

**Defined in**: `src\core\systems\System.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$system = new System(new SwimCore());
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$system = new System(new SwimCore());
$system->init();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$system = new System(new SwimCore());
$system->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$system = new System(new SwimCore());
$system->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$system = new System(new SwimCore());
$system->exit();
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$system = new System(new SwimCore());
$system->handlePlayerLeave(new SwimPlayer());
```


---

## Class: core\systems\SystemManager

**Defined in**: `src\core\systems\SystemManager.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
```


---

#### getPlayerSystem

`public function getPlayerSystem(): PlayerSystem`


**Returns**: PlayerSystem


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->getPlayerSystem();
```


---

#### getSceneSystem

`public function getSceneSystem(): SceneSystem`


**Returns**: SceneSystem


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->getSceneSystem();
```


---

#### getPartySystem

`public function getPartySystem(): PartiesSystem`


**Returns**: PartiesSystem


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->getPartySystem();
```


---

#### getMapsData

`public function getMapsData(): MapsData`


**Returns**: MapsData


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->getMapsData();
```


---

#### getEventSystem

`public function getEventSystem(): EventSystem`


**Returns**: EventSystem


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->getEventSystem();
```


---

#### getEntitySystem

`public function getEntitySystem(): EntitySystem`


**Returns**: EntitySystem


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->getEntitySystem();
```


---

#### init

`public function init(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->init();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->updateSecond();
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->handlePlayerLeave(new SwimPlayer());
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$systemManager = new SystemManager(new SwimCore());
$systemManager->exit();
```


---

## Class: core\systems\entity\Behavior

**Defined in**: `src\core\systems\entity\Behavior.php`


### Methods

#### __construct

`public function __construct(Actor $actor, ?Scene $scene = null)`


**Parameters**:

- `$actor` (Actor) — 
- `$scene` (?Scene) — 

**Example**:

```php
$behavior = new Behavior(new Actor(), null);
```


---

#### hasInited

`public function hasInited(): bool`


**Returns**: bool


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->hasInited();
```


---

#### setInited

`public function setInited(bool $inited): void`


**Parameters**:

- `$inited` (bool) — 

**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->setInited(true);
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->init();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->exit();
```


---

#### getParent

`public function getParent(): Actor`


**Returns**: Actor


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->getParent();
```


---

#### setParent

`public function setParent(Actor $parent): void`


**Parameters**:

- `$parent` (Actor) — 

**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->setParent(new Actor());
```


---

#### getScene

`public function getScene(): ?Scene`


**Returns**: ?Scene


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->getScene();
```


---

#### setScene

`public function setScene(Scene $scene): void`


**Parameters**:

- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->setScene(new Scene());
```


---

#### eventMessage

`public function eventMessage(string $message, ...$args): void`


**Parameters**:

- `$message` (string) — 
- `...$args` (mixed) — 

**Returns**: void


**Example**:

```php
$behavior = new Behavior(new Actor(), null);
$behavior->eventMessage("example", null);
```


---

## Class: core\systems\entity\EntityBehaviorManager

**Defined in**: `src\core\systems\entity\EntityBehaviorManager.php`


### Methods

#### getParent

`public function getParent(): Entity`

> @var Behavior[]


**Returns**: Entity


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->getParent();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->init();
```


---

#### initCheck

`private function initCheck(Behavior $behavior): void`


**Parameters**:

- `$behavior` (Behavior) — 

**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->initCheck(new Behavior());
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->exit();
```


---

#### addBehavior

`public function addBehavior(Behavior $behavior, string $name): void`


**Parameters**:

- `$behavior` (Behavior) — 
- `$name` (string) — 

**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->addBehavior(new Behavior(), "example");
```


---

#### hasBehavior

`public function hasBehavior(string $name): bool`


**Parameters**:

- `$name` (string) — 

**Returns**: bool


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->hasBehavior("example");
```


---

#### getBehavior

`public function getBehavior(string $name): ?Behavior`


**Parameters**:

- `$name` (string) — 

**Returns**: ?Behavior


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->getBehavior("example");
```


---

#### eventMessage

`public function eventMessage(string $message, ...$args): void`


**Parameters**:

- `$message` (string) — 
- `...$args` (mixed) — 

**Returns**: void


**Example**:

```php
$entityBehaviorManager = new EntityBehaviorManager();
$entityBehaviorManager->eventMessage("example", null);
```


---

## Class: core\systems\entity\name

**Defined in**: `src\core\systems\entity\EntityBehaviorManager.php`


### Methods

_No methods found_

## Class: core\systems\entity\EntitySystem

**Defined in**: `src\core\systems\entity\EntitySystem.php`


### Methods

#### deregisterEntity

`public function deregisterEntity(Actor $entity, bool $deSpawn = true, bool $kill = false, bool $callExit = true): void`

> @var Actor[]


**Parameters**:

- `$entity` (Actor) — 
- `$deSpawn` (bool) — 
- `$kill` (bool) — 
- `$callExit` (bool) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->deregisterEntity(new Actor(), true, false, true);
```


---

#### playerLeavingScene

`public function playerLeavingScene(Player $player, Scene $scene): void`


**Parameters**:

- `$player` (Player) — 
- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->playerLeavingScene(new Player(), new Scene());
```


---

#### playerJoiningScene

`public function playerJoiningScene(Player $player, Scene $scene): void`


**Parameters**:

- `$player` (Player) — 
- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->playerJoiningScene(new Player(), new Scene());
```


---

#### init

`public function init(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->init();
```


---

#### updateTick

`public function updateTick(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->exit();
```


---

#### eventMessage

`public function eventMessage(string $message, mixed $args = null): void`


**Parameters**:

- `$message` (string) — 
- `$args` (mixed) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->eventMessage("example", null);
```


---

#### sceneExiting

`public function sceneExiting(Scene $scene): void`

> @brief Called when a scene is being exited, exits and de-spawns + deletes all entities within that scene from memory.


**Parameters**:

- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->sceneExiting(new Scene());
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->handlePlayerLeave(new SwimPlayer());
```


---

#### deserialize

`private function deserialize(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->deserialize();
```


---

#### loadActorScripts

`private function loadActorScripts(string $directory, string $startPath): void`

> @throws ReflectionException


**Parameters**:

- `$directory` (string) — 
- `$startPath` (string) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->loadActorScripts("example", "example");
```


---

#### registerCustomEntity

`public function registerCustomEntity(string $className, string $identifier, ?Closure $creationFunc = null, string $behaviourId = ""): void`

> @throws ReflectionException


**Parameters**:

- `$className` (string) — 
- `$identifier` (string) — 
- `$creationFunc` (?Closure) — 
- `$behaviourId` (string) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->registerCustomEntity("example", "example", null, "");
```


---

#### updateStaticPacketCache

`private function updateStaticPacketCache(string $identifier, string $behaviourId): void`

> @throws ReflectionException


**Parameters**:

- `$identifier` (string) — 
- `$behaviourId` (string) — 

**Returns**: void


**Example**:

```php
$entitySystem = new EntitySystem();
$entitySystem->updateStaticPacketCache("example", "example");
```


---

## Class: core\systems\entity\name

**Defined in**: `src\core\systems\entity\EntitySystem.php`

* @var Actor[]
   * key is int id of the entity


### Methods

_No methods found_

## Class: core\systems\entity\failed

**Defined in**: `src\core\systems\entity\EntitySystem.php`

* @var Actor[]
   * key is int id of the entity


### Methods

_No methods found_

## Class: core\systems\entity\on

**Defined in**: `src\core\systems\entity\EntitySystem.php`

* @var Actor[]
   * key is int id of the entity


### Methods

_No methods found_

## Class: core\systems\entity\entities\intended

**Defined in**: `src\core\systems\entity\entities\Actor.php`


### Methods

#### __construct

`public function __construct(Location $location, ?Scene $parentScene = null, ?CompoundTag $nbt = null, ?Skin $skin = null)`

> @var Closure(int):bool|null */


**Parameters**:

- `$location` (Location) — 
- `$parentScene` (?Scene) — 
- `$nbt` (?CompoundTag) — 
- `$skin` (?Skin) — 

**Example**:

```php
$intended = new intended(new Location(), null, null, null);
```


---

#### getEntityBehaviorManager

`public function getEntityBehaviorManager(): EntityBehaviorManager`


**Returns**: EntityBehaviorManager


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getEntityBehaviorManager();
```


---

#### spawnToAllInScene

`public function spawnToAllInScene(): void`


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->spawnToAllInScene();
```


---

#### deSpawnActorFrom

`public function deSpawnActorFrom(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->deSpawnActorFrom(new Player());
```


---

#### deSpawnActorFromAll

`public function deSpawnActorFromAll(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->deSpawnActorFromAll();
```


---

#### addMotion

`public function addMotion(float $x, float $y, float $z): void`


**Parameters**:

- `$x` (float) — 
- `$y` (float) — 
- `$z` (float) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->addMotion(1.23, 1.23, 1.23);
```


---

#### setEntityBaseTickCallback

`public function setEntityBaseTickCallback(Closure $cb, bool $safety = false): void`

> @throws ReflectionException


**Parameters**:

- `$cb` (Closure) — 
- `$safety` (bool) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setEntityBaseTickCallback(new Closure(), false);
```


---

#### entityBaseTick

`public function entityBaseTick(int $tickDiff = 1): bool`


**Parameters**:

- `$tickDiff` (int) — 

**Returns**: bool


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->entityBaseTick(1);
```


---

#### setMotion

`public function setMotion(Vector3 $motion): bool`


**Parameters**:

- `$motion` (Vector3) — 

**Returns**: bool


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setMotion(new Vector3());
```


---

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
intended::getNetworkTypeId();
```


---

#### getParentScene

`public function getParentScene(): Scene`


**Returns**: Scene


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getParentScene();
```


---

#### setParentScene

`public function setParentScene(Scene $parentScene): void`


**Parameters**:

- `$parentScene` (Scene) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setParentScene(new Scene());
```


---

#### getInitialSizeInfo

`protected function getInitialSizeInfo(): EntitySizeInfo`


**Returns**: EntitySizeInfo


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getInitialSizeInfo();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->init();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->updateSecond();
```


---

#### spawnTo

`public function spawnTo(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->spawnTo(new Player());
```


---

#### updateTick

`public function updateTick(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->exit();
```


---

#### destroy

`public function destroy(bool $deSpawn = true, bool $kill = false, bool $callExit = true): void`

> @throws ReflectionException


**Parameters**:

- `$deSpawn` (bool) — 
- `$kill` (bool) — 
- `$callExit` (bool) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->destroy(true, false, true);
```


---

#### getLifeTime

`public function getLifeTime(): int`


**Returns**: int


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getLifeTime();
```


---

#### setLifeTime

`public function setLifeTime(int $lifeTime): void`


**Parameters**:

- `$lifeTime` (int) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setLifeTime(123);
```


---

#### getOffsetPosition

`public function getOffsetPosition(Vector3 $vector3): Vector3`


**Parameters**:

- `$vector3` (Vector3) — 

**Returns**: Vector3


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getOffsetPosition(new Vector3());
```


---

#### event

`public function event(string $message, mixed $args = null): void`


**Parameters**:

- `$message` (string) — 
- `$args` (mixed) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->event("example", null);
```


---

#### attack

`public function attack(EntityDamageEvent $source): void`


**Parameters**:

- `$source` (EntityDamageEvent) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->attack(new EntityDamageEvent());
```


---

#### doAnimation

`public function doAnimation(string $animation, string $nextState = "", string $stopExpression = "", int $stopExpressionVersion = 0, string $controller = "", float $blendOutTime = 0): void`


**Parameters**:

- `$animation` (string) — 
- `$nextState` (string) — 
- `$stopExpression` (string) — 
- `$stopExpressionVersion` (int) — 
- `$controller` (string) — 
- `$blendOutTime` (float) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->doAnimation("example", "", "", 0, "", 0);
```


---

#### setOnFire

`public function setOnFire(int $seconds): void`


**Parameters**:

- `$seconds` (int) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setOnFire(123);
```


---

#### initEntity

`protected function initEntity(CompoundTag $nbt): void`


**Parameters**:

- `$nbt` (CompoundTag) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->initEntity(new CompoundTag());
```


---

#### saveNBT

`public function saveNBT(): CompoundTag`


**Returns**: CompoundTag


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->saveNBT();
```


---

#### sendSpawnPacket

`protected function sendSpawnPacket(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->sendSpawnPacket(new Player());
```


---

#### getProperty

`public static function getProperty(mixed $jsonData, string $animationName, string $property): mixed`

> @throws Exception


**Parameters**:

- `$jsonData` (mixed) — 
- `$animationName` (string) — 
- `$property` (string) — 

**Returns**: mixed


**Example**:

```php
intended::getProperty(new mixed(), "example", "example");
```


---

#### hackFixClose

`public function hackFixClose(bool $close = true): void`

> @throws ReflectionException


**Parameters**:

- `$close` (bool) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->hackFixClose(true);
```


---

#### getInitialDragMultiplier

`protected function getInitialDragMultiplier(): float`


**Returns**: float


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getInitialDragMultiplier();
```


---

#### getInitialGravity

`protected function getInitialGravity(): float`


**Returns**: float


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getInitialGravity();
```


---

#### damaged

`protected function damaged(EntityDamageEvent $source)`


**Parameters**:

- `$source` (EntityDamageEvent) — 

**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->damaged(new EntityDamageEvent());
```


---

#### attackedByPlayer

`protected function attackedByPlayer(EntityDamageByEntityEvent $source, SwimPlayer $player)`


**Parameters**:

- `$source` (EntityDamageByEntityEvent) — 
- `$player` (SwimPlayer) — 

**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->attackedByPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### attackedByChild

`protected function attackedByChild(EntityDamageByChildEntityEvent $source, SwimPlayer $player, ?Entity $child)`


**Parameters**:

- `$source` (EntityDamageByChildEntityEvent) — 
- `$player` (SwimPlayer) — 
- `$child` (?Entity) — 

**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->attackedByChild(new EntityDamageByChildEntityEvent(), new SwimPlayer(), new Entity());
```


---

#### onInteract

`public function onInteract(Player $player, Vector3 $clickPos): bool`


**Parameters**:

- `$player` (Player) — 
- `$clickPos` (Vector3) — 

**Returns**: bool


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->onInteract(new Player(), new Vector3());
```


---

#### playerInteract

`protected function playerInteract(SwimPlayer $player, Vector3 $clickPos): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$clickPos` (Vector3) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->playerInteract(new SwimPlayer(), new Vector3());
```


---

#### getName

`public function getName(): string`


**Returns**: string


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getName();
```


---

#### sendSkinToPlayer

`public function sendSkinToPlayer(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->sendSkinToPlayer(new Player());
```


---

#### sendSkin

`public function sendSkin(?array $targets = null): void`

> Sends the human's skin to the specified list of players. If null is given for targets, the skin will be sent to


**Parameters**:

- `$targets` (?array) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->sendSkin(null);
```


---

#### getSkin

`public function getSkin(): Skin`


**Returns**: Skin


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getSkin();
```


---

#### setSkin

`public function setSkin(Skin $skin): void`


**Parameters**:

- `$skin` (Skin) — 

**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setSkin(new Skin());
```


---

#### setSkinUUID

`private function setSkinUUID(): void`


**Returns**: void


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->setSkinUUID();
```


---

#### hasServerSidedSkin

`public function hasServerSidedSkin(): bool`


**Returns**: bool


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->hasServerSidedSkin();
```


---

#### getUniqueId

`public function getUniqueId(): UuidInterface`


**Returns**: UuidInterface


**Example**:

```php
$intended = new intended(new Location(), null, null, null);
$intended->getUniqueId();
```


---

## Class: core\systems\entity\entities\only

**Defined in**: `src\core\systems\entity\entities\Actor.php`

@var Closure(int):bool|null


### Methods

_No methods found_

## Class: core\systems\entity\entities\ClientEntity

**Defined in**: `src\core\systems\entity\entities\ClientEntity.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$clientEntity = new ClientEntity();
```


---

#### tick

`public function tick(): void`


**Returns**: void


**Example**:

```php
$clientEntity = new ClientEntity();
$clientEntity->tick();
```


---

#### update

`public function update(Vector3 $recvPos, int $interpolationTicks): void`


**Parameters**:

- `$recvPos` (Vector3) — 
- `$interpolationTicks` (int) — 

**Returns**: void


**Example**:

```php
$clientEntity = new ClientEntity();
$clientEntity->update(new Vector3(), 123);
```


---

#### getPosition

`public function getPosition(): Vector3`


**Returns**: Vector3


**Example**:

```php
$clientEntity = new ClientEntity();
$clientEntity->getPosition();
```


---

#### getPrevPosition

`public function getPrevPosition(): Vector3`


**Returns**: Vector3


**Example**:

```php
$clientEntity = new ClientEntity();
$clientEntity->getPrevPosition();
```


---

#### setPosition

`private function setPosition(Vector3 $pos): void`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: void


**Example**:

```php
$clientEntity = new ClientEntity();
$clientEntity->setPosition(new Vector3());
```


---

## Class: core\systems\entity\entities\DeltaSupportTrait

**Defined in**: `src\core\systems\entity\entities\DeltaSupportTrait.php`


### Methods

#### getPrevPos

`public function getPrevPos(): Location`


**Returns**: Location


**Example**:

```php
$deltaSupportTrait = new DeltaSupportTrait();
$deltaSupportTrait->getPrevPos();
```


---

#### updateMovement

`public function updateMovement(bool $teleport = false): void`


**Parameters**:

- `$teleport` (bool) — 

**Returns**: void


**Example**:

```php
$deltaSupportTrait = new DeltaSupportTrait();
$deltaSupportTrait->updateMovement(false);
```


---

## Class: core\systems\entity\entities\EasierPickUpItemEntity

**Defined in**: `src\core\systems\entity\entities\EasierPickUpItemEntity.php`


### Methods

#### entityBaseTick

`protected function entityBaseTick(int $tickDiff = 1): bool`


**Parameters**:

- `$tickDiff` (int) — 

**Returns**: bool


**Example**:

```php
$easierPickUpItemEntity = new EasierPickUpItemEntity();
$easierPickUpItemEntity->entityBaseTick(1);
```


---

## Class: core\systems\entity\entities\FloatingText

**Defined in**: `src\core\systems\entity\entities\FloatingText.php`


### Methods

#### getNetworkTypeId

`public static function getNetworkTypeId(): string`


**Returns**: string


**Example**:

```php
FloatingText::getNetworkTypeId();
```


---

#### getInitialDragMultiplier

`protected function getInitialDragMultiplier(): float`


**Returns**: float


**Example**:

```php
$floatingText = new FloatingText();
$floatingText->getInitialDragMultiplier();
```


---

#### getInitialGravity

`protected function getInitialGravity(): float`


**Returns**: float


**Example**:

```php
$floatingText = new FloatingText();
$floatingText->getInitialGravity();
```


---

#### getInitialSizeInfo

`protected function getInitialSizeInfo(): EntitySizeInfo`


**Returns**: EntitySizeInfo


**Example**:

```php
$floatingText = new FloatingText();
$floatingText->getInitialSizeInfo();
```


---

#### attack

`public function attack(EntityDamageEvent $source): void`


**Parameters**:

- `$source` (EntityDamageEvent) — 

**Returns**: void


**Example**:

```php
$floatingText = new FloatingText();
$floatingText->attack(new EntityDamageEvent());
```


---

#### setText

`public function setText(string $title, string $text): void`


**Parameters**:

- `$title` (string) — 
- `$text` (string) — 

**Returns**: void


**Example**:

```php
$floatingText = new FloatingText();
$floatingText->setText("example", "example");
```


---

#### syncNetworkData

`protected function syncNetworkData(EntityMetadataCollection $properties): void`


**Parameters**:

- `$properties` (EntityMetadataCollection) — 

**Returns**: void


**Example**:

```php
$floatingText = new FloatingText();
$floatingText->syncNetworkData(new EntityMetadataCollection());
```


---

## Class: core\systems\event\EventForms

**Defined in**: `src\core\systems\event\EventForms.php`


### Methods

#### manageTeam

`public static function manageTeam(SwimPlayer $swimPlayer, ServerGameEvent $event, EventTeam $team): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 
- `$team` (EventTeam) — 

**Returns**: void


**Example**:

```php
EventForms::manageTeam(new SwimPlayer(), new ServerGameEvent(), new EventTeam());
```


---

#### invitePlayer

`private static function invitePlayer(SwimPlayer $swimPlayer, ServerGameEvent $event, EventTeam $team): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 
- `$team` (EventTeam) — 

**Returns**: void


**Example**:

```php
EventForms::invitePlayer(new SwimPlayer(), new ServerGameEvent(), new EventTeam());
```


---

#### kickPlayer

`private static function kickPlayer(SwimPlayer $swimPlayer, EventTeam $team): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$team` (EventTeam) — 

**Returns**: void


**Example**:

```php
EventForms::kickPlayer(new SwimPlayer(), new EventTeam());
```


---

#### leaveTeam

`public static function leaveTeam(SwimPlayer $swimPlayer, EventTeam $team): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$team` (EventTeam) — 

**Returns**: void


**Example**:

```php
EventForms::leaveTeam(new SwimPlayer(), new EventTeam());
```


---

#### viewTeamInvites

`public static function viewTeamInvites(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
EventForms::viewTeamInvites(new SwimPlayer());
```


---

#### handleInviteResponse

`private static function handleInviteResponse(SwimPlayer $player, EventTeam $selectedTeam): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$selectedTeam` (EventTeam) — 

**Returns**: void


**Example**:

```php
EventForms::handleInviteResponse(new SwimPlayer(), new EventTeam());
```


---

#### manageEventForm

`public static function manageEventForm(SwimPlayer $swimPlayer, ServerGameEvent $event, EventTeam $team): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 
- `$team` (EventTeam) — 

**Returns**: void


**Example**:

```php
EventForms::manageEventForm(new SwimPlayer(), new ServerGameEvent(), new EventTeam());
```


---

#### addPlayerToBlockedListForm

`private static function addPlayerToBlockedListForm(SwimPlayer $swimPlayer, ServerGameEvent $event): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 

**Returns**: void


**Example**:

```php
EventForms::addPlayerToBlockedListForm(new SwimPlayer(), new ServerGameEvent());
```


---

#### removePlayerFromBlockedListForm

`private static function removePlayerFromBlockedListForm(SwimPlayer $swimPlayer, ServerGameEvent $event): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 

**Returns**: void


**Example**:

```php
EventForms::removePlayerFromBlockedListForm(new SwimPlayer(), new ServerGameEvent());
```


---

#### kickPlayerForm

`private static function kickPlayerForm(SwimPlayer $swimPlayer, ServerGameEvent $event): void`

> Form to kick a player from the event and add them to the blocked list.


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 

**Returns**: void


**Example**:

```php
EventForms::kickPlayerForm(new SwimPlayer(), new ServerGameEvent());
```


---

## Class: core\systems\event\EventSystem

**Defined in**: `src\core\systems\event\EventSystem.php`


### Methods

#### getInQueueEvents

`public function getInQueueEvents(): array`

> @var ServerGameEvent[]


**Returns**: array


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->getInQueueEvents();
```


---

#### getInProgressEvents

`public function getInProgressEvents(): array`


**Returns**: array


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->getInProgressEvents();
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->init();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->exit();
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`

> @throws JsonException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->handlePlayerLeave(new SwimPlayer());
```


---

#### leave

`private function leave(SwimPlayer $swimPlayer, ServerGameEvent $event): bool`

> @throws JsonException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 

**Returns**: bool


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->leave(new SwimPlayer(), new ServerGameEvent());
```


---

#### registerEvent

`public function registerEvent(SwimPlayer $swimPlayerHost, ServerGameEvent $event): void`

> @throws ScoreFactoryException|JsonException


**Parameters**:

- `$swimPlayerHost` (SwimPlayer) — 
- `$event` (ServerGameEvent) — 

**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->registerEvent(new SwimPlayer(), new ServerGameEvent());
```


---

#### removeEvent

`public function removeEvent(ServerGameEvent $event): void`


**Parameters**:

- `$event` (ServerGameEvent) — 

**Returns**: void


**Example**:

```php
$eventSystem = new EventSystem();
$eventSystem->removeEvent(new ServerGameEvent());
```


---

## Class: core\systems\event\EventTeam

**Defined in**: `src\core\systems\event\EventTeam.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, ServerGameEvent $event, SwimPlayer $owner, int $id)`

> @var SwimPlayer[]


**Parameters**:

- `$core` (SwimCore) — Instance of SwimCore.
- `$event` (ServerGameEvent) — Instance of ServerGameEvent.
- `$owner` (SwimPlayer) — Instance of SwimPlayer representing the team owner.
- `$id` (int) — 

**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
```


---

#### getMaxTeamSize

`public function getMaxTeamSize(): int`


**Returns**: int


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->getMaxTeamSize();
```


---

#### setMaxTeamSize

`public function setMaxTeamSize(int $maxTeamSize): void`


**Parameters**:

- `$maxTeamSize` (int) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->setMaxTeamSize(123);
```


---

#### joinRequest

`public function joinRequest(SwimPlayer $player): void`

> Handles a join request from a player.


**Parameters**:

- `$player` (SwimPlayer) — The player requesting to join.

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->joinRequest(new SwimPlayer());
```


---

#### formatSize

`public function formatSize(): string`


**Returns**: string


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->formatSize();
```


---

#### invite

`public function invite(SwimPlayer $player): void`

> Sends an invitation to a player to join the team.


**Parameters**:

- `$player` (SwimPlayer) — The player to invite.

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->invite(new SwimPlayer());
```


---

#### messageAll

`public function messageAll(string $message): void`


**Parameters**:

- `$message` (string) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->messageAll("example");
```


---

#### attemptRequest

`public function attemptRequest(SwimPlayer $requester): void`


**Parameters**:

- `$requester` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->attemptRequest(new SwimPlayer());
```


---

#### attemptInvite

`public function attemptInvite(SwimPlayer $inviter, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$inviter` (SwimPlayer) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->attemptInvite(new SwimPlayer(), new SwimPlayer());
```


---

#### attemptJoin

`public function attemptJoin(SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->attemptJoin(new SwimPlayer());
```


---

#### teamFullMessage

`public function teamFullMessage(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->teamFullMessage(new SwimPlayer());
```


---

#### clearPlayerData

`private function clearPlayerData(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->clearPlayerData(new SwimPlayer());
```


---

#### joined

`public function joined(SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->joined(new SwimPlayer());
```


---

#### leave

`public function leave(SwimPlayer $swimPlayer, bool $leavingNormally = true): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$leavingNormally` (bool) — if player should join their own fresh solo team if this team is non-solo

**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->leave(new SwimPlayer(), true);
```


---

#### ownerLeft

`public function ownerLeft(): void`


**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->ownerLeft();
```


---

#### disband

`public function disband(): void`


**Returns**: void


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->disband();
```


---

#### canJoin

`public function canJoin(): bool`


**Returns**: bool


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->canJoin();
```


---

#### hasAlreadyInvited

`public function hasAlreadyInvited(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->hasAlreadyInvited(new SwimPlayer());
```


---

#### hasAlreadyRequested

`public function hasAlreadyRequested(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->hasAlreadyRequested(new SwimPlayer());
```


---

#### hasPlayer

`public function hasPlayer(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->hasPlayer(new SwimPlayer());
```


---

#### getOwner

`public function getOwner(): SwimPlayer`


**Returns**: SwimPlayer


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->getOwner();
```


---

#### isOwner

`public function isOwner(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->isOwner(new SwimPlayer());
```


---

#### getMembers

`public function getMembers(): array`


**Returns**: array


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->getMembers();
```


---

#### getID

`public function getID(): int`


**Returns**: int


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->getID();
```


---

#### getCurrentTeamSize

`public function getCurrentTeamSize(): int`


**Returns**: int


**Example**:

```php
$eventTeam = new EventTeam(new SwimCore(), new ServerGameEvent(), new SwimPlayer(), 123);
$eventTeam->getCurrentTeamSize();
```


---

## Class: core\systems\event\and

**Defined in**: `src\core\systems\event\ServerGameEvent.php`


### Methods

#### updateSecond

`public function updateSecond(): void`

> This value should only be subtracted when an event is finished or stopped by the host.


**Returns**: void


**Example**:

```php
$and = new and();
$and->updateSecond();
```


---

#### preStartLogic

`private function preStartLogic(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$and = new and();
$and->preStartLogic();
```


---

#### end

`private function end(): void`

> @throws ScoreFactoryException|JsonException


**Returns**: void


**Example**:

```php
$and = new and();
$and->end();
```


---

#### periodicUpdateMessage

`private function periodicUpdateMessage(): void`


**Returns**: void


**Example**:

```php
$and = new and();
$and->periodicUpdateMessage();
```


---

#### formatMap

`private function formatMap(): string`


**Returns**: string


**Example**:

```php
$and = new and();
$and->formatMap();
```


---

#### formatTimeToStart

`public function formatTimeToStart(): string`


**Returns**: string


**Example**:

```php
$and = new and();
$and->formatTimeToStart();
```


---

#### formatPlayerCount

`public function formatPlayerCount(): string`


**Returns**: string


**Example**:

```php
$and = new and();
$and->formatPlayerCount();
```


---

#### eventMessage

`public function eventMessage(string $message): void`


**Parameters**:

- `$message` (string) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->eventMessage("example");
```


---

#### isStarted

`public function isStarted(): bool`


**Returns**: bool


**Example**:

```php
$and = new and();
$and->isStarted();
```


---

#### getHost

`public function getHost(): SwimPlayer`


**Returns**: SwimPlayer


**Example**:

```php
$and = new and();
$and->getHost();
```


---

#### setHost

`public function setHost(SwimPlayer $host): void`


**Parameters**:

- `$host` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setHost(new SwimPlayer());
```


---

#### isAnnouncesUpdatesInChat

`public function isAnnouncesUpdatesInChat(): bool`


**Returns**: bool


**Example**:

```php
$and = new and();
$and->isAnnouncesUpdatesInChat();
```


---

#### setAnnouncesUpdatesInChat

`public function setAnnouncesUpdatesInChat(bool $announcesUpdatesInChat): void`


**Parameters**:

- `$announcesUpdatesInChat` (bool) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setAnnouncesUpdatesInChat(true);
```


---

#### setEventName

`public function setEventName(string $eventName): void`


**Parameters**:

- `$eventName` (string) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setEventName("example");
```


---

#### getEventName

`public function getEventName(): string`


**Returns**: string


**Example**:

```php
$and = new and();
$and->getEventName();
```


---

#### getInternalName

`public function getInternalName(): string`


**Returns**: string


**Example**:

```php
$and = new and();
$and->getInternalName();
```


---

#### canCreate

`public static function canCreate(): bool`

> returns if you can create a new instance for this event or not


**Returns**: bool


**Example**:

```php
and::canCreate();
```


---

#### canAdd

`public function canAdd(): bool`


**Returns**: bool


**Example**:

```php
$and = new and();
$and->canAdd();
```


---

#### getPlayerCount

`public function getPlayerCount(): int`


**Returns**: int


**Example**:

```php
$and = new and();
$and->getPlayerCount();
```


---

#### getMaxInstances

`public static function getMaxInstances(): int`


**Returns**: int


**Example**:

```php
and::getMaxInstances();
```


---

#### getRequiredPlayersToStart

`public function getRequiredPlayersToStart(): int`

> @breif should be implemented as: static::$instances = $instances;


**Returns**: int


**Example**:

```php
$and = new and();
$and->getRequiredPlayersToStart();
```


---

#### getMaxPlayers

`public function getMaxPlayers(): int`


**Returns**: int


**Example**:

```php
$and = new and();
$and->getMaxPlayers();
```


---

#### setMaxInstances

`public static function setMaxInstances(int $maxInstances): void`


**Parameters**:

- `$maxInstances` (int) — 

**Returns**: void


**Example**:

```php
and::setMaxInstances(123);
```


---

#### setMaxPlayers

`public function setMaxPlayers(int $maxPlayers): void`


**Parameters**:

- `$maxPlayers` (int) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setMaxPlayers(123);
```


---

#### setRequiredPlayersToStart

`public function setRequiredPlayersToStart(int $requiredPlayersToStart): void`


**Parameters**:

- `$requiredPlayersToStart` (int) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setRequiredPlayersToStart(123);
```


---

#### getMaxTeamSize

`public function getMaxTeamSize(): int`


**Returns**: int


**Example**:

```php
$and = new and();
$and->getMaxTeamSize();
```


---

#### setMaxTeamSize

`public function setMaxTeamSize(int $maxTeamSize): void`


**Parameters**:

- `$maxTeamSize` (int) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setMaxTeamSize(123);
```


---

#### setMapName

`public function setMapName(string $mapName): void`


**Parameters**:

- `$mapName` (string) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->setMapName("example");
```


---

#### getMapName

`public function getMapName(): string`


**Returns**: string


**Example**:

```php
$and = new and();
$and->getMapName();
```


---

#### getPlayers

`public function getPlayers(): array`


**Returns**: array


**Example**:

```php
$and = new and();
$and->getPlayers();
```


---

#### addPlayer

`public function addPlayer(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->addPlayer(new SwimPlayer());
```


---

#### createSoloTeam

`public function createSoloTeam(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->createSoloTeam(new SwimPlayer());
```


---

#### getInvitablePlayers

`public function getInvitablePlayers(SwimPlayer $swimPlayer): array`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: array


**Example**:

```php
$and = new and();
$and->getInvitablePlayers(new SwimPlayer());
```


---

#### assignNewHost

`public function assignNewHost(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->assignNewHost(new SwimPlayer());
```


---

#### inEvent

`public function inEvent(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$and = new and();
$and->inEvent(new SwimPlayer());
```


---

#### shouldInvite

`public function shouldInvite(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$and = new and();
$and->shouldInvite(new SwimPlayer());
```


---

#### leave

`public function leave(SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->leave(new SwimPlayer());
```


---

#### getTeamPlayerIsIn

`public function getTeamPlayerIsIn(SwimPlayer $swimPlayer): ?EventTeam`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: ?EventTeam


**Example**:

```php
$and = new and();
$and->getTeamPlayerIsIn(new SwimPlayer());
```


---

#### removePlayer

`public function removePlayer(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->removePlayer(new SwimPlayer());
```


---

#### hasPlayer

`public function hasPlayer(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$and = new and();
$and->hasPlayer(new SwimPlayer());
```


---

#### removeIfContains

`public function removeIfContains(SwimPlayer $swimPlayer): bool`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$and = new and();
$and->removeIfContains(new SwimPlayer());
```


---

#### joinMessage

`public function joinMessage(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->joinMessage(new SwimPlayer());
```


---

#### removeMessage

`public function removeMessage(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->removeMessage(new SwimPlayer());
```


---

#### isBlocked

`public function isBlocked(Player $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (Player) — 

**Returns**: bool


**Example**:

```php
$and = new and();
$and->isBlocked(new Player());
```


---

#### getBlockedPlayers

`public function getBlockedPlayers(): array`


**Returns**: array


**Example**:

```php
$and = new and();
$and->getBlockedPlayers();
```


---

#### removeFromBlockedList

`public function removeFromBlockedList(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->removeFromBlockedList(new SwimPlayer());
```


---

#### addToBlockedList

`public function addToBlockedList(Player $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (Player) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->addToBlockedList(new Player());
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$and = new and();
$and->exit();
```


---

#### isValidTeam

`public function isValidTeam(?EventTeam $team): bool`


**Parameters**:

- `$team` (?EventTeam) — 

**Returns**: bool


**Example**:

```php
$and = new and();
$and->isValidTeam(new EventTeam());
```


---

#### removeTeam

`public function removeTeam(EventTeam $team): void`


**Parameters**:

- `$team` (EventTeam) — 

**Returns**: void


**Example**:

```php
$and = new and();
$and->removeTeam(new EventTeam());
```


---

## Class: core\systems\event\must

**Defined in**: `src\core\systems\event\ServerGameEvent.php`

* This value should only be subtracted when an event is finished or stopped by the host.
   * And this value should only be incremented if we can create a new instance of the specified event.


### Methods

_No methods found_

## Class: core\systems\map\MapInfo

**Defined in**: `src\core\systems\map\MapInfo.php`


### Methods

#### __construct

`public function __construct(string $mapName, Vector3 $spawnPos1 = new Vector3(0, 0, 0)`


**Parameters**:

- `$mapName` (string) — 
- `$spawnPos1` (Vector3) — 

**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
```


---

#### mapIsActive

`public function mapIsActive(): bool`


**Returns**: bool


**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
$mapInfo->mapIsActive();
```


---

#### setActive

`public function setActive(bool $state): void`


**Parameters**:

- `$state` (bool) — 

**Returns**: void


**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
$mapInfo->setActive(true);
```


---

#### getMapName

`public function getMapName(): string`


**Returns**: string


**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
$mapInfo->getMapName();
```


---

#### getSpawnPos1

`public function getSpawnPos1(): Vector3`


**Returns**: Vector3


**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
$mapInfo->getSpawnPos1();
```


---

#### getSpawnPos2

`public function getSpawnPos2(): Vector3`


**Returns**: Vector3


**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
$mapInfo->getSpawnPos2();
```


---

#### swapSpawnPoints

`public function swapSpawnPoints(): void`


**Returns**: void


**Example**:

```php
$mapInfo = new MapInfo("example", new Vector3(0, 0, 0);
$mapInfo->swapSpawnPoints();
```


---

## Class: core\systems\map\MapPool

**Defined in**: `src\core\systems\map\MapPool.php`


### Methods

#### getUniqueMapBaseNames

`public function getUniqueMapBaseNames(): array`

> @var MapInfo[]


**Returns**: array


**Example**:

```php
$mapPool = new MapPool();
$mapPool->getUniqueMapBaseNames();
```


---

#### getFirstInactiveMapByBaseName

`public function getFirstInactiveMapByBaseName(string $baseName): ?MapInfo`

> Helper to get the first inactive map that starts with a given string (e.g., "forest").


**Parameters**:

- `$baseName` (string) — The base name of the map to search for.

**Returns**: ?MapInfo


**Example**:

```php
$mapPool = new MapPool();
$mapPool->getFirstInactiveMapByBaseName("example");
```


---

#### getMaps

`public function getMaps(): array`


**Returns**: array


**Example**:

```php
$mapPool = new MapPool();
$mapPool->getMaps();
```


---

## Class: core\systems\map\MapsData

**Defined in**: `src\core\systems\map\MapsData.php`


### Methods

#### normalizeKey

`public static function normalizeKey(string $s): string`

> @var MapPool[] */


**Parameters**:

- `$s` (string) — 

**Returns**: string


**Example**:

```php
MapsData::normalizeKey("example");
```


---

#### getMapPoolFromMode

`public function getMapPoolFromMode(string $mode): ?MapPool`


**Parameters**:

- `$mode` (string) — 

**Returns**: ?MapPool


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getMapPoolFromMode("example");
```


---

#### modeHasAvailableMap

`public function modeHasAvailableMap(string $mode): bool`


**Parameters**:

- `$mode` (string) — 

**Returns**: bool


**Example**:

```php
$mapsData = new MapsData();
$mapsData->modeHasAvailableMap("example");
```


---

#### getRandomMapFromMode

`public function getRandomMapFromMode(string $mode): ?MapInfo`


**Parameters**:

- `$mode` (string) — 

**Returns**: ?MapInfo


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getRandomMapFromMode("example");
```


---

#### getFirstInactiveMapByBaseNameFromMode

`public function getFirstInactiveMapByBaseNameFromMode(string $mode, string $name): ?MapInfo`


**Parameters**:

- `$mode` (string) — 
- `$name` (string) — 

**Returns**: ?MapInfo


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getFirstInactiveMapByBaseNameFromMode("example", "example");
```


---

#### getMostSimilarNamedMapThatIsAvailable

`public function getMostSimilarNamedMapThatIsAvailable(string $mode, string $name): ?MapInfo`


**Parameters**:

- `$mode` (string) — 
- `$name` (string) — 

**Returns**: ?MapInfo


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getMostSimilarNamedMapThatIsAvailable("example", "example");
```


---

#### modeUsesBasicMaps

`public function modeUsesBasicMaps(string $mode): bool`


**Parameters**:

- `$mode` (string) — 

**Returns**: bool


**Example**:

```php
$mapsData = new MapsData();
$mapsData->modeUsesBasicMaps("example");
```


---

#### needsToUseMiscWorld

`public function needsToUseMiscWorld(string $selectedMapName): bool`


**Parameters**:

- `$selectedMapName` (string) — 

**Returns**: bool


**Example**:

```php
$mapsData = new MapsData();
$mapsData->needsToUseMiscWorld("example");
```


---

#### getNamedMapFromMode

`public function getNamedMapFromMode(string $mode, string $name): ?MapInfo`


**Parameters**:

- `$mode` (string) — 
- `$name` (string) — 

**Returns**: ?MapInfo


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getNamedMapFromMode("example", "example");
```


---

#### getMapPool

`public function getMapPool(string $mode): ?MapPool`


**Parameters**:

- `$mode` (string) — 

**Returns**: ?MapPool


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getMapPool("example");
```


---

#### getBasicDuelMaps

`public function getBasicDuelMaps(): ?BasicDuelMaps`


**Returns**: ?BasicDuelMaps


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getBasicDuelMaps();
```


---

#### getMiscDuelMaps

`public function getMiscDuelMaps(): ?BasicDuelMaps`


**Returns**: ?BasicDuelMaps


**Example**:

```php
$mapsData = new MapsData();
$mapsData->getMiscDuelMaps();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$mapsData = new MapsData();
$mapsData->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$mapsData = new MapsData();
$mapsData->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$mapsData = new MapsData();
$mapsData->exit();
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$mapsData = new MapsData();
$mapsData->handlePlayerLeave(new SwimPlayer());
```


---

## Class: core\systems\party\PartiesSystem

**Defined in**: `src\core\systems\party\PartiesSystem.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
```


---

#### getParties

`public function getParties(): array`


**Returns**: array


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->getParties();
```


---

#### addParty

`public function addParty(Party $party): void`


**Parameters**:

- `$party` (Party) — 

**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->addParty(new Party());
```


---

#### renameParty

`public function renameParty(string $partyName, string $newPartyName): void`


**Parameters**:

- `$partyName` (string) — 
- `$newPartyName` (string) — 

**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->renameParty("example", "example");
```


---

#### disbandParty

`public function disbandParty(Party $party): void`

> @throws ScoreFactoryException


**Parameters**:

- `$party` (Party) — 

**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->disbandParty(new Party());
```


---

#### getPartyCount

`public function getPartyCount(): int`


**Returns**: int


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->getPartyCount();
```


---

#### getPartyPlayerIsIn

`public function getPartyPlayerIsIn(SwimPlayer $player): ?Party`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: ?Party


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->getPartyPlayerIsIn(new SwimPlayer());
```


---

#### isInParty

`public function isInParty(SwimPlayer $player): bool`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->isInParty(new SwimPlayer());
```


---

#### partyNameTaken

`public function partyNameTaken(string $name): bool`


**Parameters**:

- `$name` (string) — 

**Returns**: bool


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->partyNameTaken("example");
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->handlePlayerLeave(new SwimPlayer());
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->init();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$partiesSystem = new PartiesSystem(new SwimCore());
$partiesSystem->exit();
```


---

## Class: core\systems\party\Party

**Defined in**: `src\core\systems\party\Party.php`


### Methods

#### removePlayerFromParty

`public function removePlayerFromParty(SwimPlayer $player): void`

> @var SwimPlayer[]


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->removePlayerFromParty(new SwimPlayer());
```


---

#### getSetting

`public function getSetting(string $key): ?bool`


**Parameters**:

- `$key` (string) — 

**Returns**: ?bool


**Example**:

```php
$party = new Party();
$party->getSetting("example");
```


---

#### getSettings

`public function getSettings(): array`


**Returns**: array


**Example**:

```php
$party = new Party();
$party->getSettings();
```


---

#### setSetting

`public function setSetting(string $key, $value): void`


**Parameters**:

- `$key` (string) — 
- `$value` (mixed) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->setSetting("example", null);
```


---

#### isInDuel

`public function isInDuel(): bool`


**Returns**: bool


**Example**:

```php
$party = new Party();
$party->isInDuel();
```


---

#### setInDuel

`public function setInDuel(bool $status): void`


**Parameters**:

- `$status` (bool) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->setInDuel(true);
```


---

#### duelInvite

`public function duelInvite(SwimPlayer $sender, Party $senderParty, string $mode, string $mapName = 'random'): void`


**Parameters**:

- `$sender` (SwimPlayer) — 
- `$senderParty` (Party) — 
- `$mode` (string) — 
- `$mapName` (string) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->duelInvite(new SwimPlayer(), new Party(), "example", 'random');
```


---

#### clearDuelRequests

`public function clearDuelRequests(): void`


**Returns**: void


**Example**:

```php
$party = new Party();
$party->clearDuelRequests();
```


---

#### getDuelRequests

`public function getDuelRequests(): array`


**Returns**: array


**Example**:

```php
$party = new Party();
$party->getDuelRequests();
```


---

#### clearJoinRequests

`public function clearJoinRequests(): void`


**Returns**: void


**Example**:

```php
$party = new Party();
$party->clearJoinRequests();
```


---

#### getJoinRequests

`public function getJoinRequests(): array`


**Returns**: array


**Example**:

```php
$party = new Party();
$party->getJoinRequests();
```


---

#### partyMessage

`public function partyMessage(string $message): void`


**Parameters**:

- `$message` (string) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->partyMessage("example");
```


---

#### sendJoinRequest

`public function sendJoinRequest(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->sendJoinRequest(new SwimPlayer());
```


---

#### clearPartyData

`public function clearPartyData(): void`


**Returns**: void


**Example**:

```php
$party = new Party();
$party->clearPartyData();
```


---

#### hasPlayer

`public function hasPlayer(SwimPlayer $player): bool`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$party = new Party();
$party->hasPlayer(new SwimPlayer());
```


---

#### formatSize

`public function formatSize(): string`


**Returns**: string


**Example**:

```php
$party = new Party();
$party->formatSize();
```


---

#### sizeMessage

`public function sizeMessage(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->sizeMessage(new SwimPlayer());
```


---

#### startSelfDuel

`public function startSelfDuel(string $mode, string $mapName = 'random', bool $lookAt = true): void`

> @throws ScoreFactoryException


**Parameters**:

- `$mode` (string) — 
- `$mapName` (string) — 
- `$lookAt` (bool) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->startSelfDuel("example", 'random', true);
```


---

#### startPartyVsPartyDuel

`public function startPartyVsPartyDuel(Party $otherParty, string $mode, string $mapName = 'random'): void`

> @throws ScoreFactoryException


**Parameters**:

- `$otherParty` (Party) — 
- `$mode` (string) — 
- `$mapName` (string) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->startPartyVsPartyDuel(new Party(), "example", 'random');
```


---

#### setUpMap

`private function setUpMap(string $mapName, string $mode): ?MapInfo`


**Parameters**:

- `$mapName` (string) — 
- `$mode` (string) — 

**Returns**: ?MapInfo


**Example**:

```php
$party = new Party();
$party->setUpMap("example", "example");
```


---

#### registerSceneWithMapAndSpawns

`private function registerSceneWithMapAndSpawns(?Duel $duel, string $duelName, MapInfo $map, Team $teamOne, Team $teamTwo): void`


**Parameters**:

- `$duel` (?Duel) — 
- `$duelName` (string) — 
- `$map` (MapInfo) — 
- `$teamOne` (Team) — 
- `$teamTwo` (Team) — 

**Returns**: void


**Example**:

```php
$party = new Party();
$party->registerSceneWithMapAndSpawns(new Duel(), "example", new MapInfo(), new Team(), new Team());
```


---

## Class: core\systems\player\Component

**Defined in**: `src\core\systems\player\Component.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer, bool $doesUpdate = false)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$doesUpdate` (bool) — 

**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
$component->init();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
$component->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
$component->updateTick();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
$component->exit();
```


---

#### clear

`public function clear(): void`


**Returns**: void


**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
$component->clear();
```


---

#### __destruct

`public function __destruct()`


**Example**:

```php
$component = new Component(new SwimCore(), new SwimPlayer(), false);
$component->__destruct();
```


---

## Class: core\systems\player\since

**Defined in**: `src\core\systems\player\PlayerSystem.php`


### Methods

#### getPlayers

`public function getPlayers(): array`

> @var SwimPlayer[]


**Returns**: array


**Example**:

```php
$since = new since();
$since->getPlayers();
```


---

## Class: core\systems\player\SwimPlayer

**Defined in**: `src\core\systems\player\SwimPlayer.php`


### Methods

#### __construct

`public function __construct(Server $server, NetworkSession $session, PlayerInfo $playerInfo, bool $authenticated, Location $spawnLocation, ?CompoundTag $namedtag)`


**Parameters**:

- `$server` (Server) — 
- `$session` (NetworkSession) — 
- `$playerInfo` (PlayerInfo) — 
- `$authenticated` (bool) — 
- `$spawnLocation` (Location) — 
- `$namedtag` (?CompoundTag) — 

**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
```


---

#### init

`public function init(SwimCore $core): void`


**Parameters**:

- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->init(new SwimCore());
```


---

#### getRandomUUID

`public function getRandomUUID(): UuidInterface`


**Returns**: UuidInterface


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->getRandomUUID();
```


---

#### getBehaviorManager

`public function getBehaviorManager(): ?EventBehaviorComponentManager`


**Returns**: ?EventBehaviorComponentManager


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->getBehaviorManager();
```


---

#### registerBehavior

`public function registerBehavior(EventBehaviorComponent $behaviorComponent): void`


**Parameters**:

- `$behaviorComponent` (EventBehaviorComponent) — 

**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->registerBehavior(new EventBehaviorComponent());
```


---

#### event

`public function event(Event $event, BehaviorEventEnum $eventEnum): void`


**Parameters**:

- `$event` (Event) — 
- `$eventEnum` (BehaviorEventEnum) — 

**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->event(new Event(), new BehaviorEventEnum());
```


---

#### getEventBehaviorComponentManager

`public function getEventBehaviorComponentManager(): ?EventBehaviorComponentManager`


**Returns**: ?EventBehaviorComponentManager


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->getEventBehaviorComponentManager();
```


---

#### calculateFallDamage

`public function calculateFallDamage(float $fallDistance): float`


**Parameters**:

- `$fallDistance` (float) — 

**Returns**: float


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->calculateFallDamage(1.23);
```


---

#### getSwimCore

`public function getSwimCore(): SwimCore`


**Returns**: SwimCore


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->getSwimCore();
```


---

#### onUpdate

`public function onUpdate(int $currentTick): bool`


**Parameters**:

- `$currentTick` (int) — 

**Returns**: bool


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->onUpdate(123);
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->exit();
```


---

#### onPostDisconnect

`public function onPostDisconnect(Translatable|string $reason, Translatable|string|null $quitMessage): void`


**Parameters**:

- `$reason` (Translatable|string) — 
- `$quitMessage` (Translatable|string|null) — 

**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->onPostDisconnect(new Translatable(), new Translatable());
```


---

#### loadData

`public function loadData(): void`


**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->loadData();
```


---

#### saveData

`public function saveData(): void`


**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->saveData();
```


---

#### teleport

`public function teleport(Vector3 $pos, ?float $yaw = null, ?float $pitch = null): bool`


**Parameters**:

- `$pos` (Vector3) — 
- `$yaw` (?float) — 
- `$pitch` (?float) — 

**Returns**: bool


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->teleport(new Vector3(), null, null);
```


---

#### fixedVanillaTeleport

`private function fixedVanillaTeleport($pos, $yaw, $pitch): bool`


**Parameters**:

- `$pos` (mixed) — 
- `$yaw` (mixed) — 
- `$pitch` (mixed) — 

**Returns**: bool


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->fixedVanillaTeleport(null, null, null);
```


---

#### ghostPlayerFix

`public function ghostPlayerFix(): void`


**Returns**: void


**Example**:

```php
$swimPlayer = new SwimPlayer(new Server(), new NetworkSession(), new PlayerInfo(), true, new Location(), new CompoundTag());
$swimPlayer->ghostPlayerFix();
```


---

## Class: core\systems\player\bool

**Defined in**: `src\core\systems\player\SwimPlayer.php`

* @var Component[]


### Methods

_No methods found_

## Class: core\systems\player\to

**Defined in**: `src\core\systems\player\SwimPlayer.php`

* @var Component[]


### Methods

_No methods found_

## Class: core\systems\player\components\AckHandler

**Defined in**: `src\core\systems\player\components\AckHandler.php`


### Methods

#### recv

`public function recv(NetworkStackLatencyPacket $packet): bool`


**Parameters**:

- `$packet` (NetworkStackLatencyPacket) — 

**Returns**: bool


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->recv(new NetworkStackLatencyPacket());
```


---

#### remove

`public function remove(int $id): void`


**Parameters**:

- `$id` (int) — 

**Returns**: void


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->remove(123);
```


---

#### get

`public function get(int $id): ?Vector3`


**Parameters**:

- `$id` (int) — 

**Returns**: ?Vector3


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->get(123);
```


---

#### getPrev

`public function getPrev(int $id): ?Vector3`


**Parameters**:

- `$id` (int) — 

**Returns**: ?Vector3


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->getPrev(123);
```


---

#### add

`public function add(int $ts, MultiAckWithTimestamp $multiAck): void`


**Parameters**:

- `$ts` (int) — 
- `$multiAck` (MultiAckWithTimestamp) — 

**Returns**: void


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->add(123, new MultiAckWithTimestamp());
```


---

#### clean

`private function clean(): void`


**Returns**: void


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->clean();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$ackHandler = new AckHandler();
$ackHandler->updateTick();
```


---

## Class: core\systems\player\components\AntiCheatData

**Defined in**: `src\core\systems\player\components\AntiCheatData.php`


### Methods

#### setDeviceOS

`private function setDeviceOS(): void`

> @var false to start


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->setDeviceOS();
```


---

#### teleported

`public function teleported(): void`


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->teleported();
```


---

#### attacked

`public function attacked(): void`


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->attacked();
```


---

#### changedGameMode

`public function changedGameMode(): void`


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->changedGameMode();
```


---

#### updateRewindData

`private function updateRewindData(): void`

> @brief Updates the rewind data


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateRewindData();
```


---

#### updateDetections

`private function updateDetections(): void`

> @brief Heart beat tick for all detection subcomponents


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateDetections();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateSecond();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateTick();
```


---

#### decayTickCountableDetectionFlags

`private function decayTickCountableDetectionFlags(float $decay, float &$flags, ?int &$count = null): void`


**Parameters**:

- `$decay` (float) — the amount to decay the flags class field by
- `&$flags` (float) — 
- `&$count` (?int) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->decayTickCountableDetectionFlags(1.23, 1.23, null);
```


---

#### handle

`public function handle(DataPacketReceiveEvent $event): void`

> @brief Call back event function that hits all detections handle virtual function.


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->handle(new DataPacketReceiveEvent());
```


---

#### playerAuthInput

`public function playerAuthInput(PlayerAuthInputPacket $pk): void`


**Parameters**:

- `$pk` (PlayerAuthInputPacket) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->playerAuthInput(new PlayerAuthInputPacket());
```


---

#### updateLocation

`private function updateLocation(PlayerAuthInputPacket $pk): void`


**Parameters**:

- `$pk` (PlayerAuthInputPacket) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateLocation(new PlayerAuthInputPacket());
```


---

#### updateGroundAndJumping

`private function updateGroundAndJumping(PlayerAuthInputPacket $pk): void`


**Parameters**:

- `$pk` (PlayerAuthInputPacket) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateGroundAndJumping(new PlayerAuthInputPacket());
```


---

#### updateYaws

`private function updateYaws(): void`


**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateYaws();
```


---

#### updateMotion

`private function updateMotion(PlayerAuthInputPacket $pk): void`


**Parameters**:

- `$pk` (PlayerAuthInputPacket) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateMotion(new PlayerAuthInputPacket());
```


---

#### shouldEarlyExitFromCollision

`private function shouldEarlyExitFromCollision(int &$timer, bool $ignoreTimeout, bool $needsToHaveMoved = true): bool`


**Parameters**:

- `&$timer` (int) — 
- `$ignoreTimeout` (bool) — 
- `$needsToHaveMoved` (bool) — 

**Returns**: bool


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->shouldEarlyExitFromCollision(123, true, true);
```


---

#### updateAboveHeadCollision

`public function updateAboveHeadCollision(bool $ignoreTimeout = false): void`


**Parameters**:

- `$ignoreTimeout` (bool) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateAboveHeadCollision(false);
```


---

#### getGroundBlock

`public function getGroundBlock(bool $ignoreTimeout = false): ?Block`


**Parameters**:

- `$ignoreTimeout` (bool) — 

**Returns**: ?Block


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getGroundBlock(false);
```


---

#### updateGroundCollision

`public function updateGroundCollision(bool $ignoreTimeout = false): void`


**Parameters**:

- `$ignoreTimeout` (bool) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateGroundCollision(false);
```


---

#### updateBlockCollisions

`public function updateBlockCollisions(bool $ignoreTimeout = false, bool $doBlockAbove = true, bool $doBlockBelow = true): void`


**Parameters**:

- `$ignoreTimeout` (bool) — 
- `$doBlockAbove` (bool) — 
- `$doBlockBelow` (bool) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->updateBlockCollisions(false, true, true);
```


---

#### checkHorizontalCollision

`private function checkHorizontalCollision(Block $block, AxisAlignedBB $horizontalAABB): void`


**Parameters**:

- `$block` (Block) — 
- `$horizontalAABB` (AxisAlignedBB) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->checkHorizontalCollision(new Block(), new AxisAlignedBB());
```


---

#### getBlocksInBB

`private function getBlocksInBB(World $world, AxisAlignedBB $bb): array`


**Parameters**:

- `$world` (World) — 
- `$bb` (AxisAlignedBB) — 

**Returns**: array


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getBlocksInBB(new World(), new AxisAlignedBB());
```


---

#### checkSpecial

`public function checkSpecial(): bool`

> @throws ReflectionException


**Returns**: bool


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->checkSpecial();
```


---

#### getLastLocation

`public function getLastLocation(): ?Location`

> @var Block $block */


**Returns**: ?Location


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getLastLocation();
```


---

#### getCurrentLocation

`public function getCurrentLocation(): ?Vector3`


**Returns**: ?Vector3


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getCurrentLocation();
```


---

#### getCurrentMotion

`public function getCurrentMotion(): ?Vector3`


**Returns**: ?Vector3


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getCurrentMotion();
```


---

#### getTicksSinceJumping

`public function getTicksSinceJumping(): int`


**Returns**: int


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getTicksSinceJumping();
```


---

#### getLastOnGroundLocation

`public function getLastOnGroundLocation(): Location`


**Returns**: Location


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getLastOnGroundLocation();
```


---

#### getCurrentMoveDelta

`public function getCurrentMoveDelta(): ?Vector3`


**Returns**: ?Vector3


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getCurrentMoveDelta();
```


---

#### getLastClientPrediction

`public function getLastClientPrediction(): ?Vector3`


**Returns**: ?Vector3


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getLastClientPrediction();
```


---

#### getTicksSinceGround

`public function getTicksSinceGround(): int`


**Returns**: int


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getTicksSinceGround();
```


---

#### getDetections

`public function getDetections(): array`


**Returns**: array


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->getDetections();
```


---

#### lagBack

`public function lagBack(bool $smooth = true, bool $useLastGroundPosition = true, ?Vector3 $pos = null): void`


**Parameters**:

- `$smooth` (bool) — 
- `$useLastGroundPosition` (bool) — 
- `$pos` (?Vector3) — 

**Returns**: void


**Example**:

```php
$antiCheatData = new AntiCheatData();
$antiCheatData->lagBack(true, true, null);
```


---

## Class: core\systems\player\components\field

**Defined in**: `src\core\systems\player\components\AntiCheatData.php`

* @var false to start


### Methods

_No methods found_

## Class: core\systems\player\components\fields

**Defined in**: `src\core\systems\player\components\AntiCheatData.php`

* @var false to start


### Methods

_No methods found_

## Class: core\systems\player\components\Attributes

**Defined in**: `src\core\systems\player\components\Attributes.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer, bool $doesUpdate = true)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$doesUpdate` (bool) — 

**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
```


---

#### load

`public function load(): Generator`


**Returns**: Generator


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->load();
```


---

#### getEloFromGame

`public function getEloFromGame(string $mode): int`


**Parameters**:

- `$mode` (string) — 

**Returns**: int


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->getEloFromGame("example");
```


---

#### saveAttributes

`public function saveAttributes(): void`


**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->saveAttributes();
```


---

#### setShopMoney

`public function setShopMoney(int $shopMoney): void`


**Parameters**:

- `$shopMoney` (int) — 

**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->setShopMoney(123);
```


---

#### getShopMoney

`public function getShopMoney(): int`


**Returns**: int


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->getShopMoney();
```


---

#### subtractMoney

`public function subtractMoney(int $amount): void`


**Parameters**:

- `$amount` (int) — 

**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->subtractMoney(123);
```


---

#### addMoney

`public function addMoney(int $amount): void`


**Parameters**:

- `$amount` (int) — 

**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->addMoney(123);
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->updateSecond();
```


---

#### getAttribute

`public function getAttribute(string $attribute)`


**Parameters**:

- `$attribute` (string) — 

**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->getAttribute("example");
```


---

#### hasAttribute

`public function hasAttribute(string $attribute): bool`


**Parameters**:

- `$attribute` (string) — 

**Returns**: bool


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->hasAttribute("example");
```


---

#### setAttribute

`public function setAttribute(string $attribute, $value): void`


**Parameters**:

- `$attribute` (string) — 
- `$value` (mixed) — 

**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->setAttribute("example", null);
```


---

#### emplaceIncrementIntegerAttribute

`public function emplaceIncrementIntegerAttribute(string $attribute, bool $subtract = false): int`


**Parameters**:

- `$attribute` (string) — 
- `$subtract` (bool) — 

**Returns**: int


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->emplaceIncrementIntegerAttribute("example", false);
```


---

#### clear

`public function clear(): void`


**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->clear();
```


---

#### removeAttribute

`public function removeAttribute(string $attribute): void`


**Parameters**:

- `$attribute` (string) — 

**Returns**: void


**Example**:

```php
$attributes = new Attributes(new SwimCore(), new SwimPlayer(), true);
$attributes->removeAttribute("example");
```


---

## Class: core\systems\player\components\ChatHandler

**Defined in**: `src\core\systems\player\components\ChatHandler.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->init();
```


---

#### setLastMessagedPlayerName

`public function setLastMessagedPlayerName(string $lastMessagedPlayerName): void`


**Parameters**:

- `$lastMessagedPlayerName` (string) — 

**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->setLastMessagedPlayerName("example");
```


---

#### getLastMessagedPlayer

`public function getLastMessagedPlayer(): ?SwimPlayer`

> @brief returns the last player that messaged us, used in the /reply command.


**Returns**: ?SwimPlayer


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->getLastMessagedPlayer();
```


---

#### setMute

`public function setMute(string $reason, int $unmuteTime): void`


**Parameters**:

- `$reason` (string) — 
- `$unmuteTime` (int) — 

**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->setMute("example", 123);
```


---

#### unMute

`public function unMute(): void`


**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->unMute();
```


---

#### getIsMuted

`public function getIsMuted(): bool`


**Returns**: bool


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->getIsMuted();
```


---

#### getUnmuteTime

`public function getUnmuteTime(): int|null`


**Returns**: int|null


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->getUnmuteTime();
```


---

#### getMuteReason

`public function getMuteReason(): string|null`


**Returns**: string|null


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->getMuteReason();
```


---

#### handleChat

`public function handleChat(string $message): void`


**Parameters**:

- `$message` (string) — 

**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->handleChat("example");
```


---

#### sendFormattedMessage

`private function sendFormattedMessage(string $message, bool $broadcast): void`


**Parameters**:

- `$message` (string) — 
- `$broadcast` (bool) — 

**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->sendFormattedMessage("example", true);
```


---

#### sendMutedMessage

`private function sendMutedMessage(): void`


**Returns**: void


**Example**:

```php
$chatHandler = new ChatHandler(new SwimCore(), new SwimPlayer());
$chatHandler->sendMutedMessage();
```


---

## Class: core\systems\player\components\ClickHandler

**Defined in**: `src\core\systems\player\components\ClickHandler.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
```


---

#### getLastSwingTime

`public function getLastSwingTime(): float`


**Returns**: float


**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
$clickHandler->getLastSwingTime();
```


---

#### setLastSwingTime

`public function setLastSwingTime(float $time): void`


**Parameters**:

- `$time` (float) — 

**Returns**: void


**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
$clickHandler->setLastSwingTime(1.23);
```


---

#### showCPS

`public function showCPS(bool $toggle): void`


**Parameters**:

- `$toggle` (bool) — 

**Returns**: void


**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
$clickHandler->showCPS(true);
```


---

#### click

`public function click(): void`


**Returns**: void


**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
$clickHandler->click();
```


---

#### getCPS

`public function getCPS(): int`


**Returns**: int


**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
$clickHandler->getCPS();
```


---

#### cleanUpCpsArray

`private function cleanUpCpsArray(float $currentTime): void`


**Parameters**:

- `$currentTime` (float) — 

**Returns**: void


**Example**:

```php
$clickHandler = new ClickHandler(new SwimCore(), new SwimPlayer());
$clickHandler->cleanUpCpsArray(1.23);
```


---

## Class: core\systems\player\components\CombatLogger

**Defined in**: `src\core\systems\player\components\CombatLogger.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer, bool $doesUpdate = true)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$doesUpdate` (bool) — 

**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->init();
```


---

#### clear

`public function clear(): void`


**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->clear();
```


---

#### reset

`public function reset(): void`


**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->reset();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->updateSecond();
```


---

#### handleAttack

`public function handleAttack(SwimPlayer $victim): bool`


**Parameters**:

- `$victim` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->handleAttack(new SwimPlayer());
```


---

#### canAttack

`public function canAttack(SwimPlayer $victim): bool`


**Parameters**:

- `$victim` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->canAttack(new SwimPlayer());
```


---

#### isWhoWeAreCurrentlyFighting

`public function isWhoWeAreCurrentlyFighting(SwimPlayer $attacker): bool`


**Parameters**:

- `$attacker` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->isWhoWeAreCurrentlyFighting(new SwimPlayer());
```


---

#### logDamage

`public function logDamage(SwimPlayer $attacker): void`


**Parameters**:

- `$attacker` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->logDamage(new SwimPlayer());
```


---

#### logAttack

`public function logAttack(SwimPlayer $victim): void`


**Parameters**:

- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->logAttack(new SwimPlayer());
```


---

#### setCoolDownTime

`public function setCoolDownTime(int $coolDownTime): void`


**Parameters**:

- `$coolDownTime` (int) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setCoolDownTime(123);
```


---

#### getCoolDownTime

`public function getCoolDownTime(): int`


**Returns**: int


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getCoolDownTime();
```


---

#### setIsProtected

`public function setIsProtected(bool $isProtected): void`


**Parameters**:

- `$isProtected` (bool) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setIsProtected(true);
```


---

#### isProtected

`public function isProtected(): bool`


**Returns**: bool


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->isProtected();
```


---

#### isUsingCombatCoolDown

`public function isUsingCombatCoolDown(): bool`


**Returns**: bool


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->isUsingCombatCoolDown();
```


---

#### setUsingCombatCoolDown

`public function setUsingCombatCoolDown(bool $usingCombatCoolDown): void`


**Parameters**:

- `$usingCombatCoolDown` (bool) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setUsingCombatCoolDown(true);
```


---

#### getCombatCoolDown

`public function getCombatCoolDown(): int`


**Returns**: int


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getCombatCoolDown();
```


---

#### setCombatCoolDown

`public function setCombatCoolDown(int $combatCoolDown): void`


**Parameters**:

- `$combatCoolDown` (int) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setCombatCoolDown(123);
```


---

#### getComboCounter

`public function getComboCounter(): int`


**Returns**: int


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getComboCounter();
```


---

#### setComboCounter

`public function setComboCounter(int $comboCounter): void`


**Parameters**:

- `$comboCounter` (int) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setComboCounter(123);
```


---

#### getLastHitBy

`public function getLastHitBy(): ?SwimPlayer`


**Returns**: ?SwimPlayer


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getLastHitBy();
```


---

#### setLastHitBy

`public function setLastHitBy(?SwimPlayer $lastHitBy): void`


**Parameters**:

- `$lastHitBy` (?SwimPlayer) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setLastHitBy(new SwimPlayer());
```


---

#### setCurrentlyFighting

`public function setCurrentlyFighting(SwimPlayer $currentlyFighting): void`


**Parameters**:

- `$currentlyFighting` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setCurrentlyFighting(new SwimPlayer());
```


---

#### getCurrentlyFighting

`public function getCurrentlyFighting(): ?SwimPlayer`


**Returns**: ?SwimPlayer


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getCurrentlyFighting();
```


---

#### setLastHit

`public function setLastHit(SwimPlayer $lastHit): void`


**Parameters**:

- `$lastHit` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setLastHit(new SwimPlayer());
```


---

#### getLastHit

`public function getLastHit(): ?SwimPlayer`


**Returns**: ?SwimPlayer


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getLastHit();
```


---

#### isInCombat

`public function isInCombat(): bool`


**Returns**: bool


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->isInCombat();
```


---

#### setInCombat

`public function setInCombat(bool $inCombat): void`


**Parameters**:

- `$inCombat` (bool) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setInCombat(true);
```


---

#### setLastDamagedTime

`public function setLastDamagedTime(float $lastDamagedTime): void`


**Parameters**:

- `$lastDamagedTime` (float) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setLastDamagedTime(1.23);
```


---

#### getLastDamagedTime

`public function getLastDamagedTime(): float`


**Returns**: float


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getLastDamagedTime();
```


---

#### setLastSwingTime

`public function setLastSwingTime(float $lastSwingTime): void`


**Parameters**:

- `$lastSwingTime` (float) — 

**Returns**: void


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->setLastSwingTime(1.23);
```


---

#### getLastSwingTime

`public function getLastSwingTime(): float`


**Returns**: float


**Example**:

```php
$combatLogger = new CombatLogger(new SwimCore(), new SwimPlayer(), true);
$combatLogger->getLastSwingTime();
```


---

## Class: core\systems\player\components\holds

**Defined in**: `src\core\systems\player\components\CoolDowns.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
```


---

#### setCoolDown

`public function setCoolDown(Item $item, float $time, bool $notify = true): void`


**Parameters**:

- `$item` (Item) — 
- `$time` (float) — 
- `$notify` (bool) — 

**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->setCoolDown(new Item(), 1.23, true);
```


---

#### updateCoolDowns

`public function updateCoolDowns(): void`


**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->updateCoolDowns();
```


---

#### setFocused

`public function setFocused(Item $item): void`


**Parameters**:

- `$item` (Item) — 

**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->setFocused(new Item());
```


---

#### onCoolDown

`public function onCoolDown(Item $item): bool`


**Parameters**:

- `$item` (Item) — 

**Returns**: bool


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->onCoolDown(new Item());
```


---

#### getCoolDownTime

`public function getCoolDownTime(Item $item): float`


**Parameters**:

- `$item` (Item) — 

**Returns**: float


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->getCoolDownTime(new Item());
```


---

#### clearAll

`public function clearAll(): void`


**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->clearAll();
```


---

#### clear

`public function clear(): void`


**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->clear();
```


---

#### triggerItemCoolDownEvent

`public function triggerItemCoolDownEvent(PlayerItemUseEvent $event, Item $item, int $seconds = 15, bool $focused = true, bool $sendMessage = true): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$item` (Item) — 
- `$seconds` (int) — 
- `$focused` (bool) — 
- `$sendMessage` (bool) — 

**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->triggerItemCoolDownEvent(new PlayerItemUseEvent(), new Item(), 15, true, true);
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$holds = new holds(new SwimCore(), new SwimPlayer());
$holds->updateTick();
```


---

## Class: core\systems\player\components\Cosmetics

**Defined in**: `src\core\systems\player\components\Cosmetics.php`


### Methods

#### refresh

`public function refresh(): void`


**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->refresh();
```


---

#### formatTag

`public function formatTag(bool $space = true): string`


**Parameters**:

- `$space` (bool) — 

**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->formatTag(true);
```


---

#### getNameColor

`public function getNameColor(): string`


**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->getNameColor();
```


---

#### tagNameTag

`public function tagNameTag(): void`


**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->tagNameTag();
```


---

#### killMessageLogic

`public function killMessageLogic(SwimPlayer $killed): void`


**Parameters**:

- `$killed` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->killMessageLogic(new SwimPlayer());
```


---

#### formatKillMessage

`public function formatKillMessage(SwimPlayer $killed): string`


**Parameters**:

- `$killed` (SwimPlayer) — 

**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->formatKillMessage(new SwimPlayer());
```


---

#### setTag

`public function setTag(string $string): void`


**Parameters**:

- `$string` (string) — 

**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->setTag("example");
```


---

#### getTag

`public function getTag(): string`


**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->getTag();
```


---

#### shouldSendKillMessage

`public function shouldSendKillMessage(): bool`


**Returns**: bool


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->shouldSendKillMessage();
```


---

#### getChatFormat

`public function getChatFormat(): string`


**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->getChatFormat();
```


---

#### setChatFormat

`public function setChatFormat(string $chatFormat): void`


**Parameters**:

- `$chatFormat` (string) — 

**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->setChatFormat("example");
```


---

#### setKillMessage

`public function setKillMessage(string $message): void`


**Parameters**:

- `$message` (string) — 

**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->setKillMessage("example");
```


---

#### getKillMessage

`public function getKillMessage(): string`


**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->getKillMessage();
```


---

#### getHubParticleEffect

`public function getHubParticleEffect(): string`


**Returns**: string


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->getHubParticleEffect();
```


---

#### setHubParticleEffect

`public function setHubParticleEffect(string $effect): void`


**Parameters**:

- `$effect` (string) — 

**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->setHubParticleEffect("example");
```


---

#### load

`public function load(): Generator`


**Returns**: Generator


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->load();
```


---

#### saveData

`public function saveData(): void`


**Returns**: void


**Example**:

```php
$cosmetics = new Cosmetics();
$cosmetics->saveData();
```


---

## Class: core\systems\player\components\DiscordLinkHandler

**Defined in**: `src\core\systems\player\components\DiscordLinkHandler.php`


### Methods

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->init();
```


---

#### checkLink

`public function checkLink(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->checkLink();
```


---

#### isCompleteLink

`public function isCompleteLink(): bool`


**Returns**: bool


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->isCompleteLink();
```


---

#### isPendingLink

`public function isPendingLink(): bool`


**Returns**: bool


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->isPendingLink();
```


---

#### getDiscordId

`public function getDiscordId(): ?string`


**Returns**: ?string


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->getDiscordId();
```


---

#### getDiscordRoles

`public function getDiscordRoles(): ?array`


**Returns**: ?array


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->getDiscordRoles();
```


---

#### getDiscordName

`public function getDiscordName(): ?string`


**Returns**: ?string


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->getDiscordName();
```


---

#### getAvatarUrl

`public function getAvatarUrl(): ?string`


**Returns**: ?string


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->getAvatarUrl();
```


---

#### setPendingLink

`public function setPendingLink(string $id): void`


**Parameters**:

- `$id` (string) — 

**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->setPendingLink("example");
```


---

#### onLinkAccepted

`public function onLinkAccepted(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->onLinkAccepted();
```


---

#### onLinkRemoved

`public function onLinkRemoved(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->onLinkRemoved();
```


---

#### onLinkDenied

`public function onLinkDenied(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->onLinkDenied();
```


---

#### removePendingLink

`private function removePendingLink(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->removePendingLink();
```


---

#### updatePerms

`private function updatePerms(): void`


**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->updatePerms();
```


---

#### setInfo

`public function setInfo(DiscordUserResponsePacket $pk): void`


**Parameters**:

- `$pk` (DiscordUserResponsePacket) — 

**Returns**: void


**Example**:

```php
$discordLinkHandler = new DiscordLinkHandler();
$discordLinkHandler->setInfo(new DiscordUserResponsePacket());
```


---

## Class: core\systems\player\components\Invites

**Defined in**: `src\core\systems\player\components\Invites.php`


### Methods

#### getPartyInvites

`public function getPartyInvites(): array`

> @var Party[]


**Returns**: array


**Example**:

```php
$invites = new Invites();
$invites->getPartyInvites();
```


---

#### getTeamInvites

`public function getTeamInvites(): array`


**Returns**: array


**Example**:

```php
$invites = new Invites();
$invites->getTeamInvites();
```


---

#### clear

`public function clear(): void`


**Returns**: void


**Example**:

```php
$invites = new Invites();
$invites->clear();
```


---

#### clearAllInvites

`public function clearAllInvites(): void`


**Returns**: void


**Example**:

```php
$invites = new Invites();
$invites->clearAllInvites();
```


---

#### prunePlayerFromDuelInvites

`public function prunePlayerFromDuelInvites(string $name): void`


**Parameters**:

- `$name` (string) — 

**Returns**: void


**Example**:

```php
$invites = new Invites();
$invites->prunePlayerFromDuelInvites("example");
```


---

## Class: core\systems\player\components\Kits

**Defined in**: `src\core\systems\player\components\Kits.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$kits = new Kits(new SwimCore(), new SwimPlayer());
```


---

#### setKitDataRaw

`public function setKitDataRaw(string $mode, array $data): void`


**Parameters**:

- `$mode` (string) — 
- `$data` (array) — 

**Returns**: void


**Example**:

```php
$kits = new Kits(new SwimCore(), new SwimPlayer());
$kits->setKitDataRaw("example", []);
```


---

#### setKitSlotData

`public function setKitSlotData(string $mode, string $item, int $slot): void`


**Parameters**:

- `$mode` (string) — 
- `$item` (string) — 
- `$slot` (int) — 

**Returns**: void


**Example**:

```php
$kits = new Kits(new SwimCore(), new SwimPlayer());
$kits->setKitSlotData("example", "example", 123);
```


---

#### getKitData

`public function getKitData(string $mode): ?array`


**Parameters**:

- `$mode` (string) — 

**Returns**: ?array


**Example**:

```php
$kits = new Kits(new SwimCore(), new SwimPlayer());
$kits->getKitData("example");
```


---

#### saveKits

`public function saveKits(): void`


**Returns**: void


**Example**:

```php
$kits = new Kits(new SwimCore(), new SwimPlayer());
$kits->saveKits();
```


---

#### load

`public function load(): Generator`


**Returns**: Generator


**Example**:

```php
$kits = new Kits(new SwimCore(), new SwimPlayer());
$kits->load();
```


---

## Class: core\systems\player\components\NetworkStackLatencyHandler

**Defined in**: `src\core\systems\player\components\NetworkStackLatencyHandler.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
```


---

#### send

`public function send(): void`

> @throws Exception


**Returns**: void


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->send();
```


---

#### add

`public function add(int $ts): void`


**Parameters**:

- `$ts` (int) — 

**Returns**: void


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->add(123);
```


---

#### onNsl

`public function onNsl(NetworkStackLatencyPacket $pk): void`


**Parameters**:

- `$pk` (NetworkStackLatencyPacket) — 

**Returns**: void


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->onNsl(new NetworkStackLatencyPacket());
```


---

#### process

`public function process(int $timestamp): void`


**Parameters**:

- `$timestamp` (int) — 

**Returns**: void


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->process(123);
```


---

#### getPing

`public function getPing(): int`


**Returns**: int


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->getPing();
```


---

#### getRecentPing

`public function getRecentPing(): int`


**Returns**: int


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->getRecentPing();
```


---

#### getLastRawReading

`public function getLastRawReading(): int`


**Returns**: int


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->getLastRawReading();
```


---

#### getJitter

`public function getJitter(): int`


**Returns**: int


**Example**:

```php
$networkStackLatencyHandler = new NetworkStackLatencyHandler(new SwimCore(), new SwimPlayer());
$networkStackLatencyHandler->getJitter();
```


---

#### randomIntNoZeroEnd

`public static function randomIntNoZeroEnd(): int`


**Returns**: int


**Example**:

```php
NetworkStackLatencyHandler::randomIntNoZeroEnd();
```


---

#### intRev

`public static function intRev(int $num): int`


**Parameters**:

- `$num` (int) — 

**Returns**: int


**Example**:

```php
NetworkStackLatencyHandler::intRev(123);
```


---

#### std_deviation

`public static function std_deviation(array $arr): float`


**Parameters**:

- `$arr` (array) — 

**Returns**: float


**Example**:

```php
NetworkStackLatencyHandler::std_deviation([]);
```


---

## Class: core\systems\player\components\Nicks

**Defined in**: `src\core\systems\player\components\Nicks.php`


### Methods

#### getLastNickTick

`public function getLastNickTick(): int`


**Returns**: int


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->getLastNickTick();
```


---

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
```


---

#### getNick

`public function getNick(): string`


**Returns**: string


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->getNick();
```


---

#### isNicked

`public function isNicked(): bool`


**Returns**: bool


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->isNicked();
```


---

#### resetNick

`public function resetNick(): void`


**Returns**: void


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->resetNick();
```


---

#### setNickTo

`public function setNickTo(string $name): void`


**Parameters**:

- `$name` (string) — 

**Returns**: void


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->setNickTo("example");
```


---

#### getRandomNick

`public static function getRandomNick(): string`


**Returns**: string


**Example**:

```php
Nicks::getRandomNick();
```


---

#### setRandomNick

`public function setRandomNick(): void`


**Returns**: void


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->setRandomNick();
```


---

#### syncPlayerList

`public function syncPlayerList(): void`


**Returns**: void


**Example**:

```php
$nicks = new Nicks(new SwimCore(), new SwimPlayer());
$nicks->syncPlayerList();
```


---

## Class: core\systems\player\components\Rank

**Defined in**: `src\core\systems\player\components\Rank.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
```


---

#### getRankLevelFromPackageName

`public static function getRankLevelFromPackageName(string $packageName): int`


**Parameters**:

- `$packageName` (string) — 

**Returns**: int


**Example**:

```php
Rank::getRankLevelFromPackageName("example");
```


---

#### attemptRankUpgrade

`public static function attemptRankUpgrade(string $xuid, int $rankLevel): void`


**Parameters**:

- `$xuid` (string) — 
- `$rankLevel` (int) — 

**Returns**: void


**Example**:

```php
Rank::attemptRankUpgrade("example", 123);
```


---

#### getRankLevel

`public function getRankLevel(): int`


**Returns**: int


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->getRankLevel();
```


---

#### getRankColor

`public static function getRankColor(int $rank): string`


**Parameters**:

- `$rank` (int) — 

**Returns**: string


**Example**:

```php
Rank::getRankColor(123);
```


---

#### getRankNameString

`public static function getRankNameString(int $rank): string`


**Parameters**:

- `$rank` (int) — 

**Returns**: string


**Example**:

```php
Rank::getRankNameString(123);
```


---

#### getRankAbbreviationString

`public static function getRankAbbreviationString(int $rank): string`


**Parameters**:

- `$rank` (int) — 

**Returns**: string


**Example**:

```php
Rank::getRankAbbreviationString(123);
```


---

#### load

`public function load(): Generator`


**Returns**: Generator


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->load();
```


---

#### updatePerms

`private function updatePerms(): void`


**Returns**: void


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->updatePerms();
```


---

#### setTempRank

`public function setTempRank(int $rank): void`


**Parameters**:

- `$rank` (int) — 

**Returns**: void


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->setTempRank(123);
```


---

#### setOnlinePlayerRank

`public function setOnlinePlayerRank(int $rank): void`


**Parameters**:

- `$rank` (int) — 

**Returns**: void


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->setOnlinePlayerRank(123);
```


---

#### setRankInDatabase

`public static function setRankInDatabase(string $name, int $playerRank): void`


**Parameters**:

- `$name` (string) — 
- `$playerRank` (int) — 

**Returns**: void


**Example**:

```php
Rank::setRankInDatabase("example", 123);
```


---

#### insertUpdateRankInDatabase

`public static function insertUpdateRankInDatabase(string $xuid, string $name, int $playerRank): void`


**Parameters**:

- `$xuid` (string) — 
- `$name` (string) — 
- `$playerRank` (int) — 

**Returns**: void


**Example**:

```php
Rank::insertUpdateRankInDatabase("example", "example", 123);
```


---

#### rankScoreTag

`public function rankScoreTag(): void`


**Returns**: void


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->rankScoreTag();
```


---

#### rankNameTag

`public function rankNameTag(): void`


**Returns**: void


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->rankNameTag();
```


---

#### rankChatFormat

`public function rankChatFormat(string $message): string`


**Parameters**:

- `$message` (string) — 

**Returns**: string


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->rankChatFormat("example");
```


---

#### rankString

`public function rankString(): string`


**Returns**: string


**Example**:

```php
$rank = new Rank(new SwimCore(), new SwimPlayer());
$rank->rankString();
```


---

## Class: core\systems\player\components\to

**Defined in**: `src\core\systems\player\components\SceneHelper.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
```


---

#### getScene

`public function getScene(): ?Scene`


**Returns**: ?Scene


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->getScene();
```


---

#### setEvent

`public function setEvent(?ServerGameEvent $event): void`


**Parameters**:

- `$event` (?ServerGameEvent) — 

**Returns**: void


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->setEvent(new ServerGameEvent());
```


---

#### getEvent

`public function getEvent(): ?ServerGameEvent`


**Returns**: ?ServerGameEvent


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->getEvent();
```


---

#### getParty

`public function getParty(): ?Party`


**Returns**: ?Party


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->getParty();
```


---

#### setParty

`public function setParty(?Party $party): void`


**Parameters**:

- `$party` (?Party) — 

**Returns**: void


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->setParty(new Party());
```


---

#### isInParty

`public function isInParty(): bool`


**Returns**: bool


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->isInParty();
```


---

#### setScene

`public function setScene(Scene $scene): void`


**Parameters**:

- `$scene` (Scene) — 

**Returns**: void


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->setScene(new Scene());
```


---

#### setTeamNumber

`public function setTeamNumber(int $teamNumber): void`


**Parameters**:

- `$teamNumber` (int) — 

**Returns**: void


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->setTeamNumber(123);
```


---

#### getTeamNumber

`public function getTeamNumber(): int`


**Returns**: int


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->getTeamNumber();
```


---

#### setNewScene

`public function setNewScene(string $sceneName, ?Team $team = null): bool`

> @brief Sets the scene the player is in


**Parameters**:

- `$sceneName` (string) — 
- `$team` (?Team) — 

**Returns**: bool


**Example**:

```php
$to = new to(new SwimCore(), new SwimPlayer());
$to->setNewScene("example", null);
```


---

## Class: core\systems\player\components\Settings

**Defined in**: `src\core\systems\player\components\Settings.php`


### Methods

#### __construct

`public function __construct(SwimCore $core, SwimPlayer $swimPlayer)`


**Parameters**:

- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 

**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
```


---

#### updateSettings

`public function updateSettings(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->updateSettings();
```


---

#### refreshFullBright

`public function refreshFullBright(): void`


**Returns**: void


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->refreshFullBright();
```


---

#### dcPreventOn

`public function dcPreventOn(): bool`


**Returns**: bool


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->dcPreventOn();
```


---

#### isAutoSprint

`public function isAutoSprint(): bool`


**Returns**: bool


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->isAutoSprint();
```


---

#### getShopType

`public function getShopType(): int`


**Returns**: int


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->getShopType();
```


---

#### getScrimRole

`public function getScrimRole(): int`


**Returns**: int


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->getScrimRole();
```


---

#### setToggle

`public function setToggle(string $setting, bool $state): void`


**Parameters**:

- `$setting` (string) — 
- `$state` (bool) — 

**Returns**: void


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->setToggle("example", true);
```


---

#### setToggleInt

`public function setToggleInt(string $setting, int $state): void`


**Parameters**:

- `$setting` (string) — 
- `$state` (int) — 

**Returns**: void


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->setToggleInt("example", 123);
```


---

#### getToggle

`public function getToggle(string $setting): ?bool`


**Parameters**:

- `$setting` (string) — 

**Returns**: ?bool


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->getToggle("example");
```


---

#### getToggleInt

`public function getToggleInt(string $setting): ?int`


**Parameters**:

- `$setting` (string) — 

**Returns**: ?int


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->getToggleInt("example");
```


---

#### saveSettings

`public function saveSettings(): void`

> Save settings to the database (upsert).


**Returns**: void


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->saveSettings();
```


---

#### load

`public function load(): Generator`

> Load settings from the database (or insert defaults if missing).


**Returns**: Generator


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->load();
```


---

#### getToggles

`public function getToggles(): array`


**Returns**: array


**Example**:

```php
$settings = new Settings(new SwimCore(), new SwimPlayer());
$settings->getToggles();
```


---

## Class: core\systems\player\components\fields

**Defined in**: `src\core\systems\player\components\Settings.php`


### Methods

_No methods found_

## Class: core\systems\player\components\behaviors\BetterBlockBreaker

**Defined in**: `src\core\systems\player\components\behaviors\BetterBlockBreaker.php`


### Methods

#### __construct

`public function __construct(private readonly SwimPlayer $swimPlayer, // private SwimCore             $core, private readonly Vector3    $blockPos, private readonly Block      $block, private int                 $targetedFace, private readonly int        $maxPlayerDistance, private readonly int        $fxTickInterval = self::DEFAULT_FX_INTERVAL_TICKS)`


**Parameters**:

- `private readonly SwimPlayer $swimPlayer` (mixed) — 
- `// private SwimCore             $core` (mixed) — 
- `private readonly Vector3    $blockPos` (mixed) — 
- `private readonly Block      $block` (mixed) — 
- `private int                 $targetedFace` (mixed) — 
- `private readonly int        $maxPlayerDistance` (mixed) — 
- `private readonly int        $fxTickInterval = self::DEFAULT_FX_INTERVAL_TICKS` (mixed) — 

**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
```


---

#### calculateBreakProgressPerTick

`private function calculateBreakProgressPerTick(): float`

> Returns the calculated break speed as percentage progress per game tick.


**Returns**: float


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->calculateBreakProgressPerTick();
```


---

#### update

`public function update(): bool`


**Returns**: bool


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->update();
```


---

#### setClientAttemptedTooEarly

`public function setClientAttemptedTooEarly(): void`


**Returns**: void


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->setClientAttemptedTooEarly();
```


---

#### getBlockPos

`public function getBlockPos(): Vector3`


**Returns**: Vector3


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->getBlockPos();
```


---

#### getTargetedFace

`public function getTargetedFace(): int`


**Returns**: int


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->getTargetedFace();
```


---

#### setTargetedFace

`public function setTargetedFace(int $face): void`


**Parameters**:

- `$face` (int) — 

**Returns**: void


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->setTargetedFace(123);
```


---

#### getBreakSpeed

`public function getBreakSpeed(): float`


**Returns**: float


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->getBreakSpeed();
```


---

#### getBreakProgress

`public function getBreakProgress(): float`


**Returns**: float


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->getBreakProgress();
```


---

#### getNextBreakProgress

`public function getNextBreakProgress(int $ticks = 1): float`


**Parameters**:

- `$ticks` (int) — 

**Returns**: float


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->getNextBreakProgress(1);
```


---

#### __destruct

`public function __destruct()`


**Example**:

```php
$betterBlockBreaker = new BetterBlockBreaker(null, null, null, null, null, null, null);
$betterBlockBreaker->__destruct();
```


---

## Class: core\systems\player\components\behaviors\EventBehaviorComponent

**Defined in**: `src\core\systems\player\components\behaviors\EventBehaviorComponent.php`


### Methods

#### __construct

`public function __construct(string $componentName, SwimCore $core, SwimPlayer $swimPlayer, bool $doesUpdate = true, bool $hasLifeTime = false, int $tickLifeTime = 20, bool $removeOnReset = true, bool $doesEvents = true)`


**Parameters**:

- `$componentName` (string) — 
- `$core` (SwimCore) — 
- `$swimPlayer` (SwimPlayer) — 
- `$doesUpdate` (bool) — 
- `$hasLifeTime` (bool) — 
- `$tickLifeTime` (int) — 
- `$removeOnReset` (bool) — 
- `$doesEvents` (bool) — 

**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
```


---

#### printProperties

`public function printProperties(): void`


**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->printProperties();
```


---

#### setRemoveOnReset

`public function setRemoveOnReset(bool $removeOnReset): void`


**Parameters**:

- `$removeOnReset` (bool) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->setRemoveOnReset(true);
```


---

#### isRemoveOnReset

`public function isRemoveOnReset(): bool`


**Returns**: bool


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->isRemoveOnReset();
```


---

#### setTickLifeTime

`public function setTickLifeTime(int $tickLifeTime): void`

> /


**Parameters**:

- `$tickLifeTime` (int) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->setTickLifeTime(123);
```


---

#### isDoesEvents

`public function isDoesEvents(): bool`

> /


**Returns**: bool


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->isDoesEvents();
```


---

#### setDoesEvents

`public function setDoesEvents(bool $doesEvents): void`


**Parameters**:

- `$doesEvents` (bool) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->setDoesEvents(true);
```


---

#### eventUpdateTick

`protected function eventUpdateTick(): void`


**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->eventUpdateTick();
```


---

#### eventUpdateSecond

`protected function eventUpdateSecond(): void`


**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->eventUpdateSecond();
```


---

#### eventMessage

`public function eventMessage(Event $event, string $message, mixed $args)`


**Parameters**:

- `$event` (Event) — 
- `$message` (string) — 
- `$args` (mixed) — 

**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->eventMessage(new Event(), "example", new mixed());
```


---

#### entityDamageByChildEntityEvent

`protected function entityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->entityDamageByChildEntityEvent(new EntityDamageByChildEntityEvent());
```


---

#### entityDamageByEntityEvent

`protected function entityDamageByEntityEvent(EntityDamageByEntityEvent $event): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->entityDamageByEntityEvent(new EntityDamageByEntityEvent());
```


---

#### entityDamageEvent

`protected function entityDamageEvent(EntityDamageEvent $event): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->entityDamageEvent(new EntityDamageEvent());
```


---

#### itemDropEvent

`protected function itemDropEvent(PlayerDropItemEvent $event): void`


**Parameters**:

- `$event` (PlayerDropItemEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->itemDropEvent(new PlayerDropItemEvent());
```


---

#### itemUseEvent

`protected function itemUseEvent(PlayerItemUseEvent $event): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->itemUseEvent(new PlayerItemUseEvent());
```


---

#### inventoryUseEvent

`protected function inventoryUseEvent(InventoryTransactionEvent $event): void`


**Parameters**:

- `$event` (InventoryTransactionEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->inventoryUseEvent(new InventoryTransactionEvent());
```


---

#### entityTeleportEvent

`protected function entityTeleportEvent(EntityTeleportEvent $event): void`


**Parameters**:

- `$event` (EntityTeleportEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->entityTeleportEvent(new EntityTeleportEvent());
```


---

#### playerConsumeEvent

`protected function playerConsumeEvent(PlayerItemConsumeEvent $event): void`


**Parameters**:

- `$event` (PlayerItemConsumeEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->playerConsumeEvent(new PlayerItemConsumeEvent());
```


---

#### playerPickupItem

`protected function playerPickupItem(EntityItemPickupEvent $event): void`


**Parameters**:

- `$event` (EntityItemPickupEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->playerPickupItem(new EntityItemPickupEvent());
```


---

#### projectileLaunchEvent

`protected function projectileLaunchEvent(ProjectileLaunchEvent $event): void`


**Parameters**:

- `$event` (ProjectileLaunchEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->projectileLaunchEvent(new ProjectileLaunchEvent());
```


---

#### entityRegainHealthEvent

`protected function entityRegainHealthEvent(EntityRegainHealthEvent $event): void`


**Parameters**:

- `$event` (EntityRegainHealthEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->entityRegainHealthEvent(new EntityRegainHealthEvent());
```


---

#### projectileHitEvent

`protected function projectileHitEvent(ProjectileHitEvent $event): void`


**Parameters**:

- `$event` (ProjectileHitEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->projectileHitEvent(new ProjectileHitEvent());
```


---

#### projectileHitEntityEvent

`protected function projectileHitEntityEvent(ProjectileHitEntityEvent $event): void`


**Parameters**:

- `$event` (ProjectileHitEntityEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->projectileHitEntityEvent(new ProjectileHitEntityEvent());
```


---

#### playerInteractEvent

`protected function playerInteractEvent(PlayerInteractEvent $event): void`


**Parameters**:

- `$event` (PlayerInteractEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->playerInteractEvent(new PlayerInteractEvent());
```


---

#### blockPlaceEvent

`protected function blockPlaceEvent(BlockPlaceEvent $event): void`


**Parameters**:

- `$event` (BlockPlaceEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->blockPlaceEvent(new BlockPlaceEvent());
```


---

#### blockBreakEvent

`protected function blockBreakEvent(BlockBreakEvent $event): void`


**Parameters**:

- `$event` (BlockBreakEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->blockBreakEvent(new BlockBreakEvent());
```


---

#### playerSpawnChildEvent

`protected function playerSpawnChildEvent(EntitySpawnEvent $event): void`


**Parameters**:

- `$event` (EntitySpawnEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->playerSpawnChildEvent(new EntitySpawnEvent());
```


---

#### playerToggleFlightEvent

`protected function playerToggleFlightEvent(PlayerToggleFlightEvent $event): void`


**Parameters**:

- `$event` (PlayerToggleFlightEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->playerToggleFlightEvent(new PlayerToggleFlightEvent());
```


---

#### playerJumpEvent

`protected function playerJumpEvent(PlayerJumpEvent $event): void`


**Parameters**:

- `$event` (PlayerJumpEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->playerJumpEvent(new PlayerJumpEvent());
```


---

#### dataPacketReceiveEvent

`protected function dataPacketReceiveEvent(DataPacketReceiveEvent $event): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->dataPacketReceiveEvent(new DataPacketReceiveEvent());
```


---

#### attackedPlayer

`public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$victim` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$eventBehaviorComponent = new EventBehaviorComponent("example", new SwimCore(), new SwimPlayer(), true, false, 20, true, true);
$eventBehaviorComponent->attackedPlayer(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

## Class: core\systems\player\components\behaviors\EventBehaviorComponentManager

**Defined in**: `src\core\systems\player\components\behaviors\EventBehaviorComponentManager.php`


### Methods

#### getComponents

`public function getComponents(): array`

> @var EventBehaviorComponent[]


**Returns**: array


**Example**:

```php
$eventBehaviorComponentManager = new EventBehaviorComponentManager();
$eventBehaviorComponentManager->getComponents();
```


---

## Class: core\systems\player\components\detections\Detection

**Defined in**: `src\core\systems\player\components\detections\Detection.php`


### Methods

#### __construct

`public function __construct(protected SwimCore   $swimCore, protected SwimPlayer $player, protected string     $name)`


**Parameters**:

- `protected SwimCore   $swimCore` (mixed) — 
- `protected SwimPlayer $player` (mixed) — 
- `protected string     $name` (mixed) — 

**Example**:

```php
$detection = new Detection(null, null, "example");
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->init();
```


---

#### teleported

`public function teleported(): void`


**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->teleported();
```


---

#### attacked

`public function attacked(): void`


**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->attacked();
```


---

#### changedGameMode

`public function changedGameMode(): void`


**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->changedGameMode();
```


---

#### kickOnly

`public function kickOnly(): bool`


**Returns**: bool


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->kickOnly();
```


---

#### isReliable

`protected function isReliable(): bool`


**Returns**: bool


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->isReliable();
```


---

#### shouldLog

`protected function shouldLog(): bool`


**Returns**: bool


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->shouldLog();
```


---

#### shouldKick

`protected function shouldKick(): bool`


**Returns**: bool


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->shouldKick();
```


---

#### shouldBroadcastKick

`protected function shouldBroadcastKick(): bool`


**Returns**: bool


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->shouldBroadcastKick();
```


---

#### getMaxFlags

`protected function getMaxFlags(): int`


**Returns**: int


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->getMaxFlags();
```


---

#### getDecayRate

`protected function getDecayRate(): float`


**Returns**: float


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->getDecayRate();
```


---

#### handlePacket

`protected function handlePacket(Packet $packet): bool`


**Parameters**:

- `$packet` (Packet) — 

**Returns**: bool


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->handlePacket(new Packet());
```


---

#### setSleepTicks

`public function setSleepTicks(int $ticks): void`


**Parameters**:

- `$ticks` (int) — 

**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->setSleepTicks(123);
```


---

#### getSleepTicks

`public function getSleepTicks(): int`


**Returns**: int


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->getSleepTicks();
```


---

#### handle

`public function handle(DataPacketReceiveEvent $event): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 

**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->handle(new DataPacketReceiveEvent());
```


---

#### punish

`protected function punish(string $reason = ""): void`


**Parameters**:

- `$reason` (string) — 

**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->punish("");
```


---

#### PunishAlert

`public static function PunishAlert(SwimPlayer $player, SwimCore $core, string $reason): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$core` (SwimCore) — 
- `$reason` (string) — 

**Returns**: void


**Example**:

```php
Detection::PunishAlert(new SwimPlayer(), new SwimCore(), "example");
```


---

#### reward

`protected function reward(float $sub = 0.01): void`


**Parameters**:

- `$sub` (float) — 

**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->reward(0.01);
```


---

#### BanPlayer

`public static function BanPlayer(Player $player, SwimCore $core): void`


**Parameters**:

- `$player` (Player) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
Detection::BanPlayer(new Player(), new SwimCore());
```


---

#### StaffAlert

`public static function StaffAlert(string $message, SwimCore $core): void`


**Parameters**:

- `$message` (string) — 
- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
Detection::StaffAlert("example", new SwimCore());
```


---

#### tick

`public function tick(): void`


**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->tick();
```


---

#### getNumFlags

`public function getNumFlags(bool $int = false): float|int`


**Parameters**:

- `$int` (bool) — 

**Returns**: float|int


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->getNumFlags(false);
```


---

#### addFlag

`public function addFlag(string $additional = ""): void`


**Parameters**:

- `$additional` (string) — 

**Returns**: void


**Example**:

```php
$detection = new Detection(null, null, "example");
$detection->addFlag("");
```


---

## Class: core\systems\scene\DuelInfo

**Defined in**: `src\core\systems\scene\DuelInfo.php`


### Methods

#### __construct

`public function __construct(public string $modeName, // for example: "bedfight"
    public string $decoratedName, // for colored use in forms and text fields, such as: "§4Midfight"
    public string $classPath, // for class loading such as: new $classPath(...)`


**Parameters**:

- `public string $modeName` (mixed) — 
- `// for example: "bedfight"
    public string $decoratedName` (mixed) — 
- `// for colored use in forms and text fields` (mixed) — 
- `such as: "§4Midfight"
    public string $classPath` (mixed) — 
- `// for class loading such as: new $classPath(...` (mixed) — 

**Example**:

```php
$duelInfo = new DuelInfo("example", "example", null, "example", null);
```


---

## Class: core\systems\scene\loading

**Defined in**: `src\core\systems\scene\DuelInfo.php`


### Methods

_No methods found_

## Class: core\systems\scene\FFAInfo

**Defined in**: `src\core\systems\scene\FFAInfo.php`


### Methods

#### __construct

`public function __construct(public string $sceneName, // for example: "skywarsffa"
    public string $decoratedName, // for colored use in forms and text fields, such as: "§4Midfight"
    public string $worldFolderName, // for example: "duels"
    public int    $preferredSlot, // what to sort the ffa scenes by for things like the ffa selection form
    public bool   $enabled = true)`


**Parameters**:

- `public string $sceneName` (mixed) — 
- `// for example: "skywarsffa"
    public string $decoratedName` (mixed) — 
- `// for colored use in forms and text fields` (mixed) — 
- `such as: "§4Midfight"
    public string $worldFolderName` (mixed) — 
- `// for example: "duels"
    public int    $preferredSlot` (mixed) — 
- `// what to sort the ffa scenes by for things like the ffa selection form
    public bool   $enabled = true` (mixed) — 

**Example**:

```php
$fFAInfo = new FFAInfo("example", "example", null, "example", null, null);
```


---

## Class: core\systems\scene\Scene

**Defined in**: `src\core\systems\scene\Scene.php`


### Methods

#### AutoLoad

`public static function AutoLoad(): bool`

> @var BehaviorEventEnum[] Array of events


**Returns**: bool


**Example**:

```php
Scene::AutoLoad();
```


---

#### getTeamManager

`public function getTeamManager(): TeamManager`


**Returns**: TeamManager


**Example**:

```php
$scene = new Scene();
$scene->getTeamManager();
```


---

#### getPlayerTeam

`public function getPlayerTeam(SwimPlayer $swimPlayer): ?Team`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: ?Team


**Example**:

```php
$scene = new Scene();
$scene->getPlayerTeam(new SwimPlayer());
```


---

#### setRanked

`public function setRanked(bool $value): void`


**Parameters**:

- `$value` (bool) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->setRanked(true);
```


---

#### cancelCheck

`private function cancelCheck(BehaviorEventEnum $eventEnum, Event $event): void`


**Parameters**:

- `$eventEnum` (BehaviorEventEnum) — 
- `$event` (Event) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->cancelCheck(new BehaviorEventEnum(), new Event());
```


---

#### init

`public function init(): void`


**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->init();
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->updateSecond();
```


---

#### exit

`public function exit(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->exit();
```


---

#### restart

`public function restart(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->restart(new SwimPlayer());
```


---

#### sceneBossBar

`public function sceneBossBar(string $title, float $healthPercent, bool $darkenScreen = false, int $color = BossBarColor::PURPLE, int $overlay = 0): void`


**Parameters**:

- `$title` (string) — 
- `$healthPercent` (float) — 
- `$darkenScreen` (bool) — 
- `$color` (int) — 
- `$overlay` (int) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneBossBar("example", 1.23, false, BossBarColor::PURPLE, 0);
```


---

#### removeBossBarForAll

`public function removeBossBarForAll(): void`


**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->removeBossBarForAll();
```


---

#### sceneJukeBoxMessage

`public function sceneJukeBoxMessage(string $message): void`


**Parameters**:

- `$message` (string) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneJukeBoxMessage("example");
```


---

#### sceneTitle

`public function sceneTitle(string $title, string $subtitle = "", int $fadeIn = -1, int $stay = -1, int $fadeOut = -1): void`


**Parameters**:

- `$title` (string) — 
- `$subtitle` (string) — 
- `$fadeIn` (int) — 
- `$stay` (int) — 
- `$fadeOut` (int) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneTitle("example", "", -1, -1, -1);
```


---

#### sceneSound

`public function sceneSound(string $soundName, int $volume = 2, int $pitch = 1): void`


**Parameters**:

- `$soundName` (string) — 
- `$volume` (int) — 
- `$pitch` (int) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneSound("example", 2, 1);
```


---

#### playerAdded

`public function playerAdded(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->playerAdded(new SwimPlayer());
```


---

#### playerRemoved

`public function playerRemoved(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->playerRemoved(new SwimPlayer());
```


---

#### sceneEntityDamageByChildEntityEvent

`public function sceneEntityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageByChildEntityEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneEntityDamageByChildEntityEvent(new EntityDamageByChildEntityEvent(), new SwimPlayer());
```


---

#### sceneEntityDamageByEntityEvent

`public function sceneEntityDamageByEntityEvent(EntityDamageByEntityEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageByEntityEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneEntityDamageByEntityEvent(new EntityDamageByEntityEvent(), new SwimPlayer());
```


---

#### sceneEntityDamageEvent

`public function sceneEntityDamageEvent(EntityDamageEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneEntityDamageEvent(new EntityDamageEvent(), new SwimPlayer());
```


---

#### sceneItemDropEvent

`public function sceneItemDropEvent(PlayerDropItemEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerDropItemEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneItemDropEvent(new PlayerDropItemEvent(), new SwimPlayer());
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### sceneInventoryUseEvent

`public function sceneInventoryUseEvent(InventoryTransactionEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (InventoryTransactionEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneInventoryUseEvent(new InventoryTransactionEvent(), new SwimPlayer());
```


---

#### sceneEntityTeleportEvent

`public function sceneEntityTeleportEvent(EntityTeleportEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityTeleportEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneEntityTeleportEvent(new EntityTeleportEvent(), new SwimPlayer());
```


---

#### scenePlayerConsumeEvent

`public function scenePlayerConsumeEvent(PlayerItemConsumeEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerItemConsumeEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->scenePlayerConsumeEvent(new PlayerItemConsumeEvent(), new SwimPlayer());
```


---

#### scenePlayerPickupItem

`public function scenePlayerPickupItem(EntityItemPickupEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityItemPickupEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->scenePlayerPickupItem(new EntityItemPickupEvent(), new SwimPlayer());
```


---

#### sceneProjectileLaunchEvent

`public function sceneProjectileLaunchEvent(ProjectileLaunchEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (ProjectileLaunchEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneProjectileLaunchEvent(new ProjectileLaunchEvent(), new SwimPlayer());
```


---

#### sceneEntityRegainHealthEvent

`public function sceneEntityRegainHealthEvent(EntityRegainHealthEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (EntityRegainHealthEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneEntityRegainHealthEvent(new EntityRegainHealthEvent(), new SwimPlayer());
```


---

#### sceneProjectileHitEvent

`public function sceneProjectileHitEvent(ProjectileHitEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (ProjectileHitEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneProjectileHitEvent(new ProjectileHitEvent(), new SwimPlayer());
```


---

#### sceneProjectileHitEntityEvent

`public function sceneProjectileHitEntityEvent(ProjectileHitEntityEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (ProjectileHitEntityEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneProjectileHitEntityEvent(new ProjectileHitEntityEvent(), new SwimPlayer());
```


---

#### scenePlayerInteractEvent

`public function scenePlayerInteractEvent(PlayerInteractEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerInteractEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->scenePlayerInteractEvent(new PlayerInteractEvent(), new SwimPlayer());
```


---

#### sceneBlockBreakEvent

`public function sceneBlockBreakEvent(BlockBreakEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (BlockBreakEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneBlockBreakEvent(new BlockBreakEvent(), new SwimPlayer());
```


---

#### sceneBlockPlaceEvent

`public function sceneBlockPlaceEvent(BlockPlaceEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (BlockPlaceEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneBlockPlaceEvent(new BlockPlaceEvent(), new SwimPlayer());
```


---

#### scenePlayerSpawnChildEvent

`public function scenePlayerSpawnChildEvent(EntitySpawnEvent $event, SwimPlayer $swimPlayer, Entity $spawnedEntity): void`


**Parameters**:

- `$event` (EntitySpawnEvent) — 
- `$swimPlayer` (SwimPlayer) — 
- `$spawnedEntity` (Entity) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->scenePlayerSpawnChildEvent(new EntitySpawnEvent(), new SwimPlayer(), new Entity());
```


---

#### scenePlayerToggleFlightEvent

`public function scenePlayerToggleFlightEvent(PlayerToggleFlightEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerToggleFlightEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->scenePlayerToggleFlightEvent(new PlayerToggleFlightEvent(), new SwimPlayer());
```


---

#### scenePlayerJumpEvent

`public function scenePlayerJumpEvent(PlayerJumpEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (PlayerJumpEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->scenePlayerJumpEvent(new PlayerJumpEvent(), new SwimPlayer());
```


---

#### sceneDataPacketReceiveEvent

`public function sceneDataPacketReceiveEvent(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneDataPacketReceiveEvent(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

#### sceneBucketEmptyEvent

`public function sceneBucketEmptyEvent(PlayerBucketEmptyEvent $event, SwimPlayer $sp): void`


**Parameters**:

- `$event` (PlayerBucketEmptyEvent) — 
- `$sp` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneBucketEmptyEvent(new PlayerBucketEmptyEvent(), new SwimPlayer());
```


---

#### sceneBucketFillEvent

`public function sceneBucketFillEvent(PlayerBucketFillEvent $event, SwimPlayer $sp): void`


**Parameters**:

- `$event` (PlayerBucketFillEvent) — 
- `$sp` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->sceneBucketFillEvent(new PlayerBucketFillEvent(), new SwimPlayer());
```


---

#### isFFA

`public function isFFA(): bool`


**Returns**: bool


**Example**:

```php
$scene = new Scene();
$scene->isFFA();
```


---

#### allowCrafting

`public function allowCrafting(): bool`


**Returns**: bool


**Example**:

```php
$scene = new Scene();
$scene->allowCrafting();
```


---

#### eventMessage

`public function eventMessage(string $message, ...$args): void`


**Parameters**:

- `$message` (string) — 
- `...$args` (mixed) — 

**Returns**: void


**Example**:

```php
$scene = new Scene();
$scene->eventMessage("example", null);
```


---

## Class: core\systems\scene\will

**Defined in**: `src\core\systems\scene\Scene.php`

* @var BehaviorEventEnum[] Array of events


### Methods

_No methods found_

## Class: core\systems\scene\like

**Defined in**: `src\core\systems\scene\Scene.php`

* @var BehaviorEventEnum[] Array of events


### Methods

_No methods found_

## Class: core\systems\scene\will

**Defined in**: `src\core\systems\scene\Scene.php`

* @var BehaviorEventEnum[] Array of events


### Methods

_No methods found_

## Class: core\systems\scene\SceneSystem

**Defined in**: `src\core\systems\scene\SceneSystem.php`


### Methods

#### removeScene

`public function removeScene(string $sceneName): void`

> @var Scene[]


**Parameters**:

- `$sceneName` (string) — 

**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->removeScene("example");
```


---

#### registerScene

`public function registerScene(Scene $scene, string $sceneName, bool $callInit = true): void`


**Parameters**:

- `$scene` (Scene) — 
- `$sceneName` (string) — 
- `$callInit` (bool) — 

**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->registerScene(new Scene(), "example", true);
```


---

#### getScene

`public function getScene(string $sceneName): ?Scene`


**Parameters**:

- `$sceneName` (string) — 

**Returns**: ?Scene


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->getScene("example");
```


---

#### setScene

`public function setScene(SwimPlayer $player, Scene $newScene, ?Team $team = null): void`

> @throws ScoreFactoryException


**Parameters**:

- `$player` (SwimPlayer) — 
- `$newScene` (Scene) — 
- `$team` (?Team) — 

**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->setScene(new SwimPlayer(), new Scene(), null);
```


---

#### updateTick

`public function updateTick(): void`


**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->updateTick();
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->updateSecond();
```


---

#### exit

`public function exit(): void`


**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->exit();
```


---

#### handlePlayerLeave

`public function handlePlayerLeave(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->handlePlayerLeave(new SwimPlayer());
```


---

#### getScenes

`public function getScenes(): array`


**Returns**: array


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->getScenes();
```


---

#### getInDuelsCount

`public function getInDuelsCount(): int`

> @breif returns the amount of players in duel scenes on the server


**Returns**: int


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->getInDuelsCount();
```


---

#### getInFFACount

`public function getInFFACount(): int`

> @breif returns the amount of players in ffa scenes on the server


**Returns**: int


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->getInFFACount();
```


---

#### getQueuedCount

`public function getQueuedCount(string $queueSceneName = "Queue"): int`

> @breif returns the amount of players queued on the server (count of players in the queue scene)


**Parameters**:

- `$queueSceneName` (string) — The Queue scene to use

**Returns**: int


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->getQueuedCount("Queue");
```


---

#### getSceneInstanceOfCount

`public function getSceneInstanceOfCount(string $classPath): int`

> @breif Returns how many of a scene type are active. This is not strict,


**Parameters**:

- `$classPath` (string) — 

**Returns**: int


**Example**:

```php
$sceneSystem = new SceneSystem();
$sceneSystem->getSceneInstanceOfCount("example");
```


---

## Class: core\systems\scene\name

**Defined in**: `src\core\systems\scene\SceneSystem.php`

* @var Scene[]
   * key is string scene name


### Methods

_No methods found_

## Class: core\systems\scene\name

**Defined in**: `src\core\systems\scene\SceneSystem.php`

* @var Scene[]
   * key is string scene name


### Methods

_No methods found_

## Class: core\systems\scene\failed

**Defined in**: `src\core\systems\scene\SceneSystem.php`

* @var Scene[]
   * key is string scene name


### Methods

_No methods found_

## Class: core\systems\scene\path

**Defined in**: `src\core\systems\scene\SceneSystem.php`

* @var Scene[]
   * key is string scene name


### Methods

_No methods found_

## Class: core\systems\scene\managers\BlockEntry

**Defined in**: `src\core\systems\scene\managers\BlockEntry.php`


### Methods

#### __construct

`public function __construct(public Vector3 $position, public Block $block, public int $time = 0, public int $key = -1, public int $ownerEntity = -1)`


**Parameters**:

- `public Vector3 $position` (mixed) — 
- `public Block $block` (mixed) — 
- `public int $time = 0` (mixed) — 
- `public int $key = -1` (mixed) — 
- `public int $ownerEntity = -1` (mixed) — 

**Example**:

```php
$blockEntry = new BlockEntry(null, null, null, null, null);
```


---

## Class: core\systems\scene\managers\BlocksManager

**Defined in**: `src\core\systems\scene\managers\BlocksManager.php`


### Methods

#### isPrunes

`public function isPrunes(): bool`

> @var BlockEntry[]


**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->isPrunes();
```


---

#### setPrunes

`public function setPrunes(bool $prunes = true): void`


**Parameters**:

- `$prunes` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setPrunes(true);
```


---

#### setPruneReplaceBrokenBlocks

`public function setPruneReplaceBrokenBlocks(bool $prunes = true): void`


**Parameters**:

- `$prunes` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setPruneReplaceBrokenBlocks(true);
```


---

#### setPruneRemovePlacedBlocks

`public function setPruneRemovePlacedBlocks(bool $prunes = true): void`


**Parameters**:

- `$prunes` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setPruneRemovePlacedBlocks(true);
```


---

#### getBrokenLifeTime

`public function getBrokenLifeTime(): int`


**Returns**: int


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->getBrokenLifeTime();
```


---

#### getPlacedLifeTime

`public function getPlacedLifeTime(): int`


**Returns**: int


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->getPlacedLifeTime();
```


---

#### setBrokenLifeTime

`public function setBrokenLifeTime(int $brokenLifeTime): void`


**Parameters**:

- `$brokenLifeTime` (int) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setBrokenLifeTime(123);
```


---

#### setPlacedLifeTime

`public function setPlacedLifeTime(int $placedLifeTime): void`


**Parameters**:

- `$placedLifeTime` (int) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setPlacedLifeTime(123);
```


---

#### isHashKeyInArray

`private function isHashKeyInArray(Vector3 $vector, array $array): bool`

> Checks if a hashed Vector3 key exists in the given array.


**Parameters**:

- `$vector` (Vector3) — The Vector3 object to generate the hash key.
- `$array` (array) — The array to check for the key.

**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->isHashKeyInArray(new Vector3(), []);
```


---

#### addBlockEntryToArrayWithVector3Key

`public function addBlockEntryToArrayWithVector3Key(array &$array, BlockEntry $entry): void`

> Adds a Vector3 object to an array using a hashed Vector3 key.


**Parameters**:

- `&$array` (array) — 
- `$entry` (BlockEntry) — The entry to add to the array.

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->addBlockEntryToArrayWithVector3Key([], new BlockEntry());
```


---

#### handleBlockPlace

`public function handleBlockPlace(BlockPlaceEvent $event): void`


**Parameters**:

- `$event` (BlockPlaceEvent) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->handleBlockPlace(new BlockPlaceEvent());
```


---

#### handleBlockBreak

`public function handleBlockBreak(BlockBreakEvent $event): void`


**Parameters**:

- `$event` (BlockBreakEvent) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->handleBlockBreak(new BlockBreakEvent());
```


---

#### handleBlockBreakOnBlock

`public function handleBlockBreakOnBlock(Block $block, int $ownerID = -1): bool`


**Parameters**:

- `$block` (Block) — 
- `$ownerID` (int) — 

**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->handleBlockBreakOnBlock(new Block(), -1);
```


---

#### handleNaturalBlockEvent

`public function handleNaturalBlockEvent(BlockFormEvent|BlockSpreadEvent $event): void`


**Parameters**:

- `$event` (BlockFormEvent|BlockSpreadEvent) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->handleNaturalBlockEvent(new BlockFormEvent());
```


---

#### handleBucketDump

`public function handleBucketDump(PlayerBucketEmptyEvent $event): void`


**Parameters**:

- `$event` (PlayerBucketEmptyEvent) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->handleBucketDump(new PlayerBucketEmptyEvent());
```


---

#### isInPlacedBlocks

`private function isInPlacedBlocks(Vector3 $vector3): bool`


**Parameters**:

- `$vector3` (Vector3) — 

**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->isInPlacedBlocks(new Vector3());
```


---

#### clearPlacedBlocks

`public function clearPlacedBlocks(): void`


**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->clearPlacedBlocks();
```


---

#### replaceBrokenMapBlocks

`public function replaceBrokenMapBlocks(): void`


**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->replaceBrokenMapBlocks();
```


---

#### cleanMap

`public function cleanMap(): void`


**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->cleanMap();
```


---

#### resetBlocksFromPlayer

`public function resetBlocksFromPlayer(SwimPlayer $player, bool $doBroken, bool $doPlaced): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$doBroken` (bool) — 
- `$doPlaced` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->resetBlocksFromPlayer(new SwimPlayer(), true, true);
```


---

#### getCanPlaceBlocks

`public function getCanPlaceBlocks(): bool`


**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->getCanPlaceBlocks();
```


---

#### setCanPlaceBlocks

`public function setCanPlaceBlocks(bool $canPlaceBlocks): void`


**Parameters**:

- `$canPlaceBlocks` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setCanPlaceBlocks(true);
```


---

#### getCanBreakBlocks

`public function getCanBreakBlocks(): bool`


**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->getCanBreakBlocks();
```


---

#### setCanBreakBlocks

`public function setCanBreakBlocks(bool $canBreakBlocks): void`


**Parameters**:

- `$canBreakBlocks` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setCanBreakBlocks(true);
```


---

#### getCanBreakMapBlocks

`public function getCanBreakMapBlocks(): bool`


**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->getCanBreakMapBlocks();
```


---

#### setCanBreakMapBlocks

`public function setCanBreakMapBlocks(bool $canBreakMapBlocks): void`


**Parameters**:

- `$canBreakMapBlocks` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setCanBreakMapBlocks(true);
```


---

#### isCanBreakRegisteredBlocks

`public function isCanBreakRegisteredBlocks(): bool`


**Returns**: bool


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->isCanBreakRegisteredBlocks();
```


---

#### setCanBreakRegisteredBlocks

`public function setCanBreakRegisteredBlocks(bool $canBreakRegisteredBlocks): void`


**Parameters**:

- `$canBreakRegisteredBlocks` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->setCanBreakRegisteredBlocks(true);
```


---

#### placeBlocks

`public function placeBlocks(array $positions, Block $block): void`


**Parameters**:

- `$positions` (array) — 
- `$block` (Block) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->placeBlocks([], new Block());
```


---

#### removeBlocks

`public function removeBlocks(array $positions): void`


**Parameters**:

- `$positions` (array) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->removeBlocks([]);
```


---

#### removeBlocksFast

`public function removeBlocksFast(array $positions, bool $removeFromPlacedBlocksArray = true): void`


**Parameters**:

- `$positions` (array) — 
- `$removeFromPlacedBlocksArray` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->removeBlocksFast([], true);
```


---

#### updateSecond

`public function updateSecond(): void`


**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->updateSecond();
```


---

#### addChunkLoader

`public function addChunkLoader(Vector3 $position, bool $tick = false): void`


**Parameters**:

- `$position` (Vector3) — 
- `$tick` (bool) — 

**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->addChunkLoader(new Vector3(), false);
```


---

#### removeChunkLoader

`public function removeChunkLoader(Vector3 $position): int`


**Parameters**:

- `$position` (Vector3) — 

**Returns**: int


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->removeChunkLoader(new Vector3());
```


---

#### clearChunkLoaders

`public function clearChunkLoaders(): void`


**Returns**: void


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->clearChunkLoaders();
```


---

#### getPlacedBlocks

`public function getPlacedBlocks(): array`


**Returns**: array


**Example**:

```php
$blocksManager = new BlocksManager();
$blocksManager->getPlacedBlocks();
```


---

#### debugBlockEntries

`public static function debugBlockEntries(array $arr): void`


**Parameters**:

- `$arr` (array) — 

**Returns**: void


**Example**:

```php
BlocksManager::debugBlockEntries([]);
```


---

## Class: core\systems\scene\managers\to

**Defined in**: `src\core\systems\scene\managers\BlocksManager.php`

* @var BlockEntry[]
   * @brief key is an int of a vector3 hash


### Methods

_No methods found_

## Class: core\systems\scene\managers\ChestLootManager

**Defined in**: `src\core\systems\scene\managers\ChestLootManager.php`


### Methods

#### setLootTable

`public function setLootTable(LootTable $lootTable): void`

> @var ChestTile[]


**Parameters**:

- `$lootTable` (LootTable) — 

**Returns**: void


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->setLootTable(new LootTable());
```


---

#### openAndLootChestWithLog

`public function openAndLootChestWithLog(ChestTile $chestTile): ?ChestInventory`

> First checks if we haven't fixed this chest yet


**Parameters**:

- `$chestTile` (ChestTile) — 

**Returns**: ?ChestInventory


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->openAndLootChestWithLog(new ChestTile());
```


---

#### logLooted

`public function logLooted(ChestTile $chestTile): void`


**Parameters**:

- `$chestTile` (ChestTile) — 

**Returns**: void


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->logLooted(new ChestTile());
```


---

#### isFixed

`public function isFixed(Position $position): bool`


**Parameters**:

- `$position` (Position) — 

**Returns**: bool


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->isFixed(new Position());
```


---

#### isLooted

`public function isLooted(Position $position): bool`


**Parameters**:

- `$position` (Position) — 

**Returns**: bool


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->isLooted(new Position());
```


---

#### clearLootedChestsInventory

`public function clearLootedChestsInventory(): void`


**Returns**: void


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->clearLootedChestsInventory();
```


---

#### clearLootedChestsData

`public function clearLootedChestsData(): void`


**Returns**: void


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->clearLootedChestsData();
```


---

#### refillAll

`public function refillAll(): void`


**Returns**: void


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->refillAll();
```


---

#### refillChest

`public function refillChest(ChestTile $chest): ChestInventory`


**Parameters**:

- `$chest` (ChestTile) — 

**Returns**: ChestInventory


**Example**:

```php
$chestLootManager = new ChestLootManager();
$chestLootManager->refillChest(new ChestTile());
```


---

#### fillInventory

`public static function fillInventory(Inventory $inventory, array $items, bool $attemptToStack = true): void`

> @breif fills an inventory with an array of items at random slots


**Parameters**:

- `$inventory` (Inventory) — 
- `$items` (array) — 
- `$attemptToStack` (bool) — 

**Returns**: void


**Example**:

```php
ChestLootManager::fillInventory(new Inventory(), [], true);
```


---

## Class: core\systems\scene\managers\must

**Defined in**: `src\core\systems\scene\managers\ChestLootManager.php`

* @var ChestTile[]
   * key is int from vector3 hash


### Methods

_No methods found_

## Class: core\systems\scene\managers\DroppedItemManager

**Defined in**: `src\core\systems\scene\managers\DroppedItemManager.php`


### Methods

#### addDroppedItem

`public function addDroppedItem(ItemEntity $entity, int $delayTicks = ItemEntity::NEVER_DESPAWN): void`


**Parameters**:

- `$entity` (ItemEntity) — 
- `$delayTicks` (int) — 

**Returns**: void


**Example**:

```php
$droppedItemManager = new DroppedItemManager();
$droppedItemManager->addDroppedItem(new ItemEntity(), ItemEntity::NEVER_DESPAWN);
```


---

#### removeDroppedItem

`public function removeDroppedItem(ItemEntity $entity): void`


**Parameters**:

- `$entity` (ItemEntity) — 

**Returns**: void


**Example**:

```php
$droppedItemManager = new DroppedItemManager();
$droppedItemManager->removeDroppedItem(new ItemEntity());
```


---

#### despawnAll

`public function despawnAll(): void`


**Returns**: void


**Example**:

```php
$droppedItemManager = new DroppedItemManager();
$droppedItemManager->despawnAll();
```


---

## Class: core\systems\scene\managers\JoinRequestManager

**Defined in**: `src\core\systems\scene\managers\JoinRequestManager.php`


### Methods

#### __construct

`public function __construct(Scene $scene)`


**Parameters**:

- `$scene` (Scene) — 

**Example**:

```php
$joinRequestManager = new JoinRequestManager(new Scene());
```


---

#### hasSentJoinRequest

`public function hasSentJoinRequest(SwimPlayer $player): bool`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$joinRequestManager = new JoinRequestManager(new Scene());
$joinRequestManager->hasSentJoinRequest(new SwimPlayer());
```


---

#### sendJoinRequest

`public function sendJoinRequest(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$joinRequestManager = new JoinRequestManager(new Scene());
$joinRequestManager->sendJoinRequest(new SwimPlayer());
```


---

#### acceptedJoinRequest

`public function acceptedJoinRequest(SwimPlayer $player, SwimPlayer $owner): void`

> @throws ScoreFactoryException


**Parameters**:

- `$player` (SwimPlayer) — 
- `$owner` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$joinRequestManager = new JoinRequestManager(new Scene());
$joinRequestManager->acceptedJoinRequest(new SwimPlayer(), new SwimPlayer());
```


---

## Class: core\systems\scene\managers\TeamManager

**Defined in**: `src\core\systems\scene\managers\TeamManager.php`


### Methods

#### getTeams

`public function getTeams(): array`

> @var Team[] Array of Teams


**Returns**: array


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getTeams();
```


---

#### setSpecTeam

`public function setSpecTeam(Team $specTeam): void`


**Parameters**:

- `$specTeam` (Team) — 

**Returns**: void


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->setSpecTeam(new Team());
```


---

#### getTeamByColor

`public function getTeamByColor(string $color): ?Team`


**Parameters**:

- `$color` (string) — 

**Returns**: ?Team


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getTeamByColor("example");
```


---

#### getSpecTeam

`public function getSpecTeam(): ?Team`


**Returns**: ?Team


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getSpecTeam();
```


---

#### getFirstOpposingTeam

`public function getFirstOpposingTeam(Team $team): ?Team`


**Parameters**:

- `$team` (Team) — 

**Returns**: ?Team


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getFirstOpposingTeam(new Team());
```


---

#### getAllOpposingTeams

`public function getAllOpposingTeams(Team $team): array`

> Array key is string team name


**Parameters**:

- `$team` (Team) — 

**Returns**: array


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getAllOpposingTeams(new Team());
```


---

#### getParentScene

`public function getParentScene(): Scene`


**Returns**: Scene


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getParentScene();
```


---

#### setParentScene

`public function setParentScene(Scene $parentScene): void`


**Parameters**:

- `$parentScene` (Scene) — 

**Returns**: void


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->setParentScene(new Scene());
```


---

#### getTeamByID

`public function getTeamByID(int $id): ?Team`


**Parameters**:

- `$id` (int) — 

**Returns**: ?Team


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getTeamByID(123);
```


---

#### makeTeam

`public function makeTeam(string $teamName, string $teamColor, bool $respawn = false, int $targetScore = 1): Team`


**Parameters**:

- `$teamName` (string) — 
- `$teamColor` (string) — 
- `$respawn` (bool) — 
- `$targetScore` (int) — 

**Returns**: Team


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->makeTeam("example", "example", false, 1);
```


---

#### getTeam

`public function getTeam(string $teamName): ?Team`


**Parameters**:

- `$teamName` (string) — 

**Returns**: ?Team


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->getTeam("example");
```


---

#### lookAtEachOther

`public function lookAtEachOther(): void`


**Returns**: void


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->lookAtEachOther();
```


---

#### teamValidAndInScene

`public function teamValidAndInScene(?Team $team = null): bool`


**Parameters**:

- `$team` (?Team) — 

**Returns**: bool


**Example**:

```php
$teamManager = new TeamManager();
$teamManager->teamValidAndInScene(null);
```


---

## Class: core\systems\scene\misc\is

**Defined in**: `src\core\systems\scene\misc\BlockTicker.php`


### Methods

#### __construct

`public function __construct(World $world, Vector3 $position, bool $ticking = false)`


**Parameters**:

- `$world` (World) — 
- `$position` (Vector3) — 
- `$ticking` (bool) — 

**Example**:

```php
$is = new is(new World(), new Vector3(), false);
```


---

#### setPosition

`public function setPosition(Vector3 $newPosition, bool $free = true): void`

> Set a new position for the ticker, unregistering the old one and registering at the new position.


**Parameters**:

- `$newPosition` (Vector3) — 
- `$free` (bool) — 

**Returns**: void


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->setPosition(new Vector3(), true);
```


---

#### registerChunkLoaderAndTicker

`private function registerChunkLoaderAndTicker(): void`

> Registers the chunk loader and ticker for the current position.


**Returns**: void


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->registerChunkLoaderAndTicker();
```


---

#### enableChunkTicker

`public function enableChunkTicker(bool $enable): void`

> Enable or disable the chunk ticker.


**Parameters**:

- `$enable` (bool) — 

**Returns**: void


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->enableChunkTicker(true);
```


---

#### free

`public function free(): void`

> Free the current chunk loader and ticker (if enabled).


**Returns**: void


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->free();
```


---

#### getPosition

`public function getPosition(): Vector3`


**Returns**: Vector3


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->getPosition();
```


---

#### getWorld

`public function getWorld(): World`


**Returns**: World


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->getWorld();
```


---

#### isChunkTickerEnabled

`public function isChunkTickerEnabled(): bool`


**Returns**: bool


**Example**:

```php
$is = new is(new World(), new Vector3(), false);
$is->isChunkTickerEnabled();
```


---

## Class: core\systems\scene\misc\implements

**Defined in**: `src\core\systems\scene\misc\BlockTicker.php`


### Methods

_No methods found_

## Class: core\systems\scene\misc\LootTable

**Defined in**: `src\core\systems\scene\misc\LootTable.php`


### Methods

#### getRandomLoot

`public function getRandomLoot(): array`

> @brief Parent class will implement this and use this function as where to call the register functions


**Returns**: array


**Example**:

```php
$lootTable = new LootTable();
$lootTable->getRandomLoot();
```


---

#### addItem

`private function addItem(array $itemCategory, array &$loot, int $index, bool $randomizeCount = true, bool $doubleCount = false): void`


**Parameters**:

- `$itemCategory` (array) — 
- `&$loot` (array) — 
- `$index` (int) — 
- `$randomizeCount` (bool) — 
- `$doubleCount` (bool) — 

**Returns**: void


**Example**:

```php
$lootTable = new LootTable();
$lootTable->addItem([], [], 123, true, false);
```


---

#### getRandomItem

`public function getRandomItem(): Item`

> Retrieves a single randomly selected item from all categories.


**Returns**: Item


**Example**:

```php
$lootTable = new LootTable();
$lootTable->getRandomItem();
```


---

#### getRandomItemOfCategory

`public function getRandomItemOfCategory(int $category): Item`

> Retrieves a random item of a specified category.


**Parameters**:

- `$category` (int) — The category from which to retrieve the item ('weapon', 'armor', 'movement', 'healing', 'misc').

**Returns**: Item


**Example**:

```php
$lootTable = new LootTable();
$lootTable->getRandomItemOfCategory(123);
```


---

#### registerItem

`public function registerItem(int $category, Item $item): void`

> Registers an item under a specified category.


**Parameters**:

- `$category` (int) — The category to register the item under.
- `$item` (Item) — The item to register.

**Returns**: void


**Example**:

```php
$lootTable = new LootTable();
$lootTable->registerItem(123, new Item());
```


---

## Class: core\systems\scene\misc\will

**Defined in**: `src\core\systems\scene\misc\LootTable.php`


### Methods

_No methods found_

## Class: core\systems\scene\misc\SpectatorCompass

**Defined in**: `src\core\systems\scene\misc\SpectatorCompass.php`


### Methods

#### __construct

`public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::COMPASS)`


**Parameters**:

- `$identifier` (ItemIdentifier) — 

**Example**:

```php
$spectatorCompass = new SpectatorCompass(new ItemIdentifier(ItemTypeIds::COMPASS);
```


---

#### onClickAir

`public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult`


**Parameters**:

- `$player` (Player) — 
- `$directionVector` (Vector3) — 
- `&$returnedItems` (array) — 

**Returns**: ItemUseResult


**Example**:

```php
$spectatorCompass = new SpectatorCompass(new ItemIdentifier(ItemTypeIds::COMPASS);
$spectatorCompass->onClickAir(new Player(), new Vector3(), []);
```


---

#### spectatorForm

`public static function spectatorForm(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
SpectatorCompass::spectatorForm(new SwimPlayer());
```


---

## Class: core\systems\scene\misc\Team

**Defined in**: `src\core\systems\scene\misc\Team.php`


### Methods

#### getOriginalPlayers

`public function getOriginalPlayers(): array`

> @var SwimPlayer[] Array of SwimPlayer objects indexed by int ID keys


**Returns**: array


**Example**:

```php
$team = new Team();
$team->getOriginalPlayers();
```


---

#### isSpecTeam

`public function isSpecTeam(): bool`


**Returns**: bool


**Example**:

```php
$team = new Team();
$team->isSpecTeam();
```


---

#### setSpecTeam

`public function setSpecTeam(bool $specTeam): void`


**Parameters**:

- `$specTeam` (bool) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setSpecTeam(true);
```


---

#### getTeamID

`public function getTeamID(): int`


**Returns**: int


**Example**:

```php
$team = new Team();
$team->getTeamID();
```


---

#### getTeamSize

`public function getTeamSize(): int`


**Returns**: int


**Example**:

```php
$team = new Team();
$team->getTeamSize();
```


---

#### addPlayer

`public function addPlayer(SwimPlayer $swimPlayer, bool $customizeTagColor = true): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$customizeTagColor` (bool) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->addPlayer(new SwimPlayer(), true);
```


---

#### getRandomSpawnPosition

`public function getRandomSpawnPosition(): ?Position`


**Returns**: ?Position


**Example**:

```php
$team = new Team();
$team->getRandomSpawnPosition();
```


---

#### getFormattedScore

`public function getFormattedScore(): string`


**Returns**: string


**Example**:

```php
$team = new Team();
$team->getFormattedScore();
```


---

#### formattedScoreParenthesis

`public function formattedScoreParenthesis(): string`


**Returns**: string


**Example**:

```php
$team = new Team();
$team->formattedScoreParenthesis();
```


---

#### applySpectatorKit

`public static function applySpectatorKit(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
Team::applySpectatorKit(new SwimPlayer());
```


---

#### removePlayer

`public function removePlayer(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->removePlayer(new SwimPlayer());
```


---

#### pruneOffline

`public function pruneOffline(): void`

> @breif Removes all disconnected player's from a team, or player's no longer in the queue scene.


**Returns**: void


**Example**:

```php
$team = new Team();
$team->pruneOffline();
```


---

#### getFirstPlayer

`public function getFirstPlayer(): ?SwimPlayer`


**Returns**: ?SwimPlayer


**Example**:

```php
$team = new Team();
$team->getFirstPlayer();
```


---

#### getFirstTwoPlayers

`public function getFirstTwoPlayers(): array`


**Returns**: array


**Example**:

```php
$team = new Team();
$team->getFirstTwoPlayers();
```


---

#### isInTeam

`public function isInTeam(SwimPlayer $swimPlayer): bool`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: bool


**Example**:

```php
$team = new Team();
$team->isInTeam(new SwimPlayer());
```


---

#### teamMessage

`public function teamMessage(string $msg): void`


**Parameters**:

- `$msg` (string) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->teamMessage("example");
```


---

#### teamSound

`public function teamSound(string $soundName, float $volume = 0, float $pitch = 0): void`


**Parameters**:

- `$soundName` (string) — 
- `$volume` (float) — 
- `$pitch` (float) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->teamSound("example", 0, 0);
```


---

#### teamTitle

`public function teamTitle(string $title, string $subtitle = "", int $fadeIn = -1, int $stay = -1, int $fadeOut = -1): void`


**Parameters**:

- `$title` (string) — 
- `$subtitle` (string) — 
- `$fadeIn` (int) — 
- `$stay` (int) — 
- `$fadeOut` (int) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->teamTitle("example", "", -1, -1, -1);
```


---

#### setParentScene

`public function setParentScene(Scene $parentScene): void`


**Parameters**:

- `$parentScene` (Scene) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setParentScene(new Scene());
```


---

#### getParentScene

`public function getParentScene(): Scene`


**Returns**: Scene


**Example**:

```php
$team = new Team();
$team->getParentScene();
```


---

#### addSpawnPoint

`public function addSpawnPoint(int $index, Position $position): void`


**Parameters**:

- `$index` (int) — 
- `$position` (Position) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->addSpawnPoint(123, new Position());
```


---

#### removeSpawnPoint

`public function removeSpawnPoint(int $index): void`


**Parameters**:

- `$index` (int) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->removeSpawnPoint(123);
```


---

#### swapSpawnPointsAtIndex

`public static function swapSpawnPointsAtIndex(Team $teamOne, Team $teamTwo, int $index): void`


**Parameters**:

- `$teamOne` (Team) — 
- `$teamTwo` (Team) — 
- `$index` (int) — 

**Returns**: void


**Example**:

```php
Team::swapSpawnPointsAtIndex(new Team(), new Team(), 123);
```


---

#### getSpawnPoint

`public function getSpawnPoint(int $index): ?Position`


**Parameters**:

- `$index` (int) — 

**Returns**: ?Position


**Example**:

```php
$team = new Team();
$team->getSpawnPoint(123);
```


---

#### getTeamName

`public function getTeamName(): string`


**Returns**: string


**Example**:

```php
$team = new Team();
$team->getTeamName();
```


---

#### setTeamName

`public function setTeamName(string $teamName): void`


**Parameters**:

- `$teamName` (string) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setTeamName("example");
```


---

#### getScore

`public function getScore(): int`


**Returns**: int


**Example**:

```php
$team = new Team();
$team->getScore();
```


---

#### setScore

`public function setScore(int $score): void`


**Parameters**:

- `$score` (int) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setScore(123);
```


---

#### getPlayers

`public function getPlayers(): array`


**Returns**: array


**Example**:

```php
$team = new Team();
$team->getPlayers();
```


---

#### getSpawnPoints

`public function getSpawnPoints(): array`


**Returns**: array


**Example**:

```php
$team = new Team();
$team->getSpawnPoints();
```


---

#### getTeamColor

`public function getTeamColor(): string`


**Returns**: string


**Example**:

```php
$team = new Team();
$team->getTeamColor();
```


---

#### setTeamColor

`public function setTeamColor(string $teamColor): void`


**Parameters**:

- `$teamColor` (string) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setTeamColor("example");
```


---

#### getTargetScore

`public function getTargetScore(): int`


**Returns**: int


**Example**:

```php
$team = new Team();
$team->getTargetScore();
```


---

#### setTargetScore

`public function setTargetScore(int $targetScore): void`


**Parameters**:

- `$targetScore` (int) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setTargetScore(123);
```


---

#### canRespawn

`public function canRespawn(): bool`


**Returns**: bool


**Example**:

```php
$team = new Team();
$team->canRespawn();
```


---

#### setRespawn

`public function setRespawn(bool $respawn): void`


**Parameters**:

- `$respawn` (bool) — 

**Returns**: void


**Example**:

```php
$team = new Team();
$team->setRespawn(true);
```


---

## Class: core\systems\scene\replay\MovieScene

**Defined in**: `src\core\systems\scene\replay\MovieScene.php`


### Methods

#### init

`public function init(): void`

> @var MovieActor[] $movieActors */


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->init();
```


---

#### setUpChunkLoaders

`private function setUpChunkLoaders(): void`


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->setUpChunkLoaders();
```


---

#### spawnFakePlayers

`private function spawnFakePlayers(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->spawnFakePlayers();
```


---

#### updateTick

`public function updateTick(): void`

> Updates the scene tick.


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->updateTick();
```


---

#### scoreboard

`private function scoreboard(): void`

> @throws ScoreFactoryException


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->scoreboard();
```


---

#### processTick

`private function processTick(int $tick): void`

> Process events for a specific tick.


**Parameters**:

- `$tick` (int) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->processTick(123);
```


---

#### movement

`private function movement(int $tick): void`


**Parameters**:

- `$tick` (int) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->movement(123);
```


---

#### visibleArmor

`private function visibleArmor(int $tick): void`

> Applies recorded inventory changes (held item and armor) for the given tick to the corresponding movie actors.


**Parameters**:

- `$tick` (int) — The tick at which to apply inventory changes.

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->visibleArmor(123);
```


---

#### blockAdds

`private function blockAdds(int $tick): void`


**Parameters**:

- `$tick` (int) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->blockAdds(123);
```


---

#### blockRemoves

`private function blockRemoves(int $tick): void`


**Parameters**:

- `$tick` (int) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->blockRemoves(123);
```


---

#### resetSceneState

`private function resetSceneState(): void`

> Resets the scene state for scrubbing.


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->resetSceneState();
```


---

#### applyInventory

`private function applyInventory(MovieActor $actor, array $invData): void`


**Parameters**:

- `$actor` (MovieActor) — 
- `$invData` (array) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->applyInventory(new MovieActor(), []);
```


---

#### createPropItem

`private function createPropItem(int $id, int $color = -1, bool $isArmor = false, bool $enchanted = false, bool $isBlock = false): Item`


**Parameters**:

- `$id` (int) — 
- `$color` (int) — 
- `$isArmor` (bool) — 
- `$enchanted` (bool) — 
- `$isBlock` (bool) — 

**Returns**: Item


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->createPropItem(123, -1, false, false, false);
```


---

#### getClosestDyeColor

`private function getClosestDyeColor(int $color): DyeColor`


**Parameters**:

- `$color` (int) — 

**Returns**: DyeColor


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->getClosestDyeColor(123);
```


---

#### isArmorItem

`private function isArmorItem(int $itemID): bool`

> Determines if the given item is an armor piece.


**Parameters**:

- `$itemID` (int) — 

**Returns**: bool


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->isArmorItem(123);
```


---

#### sceneItemUseEvent

`public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void`

> @throws ScoreFactoryException


**Parameters**:

- `$event` (PlayerItemUseEvent) — 
- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->sceneItemUseEvent(new PlayerItemUseEvent(), new SwimPlayer());
```


---

#### getMaxTick

`private function getMaxTick(): int`

> @throws ScoreFactoryException


**Returns**: int


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->getMaxTick();
```


---

#### getCurrentTick

`private function getCurrentTick(): int`

> Returns the current tick taking into account the playback start time and any time offset.


**Returns**: int


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->getCurrentTick();
```


---

#### scrubBack

`private function scrubBack(int $ticks): void`

> Scrubs backward by a specified number of ticks.


**Parameters**:

- `$ticks` (int) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->scrubBack(123);
```


---

#### scrubForward

`private function scrubForward(int $ticks): void`

> Scrubs forward by a specified number of ticks.


**Parameters**:

- `$ticks` (int) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->scrubForward(123);
```


---

#### togglePause

`private function togglePause(): void`

> Toggles the pause state of the replay.


**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->togglePause();
```


---

#### kit

`public function kit(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->kit(new SwimPlayer());
```


---

#### playerRemoved

`public function playerRemoved(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$movieScene = new MovieScene();
$movieScene->playerRemoved(new SwimPlayer());
```


---

#### makeMovieScene

`public static function makeMovieScene(SceneReplay $replay, array $playersToJoin): void`

> @throws ScoreFactoryException|ReflectionException


**Parameters**:

- `$replay` (SceneReplay) — 
- `$playersToJoin` (array) — 

**Returns**: void


**Example**:

```php
MovieScene::makeMovieScene(new SceneReplay(), []);
```


---

## Class: core\systems\scene\replay\ReplaySelectionDebugUI

**Defined in**: `src\core\systems\scene\replay\ReplaySelectionDebugUI.php`


### Methods

#### replaySelectionDebugUI

`public static function replaySelectionDebugUI(SwimPlayer $swimPlayer): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
ReplaySelectionDebugUI::replaySelectionDebugUI(new SwimPlayer());
```


---

## Class: core\systems\scene\replay\SceneRecorder

**Defined in**: `src\core\systems\scene\replay\SceneRecorder.php`


### Methods

#### startRecording

`public function startRecording(string $name, string $modeName, string $mapName, string $worldName, Vector3 $origin): void`


**Parameters**:

- `$name` (string) — 
- `$modeName` (string) — 
- `$mapName` (string) — 
- `$worldName` (string) — 
- `$origin` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->startRecording("example", "example", "example", "example", new Vector3());
```


---

#### stopRecording

`public function stopRecording(): void`


**Returns**: void


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->stopRecording();
```


---

#### onReceive

`public function onReceive(DataPacketReceiveEvent $event, SwimPlayer $player): void`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->onReceive(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

#### onBlockAdd

`public function onBlockAdd(Block $block, Vector3 $pos): void`


**Parameters**:

- `$block` (Block) — 
- `$pos` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->onBlockAdd(new Block(), new Vector3());
```


---

#### onBlockRemove

`public function onBlockRemove(Block $block, Vector3 $pos): void`


**Parameters**:

- `$block` (Block) — 
- `$pos` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->onBlockRemove(new Block(), new Vector3());
```


---

#### addChunkLoader

`public function addChunkLoader(Vector3 $position): void`


**Parameters**:

- `$position` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->addChunkLoader(new Vector3());
```


---

#### internalGet

`private function internalGet(): ?SceneReplay`


**Returns**: ?SceneReplay


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->internalGet();
```


---

#### isRecording

`public function isRecording(): bool`


**Returns**: bool


**Example**:

```php
$sceneRecorder = new SceneRecorder();
$sceneRecorder->isRecording();
```


---

## Class: core\systems\scene\replay\SceneReplay

**Defined in**: `src\core\systems\scene\replay\SceneReplay.php`


### Methods

#### dumpInfo

`public function dumpInfo(): string`

> @var SceneReplay[] */


**Returns**: string


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->dumpInfo();
```


---

#### onReceive

`public function onReceive(DataPacketReceiveEvent $event, SwimPlayer $player): void`

> Called frequently during recording.


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->onReceive(new DataPacketReceiveEvent(), new SwimPlayer());
```


---

#### recordMovement

`private function recordMovement(PlayerAuthInputPacket $pk, int $timeKey, SwimPlayer $player): void`

> @var PlayerAuthInputPacket $pk */


**Parameters**:

- `$pk` (PlayerAuthInputPacket) — 
- `$timeKey` (int) — 
- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->recordMovement(new PlayerAuthInputPacket(), 123, new SwimPlayer());
```


---

#### recordArmorAndHeldItem

`private function recordArmorAndHeldItem(SwimPlayer $player, int $timeKey): void`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$timeKey` (int) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->recordArmorAndHeldItem(new SwimPlayer(), 123);
```


---

#### getItemID

`private function getItemID(Item $item): int`

> Returns the item ID, ensuring that item blocks are correctly mapped to their block IDs.


**Parameters**:

- `$item` (Item) — 

**Returns**: int


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->getItemID(new Item());
```


---

#### isBlock

`private function isBlock(Item $item): bool`

> Determines if the given item is a block item.


**Parameters**:

- `$item` (Item) — 

**Returns**: bool


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->isBlock(new Item());
```


---

#### getItemColor

`private function getItemColor(Item $item): int`

> Returns the RGBA color value of an item if applicable (e.g., leather armor or colored blocks).


**Parameters**:

- `$item` (Item) — 

**Returns**: int


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->getItemColor(new Item());
```


---

#### isLeatherArmorItem

`private function isLeatherArmorItem(Item $item): bool`

> @var Armor $item */


**Parameters**:

- `$item` (Item) — 

**Returns**: bool


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->isLeatherArmorItem(new Item());
```


---

#### getBlockColor

`private function getBlockColor(Block $block): int`

> Returns the RGBA color value of a block if it has a dye color.


**Parameters**:

- `$block` (Block) — 

**Returns**: int


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->getBlockColor(new Block());
```


---

#### sameLocation

`private function sameLocation(Location $location1, Location $location2, float $epsilon = 0.001): bool`

> Helper function to check if two locations are nearly the same.


**Parameters**:

- `$location1` (Location) — 
- `$location2` (Location) — 
- `$epsilon` (float) — 

**Returns**: bool


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->sameLocation(new Location(), new Location(), 0.001);
```


---

#### onBlockAdd

`public function onBlockAdd(Block $block, Vector3 $pos): void`

> Records a block addition event.


**Parameters**:

- `$block` (Block) — 
- `$pos` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->onBlockAdd(new Block(), new Vector3());
```


---

#### onBlockRemove

`public function onBlockRemove(Block $block, Vector3 $pos): void`

> Records a block removal event.


**Parameters**:

- `$block` (Block) — 
- `$pos` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->onBlockRemove(new Block(), new Vector3());
```


---

#### recordBlockAction

`private function recordBlockAction(int $key, Block $block, Vector3 $pos): void`

> Helper function to record block actions (add or remove) at a tick.


**Parameters**:

- `$key` (int) — 
- `$block` (Block) — 
- `$pos` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->recordBlockAction(123, new Block(), new Vector3());
```


---

#### addChunkLoader

`public function addChunkLoader(Vector3 $position): void`

> Records a chunk loader position.


**Parameters**:

- `$position` (Vector3) — 

**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->addChunkLoader(new Vector3());
```


---

#### save

`public function save(): void`

> Saves this replay to temporary storage.


**Returns**: void


**Example**:

```php
$sceneReplay = new SceneReplay();
$sceneReplay->save();
```


---

## Class: core\tasks\RandomMessageTask

**Defined in**: `src\core\tasks\RandomMessageTask.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$randomMessageTask = new RandomMessageTask();
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$randomMessageTask = new RandomMessageTask();
$randomMessageTask->onRun();
```


---

## Class: core\tasks\SystemUpdateTask

**Defined in**: `src\core\tasks\SystemUpdateTask.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$systemUpdateTask = new SystemUpdateTask(new SwimCore());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$systemUpdateTask = new SystemUpdateTask(new SwimCore());
$systemUpdateTask->onRun();
```


---

## Class: core\utils\AABB

**Defined in**: `src\core\utils\AABB.php`


### Methods

#### __construct

`public function __construct(float $minX, $minY, float $minZ, float $maxX, float $maxY, float $maxZ)`


**Parameters**:

- `$minX` (float) — 
- `$minY` (mixed) — 
- `$minZ` (float) — 
- `$maxX` (float) — 
- `$maxY` (float) — 
- `$maxZ` (float) — 

**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
```


---

#### fromAxisAlignedBB

`public static function fromAxisAlignedBB(AxisAlignedBB $alignedBB): AABB`


**Parameters**:

- `$alignedBB` (AxisAlignedBB) — 

**Returns**: AABB


**Example**:

```php
AABB::fromAxisAlignedBB(new AxisAlignedBB());
```


---

#### fromPosition

`public static function fromPosition(Vector3 $pos, float $width = 0.3, float $height = 1.8): AABB`


**Parameters**:

- `$pos` (Vector3) — 
- `$width` (float) — 
- `$height` (float) — 

**Returns**: AABB


**Example**:

```php
AABB::fromPosition(new Vector3(), 0.3, 1.8);
```


---

#### fromBlock

`public static function fromBlock(Block $block): AABB`


**Parameters**:

- `$block` (Block) — 

**Returns**: AABB


**Example**:

```php
AABB::fromBlock(new Block());
```


---

#### clone

`public function clone(): AABB`


**Returns**: AABB


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->clone();
```


---

#### translate

`public function translate(float $x, float $y, float $z): AABB`


**Parameters**:

- `$x` (float) — 
- `$y` (float) — 
- `$z` (float) — 

**Returns**: AABB


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->translate(1.23, 1.23, 1.23);
```


---

#### grow

`public function grow(float $x, float $y, float $z): AABB`


**Parameters**:

- `$x` (float) — 
- `$y` (float) — 
- `$z` (float) — 

**Returns**: AABB


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->grow(1.23, 1.23, 1.23);
```


---

#### contains

`public function contains(Vector3 $pos): bool`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: bool


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->contains(new Vector3());
```


---

#### min

`public function min(int $i): float`


**Parameters**:

- `$i` (int) — 

**Returns**: float


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->min(123);
```


---

#### max

`public function max(int $i): float`


**Parameters**:

- `$i` (int) — 

**Returns**: float


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->max(123);
```


---

#### getCornerVectors

`public function getCornerVectors(): array`


**Returns**: array


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->getCornerVectors();
```


---

#### distanceFromVector

`public function distanceFromVector(Vector3 $vector): float`


**Parameters**:

- `$vector` (Vector3) — 

**Returns**: float


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->distanceFromVector(new Vector3());
```


---

#### closestPoint

`public function closestPoint(Vector3 $origin): Vector3`


**Parameters**:

- `$origin` (Vector3) — 

**Returns**: Vector3


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->closestPoint(new Vector3());
```


---

#### calculateIntercept

`public function calculateIntercept(Vector3 $pos1, Vector3 $pos2): ?RayTraceResult`


**Parameters**:

- `$pos1` (Vector3) — 
- `$pos2` (Vector3) — 

**Returns**: ?RayTraceResult


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->calculateIntercept(new Vector3(), new Vector3());
```


---

#### toAABB

`public function toAABB(): AxisAlignedBB`


**Returns**: AxisAlignedBB


**Example**:

```php
$aABB = new AABB(1.23, null, 1.23, 1.23, 1.23, 1.23);
$aABB->toAABB();
```


---

## Class: core\utils\AcData

**Defined in**: `src\core\utils\AcData.php`


### Methods

_No methods found_

## Class: core\utils\ArrayEnumArgument

**Defined in**: `src\core\utils\ArrayEnumArgument.php`


### Methods

#### __construct

`public function __construct(string $name, array $values, bool $optional = false, bool $check = true, string $typeName = "")`


**Parameters**:

- `$name` (string) — 
- `$values` (array) — 
- `$optional` (bool) — 
- `$check` (bool) — 
- `$typeName` (string) — 

**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
```


---

#### getNetworkType

`public function getNetworkType(): int`


**Returns**: int


**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
$arrayEnumArgument->getNetworkType();
```


---

#### getTypeName

`public function getTypeName(): string`


**Returns**: string


**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
$arrayEnumArgument->getTypeName();
```


---

#### canParse

`public function canParse(string $testString, CommandSender $sender): bool`


**Parameters**:

- `$testString` (string) — 
- `$sender` (CommandSender) — 

**Returns**: bool


**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
$arrayEnumArgument->canParse("example", new CommandSender());
```


---

#### getValue

`public function getValue(string $string)`


**Parameters**:

- `$string` (string) — 

**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
$arrayEnumArgument->getValue("example");
```


---

#### getEnumValues

`public function getEnumValues(): array`


**Returns**: array


**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
$arrayEnumArgument->getEnumValues();
```


---

#### parse

`public function parse(string $argument, CommandSender $sender): mixed`


**Parameters**:

- `$argument` (string) — 
- `$sender` (CommandSender) — 

**Returns**: mixed


**Example**:

```php
$arrayEnumArgument = new ArrayEnumArgument("example", [], false, true, "");
$arrayEnumArgument->parse("example", new CommandSender());
```


---

## Class: core\utils\AsyncQuery

**Defined in**: `src\core\utils\AsyncQuery.php`


### Methods

#### __construct

`public function __construct(callable $cb, private readonly string $ip, private readonly int $port = 19132)`


**Parameters**:

- `$cb` (callable) — 
- `private readonly string $ip` (mixed) — 
- `private readonly int $port = 19132` (mixed) — 

**Example**:

```php
$asyncQuery = new AsyncQuery(function() {}, "example", null);
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$asyncQuery = new AsyncQuery(function() {}, "example", null);
$asyncQuery->onRun();
```


---

#### onCompletion

`public function onCompletion(): void`


**Returns**: void


**Example**:

```php
$asyncQuery = new AsyncQuery(function() {}, "example", null);
$asyncQuery->onCompletion();
```


---

## Class: core\utils\BehaviorEventEnums

**Defined in**: `src\core\utils\BehaviorEventEnums.php`


### Methods

_No methods found_

## Class: core\utils\is

**Defined in**: `src\core\utils\Colors.php`


### Methods

#### colorize

`public static function colorize(array $colorSeq, string $text): string`


**Parameters**:

- `$colorSeq` (array) — 
- `$text` (string) — 

**Returns**: string


**Example**:

```php
is::colorize([], "example");
```


---

#### handleMessageColor

`public static function handleMessageColor(string $color, string $msg): string`


**Parameters**:

- `$color` (string) — 
- `$msg` (string) — 

**Returns**: string


**Example**:

```php
is::handleMessageColor("example", "example");
```


---

## Class: core\utils\CoolAnimations

**Defined in**: `src\core\utils\CoolAnimations.php`


### Methods

#### lightningBolt

`public static function lightningBolt(Position $pos, World $world): void`


**Parameters**:

- `$pos` (Position) — 
- `$world` (World) — 

**Returns**: void


**Example**:

```php
CoolAnimations::lightningBolt(new Position(), new World());
```


---

#### bloodDeathAnimation

`public static function bloodDeathAnimation(Position $pos, World $world): void`


**Parameters**:

- `$pos` (Position) — 
- `$world` (World) — 

**Returns**: void


**Example**:

```php
CoolAnimations::bloodDeathAnimation(new Position(), new World());
```


---

#### explodeAnimation

`public static function explodeAnimation(Position $pos, World $world): void`


**Parameters**:

- `$pos` (Position) — 
- `$world` (World) — 

**Returns**: void


**Example**:

```php
CoolAnimations::explodeAnimation(new Position(), new World());
```


---

## Class: core\utils\CustomDamage

**Defined in**: `src\core\utils\CustomDamage.php`


### Methods

#### customDamageHandle

`public static function customDamageHandle(EntityDamageEvent $ev, bool $critEnabled = false): void`


**Parameters**:

- `$ev` (EntityDamageEvent) — 
- `$critEnabled` (bool) — 

**Returns**: void


**Example**:

```php
CustomDamage::customDamageHandle(new EntityDamageEvent(), false);
```


---

#### calculateFinalDamageWithoutCrits

`public static function calculateFinalDamageWithoutCrits(EntityDamageEvent $event, bool $critEnabled = false): float`


**Parameters**:

- `$event` (EntityDamageEvent) — 
- `$critEnabled` (bool) — 

**Returns**: float


**Example**:

```php
CustomDamage::calculateFinalDamageWithoutCrits(new EntityDamageEvent(), false);
```


---

## Class: core\utils\FileUtil

**Defined in**: `src\core\utils\FileUtil.php`


### Methods

#### GetDirectories

`public static function GetDirectories(string $path): array`


**Parameters**:

- `$path` (string) — 

**Returns**: array


**Example**:

```php
FileUtil::GetDirectories("example");
```


---

#### RecurseDelete

`public static function RecurseDelete($src): void`


**Parameters**:

- `$src` (mixed) — 

**Returns**: void


**Example**:

```php
FileUtil::RecurseDelete(null);
```


---

#### RecurseCopy

`public static function RecurseCopy($src, $dst): void`


**Parameters**:

- `$src` (mixed) — 
- `$dst` (mixed) — 

**Returns**: void


**Example**:

```php
FileUtil::RecurseCopy(null, null);
```


---

## Class: core\utils\FilterHelper

**Defined in**: `src\core\utils\FilterHelper.php`


### Methods

#### chatFilter

`public static function chatFilter($str): bool`


**Parameters**:

- `$str` (mixed) — 

**Returns**: bool


**Example**:

```php
FilterHelper::chatFilter(null);
```


---

#### ignFilter

`public static function ignFilter($str): bool`


**Parameters**:

- `$str` (mixed) — 

**Returns**: bool


**Example**:

```php
FilterHelper::ignFilter(null);
```


---

## Class: core\utils\InventoryUtil

**Defined in**: `src\core\utils\InventoryUtil.php`


### Methods

#### clearInventory

`public static function clearInventory(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::clearInventory(new Player());
```


---

#### clearXP

`public static function clearXP(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::clearXP(new Player());
```


---

#### fullPlayerReset

`public static function fullPlayerReset(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
InventoryUtil::fullPlayerReset(new SwimPlayer());
```


---

#### getItemCount

`public static function getItemCount(Player $player, Item $item): int`


**Parameters**:

- `$player` (Player) — 
- `$item` (Item) — 

**Returns**: int


**Example**:

```php
InventoryUtil::getItemCount(new Player(), new Item());
```


---

#### diamondArmor

`public static function diamondArmor(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::diamondArmor(new Player());
```


---

#### diamondSword

`public static function diamondSword(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::diamondSword(new Player());
```


---

#### potKit

`public static function potKit(SwimPlayer $swimPlayer, bool $giveSpeed = true): void`


**Parameters**:

- `$swimPlayer` (SwimPlayer) — 
- `$giveSpeed` (bool) — 

**Returns**: void


**Example**:

```php
InventoryUtil::potKit(new SwimPlayer(), true);
```


---

#### refill

`public static function refill(Player $player, Item $item, int $amount): void`


**Parameters**:

- `$player` (Player) — 
- `$item` (Item) — 
- `$amount` (int) — 

**Returns**: void


**Example**:

```php
InventoryUtil::refill(new Player(), new Item(), 123);
```


---

#### forceItemPop

`public static function forceItemPop(Player $player, Item $item): void`


**Parameters**:

- `$player` (Player) — 
- `$item` (Item) — 

**Returns**: void


**Example**:

```php
InventoryUtil::forceItemPop(new Player(), new Item());
```


---

#### boxingKit

`public static function boxingKit(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::boxingKit(new Player());
```


---

#### midfKit

`public static function midfKit(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::midfKit(new Player());
```


---

#### midfPearlKit

`public static function midfPearlKit(SwimPlayer $player): void`


**Parameters**:

- `$player` (SwimPlayer) — 

**Returns**: void


**Example**:

```php
InventoryUtil::midfPearlKit(new SwimPlayer());
```


---

#### bbMidfKit

`public static function bbMidfKit(Player $player): void`


**Parameters**:

- `$player` (Player) — 

**Returns**: void


**Example**:

```php
InventoryUtil::bbMidfKit(new Player());
```


---

#### getSlotItemIsIn

`public static function getSlotItemIsIn(SwimPlayer $player, Item $item): int`


**Parameters**:

- `$player` (SwimPlayer) — 
- `$item` (Item) — 

**Returns**: int


**Example**:

```php
InventoryUtil::getSlotItemIsIn(new SwimPlayer(), new Item());
```


---

#### safeSetItem

`public static function safeSetItem(Inventory $inv, int $slot, Item $item): void`


**Parameters**:

- `$inv` (Inventory) — 
- `$slot` (int) — 
- `$item` (Item) — 

**Returns**: void


**Example**:

```php
InventoryUtil::safeSetItem(new Inventory(), 123, new Item());
```


---

#### hasAmount

`public static function hasAmount(Inventory $inventory, int $amount, Item $item): bool`


**Parameters**:

- `$inventory` (Inventory) — 
- `$amount` (int) — 
- `$item` (Item) — 

**Returns**: bool


**Example**:

```php
InventoryUtil::hasAmount(new Inventory(), 123, new Item());
```


---

#### takeItems

`public static function takeItems(Inventory $inventory, int $amount, Item $item): void`

> This method removes up to $amount of items matching $item's type from the given inventory.


**Parameters**:

- `$inventory` (Inventory) — The inventory to remove items from.
- `$amount` (int) — The total number of items to remove.
- `$item` (Item) — An item instance whose type will be matched during removal.

**Returns**: void


**Example**:

```php
InventoryUtil::takeItems(new Inventory(), 123, new Item());
```


---

#### getFirstOpenSlot

`public static function getFirstOpenSlot(Inventory $inventory): int`


**Parameters**:

- `$inventory` (Inventory) — 

**Returns**: int


**Example**:

```php
InventoryUtil::getFirstOpenSlot(new Inventory());
```


---

## Class: core\utils\MathUtils

**Defined in**: `src\core\utils\MathUtils.php`


### Methods

#### interpolate

`public static function interpolate(float $float1, float $float2, float $percentage): float`


**Parameters**:

- `$float1` (float) — 
- `$float2` (float) — 
- `$percentage` (float) — 

**Returns**: float


**Example**:

```php
MathUtils::interpolate(1.23, 1.23, 1.23);
```


---

## Class: core\utils\PacketsHelper

**Defined in**: `src\core\utils\PacketsHelper.php`


### Methods

#### broadCastPacketsToPlayers

`public static function broadCastPacketsToPlayers(array $players, array $packets): void`


**Parameters**:

- `$players` (array) — 
- `$packets` (array) — 

**Returns**: void


**Example**:

```php
PacketsHelper::broadCastPacketsToPlayers([], []);
```


---

#### broadCastPackets

`public static function broadCastPackets(Player $player, array $packets): void`


**Parameters**:

- `$player` (Player) — 
- `$packets` (array) — 

**Returns**: void


**Example**:

```php
PacketsHelper::broadCastPackets(new Player(), []);
```


---

#### dataEventDidClickCustomEntity

`public static function dataEventDidClickCustomEntity(DataPacketReceiveEvent $event, CustomEntity $customEntity): bool`


**Parameters**:

- `$event` (DataPacketReceiveEvent) — 
- `$customEntity` (CustomEntity) — 

**Returns**: bool


**Example**:

```php
PacketsHelper::dataEventDidClickCustomEntity(new DataPacketReceiveEvent(), new CustomEntity());
```


---

## Class: core\utils\PlayerInfoHelper

**Defined in**: `src\core\utils\PlayerInfoHelper.php`


### Methods

#### getOS

`public static function getOS(Player $player): string`


**Parameters**:

- `$player` (Player) — 

**Returns**: string


**Example**:

```php
PlayerInfoHelper::getOS(new Player());
```


---

#### getOSString

`private static function getOSString(int $os): string`


**Parameters**:

- `$os` (int) — 

**Returns**: string


**Example**:

```php
PlayerInfoHelper::getOSString(123);
```


---

## Class: core\utils\PositionHelper

**Defined in**: `src\core\utils\PositionHelper.php`


### Methods

#### getPitchTowardsPosition

`public static function getPitchTowardsPosition(Vector3 $source, Vector3 $target): float`


**Parameters**:

- `$source` (Vector3) — 
- `$target` (Vector3) — 

**Returns**: float


**Example**:

```php
PositionHelper::getPitchTowardsPosition(new Vector3(), new Vector3());
```


---

#### getYawTowardsPosition

`public static function getYawTowardsPosition(Vector3 $source, Vector3 $target): float`


**Parameters**:

- `$source` (Vector3) — 
- `$target` (Vector3) — 

**Returns**: float


**Example**:

```php
PositionHelper::getYawTowardsPosition(new Vector3(), new Vector3());
```


---

#### centerPosition

`public static function centerPosition(Position $position): Position`


**Parameters**:

- `$position` (Position) — 

**Returns**: Position


**Example**:

```php
PositionHelper::centerPosition(new Position());
```


---

#### centerVector

`public static function centerVector(Vector3 $vector3): Vector3`


**Parameters**:

- `$vector3` (Vector3) — 

**Returns**: Vector3


**Example**:

```php
PositionHelper::centerVector(new Vector3());
```


---

#### toString

`public static function toString(Vector3|Position $vector3): string`


**Parameters**:

- `$vector3` (Vector3|Position) — 

**Returns**: string


**Example**:

```php
PositionHelper::toString(new Vector3());
```


---

#### isZeroVector

`public static function isZeroVector(Vector3 $vector3): bool`


**Parameters**:

- `$vector3` (Vector3) — 

**Returns**: bool


**Example**:

```php
PositionHelper::isZeroVector(new Vector3());
```


---

#### positionToLocation

`public static function positionToLocation(Position $position, float $yaw = 0, float $pitch = 0): Location`


**Parameters**:

- `$position` (Position) — 
- `$yaw` (float) — 
- `$pitch` (float) — 

**Returns**: Location


**Example**:

```php
PositionHelper::positionToLocation(new Position(), 0, 0);
```


---

#### getVectorHashKey

`public static function getVectorHashKey(Vector3|Position $vector3): int`

> Generates a hashed integer key from 3D coordinates for fast lookup.


**Parameters**:

- `$vector3` (Vector3|Position) — 

**Returns**: int


**Example**:

```php
PositionHelper::getVectorHashKey(new Vector3());
```


---

#### moveCloserTo

`public static function moveCloserTo(Position $positionToMove, Position $positionToMoveTowards, float $amount): Position`


**Parameters**:

- `$positionToMove` (Position) — 
- `$positionToMoveTowards` (Position) — 
- `$amount` (float) — 

**Returns**: Position


**Example**:

```php
PositionHelper::moveCloserTo(new Position(), new Position(), 1.23);
```


---

#### vecToPos

`public static function vecToPos(Vector3 $vector3, World $world): Position`


**Parameters**:

- `$vector3` (Vector3) — 
- `$world` (World) — 

**Returns**: Position


**Example**:

```php
PositionHelper::vecToPos(new Vector3(), new World());
```


---

#### sameXZ

`public static function sameXZ(Vector3 $vector3, Vector3 $otherVector3): bool`


**Parameters**:

- `$vector3` (Vector3) — 
- `$otherVector3` (Vector3) — 

**Returns**: bool


**Example**:

```php
PositionHelper::sameXZ(new Vector3(), new Vector3());
```


---

#### getChunkX

`public static function getChunkX(Position $position): int|float`


**Parameters**:

- `$position` (Position) — 

**Returns**: int|float


**Example**:

```php
PositionHelper::getChunkX(new Position());
```


---

#### getChunkZ

`public static function getChunkZ(Position $position): int|float`


**Parameters**:

- `$position` (Position) — 

**Returns**: int|float


**Example**:

```php
PositionHelper::getChunkZ(new Position());
```


---

#### distanceSquared2D

`public static function distanceSquared2D(float $x1, float $y1, float $x2, float $y2): float`


**Parameters**:

- `$x1` (float) — 
- `$y1` (float) — 
- `$x2` (float) — 
- `$y2` (float) — 

**Returns**: float


**Example**:

```php
PositionHelper::distanceSquared2D(1.23, 1.23, 1.23, 1.23);
```


---

#### midPoint

`public static function midPoint(Position $position1, Position $position2): Position`


**Parameters**:

- `$position1` (Position) — 
- `$position2` (Position) — 

**Returns**: Position


**Example**:

```php
PositionHelper::midPoint(new Position(), new Position());
```


---

#### getPitchTowards

`public static function getPitchTowards(Vector3 $from, Vector3 $target, float $offsetHeight = 0): float`


**Parameters**:

- `$from` (Vector3) — 
- `$target` (Vector3) — 
- `$offsetHeight` (float) — is usually eye height

**Returns**: float


**Example**:

```php
PositionHelper::getPitchTowards(new Vector3(), new Vector3(), 0);
```


---

#### getYawTowards

`public static function getYawTowards(Vector3 $from, Vector3 $target): float`


**Parameters**:

- `$from` (Vector3) — 
- `$target` (Vector3) — 

**Returns**: float


**Example**:

```php
PositionHelper::getYawTowards(new Vector3(), new Vector3());
```


---

#### calculateAveragePosition

`public static function calculateAveragePosition(array $players): Vector3`

> @brief Calculates the average position of a group of players.


**Parameters**:

- `$players` (array) — 

**Returns**: Vector3


**Example**:

```php
PositionHelper::calculateAveragePosition([]);
```


---

#### getNearestPlayer

`public static function getNearestPlayer(Position $position): ?SwimPlayer`

> @brief uses the positions world for iterating all the possible players, null is returned if there are no players in the world


**Parameters**:

- `$position` (Position) — 

**Returns**: ?SwimPlayer


**Example**:

```php
PositionHelper::getNearestPlayer(new Position());
```


---

#### offSetRandomlyBy

`public static function offSetRandomlyBy(Position $position, int $n, int $n2, bool $anyDirection = true): Position`

> @var SwimPlayer[] $players */


**Parameters**:

- `$position` (Position) — - The original position to be offset.
- `$n` (int) — - The minimum offset value.
- `$n2` (int) — - The maximum offset value.
- `$anyDirection` (bool) — - If true, offset can be positive or negative. If false, only positive.

**Returns**: Position


**Example**:

```php
PositionHelper::offSetRandomlyBy(new Position(), 123, 123, true);
```


---

## Class: core\utils\ProtocolIdToVersion

**Defined in**: `src\core\utils\ProtocolIdToVersion.php`


### Methods

#### init

`public static function init(): void`


**Returns**: void


**Example**:

```php
ProtocolIdToVersion::init();
```


---

#### getVersionFromProtocolId

`public static function getVersionFromProtocolId(int $protocolId): string`


**Parameters**:

- `$protocolId` (int) — 

**Returns**: string


**Example**:

```php
ProtocolIdToVersion::getVersionFromProtocolId(123);
```


---

#### getMap

`public static function getMap(): array`


**Returns**: array


**Example**:

```php
ProtocolIdToVersion::getMap();
```


---

## Class: core\utils\ServerSounds

**Defined in**: `src\core\utils\ServerSounds.php`


### Methods

#### playSoundToPlayer

`public static function playSoundToPlayer(Player $player, string $soundName, float $volume = 0, float $pitch = 0): void`


**Parameters**:

- `$player` (Player) — 
- `$soundName` (string) — 
- `$volume` (float) — 
- `$pitch` (float) — 

**Returns**: void


**Example**:

```php
ServerSounds::playSoundToPlayer(new Player(), "example", 0, 0);
```


---

#### playSoundToWholeWorld

`public static function playSoundToWholeWorld(World $world, string $soundName, float $volume = 0, float $pitch = 0): void`


**Parameters**:

- `$world` (World) — 
- `$soundName` (string) — 
- `$volume` (float) — 
- `$pitch` (float) — 

**Returns**: void


**Example**:

```php
ServerSounds::playSoundToWholeWorld(new World(), "example", 0, 0);
```


---

#### playSoundToEveryone

`public static function playSoundToEveryone(string $soundName, float $volume = 0, float $pitch = 0): void`


**Parameters**:

- `$soundName` (string) — 
- `$volume` (float) — 
- `$pitch` (float) — 

**Returns**: void


**Example**:

```php
ServerSounds::playSoundToEveryone("example", 0, 0);
```


---

#### playCustomSoundEffectInWorld

`public static function playCustomSoundEffectInWorld(string $sound, World $world, Position $position, $volume = 3, $pitch = 1, int $radius = 40): void`


**Parameters**:

- `$sound` (string) — 
- `$world` (World) — 
- `$position` (Position) — 
- `$volume` (mixed) — 
- `$pitch` (mixed) — 
- `$radius` (int) — 

**Returns**: void


**Example**:

```php
ServerSounds::playCustomSoundEffectInWorld("example", new World(), new Position(), 3, 1, 40);
```


---

## Class: core\utils\SkinHelper

**Defined in**: `src\core\utils\SkinHelper.php`


### Methods

#### getSkinDataFromPNG

`public static function getSkinDataFromPNG(string $path): string`


**Parameters**:

- `$path` (string) — 

**Returns**: string


**Example**:

```php
SkinHelper::getSkinDataFromPNG("example");
```


---

#### getHeadData

`public static function getHeadData(string $rawSkinData): ImageData`


**Parameters**:

- `$rawSkinData` (string) — 

**Returns**: ImageData


**Example**:

```php
SkinHelper::getHeadData("example");
```


---

#### combineRows

`private static function combineRows(string $headRow, string $hoodRow, int $headWidth): string`


**Parameters**:

- `$headRow` (string) — 
- `$hoodRow` (string) — 
- `$headWidth` (int) — 

**Returns**: string


**Example**:

```php
SkinHelper::combineRows("example", "example", 123);
```


---

#### emplaceDataOnNewCanvas

`public static function emplaceDataOnNewCanvas(string $rawImageData, int $imageWidth, int $imageHeight, int $canvasWidth, int $canvasHeight): ImageData`


**Parameters**:

- `$rawImageData` (string) — 
- `$imageWidth` (int) — 
- `$imageHeight` (int) — 
- `$canvasWidth` (int) — 
- `$canvasHeight` (int) — 

**Returns**: ImageData


**Example**:

```php
SkinHelper::emplaceDataOnNewCanvas("example", 123, 123, 123, 123);
```


---

#### saveAsPNG

`public static function saveAsPNG(string $rawImageData, string $outputPath, int $width, int $height): void`


**Parameters**:

- `$rawImageData` (string) — 
- `$outputPath` (string) — 
- `$width` (int) — 
- `$height` (int) — 

**Returns**: void


**Example**:

```php
SkinHelper::saveAsPNG("example", "example", 123, 123);
```


---

## Class: core\utils\ImageData

**Defined in**: `src\core\utils\SkinHelper.php`


### Methods

#### __construct

`public function __construct(string $bytes, int $width, int $height)`


**Parameters**:

- `$bytes` (string) — 
- `$width` (int) — 
- `$height` (int) — 

**Example**:

```php
$imageData = new ImageData("example", 123, 123);
```


---

## Class: core\utils\SkinInfo

**Defined in**: `src\core\utils\SkinInfo.php`


### Methods

_No methods found_

## Class: core\utils\StackTracer

**Defined in**: `src\core\utils\StackTracer.php`


### Methods

#### PrintStackTrace

`public static function PrintStackTrace($limit = 10, $includeSelf = false): void`


**Parameters**:

- `$limit` (mixed) — 
- `$includeSelf` (mixed) — 

**Returns**: void


**Example**:

```php
StackTracer::PrintStackTrace(10, false);
```


---

#### formatArgs

`private static function formatArgs($args): string`


**Parameters**:

- `$args` (mixed) — 

**Returns**: string


**Example**:

```php
StackTracer::formatArgs(null);
```


---

## Class: core\utils\SteveSkin

**Defined in**: `src\core\utils\SteveSkin.php`


### Methods

#### getInstance

`public static function getInstance(): SteveSkin`


**Returns**: SteveSkin


**Example**:

```php
SteveSkin::getInstance();
```


---

#### __construct

`public function __construct()`

> @throws JsonException


**Example**:

```php
$steveSkin = new SteveSkin();
```


---

#### getSkin

`public function getSkin(): Skin`


**Returns**: Skin


**Example**:

```php
$steveSkin = new SteveSkin();
$steveSkin->getSkin();
```


---

## Class: core\utils\SwimCoreInstance

**Defined in**: `src\core\utils\SwimCoreInstance.php`


### Methods

#### setInstance

`public static function setInstance(SwimCore $core): void`


**Parameters**:

- `$core` (SwimCore) — 

**Returns**: void


**Example**:

```php
SwimCoreInstance::setInstance(new SwimCore());
```


---

#### getInstance

`public static function getInstance(): SwimCore`


**Returns**: SwimCore


**Example**:

```php
SwimCoreInstance::getInstance();
```


---

## Class: core\utils\TargetArgument

**Defined in**: `src\core\utils\TargetArgument.php`


### Methods

#### __construct

`public function __construct(string $name, bool $optional = false, int $length = 1)`


**Parameters**:

- `$name` (string) — 
- `$optional` (bool) — 
- `$length` (int) — 

**Example**:

```php
$targetArgument = new TargetArgument("example", false, 1);
```


---

#### getNetworkType

`public function getNetworkType(): int`


**Returns**: int


**Example**:

```php
$targetArgument = new TargetArgument("example", false, 1);
$targetArgument->getNetworkType();
```


---

#### getTypeName

`public function getTypeName(): string`


**Returns**: string


**Example**:

```php
$targetArgument = new TargetArgument("example", false, 1);
$targetArgument->getTypeName();
```


---

#### canParse

`public function canParse(string $testString, CommandSender $sender): bool`


**Parameters**:

- `$testString` (string) — 
- `$sender` (CommandSender) — 

**Returns**: bool


**Example**:

```php
$targetArgument = new TargetArgument("example", false, 1);
$targetArgument->canParse("example", new CommandSender());
```


---

#### getSpanLength

`public function getSpanLength(): int`


**Returns**: int


**Example**:

```php
$targetArgument = new TargetArgument("example", false, 1);
$targetArgument->getSpanLength();
```


---

#### parse

`public function parse(string $argument, CommandSender $sender): string`


**Parameters**:

- `$argument` (string) — 
- `$sender` (CommandSender) — 

**Returns**: string


**Example**:

```php
$targetArgument = new TargetArgument("example", false, 1);
$targetArgument->parse("example", new CommandSender());
```


---

## Class: core\utils\TaskUtils

**Defined in**: `src\core\utils\TaskUtils.php`


### Methods

#### delayed

`public static function delayed(SwimCore $swimCore, int $delay, callable $cb): void`


**Parameters**:

- `$swimCore` (SwimCore) — 
- `$delay` (int) — 
- `$cb` (callable) — 

**Returns**: void


**Example**:

```php
TaskUtils::delayed(new SwimCore(), 123, function() {});
```


---

#### __construct

`public function __construct(private $cb)`


**Parameters**:

- `$cb` (private) — 

**Example**:

```php
$taskUtils = new TaskUtils(new private());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$taskUtils = new TaskUtils(new private());
$taskUtils->onRun();
```


---

#### repeating

`public static function repeating(SwimCore $swimCore, int $interval, callable $cb): void`


**Parameters**:

- `$swimCore` (SwimCore) — 
- `$interval` (int) — 
- `$cb` (callable) — 

**Returns**: void


**Example**:

```php
TaskUtils::repeating(new SwimCore(), 123, function() {});
```


---

#### __construct

`public function __construct(private $cb)`


**Parameters**:

- `$cb` (private) — 

**Example**:

```php
$taskUtils = new TaskUtils(new private());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$taskUtils = new TaskUtils(new private());
$taskUtils->onRun();
```


---

## Class: core\utils\TimeHelper

**Defined in**: `src\core\utils\TimeHelper.php`


### Methods

#### secondsToTicks

`public static function secondsToTicks(int|float $seconds): int|float`


**Parameters**:

- `$seconds` (int|float) — 

**Returns**: int|float


**Example**:

```php
TimeHelper::secondsToTicks(123);
```


---

#### minutesToTicks

`public static function minutesToTicks(int|float $minutes): int|float`


**Parameters**:

- `$minutes` (int|float) — 

**Returns**: int|float


**Example**:

```php
TimeHelper::minutesToTicks(123);
```


---

#### ticksToSeconds

`public static function ticksToSeconds(int|float $ticks): int|float`


**Parameters**:

- `$ticks` (int|float) — 

**Returns**: int|float


**Example**:

```php
TimeHelper::ticksToSeconds(123);
```


---

#### formatTime

`public static function formatTime(int $seconds): string`


**Parameters**:

- `$seconds` (int) — 

**Returns**: string


**Example**:

```php
TimeHelper::formatTime(123);
```


---

#### digitalClockFormatter

`public static function digitalClockFormatter(int $seconds, bool $includeHours = false, bool $inFrontZeroForMinutes = false): string`


**Parameters**:

- `$seconds` (int) — 
- `$includeHours` (bool) — 
- `$inFrontZeroForMinutes` (bool) — 

**Returns**: string


**Example**:

```php
TimeHelper::digitalClockFormatter(123, false, false);
```


---

#### parseTime

`public static function parseTime(string|null $timeOption): int|null`


**Parameters**:

- `$timeOption` (string|null) — 

**Returns**: int|null


**Example**:

```php
TimeHelper::parseTime("example");
```


---

#### getTimeIndex

`public static function getTimeIndex(int $raw): int`


**Parameters**:

- `$raw` (int) — 

**Returns**: int


**Example**:

```php
TimeHelper::getTimeIndex(123);
```


---

#### timeIndexToRaw

`public static function timeIndexToRaw(int $index): int`


**Parameters**:

- `$index` (int) — 

**Returns**: int


**Example**:

```php
TimeHelper::timeIndexToRaw(123);
```


---

#### timeIntToString

`public static function timeIntToString(int $rawTime): string`


**Parameters**:

- `$rawTime` (int) — 

**Returns**: string


**Example**:

```php
TimeHelper::timeIntToString(123);
```


---

#### minutesToSeconds

`public static function minutesToSeconds(int $minutes): int`


**Parameters**:

- `$minutes` (int) — 

**Returns**: int


**Example**:

```php
TimeHelper::minutesToSeconds(123);
```


---

#### secondsToMinutes

`public static function secondsToMinutes(int $seconds): float`


**Parameters**:

- `$seconds` (int) — 

**Returns**: float


**Example**:

```php
TimeHelper::secondsToMinutes(123);
```


---

## Class: core\utils\VoidGenerator

**Defined in**: `src\core\utils\VoidGenerator.php`


### Methods

#### __construct

`public function __construct(int $seed, string $preset)`


**Parameters**:

- `$seed` (int) — 
- `$preset` (string) — 

**Example**:

```php
$voidGenerator = new VoidGenerator(123, "example");
```


---

#### generateChunk

`public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void`


**Parameters**:

- `$world` (ChunkManager) — 
- `$chunkX` (int) — 
- `$chunkZ` (int) — 

**Returns**: void


**Example**:

```php
$voidGenerator = new VoidGenerator(123, "example");
$voidGenerator->generateChunk(new ChunkManager(), 123, 123);
```


---

#### populateChunk

`public function populateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void`


**Parameters**:

- `$world` (ChunkManager) — 
- `$chunkX` (int) — 
- `$chunkZ` (int) — 

**Returns**: void


**Example**:

```php
$voidGenerator = new VoidGenerator(123, "example");
$voidGenerator->populateChunk(new ChunkManager(), 123, 123);
```


---

## Class: core\utils\is

**Defined in**: `src\core\utils\Words.php`


### Methods

_No methods found_

## Class: core\utils\WorldCollisionAccessorCacheHack

**Defined in**: `src\core\utils\WorldCollisionAccessorCacheHack.php`


### Methods

#### get

`public static function get(World $world): mixed`

> @var ReflectionProperty|null */


**Parameters**:

- `$world` (World) — 

**Returns**: mixed


**Example**:

```php
WorldCollisionAccessorCacheHack::get(new World());
```


---

## Class: core\utils\WorldCollisionBoxHelper

**Defined in**: `src\core\utils\WorldCollisionBoxHelper.php`


### Methods

#### getCollisionBlocksIncludingSoft

`public static function getCollisionBlocksIncludingSoft(AxisAlignedBB $bb, World $world, bool $targetFirst = false): array`

> @throws ReflectionException


**Parameters**:

- `$bb` (AxisAlignedBB) — 
- `$world` (World) — 
- `$targetFirst` (bool) — 

**Returns**: array


**Example**:

```php
WorldCollisionBoxHelper::getCollisionBlocksIncludingSoft(new AxisAlignedBB(), new World(), false);
```


---

#### hitCheck

`private static function hitCheck(int $x, int $y, int $z, mixed $collisionInfo, World $world, AxisAlignedBB $bb): bool`


**Parameters**:

- `$x` (int) — 
- `$y` (int) — 
- `$z` (int) — 
- `$collisionInfo` (mixed) — 
- `$world` (World) — 
- `$bb` (AxisAlignedBB) — 

**Returns**: bool


**Example**:

```php
WorldCollisionBoxHelper::hitCheck(123, 123, 123, new mixed(), new World(), new AxisAlignedBB());
```


---

#### checkCubeCollision

`private static function checkCubeCollision(int $x, int $y, int $z, AxisAlignedBB $bb, float $epsilon = 0.0001): bool`


**Parameters**:

- `$x` (int) — 
- `$y` (int) — 
- `$z` (int) — 
- `$bb` (AxisAlignedBB) — 
- `$epsilon` (float) — 

**Returns**: bool


**Example**:

```php
WorldCollisionBoxHelper::checkCubeCollision(123, 123, 123, new AxisAlignedBB(), 0.0001);
```


---

#### isSoft

`public static function isSoft(int $id): bool`


**Parameters**:

- `$id` (int) — 

**Returns**: bool


**Example**:

```php
WorldCollisionBoxHelper::isSoft(123);
```


---

#### checkSoftCollision

`private static function checkSoftCollision(int $x, int $y, int $z, AxisAlignedBB $bb, World $world): bool`

> Treat soft blocks as collidable for detection purposes (cobwebs/liquids/vines/ladders/etc).


**Parameters**:

- `$x` (int) — 
- `$y` (int) — 
- `$z` (int) — 
- `$bb` (AxisAlignedBB) — 
- `$world` (World) — 

**Returns**: bool


**Example**:

```php
WorldCollisionBoxHelper::checkSoftCollision(123, 123, 123, new AxisAlignedBB(), new World());
```


---

#### getBlockCollisionInfo

`private static function getBlockCollisionInfo(int $x, int $y, int $z, array $collisionInfo, World $world): int`

> @phpstan-param array<int, int> $collisionInfo


**Parameters**:

- `$x` (int) — 
- `$y` (int) — 
- `$z` (int) — 
- `$collisionInfo` (array) — 
- `$world` (World) — 

**Returns**: int


**Example**:

```php
WorldCollisionBoxHelper::getBlockCollisionInfo(123, 123, 123, [], new World());
```


---

## Class: core\utils\acktypes\EntityPositionAck

**Defined in**: `src\core\utils\acktypes\EntityPositionAck.php`


### Methods

#### __construct

`public function __construct(public Vector3 $pos, public int $actorRuntimeId, public bool $tp)`


**Parameters**:

- `public Vector3 $pos` (mixed) — 
- `public int $actorRuntimeId` (mixed) — 
- `public bool $tp` (mixed) — 

**Example**:

```php
$entityPositionAck = new EntityPositionAck(null, null, null);
```


---

## Class: core\utils\acktypes\EntityRemovalAck

**Defined in**: `src\core\utils\acktypes\EntityRemovalAck.php`


### Methods

#### __construct

`public function __construct(public int $actorRuntimeId)`


**Parameters**:

- `public int $actorRuntimeId` (mixed) — 

**Example**:

```php
$entityRemovalAck = new EntityRemovalAck(null);
```


---

## Class: core\utils\acktypes\GamemodeChangeAck

**Defined in**: `src\core\utils\acktypes\GamemodeChangeAck.php`


### Methods

#### __construct

`public function __construct(public GameMode $newGamemode)`


**Parameters**:

- `public GameMode $newGamemode` (mixed) — 

**Example**:

```php
$gamemodeChangeAck = new GamemodeChangeAck(null);
```


---

## Class: core\utils\acktypes\KnockbackAck

**Defined in**: `src\core\utils\acktypes\KnockbackAck.php`


### Methods

#### __construct

`public function __construct(public Vector3 $motion)`


**Parameters**:

- `public Vector3 $motion` (mixed) — 

**Example**:

```php
$knockbackAck = new KnockbackAck(null);
```


---

## Class: core\utils\acktypes\MultiAckWithTimestamp

**Defined in**: `src\core\utils\acktypes\MultiAckWithTimestamp.php`


### Methods

#### __construct

`public function __construct(public array $acks, bool $noTimestamp = false)`


**Parameters**:

- `public array $acks` (mixed) — 
- `$noTimestamp` (bool) — 

**Example**:

```php
$multiAckWithTimestamp = new MultiAckWithTimestamp(null, false);
```


---

## Class: core\utils\acktypes\NoAiAck

**Defined in**: `src\core\utils\acktypes\NoAiAck.php`


### Methods

#### __construct

`public function __construct(public bool $noAi)`


**Parameters**:

- `public bool $noAi` (mixed) — 

**Example**:

```php
$noAiAck = new NoAiAck(null);
```


---

## Class: core\utils\acktypes\NslAck

**Defined in**: `src\core\utils\acktypes\NslAck.php`


### Methods

_No methods found_

## Class: core\utils\config\CommunicatorConfig

**Defined in**: `src\core\utils\config\CommunicatorConfig.php`


### Methods

_No methods found_

## Class: core\utils\config\ConfigMapper

**Defined in**: `src\core\utils\config\ConfigMapper.php`


### Methods

#### __construct

`public function __construct(PluginBase|Config $pluginOrConf, private readonly object $object, private readonly bool $deleteUnused = true)`


**Parameters**:

- `$pluginOrConf` (PluginBase|Config) — 
- `private readonly object $object` (mixed) — 
- `private readonly bool $deleteUnused = true` (mixed) — 

**Example**:

```php
$configMapper = new ConfigMapper(new PluginBase(), null, null);
```


---

#### load

`public function load(): void`


**Returns**: void


**Example**:

```php
$configMapper = new ConfigMapper(new PluginBase(), null, null);
$configMapper->load();
```


---

#### save

`public function save(): void`

> @throws JsonException


**Returns**: void


**Example**:

```php
$configMapper = new ConfigMapper(new PluginBase(), null, null);
$configMapper->save();
```


---

#### loadClass

`private static function loadClass(object $obj, array $in): void`


**Parameters**:

- `$obj` (object) — 
- `$in` (array) — 

**Returns**: void


**Example**:

```php
ConfigMapper::loadClass(new object(), []);
```


---

#### saveClass

`private static function saveClass(object $obj, array $out = []): array`


**Parameters**:

- `$obj` (object) — 
- `$out` (array) — 

**Returns**: array


**Example**:

```php
ConfigMapper::saveClass(new object(), []);
```


---

#### loopProperties

`private static function loopProperties(ReflectionClass $reflectionClass, callable $cb): void`


**Parameters**:

- `$reflectionClass` (ReflectionClass) — 
- `$cb` (callable) — 

**Returns**: void


**Example**:

```php
ConfigMapper::loopProperties(new ReflectionClass(), function() {});
```


---

## Class: core\utils\config\DatabaseConfig

**Defined in**: `src\core\utils\config\DatabaseConfig.php`


### Methods

_No methods found_

## Class: core\utils\config\RegionInfo

**Defined in**: `src\core\utils\config\RegionInfo.php`


### Methods

#### isHub

`public function isHub(): bool`


**Returns**: bool


**Example**:

```php
$regionInfo = new RegionInfo();
$regionInfo->isHub();
```


---

## Class: core\utils\config\SwimConfig

**Defined in**: `src\core\utils\config\SwimConfig.php`


### Methods

_No methods found_

## Class: core\utils\cordhook\CordHook

**Defined in**: `src\core\utils\cordhook\CordHook.php`


### Methods

#### sendEmbed

`public static function sendEmbed(string $description, string $title, string $footer = "Made by Swim Services", int $color = 0x0000ff): void`


**Parameters**:

- `$description` (string) — 
- `$title` (string) — 
- `$footer` (string) — 
- `$color` (int) — 

**Returns**: void


**Example**:

```php
CordHook::sendEmbed("example", "example", "Made by Swim Services", 0x0000ff);
```


---

## Class: core\utils\libpmquery\PMQuery

**Defined in**: `src\core\utils\libpmquery\PMQuery.php`


### Methods

#### query

`public static function query(string $host, int $port, int $timeout = 4): array`

> 	 * @param int    $port    Port on the ip being queried


**Parameters**:

- `$host` (string) — Ip/dns address being queried
- `$port` (int) — 
- `$timeout` (int) — 

**Returns**: array


**Example**:

```php
PMQuery::query("example", 123, 4);
```


---

## Class: core\utils\libpmquery\PmQueryException

**Defined in**: `src\core\utils\libpmquery\PmQueryException.php`


### Methods

_No methods found_

## Class: core\utils\loaders\CommandLoader

**Defined in**: `src\core\utils\loaders\CommandLoader.php`


### Methods

#### __construct

`public function __construct(SwimCore $core)`


**Parameters**:

- `$core` (SwimCore) — 

**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
```


---

#### setUpCommands

`public function setUpCommands(bool $disableVanilla = true): void`

> @throws HookAlreadyRegistered


**Parameters**:

- `$disableVanilla` (bool) — 

**Returns**: void


**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
$commandLoader->setUpCommands(true);
```


---

#### loadCommands

`public function loadCommands(): void`


**Returns**: void


**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
$commandLoader->loadCommands();
```


---

#### registerCommandScriptsRecursively

`private function registerCommandScriptsRecursively(string $directory): void`


**Parameters**:

- `$directory` (string) — 

**Returns**: void


**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
$commandLoader->registerCommandScriptsRecursively("example");
```


---

#### unloadVanillaCommands

`private function unloadVanillaCommands(): void`


**Returns**: void


**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
$commandLoader->unloadVanillaCommands();
```


---

#### registerCommand

`private function registerCommand(Command $command): void`


**Parameters**:

- `$command` (Command) — 

**Returns**: void


**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
$commandLoader->registerCommand(new Command());
```


---

#### unregisterCommand

`private function unregisterCommand(string $commandName): void`


**Parameters**:

- `$commandName` (string) — 

**Returns**: void


**Example**:

```php
$commandLoader = new CommandLoader(new SwimCore());
$commandLoader->unregisterCommand("example");
```


---

## Class: core\utils\loaders\name

**Defined in**: `src\core\utils\loaders\CommandLoader.php`

* @throws HookAlreadyRegistered


### Methods

_No methods found_

## Class: core\utils\loaders\failed

**Defined in**: `src\core\utils\loaders\CommandLoader.php`

* @throws HookAlreadyRegistered


### Methods

_No methods found_

## Class: core\utils\loaders\CustomItemLoader

**Defined in**: `src\core\utils\loaders\CustomItemLoader.php`


### Methods

#### registerCustoms

`public static function registerCustoms(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
CustomItemLoader::registerCustoms();
```


---

#### replaceVanillaItems

`private static function replaceVanillaItems(string $methodName, Item $item): void`


**Parameters**:

- `$methodName` (string) — 
- `$item` (Item) — 

**Returns**: void


**Example**:

```php
CustomItemLoader::replaceVanillaItems("example", new Item());
```


---

#### registerSimpleItem

`private static function registerSimpleItem(string $id, Item $item, array $stringToItemParserNames): void`


**Parameters**:

- `$id` (string) — 
- `$item` (Item) — 
- `$stringToItemParserNames` (array) — 

**Returns**: void


**Example**:

```php
CustomItemLoader::registerSimpleItem("example", new Item(), []);
```


---

#### registerItemWithMeta

`private static function registerItemWithMeta(string $id, Item $item, array $stringToItemParserNames, Closure $deserializeMeta, Closure $serializeMeta): void`

> @phpstan-template TItem of Item


**Parameters**:

- `$id` (string) — 
- `$item` (Item) — 
- `$stringToItemParserNames` (array) — 
- `$deserializeMeta` (Closure) — 
- `$serializeMeta` (Closure) — 

**Returns**: void


**Example**:

```php
CustomItemLoader::registerItemWithMeta("example", new Item(), [], new Closure(), new Closure());
```


---

#### unregisterItem

`private static function unregisterItem(string $id): void`

> @throws ReflectionException


**Parameters**:

- `$id` (string) — 

**Returns**: void


**Example**:

```php
CustomItemLoader::unregisterItem("example");
```


---

#### unregisterEducationItems

`private static function unregisterEducationItems(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
CustomItemLoader::unregisterEducationItems();
```


---

#### isEdu

`private static function isEdu(string $item): bool`


**Parameters**:

- `$item` (string) — 

**Returns**: bool


**Example**:

```php
CustomItemLoader::isEdu("example");
```


---

## Class: core\utils\loaders\WorldLoader

**Defined in**: `src\core\utils\loaders\WorldLoader.php`


### Methods

#### loadWorlds

`public static function loadWorlds(string $folder): void`

> @throws ReflectionException


**Parameters**:

- `$folder` (string) — 

**Returns**: void


**Example**:

```php
WorldLoader::loadWorlds("example");
```


---

#### getWorldPlayerCount

`public static function getWorldPlayerCount(string $worldName): int`


**Parameters**:

- `$worldName` (string) — 

**Returns**: int


**Example**:

```php
WorldLoader::getWorldPlayerCount("example");
```


---

## Class: core\utils\particles\ColorFlameParticle

**Defined in**: `src\core\utils\particles\ColorFlameParticle.php`


### Methods

#### __construct

`public function __construct(private int $color)`


**Parameters**:

- `private int $color` (mixed) — 

**Example**:

```php
$colorFlameParticle = new ColorFlameParticle(null);
```


---

#### rgb

`public static function rgb(int $red, int $green, int $blue): self`


**Parameters**:

- `$red` (int) — 
- `$green` (int) — 
- `$blue` (int) — 

**Returns**: self


**Example**:

```php
ColorFlameParticle::rgb(123, 123, 123);
```


---

#### encode

`public function encode(Vector3 $pos): array`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: array


**Example**:

```php
$colorFlameParticle = new ColorFlameParticle(null);
$colorFlameParticle->encode(new Vector3());
```


---

## Class: core\utils\particles\ParticleTrails

**Defined in**: `src\core\utils\particles\ParticleTrails.php`


### Methods

_No methods found_

## Class: core\utils\particles\SonicBoomParticle

**Defined in**: `src\core\utils\particles\SonicBoomParticle.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$sonicBoomParticle = new SonicBoomParticle();
```


---

#### encode

`public function encode(Vector3 $pos): array`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: array


**Example**:

```php
$sonicBoomParticle = new SonicBoomParticle();
$sonicBoomParticle->encode(new Vector3());
```


---

## Class: core\utils\particles\SparklerParticle

**Defined in**: `src\core\utils\particles\SparklerParticle.php`


### Methods

#### __construct

`public function __construct(private int $color)`


**Parameters**:

- `private int $color` (mixed) — 

**Example**:

```php
$sparklerParticle = new SparklerParticle(null);
```


---

#### rgb

`public static function rgb(int $red, int $green, int $blue): self`


**Parameters**:

- `$red` (int) — 
- `$green` (int) — 
- `$blue` (int) — 

**Returns**: self


**Example**:

```php
SparklerParticle::rgb(123, 123, 123);
```


---

#### encode

`public function encode(Vector3 $pos): array`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: array


**Example**:

```php
$sparklerParticle = new SparklerParticle(null);
$sparklerParticle->encode(new Vector3());
```


---

## Class: core\utils\particles\TotemParticle

**Defined in**: `src\core\utils\particles\TotemParticle.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$totemParticle = new TotemParticle();
```


---

#### encode

`public function encode(Vector3 $pos): array`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: array


**Example**:

```php
$totemParticle = new TotemParticle();
$totemParticle->encode(new Vector3());
```


---

## Class: core\utils\particles\WindExplosionParticle

**Defined in**: `src\core\utils\particles\WindExplosionParticle.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$windExplosionParticle = new WindExplosionParticle();
```


---

#### encode

`public function encode(Vector3 $pos): array`


**Parameters**:

- `$pos` (Vector3) — 

**Returns**: array


**Example**:

```php
$windExplosionParticle = new WindExplosionParticle();
$windExplosionParticle->encode(new Vector3());
```


---

## Class: core\utils\raklib\DdosEvent

**Defined in**: `src\core\utils\raklib\DdosEvent.php`


### Methods

#### __construct

`public function __construct(private readonly DdosEventType $type, private readonly RakLibInterface $interface)`


**Parameters**:

- `private readonly DdosEventType $type` (mixed) — 
- `private readonly RakLibInterface $interface` (mixed) — 

**Example**:

```php
$ddosEvent = new DdosEvent(null, null);
```


---

#### getType

`public function getType(): DdosEventType`


**Returns**: DdosEventType


**Example**:

```php
$ddosEvent = new DdosEvent(null, null);
$ddosEvent->getType();
```


---

#### getRakLibInterface

`public function getRakLibInterface(): RakLibInterface`


**Returns**: RakLibInterface


**Example**:

```php
$ddosEvent = new DdosEvent(null, null);
$ddosEvent->getRakLibInterface();
```


---

## Class: core\utils\raklib\KickMessageOverridePacket

**Defined in**: `src\core\utils\raklib\KickMessageOverridePacket.php`


### Methods

#### __construct

`public function __construct(private string $key, private string $msg)`


**Parameters**:

- `private string $key` (mixed) — 
- `private string $msg` (mixed) — 

**Example**:

```php
$kickMessageOverridePacket = new KickMessageOverridePacket("example", "example");
```


---

#### encode

`public function encode(ByteBufferWriter $writer): void`


**Parameters**:

- `$writer` (ByteBufferWriter) — 

**Returns**: void


**Example**:

```php
$kickMessageOverridePacket = new KickMessageOverridePacket("example", "example");
$kickMessageOverridePacket->encode(new ByteBufferWriter());
```


---

## Class: core\utils\raklib\LogKickPacket

**Defined in**: `src\core\utils\raklib\LogKickPacket.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$logKickPacket = new LogKickPacket();
```


---

#### decode

`public function decode(ByteBufferReader $reader): void`


**Parameters**:

- `$reader` (ByteBufferReader) — 

**Returns**: void


**Example**:

```php
$logKickPacket = new LogKickPacket();
$logKickPacket->decode(new ByteBufferReader());
```


---

#### sendLog

`public function sendLog(): void`


**Returns**: void


**Example**:

```php
$logKickPacket = new LogKickPacket();
$logKickPacket->sendLog();
```


---

## Class: core\utils\raklib\MTUOpenConnectionReply2

**Defined in**: `src\core\utils\raklib\MTUOpenConnectionReply2.php`


### Methods

#### create

`public static function create(int $serverId, InternetAddress $clientAddress, int $mtuSize, bool $serverSecurity, int $ipHeaderSize = 0): self`


**Parameters**:

- `$serverId` (int) — 
- `$clientAddress` (InternetAddress) — 
- `$mtuSize` (int) — 
- `$serverSecurity` (bool) — 
- `$ipHeaderSize` (int) — 

**Returns**: self


**Example**:

```php
MTUOpenConnectionReply2::create(123, new InternetAddress(), 123, true, 0);
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $out): void`


**Parameters**:

- `$out` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$mTUOpenConnectionReply2 = new MTUOpenConnectionReply2();
$mTUOpenConnectionReply2->encodePayload(new PacketSerializer());
```


---

## Class: core\utils\raklib\MultiProtocolAcceptor

**Defined in**: `src\core\utils\raklib\MultiProtocolAcceptor.php`


### Methods

#### __construct

`public function __construct(private int $primaryVersion, private array $protocolVersions)`


**Parameters**:

- `private int $primaryVersion` (mixed) — 
- `private array $protocolVersions` (mixed) — 

**Example**:

```php
$multiProtocolAcceptor = new MultiProtocolAcceptor(null, null);
```


---

#### accepts

`public function accepts(int $protocolVersion): bool`


**Parameters**:

- `$protocolVersion` (int) — 

**Returns**: bool


**Example**:

```php
$multiProtocolAcceptor = new MultiProtocolAcceptor(null, null);
$multiProtocolAcceptor->accepts(123);
```


---

#### getPrimaryVersion

`public function getPrimaryVersion(): int`


**Returns**: int


**Example**:

```php
$multiProtocolAcceptor = new MultiProtocolAcceptor(null, null);
$multiProtocolAcceptor->getPrimaryVersion();
```


---

## Class: core\utils\raklib\NetherNetIdPacket

**Defined in**: `src\core\utils\raklib\NetherNetIdPacket.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$netherNetIdPacket = new NetherNetIdPacket();
```


---

#### decode

`public function decode(ByteBufferReader $reader): void`


**Parameters**:

- `$reader` (ByteBufferReader) — 

**Returns**: void


**Example**:

```php
$netherNetIdPacket = new NetherNetIdPacket();
$netherNetIdPacket->decode(new ByteBufferReader());
```


---

#### handle

`public function handle(): void`


**Returns**: void


**Example**:

```php
$netherNetIdPacket = new NetherNetIdPacket();
$netherNetIdPacket->handle();
```


---

## Class: core\utils\raklib\NetherNetNoticePacket

**Defined in**: `src\core\utils\raklib\NetherNetNoticePacket.php`


### Methods

#### __construct

`public function __construct()`


**Example**:

```php
$netherNetNoticePacket = new NetherNetNoticePacket();
```


---

#### decode

`public function decode(ByteBufferReader $reader): void`


**Parameters**:

- `$reader` (ByteBufferReader) — 

**Returns**: void


**Example**:

```php
$netherNetNoticePacket = new NetherNetNoticePacket();
$netherNetNoticePacket->decode(new ByteBufferReader());
```


---

#### getSessionId

`public function getSessionId(): int`


**Returns**: int


**Example**:

```php
$netherNetNoticePacket = new NetherNetNoticePacket();
$netherNetNoticePacket->getSessionId();
```


---

## Class: core\utils\raklib\NoFreeIncomingConnections

**Defined in**: `src\core\utils\raklib\NoFreeIncomingConnections.php`


### Methods

#### create

`public static function create(int $serverID): self`


**Parameters**:

- `$serverID` (int) — 

**Returns**: self


**Example**:

```php
NoFreeIncomingConnections::create(123);
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $out): void`


**Parameters**:

- `$out` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$noFreeIncomingConnections = new NoFreeIncomingConnections();
$noFreeIncomingConnections->encodePayload(new PacketSerializer());
```


---

#### decodePayload

`protected function decodePayload(PacketSerializer $in): void`


**Parameters**:

- `$in` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$noFreeIncomingConnections = new NoFreeIncomingConnections();
$noFreeIncomingConnections->decodePayload(new PacketSerializer());
```


---

## Class: core\utils\raklib\QueryInfoPacket

**Defined in**: `src\core\utils\raklib\QueryInfoPacket.php`


### Methods

#### __construct

`public function __construct(private string $hostName, private string $gameType, private string $version, private string $serverEngine, private string $plugins, private string $map, private int    $numPlayers, private int    $maxPlayers, private bool   $whiteList, private string $hostIp, private int    $hostPort, private array  $extraData, private array  $players)`


**Parameters**:

- `private string $hostName` (mixed) — 
- `private string $gameType` (mixed) — 
- `private string $version` (mixed) — 
- `private string $serverEngine` (mixed) — 
- `private string $plugins` (mixed) — 
- `private string $map` (mixed) — 
- `private int    $numPlayers` (mixed) — 
- `private int    $maxPlayers` (mixed) — 
- `private bool   $whiteList` (mixed) — 
- `private string $hostIp` (mixed) — 
- `private int    $hostPort` (mixed) — 
- `private array  $extraData` (mixed) — 
- `private array  $players` (mixed) — 

**Example**:

```php
$queryInfoPacket = new QueryInfoPacket("example", "example", "example", "example", "example", "example", 123, null, null, "example", null, null, null);
```


---

#### encode

`public function encode(ByteBufferWriter $writer): void`


**Parameters**:

- `$writer` (ByteBufferWriter) — 

**Returns**: void


**Example**:

```php
$queryInfoPacket = new QueryInfoPacket("example", "example", "example", "example", "example", "example", 123, null, null, "example", null, null, null);
$queryInfoPacket->encode(new ByteBufferWriter());
```


---

## Class: core\utils\raklib\RaklibSetup

**Defined in**: `src\core\utils\raklib\RaklibSetup.php`


### Methods

#### __construct

`public function __construct(private SwimCore $core, array $addresses, string $rakRouterSocketPath)`

> @throws ReflectionException


**Parameters**:

- `private SwimCore $core` (mixed) — 
- `$addresses` (array) — 
- `$rakRouterSocketPath` (string) — 

**Example**:

```php
$raklibSetup = new RaklibSetup(null, [], "example");
```


---

#### onInterfaceRegister

`public function onInterfaceRegister(NetworkInterfaceRegisterEvent $event): void`


**Parameters**:

- `$event` (NetworkInterfaceRegisterEvent) — 

**Returns**: void


**Example**:

```php
$raklibSetup = new RaklibSetup(null, [], "example");
$raklibSetup->onInterfaceRegister(new NetworkInterfaceRegisterEvent());
```


---

#### getMOTDS

`private function getMOTDS(): array`


**Returns**: array


**Example**:

```php
$raklibSetup = new RaklibSetup(null, [], "example");
$raklibSetup->getMOTDS();
```


---

#### registerInterface

`public function registerInterface(string $ip, int $port): void`


**Parameters**:

- `$ip` (string) — 
- `$port` (int) — 

**Returns**: void


**Example**:

```php
$raklibSetup = new RaklibSetup(null, [], "example");
$raklibSetup->registerInterface("example", 123);
```


---

#### registerRakRouter

`public function registerRakRouter(string $path): SwimRakLibInterface`


**Parameters**:

- `$path` (string) — 

**Returns**: SwimRakLibInterface


**Example**:

```php
$raklibSetup = new RaklibSetup(null, [], "example");
$raklibSetup->registerRakRouter("example");
```


---

## Class: core\utils\raklib\instanceof

**Defined in**: `src\core\utils\raklib\RaklibSetup.php`

@param string[] $addresses
   * @throws ReflectionException


### Methods

_No methods found_

## Class: core\utils\raklib\RakRouterRaklibServer

**Defined in**: `src\core\utils\raklib\RakRouterRaklibServer.php`


### Methods

#### __construct

`public function __construct(ThreadSafeLogger $logger, ThreadSafeArray $mainToThreadBuffer, ThreadSafeArray $threadToMainBuffer, int $serverId, SleeperHandlerEntry $sleeperEntry, protected string    $socketPath, protected string    $serverKey)`


**Parameters**:

- `$logger` (ThreadSafeLogger) — 
- `$mainToThreadBuffer` (ThreadSafeArray) — 
- `$threadToMainBuffer` (ThreadSafeArray) — 
- `$serverId` (int) — 
- `$sleeperEntry` (SleeperHandlerEntry) — 
- `protected string    $socketPath` (mixed) — 
- `protected string    $serverKey` (mixed) — 

**Example**:

```php
$rakRouterRaklibServer = new RakRouterRaklibServer(new ThreadSafeLogger(), new ThreadSafeArray(), new ThreadSafeArray(), 123, new SleeperHandlerEntry(), "example", "example");
```


---

#### onRun

`protected function onRun(): void`


**Returns**: void


**Example**:

```php
$rakRouterRaklibServer = new RakRouterRaklibServer(new ThreadSafeLogger(), new ThreadSafeArray(), new ThreadSafeArray(), 123, new SleeperHandlerEntry(), "example", "example");
$rakRouterRaklibServer->onRun();
```


---

#### fwrite_all

`private function fwrite_all($handle, string $data): void`


**Parameters**:

- `$handle` (mixed) — 
- `$data` (string) — 

**Returns**: void


**Example**:

```php
$rakRouterRaklibServer = new RakRouterRaklibServer(new ThreadSafeLogger(), new ThreadSafeArray(), new ThreadSafeArray(), 123, new SleeperHandlerEntry(), "example", "example");
$rakRouterRaklibServer->fwrite_all(null, "example");
```


---

## Class: core\utils\raklib\SecureOpenConnectionReply1

**Defined in**: `src\core\utils\raklib\SecureOpenConnectionReply1.php`


### Methods

#### create

`public static function create(int $serverId, bool $serverSecurity, int $mtuSize, int $handshakeId = 0): self`


**Parameters**:

- `$serverId` (int) — 
- `$serverSecurity` (bool) — 
- `$mtuSize` (int) — 
- `$handshakeId` (int) — 

**Returns**: self


**Example**:

```php
SecureOpenConnectionReply1::create(123, true, 123, 0);
```


---

#### encodePayload

`protected function encodePayload(PacketSerializer $out): void`


**Parameters**:

- `$out` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$secureOpenConnectionReply1 = new SecureOpenConnectionReply1();
$secureOpenConnectionReply1->encodePayload(new PacketSerializer());
```


---

#### decodePayload

`protected function decodePayload(PacketSerializer $in): void`


**Parameters**:

- `$in` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$secureOpenConnectionReply1 = new SecureOpenConnectionReply1();
$secureOpenConnectionReply1->decodePayload(new PacketSerializer());
```


---

## Class: core\utils\raklib\SecureOpenConnectionRequest2

**Defined in**: `src\core\utils\raklib\SecureOpenConnectionRequest2.php`


### Methods

#### encodePayload

`protected function encodePayload(PacketSerializer $out): void`


**Parameters**:

- `$out` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$secureOpenConnectionRequest2 = new SecureOpenConnectionRequest2();
$secureOpenConnectionRequest2->encodePayload(new PacketSerializer());
```


---

#### decodePayload

`protected function decodePayload(PacketSerializer $in): void`


**Parameters**:

- `$in` (PacketSerializer) — 

**Returns**: void


**Example**:

```php
$secureOpenConnectionRequest2 = new SecureOpenConnectionRequest2();
$secureOpenConnectionRequest2->decodePayload(new PacketSerializer());
```


---

## Class: core\utils\raklib\SecureUnconnectedMessageHandler

**Defined in**: `src\core\utils\raklib\SecureUnconnectedMessageHandler.php`


### Methods

#### __construct

`public function __construct(private SwimRakLibRawServer $server, private ProtocolAcceptor    $protocolAcceptor)`

> @throws ReflectionException


**Parameters**:

- `private SwimRakLibRawServer $server` (mixed) — 
- `private ProtocolAcceptor    $protocolAcceptor` (mixed) — 

**Example**:

```php
$secureUnconnectedMessageHandler = new SecureUnconnectedMessageHandler(null, null);
```


---

#### ipTo32BitInt

`private function ipTo32BitInt(string $ip): int`


**Parameters**:

- `$ip` (string) — 

**Returns**: int


**Example**:

```php
$secureUnconnectedMessageHandler = new SecureUnconnectedMessageHandler(null, null);
$secureUnconnectedMessageHandler->ipTo32BitInt("example");
```


---

#### handleRaw

`public function handleRaw(string $payload, InternetAddress $address): bool`

> @throws ReflectionException


**Parameters**:

- `$payload` (string) — 
- `$address` (InternetAddress) — 

**Returns**: bool


**Example**:

```php
$secureUnconnectedMessageHandler = new SecureUnconnectedMessageHandler(null, null);
$secureUnconnectedMessageHandler->handleRaw("example", new InternetAddress());
```


---

#### handle

`private function handle(OfflineMessage $packet, InternetAddress $address, bool $unreadBytes = false): bool`

> @throws ReflectionException


**Parameters**:

- `$packet` (OfflineMessage) — 
- `$address` (InternetAddress) — 
- `$unreadBytes` (bool) — 

**Returns**: bool


**Example**:

```php
$secureUnconnectedMessageHandler = new SecureUnconnectedMessageHandler(null, null);
$secureUnconnectedMessageHandler->handle(new OfflineMessage(), new InternetAddress(), false);
```


---

## Class: core\utils\raklib\StubLogger

**Defined in**: `src\core\utils\raklib\StubLogger.php`


### Methods

#### emergency

`public function emergency($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->emergency(null);
```


---

#### alert

`public function alert($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->alert(null);
```


---

#### critical

`public function critical($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->critical(null);
```


---

#### warning

`public function warning($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->warning(null);
```


---

#### debug

`public function debug($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->debug(null);
```


---

#### error

`public function error($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->error(null);
```


---

#### info

`public function info($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->info(null);
```


---

#### notice

`public function notice($message)`


**Parameters**:

- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->notice(null);
```


---

#### log

`public function log($level, $message)`


**Parameters**:

- `$level` (mixed) — 
- `$message` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->log(null, null);
```


---

#### logException

`public function logException(\Throwable $e, $trace = null)`


**Parameters**:

- `$e` (\Throwable) — 
- `$trace` (mixed) — 

**Example**:

```php
$stubLogger = new StubLogger();
$stubLogger->logException(new \Throwable(), null);
```


---

## Class: core\utils\raklib\SwimNetworkSession

**Defined in**: `src\core\utils\raklib\SwimNetworkSession.php`


### Methods

#### disconnectIncompatibleProtocol

`public function disconnectIncompatibleProtocol(int $protocolVersion): void`

> @var \Closure[] */


**Parameters**:

- `$protocolVersion` (int) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->disconnectIncompatibleProtocol(123);
```


---

#### onPlayerDestroyed

`public function onPlayerDestroyed(Translatable|string $reason, Translatable|string $disconnectScreenMessage, int $disconnectReason = DisconnectReason::CLIENT_DISCONNECT): void`

> Called by the Player when it is closed (for example due to getting kicked).


**Parameters**:

- `$reason` (Translatable|string) — 
- `$disconnectScreenMessage` (Translatable|string) — 
- `$disconnectReason` (int) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->onPlayerDestroyed(new Translatable(), new Translatable(), DisconnectReason::CLIENT_DISCONNECT);
```


---

#### disconnect

`public function disconnect(Translatable|string $reason, Translatable|string|null $disconnectScreenMessage = null, bool $notify = true, int $disconnectReason = DisconnectReason::CLIENT_DISCONNECT): void`

> Disconnects the session, destroying the associated player (if it exists).


**Parameters**:

- `$reason` (Translatable|string) — Shown in the server log - this should be a short one-line message
- `$disconnectScreenMessage` (Translatable|string|null) — Shown on the player's disconnection screen (null will use the reason)
- `$notify` (bool) — 
- `$disconnectReason` (int) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->disconnect(new Translatable(), null, true, DisconnectReason::CLIENT_DISCONNECT);
```


---

#### sendDisconnectPacketWithReason

`private function sendDisconnectPacketWithReason(Translatable|string $message, int $reason): void`


**Parameters**:

- `$message` (Translatable|string) — 
- `$reason` (int) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->sendDisconnectPacketWithReason(new Translatable(), 123);
```


---

#### onPlayerAdded

`public function onPlayerAdded(Player $p): void`


**Parameters**:

- `$p` (Player) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->onPlayerAdded(new Player());
```


---

#### syncPlayerList

`public function syncPlayerList(array $players): void`

> @var SwimPlayer $p */


**Parameters**:

- `$players` (array) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->syncPlayerList([]);
```


---

#### onPlayerRemoved

`public function onPlayerRemoved(Player $p): void`


**Parameters**:

- `$p` (Player) — 

**Returns**: void


**Example**:

```php
$swimNetworkSession = new SwimNetworkSession();
$swimNetworkSession->onPlayerRemoved(new Player());
```


---

## Class: core\utils\raklib\SwimRakLibInterface

**Defined in**: `src\core\utils\raklib\SwimRakLibInterface.php`


### Methods

#### __construct

`public function __construct(Server $server, string $ip, int $port, bool $ipV6, private PacketBroadcaster      $packetBroadcaster, private EntityEventBroadcaster $entityEventBroadcaster, private TypeConverter          $typeConverter, private array                  $motds)`


**Parameters**:

- `$server` (Server) — 
- `$ip` (string) — 
- `$port` (int) — 
- `$ipV6` (bool) — 
- `private PacketBroadcaster      $packetBroadcaster` (mixed) — 
- `private EntityEventBroadcaster $entityEventBroadcaster` (mixed) — 
- `private TypeConverter          $typeConverter` (mixed) — 
- `private array                  $motds` (mixed) — 

**Example**:

```php
$swimRakLibInterface = new SwimRakLibInterface(new Server(), "example", 123, true, null, null, null, null);
```


---

#### onPacketReceive

`public function onPacketReceive(int $sessionId, string $packet): void`

> @phpstan-var ThreadSafeArray<int, string> $mainToThreadBuffer */


**Parameters**:

- `$sessionId` (int) — 
- `$packet` (string) — 

**Returns**: void


**Example**:

```php
$swimRakLibInterface = new SwimRakLibInterface(new Server(), "example", 123, true, null, null, null, null);
$swimRakLibInterface->onPacketReceive(123, "example");
```


---

#### queryData

`public function queryData(QueryInfoPacket $queryInfoPacket): void`


**Parameters**:

- `$queryInfoPacket` (QueryInfoPacket) — 

**Returns**: void


**Example**:

```php
$swimRakLibInterface = new SwimRakLibInterface(new Server(), "example", 123, true, null, null, null, null);
$swimRakLibInterface->queryData(new QueryInfoPacket());
```


---

#### kickMessageOverride

`public function kickMessageOverride(KickMessageOverridePacket $pk): void`


**Parameters**:

- `$pk` (KickMessageOverridePacket) — 

**Returns**: void


**Example**:

```php
$swimRakLibInterface = new SwimRakLibInterface(new Server(), "example", 123, true, null, null, null, null);
$swimRakLibInterface->kickMessageOverride(new KickMessageOverridePacket());
```


---

#### onClientConnect

`public function onClientConnect(int $sessionId, string $address, int $port, int $mtu): void`


**Parameters**:

- `$sessionId` (int) — 
- `$address` (string) — 
- `$port` (int) — 
- `$mtu` (int) — 

**Returns**: void


**Example**:

```php
$swimRakLibInterface = new SwimRakLibInterface(new Server(), "example", 123, true, null, null, null, null);
$swimRakLibInterface->onClientConnect(123, "example", 123, 123);
```


---

## Class: core\utils\raklib\SwimRakLibRawServer

**Defined in**: `src\core\utils\raklib\SwimRakLibRawServer.php`


### Methods

#### __construct

`public function __construct(int $serverId, Logger $logger, ServerSocket $socket, int $maxMtuSize, ProtocolAcceptor $protocolAcceptor, ServerEventSource $eventSource, ServerEventListener $eventListener, ExceptionTraceCleaner $traceCleaner)`

> @throws ReflectionException


**Parameters**:

- `$serverId` (int) — 
- `$logger` (Logger) — 
- `$socket` (ServerSocket) — 
- `$maxMtuSize` (int) — 
- `$protocolAcceptor` (ProtocolAcceptor) — 
- `$eventSource` (ServerEventSource) — 
- `$eventListener` (ServerEventListener) — 
- `$traceCleaner` (ExceptionTraceCleaner) — 

**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
```


---

#### tickProcessor

`public function tickProcessor(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->tickProcessor();
```


---

#### isShuttingDown

`public function isShuttingDown(): bool`


**Returns**: bool


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->isShuttingDown();
```


---

#### waitShutdown

`public function waitShutdown(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->waitShutdown();
```


---

#### tick

`private function tick(): void`

> Runs once per RakLib tick (1 kHz).


**Returns**: void


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->tick();
```


---

#### sendPacket

`public function sendPacket(Packet $packet, InternetAddress $address): void`


**Parameters**:

- `$packet` (Packet) — 
- `$address` (InternetAddress) — 

**Returns**: void


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->sendPacket(new Packet(), new InternetAddress());
```


---

#### sendPacketInternal

`public function sendPacketInternal(Packet $packet, InternetAddress $address): void`


**Parameters**:

- `$packet` (Packet) — 
- `$address` (InternetAddress) — 

**Returns**: void


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->sendPacketInternal(new Packet(), new InternetAddress());
```


---

#### receivePacket

`private function receivePacket(): bool`

> Reads one UDP datagram from the bound socket, performs basic


**Returns**: bool


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->receivePacket();
```


---

#### createSession

`public function createSession(InternetAddress $address, int $clientId, int $mtuSize): ServerSession`

> @var SwimServerSession $session */


**Parameters**:

- `$address` (InternetAddress) — 
- `$clientId` (int) — 
- `$mtuSize` (int) — 

**Returns**: ServerSession


**Example**:

```php
$swimRakLibRawServer = new SwimRakLibRawServer(123, new Logger(), new ServerSocket(), 123, new ProtocolAcceptor(), new ServerEventSource(), new ServerEventListener(), new ExceptionTraceCleaner());
$swimRakLibRawServer->createSession(new InternetAddress(), 123, 123);
```


---

## Class: core\utils\raklib\SwimRakLibServer

**Defined in**: `src\core\utils\raklib\SwimRakLibServer.php`


### Methods

#### onRun

`protected function onRun(): void`

> @throws ReflectionException


**Returns**: void


**Example**:

```php
$swimRakLibServer = new SwimRakLibServer();
$swimRakLibServer->onRun();
```


---

## Class: core\utils\raklib\SwimServerSession

**Defined in**: `src\core\utils\raklib\SwimServerSession.php`


### Methods

#### __construct

`public function __construct(private Server  $server, Logger $logger, InternetAddress $address, int $clientId, int $mtuSize, int $internalId, int $recvMaxSplitParts = self::DEFAULT_MAX_SPLIT_PART_COUNT, int $recvMaxConcurrentSplits = self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT)`

> @throws ReflectionException


**Parameters**:

- `private Server  $server` (mixed) — 
- `$logger` (Logger) — 
- `$address` (InternetAddress) — 
- `$clientId` (int) — 
- `$mtuSize` (int) — 
- `$internalId` (int) — 
- `$recvMaxSplitParts` (int) — 
- `$recvMaxConcurrentSplits` (int) — 

**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
```


---

#### update

`public function update(float $time): void`


**Parameters**:

- `$time` (float) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->update(1.23);
```


---

#### getMTUSize

`public function getMTUSize(): int`


**Returns**: int


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->getMTUSize();
```


---

#### adjustWindow

`public function adjustWindow(int $highestSeqNumber, int $windowStart, int $windowEnd): void`


**Parameters**:

- `$highestSeqNumber` (int) — 
- `$windowStart` (int) — 
- `$windowEnd` (int) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->adjustWindow(123, 123, 123);
```


---

#### handleConnectionPacket

`protected function handleConnectionPacket(string $packet): void`

> @throws Exception


**Parameters**:

- `$packet` (string) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->handleConnectionPacket("example");
```


---

#### handleEncapsulatedPacketRoute

`private function handleEncapsulatedPacketRoute(EncapsulatedPacket $packet): void`

> @throws ReflectionException


**Parameters**:

- `$packet` (EncapsulatedPacket) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->handleEncapsulatedPacketRoute(new EncapsulatedPacket());
```


---

#### setSpoofAmt

`public function setSpoofAmt(int $spoofAmt): void`


**Parameters**:

- `$spoofAmt` (int) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->setSpoofAmt(123);
```


---

#### setSpoofJitter

`public function setSpoofJitter(int $spoofJitter): void`


**Parameters**:

- `$spoofJitter` (int) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->setSpoofJitter(123);
```


---

#### getSpoofJitter

`public function getSpoofJitter(): int`


**Returns**: int


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->getSpoofJitter();
```


---

#### getSpoofAmt

`public function getSpoofAmt(): float`


**Returns**: float


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->getSpoofAmt();
```


---

#### getTotalSpoofAmt

`public function getTotalSpoofAmt(): float`


**Returns**: float


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->getTotalSpoofAmt();
```


---

#### getSendEntries

`public function getSendEntries(): array`


**Returns**: array


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->getSendEntries();
```


---

#### getRecvEntries

`public function getRecvEntries(): array`


**Returns**: array


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->getRecvEntries();
```


---

#### addSendEntry

`public function addSendEntry(float $time, Packet $packet): void`


**Parameters**:

- `$time` (float) — 
- `$packet` (Packet) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->addSendEntry(1.23, new Packet());
```


---

#### addRecvEntry

`public function addRecvEntry(float $time, Packet $packet): void`


**Parameters**:

- `$time` (float) — 
- `$packet` (Packet) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->addRecvEntry(1.23, new Packet());
```


---

#### removeSendEntry

`public function removeSendEntry(int $index): void`


**Parameters**:

- `$index` (int) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->removeSendEntry(123);
```


---

#### removeRecvEntry

`public function removeRecvEntry(int $index): void`


**Parameters**:

- `$index` (int) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->removeRecvEntry(123);
```


---

#### cleanEntries

`public function cleanEntries(bool $sendEntries, bool $recvEntries): void`


**Parameters**:

- `$sendEntries` (bool) — 
- `$recvEntries` (bool) — 

**Returns**: void


**Example**:

```php
$swimServerSession = new SwimServerSession(null, new Logger(), new InternetAddress(), 123, 123, 123, self::DEFAULT_MAX_SPLIT_PART_COUNT, self::DEFAULT_MAX_CONCURRENT_SPLIT_COUNT);
$swimServerSession->cleanEntries(true, true);
```


---

## Class: core\utils\raklib\SwimSkinAdapter

**Defined in**: `src\core\utils\raklib\SwimSkinAdapter.php`


### Methods

#### toSkinData

`public function toSkinData(Skin $skin): SkinData`

> @throws JsonException


**Parameters**:

- `$skin` (Skin) — 

**Returns**: SkinData


**Example**:

```php
$swimSkinAdapter = new SwimSkinAdapter();
$swimSkinAdapter->toSkinData(new Skin());
```


---

#### fromSkinData

`public function fromSkinData(SkinData $data): Skin`

> @throws JsonException


**Parameters**:

- `$data` (SkinData) — 

**Returns**: Skin


**Example**:

```php
$swimSkinAdapter = new SwimSkinAdapter();
$swimSkinAdapter->fromSkinData(new SkinData());
```


---

## Class: core\utils\raklib\SwimTypeConverter

**Defined in**: `src\core\utils\raklib\SwimTypeConverter.php`


### Methods

#### make

`public static function make(int $protocolId): self`


**Parameters**:

- `$protocolId` (int) — 

**Returns**: self


**Example**:

```php
SwimTypeConverter::make(123);
```


---

#### coreItemStackToNet

`public function coreItemStackToNet(Item $itemStack): ItemStack`


**Parameters**:

- `$itemStack` (Item) — 

**Returns**: ItemStack


**Example**:

```php
$swimTypeConverter = new SwimTypeConverter();
$swimTypeConverter->coreItemStackToNet(new Item());
```


---

## Class: core\utils\security\AsyncIPLookup

**Defined in**: `src\core\utils\security\AsyncIPLookup.php`


### Methods

#### __construct

`public function __construct(string $name, string $ip)`


**Parameters**:

- `$name` (string) — 
- `$ip` (string) — 

**Example**:

```php
$asyncIPLookup = new AsyncIPLookup("example", "example");
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$asyncIPLookup = new AsyncIPLookup("example", "example");
$asyncIPLookup->onRun();
```


---

#### onCompletion

`public function onCompletion(): void`


**Returns**: void


**Example**:

```php
$asyncIPLookup = new AsyncIPLookup("example", "example");
$asyncIPLookup->onCompletion();
```


---

## Class: core\utils\security\KickMessageFix

**Defined in**: `src\core\utils\security\KickMessageFix.php`


### Methods

#### kick

`public static function kick(SwimCore $core, Player $player, string $msg): void`


**Parameters**:

- `$core` (SwimCore) — 
- `$player` (Player) — 
- `$msg` (string) — 

**Returns**: void


**Example**:

```php
KickMessageFix::kick(new SwimCore(), new Player(), "example");
```


---

#### __construct

`public function __construct(Player $player)`


**Parameters**:

- `$player` (Player) — 

**Example**:

```php
$kickMessageFix = new KickMessageFix(new Player());
```


---

#### onRun

`public function onRun(): void`


**Returns**: void


**Example**:

```php
$kickMessageFix = new KickMessageFix(new Player());
$kickMessageFix->onRun();
```


---

## Class: core\utils\security\TouchMode

**Defined in**: `src\core\utils\security\LoginProcessor.php`


### Methods

_No methods found_

## Class: core\utils\security\runs

**Defined in**: `src\core\utils\security\LoginProcessor.php`


### Methods

_No methods found_

## Class: core\utils\security\ParseIP

**Defined in**: `src\core\utils\security\ParseIP.php`


### Methods

#### parseIp

`public static function parseIp(string $ip): string`


**Parameters**:

- `$ip` (string) — 

**Returns**: string


**Example**:

```php
ParseIP::parseIp("example");
```


---

#### sepIpFromPort

`public static function sepIpFromPort(string $ip): array`


**Parameters**:

- `$ip` (string) — 

**Returns**: array


**Example**:

```php
ParseIP::sepIpFromPort("example");
```


---

#### sepIpFromPortWithv6Bracketed

`public static function sepIpFromPortWithv6Bracketed(string $address): bool|array`


**Parameters**:

- `$address` (string) — 

**Returns**: bool|array


**Example**:

```php
ParseIP::sepIpFromPortWithv6Bracketed("example");
```


---

## Class: core\utils\security\SqlInjectCheck

**Defined in**: `src\core\utils\security\SqlInjectCheck.php`


### Methods

#### isSqlInjectionAttempt

`public static function isSqlInjectionAttempt(string $input): bool`


**Parameters**:

- `$input` (string) — 

**Returns**: bool


**Example**:

```php
SqlInjectCheck::isSqlInjectionAttempt("example");
```


---

#### isValidUuidOrHex

`public static function isValidUuidOrHex(string $input): bool`


**Parameters**:

- `$input` (string) — 

**Returns**: bool


**Example**:

```php
SqlInjectCheck::isValidUuidOrHex("example");
```


---

#### isBase64

`public static function isBase64(string $input): bool`


**Parameters**:

- `$input` (string) — 

**Returns**: bool


**Example**:

```php
SqlInjectCheck::isBase64("example");
```


---

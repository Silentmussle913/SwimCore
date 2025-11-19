<?php

namespace core\utils\security;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class AsyncIPLookup extends AsyncTask
{

  private string $name;
  private string $ip;
  private bool $vpn = false;

  public function __construct(string $name, string $ip)
  {
    $this->name = $name;
    $this->ip = $ip;
  }

  public function onRun(): void
  {
    $url = "http://ip-api.com/json/" . $this->ip . "?fields=proxy";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
      print(curl_errno($ch) . "\n");
      return;
    }
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpStatus != 200) {
      print("http status: " . $httpStatus . "\n");
      return;
    }

    $obj = json_decode($response, true);
    if (isset($obj["proxy"])) {
      $this->vpn = $obj["proxy"];
    } else {
      // to do?
    }
  }

  public function onCompletion(): void
  {
    if (Server::getInstance()->getPlayerExact($this->name) && $this->vpn) {
      Server::getInstance()->getPlayerExact($this->name)->sendMessage(TextFormat::RED . "VPN/Proxy detected! Please do not use a vpn or proxy if possible.");
      Server::getInstance()->getLogger()->warning($this->name . " logged in with a vpn/proxy");
    }
  }

}
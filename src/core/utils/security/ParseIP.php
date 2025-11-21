<?php

namespace core\utils\security;

final class ParseIP
{

  public static function parseIp(string $ip): string
  {
    if (!str_contains($ip, ":")) {
      return $ip; //ipv4
    }

    $parts = explode(':', $ip);

    if (count($parts) < 4) {
      return $ip;
    }

    return implode(':', array_slice($parts, 0, 4));
  }

  public static function sepIpFromPort(string $ip): array
  {
    $parts = explode(":", $ip);

    if (count($parts) < 2) {
      return ["0.0.0.0", 19132];
    }

    $port = intval($parts[count($parts) - 1]) ?? 19132;

    if (count($parts) == 2) {
      return [$parts[0] ?? "0.0.0.0", $port]; // ipv4
    }

    array_splice($parts, count($parts) - 1);
    return [implode(":", $parts), $port];
  }

  public static function sepIpFromPortWithv6Bracketed(string $address): bool|array
  {
    if (str_contains($address, "[") && str_contains($address, "]")) {
      $v6End = strpos($address, "]");

      if ($v6End === false) {
        return false;
      }

      $ipv6 = substr($address, 1, $v6End - 1);
      $port = substr($address, $v6End + 2);

      return [$ipv6, (int)$port];
    }

    $parts = explode(":", $address);
    if (count($parts) !== 2) {
      return false;
    }

    return [$parts[0], (int)$parts[1]];
  }

}

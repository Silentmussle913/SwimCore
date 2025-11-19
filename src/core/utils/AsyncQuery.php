<?php

namespace core\utils;

use core\utils\libpmquery\PMQuery;
use core\utils\libpmquery\PmQueryException;
use pmmp\thread\ThreadSafeArray;
use pocketmine\scheduler\AsyncTask;

class AsyncQuery extends AsyncTask
{

  private ThreadSafeArray $result;

  public function __construct(callable $cb, private readonly string $ip, private readonly int $port = 19132)
  {
    $this->storeLocal("cb", $cb);
  }

  public function onRun(): void
  {
    try {
      $query = PMQuery::query($this->ip, $this->port);
      $this->result = ThreadSafeArray::fromArray($query);
    } catch (PmQueryException) {
      // nothing I guess
    }
  }

  public function onCompletion(): void
  {
    if (!isset($this->result)) {
      $this->fetchLocal("cb")(null);
      return;
    }
    $this->fetchLocal("cb")($this->result);
  }

}

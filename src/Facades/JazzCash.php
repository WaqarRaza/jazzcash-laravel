<?php

namespace Waqarraza\Jazzcashlaravel\Facades;

use Illuminate\Support\Facades\Facade;

class JazzCash extends Facade
{

  protected static function getFacadeAccessor() {
   return 'JazzCash';
  }

}

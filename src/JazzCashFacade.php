<?php

namespace Waqarraza\Jazzcashlaravel;

use Illuminate\Support\Facades\Facade;

class JazzCashFacade extends Facade
{

  protected static function getFacadeAccessor() {
   return 'JazzCash';
  }

}

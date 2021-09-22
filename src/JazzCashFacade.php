<?php namespace Waqar\Jazzcash;

use Illuminate\Support\Facades\Facade;

class JazzCashFacade extends Facade
{

  protected static function getFacadeAccessor() {
   return 'JazzCash';
  }

}

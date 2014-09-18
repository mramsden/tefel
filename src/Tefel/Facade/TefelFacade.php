<?php namespace Tefel\Facade;

use Illuminate\Support\Facades\Facade;

class TefelFacade extends Facade {

    public static function getFacadeAccessor() { return 'tefel'; }

}

<?php

namespace App\Facades;

use App\Contracts\Service\CarServiceContract;
use Illuminate\Support\Facades\Facade;

class CarServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CarServiceContract::class;
    }
}

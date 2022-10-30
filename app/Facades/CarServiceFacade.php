<?php

declare(strict_types=1);

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

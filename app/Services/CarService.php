<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Service\CarServiceContract;
use App\Models;

class CarService implements CarServiceContract
{
    public function takeControl(Models\Car $car, int $userId): void
    {
        if (isset($car->controlled_by)) {
            throw new \Exception('Car is under control!');
        }

        $car->controlled_by = $userId;
        $car->save();
    }

    public function takeOffControl(Models\Car $car): void
    {
        if (is_null($car->controlled_by)) {
            throw new \Exception('Car is out of control!');
        }

        $car->controlled_by = null;
        $car->save();
    }
}

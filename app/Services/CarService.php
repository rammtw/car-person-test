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
        \DB::transaction(function () use ($car, $userId): void {
            Models\Car::lockForUpdate()->find($car->id);

            $user = Models\User::find($userId);

            if (isset($user->car)) {
                throw new \Exception('The user is already driving a car!');
            }

            $car->controlled_by = $userId;
            $car->save();
        });
    }

    public function takeOffControl(Models\Car $car): void
    {
        if (null === $car->controlled_by) {
            throw new \Exception('Car is out of control!');
        }

        $car->controlled_by = null;
        $car->save();
    }
}

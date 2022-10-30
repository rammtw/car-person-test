<?php

declare(strict_types=1);

namespace App\Contracts\Service;

use App\Models;

interface CarServiceContract
{
    public function takeControl(Models\Car $car, int $userId): void;
    public function takeOffControl(Models\Car $car): void;
}

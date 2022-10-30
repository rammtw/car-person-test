<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\TakeControlRequest;
use CarService;

class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/car/take_control",
     *     @OA\Response(response="200", description="Request to take control of car")
     * )
     */
    public function takeControl(TakeControlRequest $request)
    {
        CarService::takeControl();

        return response()->json();
    }
}

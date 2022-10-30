<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\TakeControlRequest;
use App\Models\Car;
use CarService;

class CarController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/car/{car}/take_control",
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass user id",
     *              @OA\JsonContent(
     *              required={"user_id"},
     *          @OA\Property(property="user_id", type="integer", example="1"),
     *    ),
     * ),
     *     @OA\Response(response="200", description="Request to take control of car")
     * )
     */
    public function takeControl(Car $car, TakeControlRequest $request)
    {
        CarService::takeControl($car, $request->get('user_id'));

        return response()->json();
    }

    /**
     * @OA\Post(
     *     path="/api/car/{car}/take_off_control",
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\Response(response="200", description="Request to take off control of car")
     * )
     */
    public function takeOffControl(Car $car)
    {
        CarService::takeOffControl($car);

        return response()->json();
    }
}

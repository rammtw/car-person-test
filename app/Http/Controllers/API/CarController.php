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
     *              @OA\Property(property="user_id", type="integer", example="1"),
     *          ),
     *      ),
     *      @OA\Response(response="200", description="Request to take control of car"),
     *      @OA\Response(
     *          response=400,
     *          description="Car is under control!",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="array", example="[]", @OA\Items()),
     *              @OA\Property(property="error", type="string", example="Car is under control!")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="The user is already driving a car!",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="array", example="[]", @OA\Items()),
     *              @OA\Property(property="error", type="string", example="The user is already driving a car!")
     *          )
     *      )
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
     *     @OA\Response(response="200", description="Request to take off control of car"),
     *     @OA\Response(
     *          response=400,
     *          description="Car is out of control!",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="array", example="[]", @OA\Items()),
     *              @OA\Property(property="error", type="string", example="Car is out of control!")
     *          )
     *      )
     * )
     */
    public function takeOffControl(Car $car)
    {
        CarService::takeOffControl($car);

        return response()->json();
    }
}

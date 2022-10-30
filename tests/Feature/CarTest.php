<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class CarTest extends TestCase
{
    use RefreshDatabase;

    public function testCarTakeControlSuccess(): void
    {
        // Arrange
        $sut = Car::factory()->create();
        $user = User::factory()->create();

        // Act
        $response = $this->post("/api/car/{$sut->id}/take_control", [
            'user_id' => $user->id,
        ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }

    public function testCarTakeControlUnderControlFail(): void
    {
        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Car is under control!');

        // Arrange
        $sut = Car::factory()->create([
            'controlled_by' => User::factory(),
        ]);
        $user = User::factory()->create();

        // Act
        $this->withoutExceptionHandling()->post("/api/car/{$sut->id}/take_control", [
            'user_id' => $user->id,
        ]);
    }

    public function testCarTakeControlUserAlreadyDrivingCarFail(): void
    {
        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The user is already driving a car!');

        // Arrange
        $user = User::factory()->create();
        Car::factory()->create([
            'controlled_by' => $user->id,
        ]);
        $sut = Car::factory()->create();

        // Act
        $this->withoutExceptionHandling()->post("/api/car/{$sut->id}/take_control", [
            'user_id' => $user->id,
        ]);
    }

    public function testCarTakeOffControlSuccess(): void
    {
        // Arrange
        $sut = Car::factory()->create([
            'controlled_by' => User::factory(),
        ]);

        // Act
        $response = $this->post("/api/car/{$sut->id}/take_off_control");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }

    public function testCarTakeOffControlIsOutOfControlSuccess(): void
    {
        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Car is out of control!');

        // Arrange
        $sut = Car::factory()->create();

        // Act
        $this->withoutExceptionHandling()->post("/api/car/{$sut->id}/take_off_control");
    }
}

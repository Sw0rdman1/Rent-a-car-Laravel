<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
use \App\Models\Car;
use \App\Models\Rental;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Rental::class;

    public function definition()
    {
        return [
            'user_id'=> User::factory(),
            'car_id'=> Car::factory(),
            'rented_at' => now(),
            'rented_until' => now(),
        ];
    }
}

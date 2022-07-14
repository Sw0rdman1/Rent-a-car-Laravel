<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Brand;
use \App\Models\Car;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Car::class;

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));
        $v = $this->faker->unique()->vehicleArray();
        return [
            'registration_plate' => Str::random(7),
            'model' =>$v['model'],
            'year_of_production' =>$this->faker->numberBetween(2000,2020),
            'cubic_capacity'=>$this->faker->numberBetween(1000,4000),
            'horse_powers'=>$this->faker->numberBetween(100,400),
            'brand_id'=>Brand::factory(),
        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Car;
use \App\Models\User;
use \App\Models\Rental;
use \App\Models\Brand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
            User::truncate();
            Brand::truncate();
            Car::truncate();
            Rental::truncate();
    
             User::factory(2)->create();
             Rental::factory(2)->create();
             Rental::factory(3)->create([
                 'user_id'=>User::factory()->create(),
             ]);
             $brand = Brand::factory()->create();
             Car::factory(3)->create([
                'brand_id'=>$brand->id,
            ]);
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
         User::factory(10)->create();
         Flight::factory(10)->create();
         Booking::factory(10)->create();
         

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Flight::create([
        //     'flight_id' => '1111',
        //     'airline' => 'British Airways',
        //     'origin' => 'London, United Kingdom',
        //     'destination' => 'Belgrade, Serbia',
        //     'departure_date' => '2021-08-12',
        //     'arrival_date' => '2021-08-13',
        //     'capacity' => '130',
        //     'price' => '350.00'
        // ]);

        // User::create([
        //     'user_id' => 1,
        //     'name' => 'pavle',
        //     'password' => 'pavle123',
        //     'email' => 'pavle@gmail.com',
        // ]);
    }
}

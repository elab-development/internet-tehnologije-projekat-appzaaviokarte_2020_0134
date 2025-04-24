<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Flight;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\booking>
 */
class BookingFactory extends Factory
{ 
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Booking::class;

   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
       return [
           'user_id' => User::factory(), // Kreira korisnika ili možete koristiti `User::inRandomOrder()->first()->id` za nasumičnog korisnika
           'flight_id' => Flight::factory(), // Kreira let ili možete koristiti `Flight::inRandomOrder()->first()->id` za nasumičan let
           'booking_date' => Carbon::now(),
           'status' => $this->faker->randomElement(['confirmed', 'pending', 'canceled']),
       ];
    }
}

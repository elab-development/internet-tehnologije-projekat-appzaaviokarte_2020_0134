<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\flight>
 */
class FlightFactory extends Factory
{


        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureDate = Carbon::instance($this->faker->dateTimeBetween('+1 week', '+1 month'));
        $arrivalDate = (clone $departureDate)->addHours(rand(1, 10));

        return [
            'airline' => $this->faker->company,
            'origin' => $this->faker->city,
            'destination' => $this->faker->city,
            'departure_date' => $departureDate,
            'arrival_date' => $arrivalDate,
            'capacity' => $this->faker->numberBetween(50, 300),
            'price' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}

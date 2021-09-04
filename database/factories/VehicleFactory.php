<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plate_no' => $this->faker->numberBetween(1111, 1119),
            'model' => $this->faker->randomElement(['Nissan', 'Toyota', 'BMW', 'Volvo', 'GMC']),
            'color' => $this->faker->colorName,
            'model_year' => $this->faker->year,
            'insurance_no' => $this->faker->numberBetween(11111, 99999999),
            'insurance_company' => $this->faker->company,
            'insurance_start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'insurance_expiry_date' => $this->faker->dateTimeBetween('now', '3 years'),
            'user_id' => User::all()->random(),
        ];
    }
}

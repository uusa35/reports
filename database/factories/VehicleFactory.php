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
            'plate_no' => $this->faker->name,
            'model' => $this->faker->randomElement(['Nissan','Toyota','BMW','Volvo','GMC']),
            'color' => $this->faker->colorName,
            'model_year' => $this->faker->year,
            'scrapped' => $this->faker->boolean,
            'user_id' => User::all()->random(),
        ];
    }
}

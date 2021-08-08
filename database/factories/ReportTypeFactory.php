<?php

namespace Database\Factories;

use App\Models\ReportType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReportType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Minor Accident', 'Minor Accident with Injury','Calling Ambulance', 'Fire Accident','Property Damage']),
            'image' => 'default.svg',
            'hot_line' => $this->faker->phoneNumber,
            'notes' => $this->faker->paragraph,
            'description' => $this->faker->paragraph(2),
            'is_traffic' => $this->faker->boolean,
            'is_ambulance' => $this->faker->boolean,
            'is_fire' => $this->faker->boolean,
        ];
    }
}

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
            'name' => $this->faker->randomElement(['Accident', 'Fire', 'Fight', 'Theft', 'Murder', 'Harassment']),
            'image' => 'default.svg',
            'hot_line' => $this->faker->phoneNumber,
            'notes' => $this->faker->paragraph,
            'description' => $this->faker->paragraph(2),
        ];
    }
}

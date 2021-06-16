<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\ReportType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference_id' => $this->faker->randomNumber(),
            'has_injuries' => $this->faker->boolean,
            'injuries_no' => $this->faker->randomNumber(),
            'street' => $this->faker->streetAddress,
            'building_no' => $this->faker->buildingNumber,
            'area' => $this->faker->randomElement(['farwaniya', 'hawali', 'salmya', 'salwa', 'sharq', '']),
            'address' => $this->faker->address,
            'image' => 'default.svg',
            'image_two' => 'default.svg',
            'image_three' => 'default.svg',
            'image_four' => 'default.svg',
            'video_one' => $this->faker->url,
            'video_two' => $this->faker->url,
            'notes' => $this->faker->paragraph,
            'description' => $this->faker->paragraph,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'user_id' => User::where(['is_officer' => false])->get()->random()->id,
            'report_type_id' => ReportType::all()->random()->id,
            'officer_id' => function ($array) {
                return User::where(['report_type_id' => $array['report_type_id'], 'is_officer' => true])->get()->random()->id;
            },
        ];
    }
}

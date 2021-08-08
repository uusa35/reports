<?php

namespace Database\Factories;

use App\Models\Governate;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\User;
use App\Models\Vehicle;
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
            'injuries_no' => $this->faker->randomDigit,
            'mobile' => $this->faker->phoneNumber,
            'street' => $this->faker->streetAddress,
            'building_no' => $this->faker->buildingNumber,
            'block' => $this->faker->randomDigit,
            'area' => $this->faker->randomElement(['farwaniya', 'hawali', 'salmya', 'salwa', 'sharq', 'qairwan']),
            'electricity_pole_no' => $this->faker->numberBetween(99,999),
            'speed_limit' => $this->faker->randomElement([60,80,120]),
            'image' => 'default.svg',
            'path' => '1.mov',
            'notes' => $this->faker->paragraph,
            'description' => $this->faker->paragraph,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'traffic_offences' => $this->faker->randomElement(['No Parking', 'Honking', 'Dangerous Overtaking', 'Handicapped Parking', 'Documents & License Plates', 'Others']),
            'primary_contributory' => $this->faker->randomElement(['Driver/Rider Error', 'Bad weather', 'Fault of passenger', 'Overloading', 'Cause Not Known', 'Defect in road condition', 'AlcoholLDrugs', 'Poor light condition', 'Infrastructure Problem', 'Mechanical Defect of Vehicle']),
            'hit_and_run' => $this->faker->boolean,
            'weather' => $this->faker->randomElement(['wind', 'mist/fog', 'cloudy', 'light rain', 'heavy rain', 'smoke', 'strong wind']),
            'user_id' => User::where(['is_officer' => false])->get()->random()->id,
            'report_type_id' => ReportType::all()->random()->id,
            'officer_id' => User::officers()->get()->random()->id,
            'governate_id' => Governate::all()->random()->id
        ];
    }
}

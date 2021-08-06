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
            'vehicle_no_1' => Vehicle::all()->random()->plate_no,
            'vehicle_no_2' => Vehicle::all()->random()->plate_no,
            'vehicle_no_3' => Vehicle::all()->random()->plate_no,
            'driving_license_vehicle_no_1' => $this->faker->numberBetween(111111,99999999),
            'driving_license_vehicle_no_2' => $this->faker->numberBetween(111111,99999999),
            'driving_license_vehicle_no_3' => $this->faker->numberBetween(111111,99999999),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'traffic_offences' => $this->faker->randomElement(['No Parking', 'Honking', 'Dangerous Overtaking', 'Handicapped Parking', 'Documents & License Plates', 'Others']),
            'primary_contributory' => $this->faker->randomElement(['Driver/Rider Error', 'Bad weather', 'Fault of passenger', 'Overloading', 'Cause Not Known', 'Defect in road condition', 'AlcoholLDrugs', 'Poor light condition', 'Infrastructure Problem', 'Mechanical Defect of Vehicle']),
            'hit_and_run' => $this->faker->boolean,
            'weather' => $this->faker->randomElement(['wind', 'mist/fog', 'cloudy', 'light rain', 'heavy rain', 'smoke', 'strong wind']),
            'user_id' => User::where(['is_officer' => false])->get()->random()->id,
            'report_type_id' => ReportType::all()->random()->id,
            'officer_id' => function ($array) {
                return User::where(['report_type_id' => $array['report_type_id'], 'is_officer' => true])->get()->random()->id;
            },
            'governate_id' => Governate::all()->random()->id
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Governate;
use App\Models\ReportType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fakerAr = \Faker\Factory::create('ar_JO');
        return [
            'name' => $this->faker->name(),
            'first_name' => $this->faker->firstName,
            'father_name' => $this->faker->firstName,
            'sur_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'mobile' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'civil_id_no' => $this->faker->numberBetween(1111111111, 9999999999),
            'reference_no' => $this->faker->numberBetween(1111111111, 9999999999),
            'file_no' => $this->faker->numberBetween(1111111111, 9999999999),
            'passport_no' => $this->faker->numberBetween(1111111111, 9999999999),
            'civil_id_image' => 'default.svg',
            'personal_image' => 'default.svg',
            'description' => $this->faker->paragraph,
            'is_officer' => $this->faker->boolean,
            'is_admin' => $this->faker->boolean(false),
            'report_type_id' => ReportType::all()->random()->id,
            'governate_id' => Governate::all()->random()->id,
            'city' => $this->faker->city,
            'nationality' => $this->faker->country,
            'department' => $this->faker->jobTitle,
            'section' => $this->faker->country,
            'age' => $this->faker->numberBetween(30, 40),
            'block' => $this->faker->numberBetween(1, 10),
            'house_no' => $this->faker->numberBetween(1, 99),
            'has_driving_license' => $this->faker->boolean,
            'driving_license_issuance' => Carbon::now()->subMonths($this->faker->numberBetween(3, 10)),
            'driving_license_expiry' => Carbon::now()->addMonths($this->faker->numberBetween(1, 5))
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

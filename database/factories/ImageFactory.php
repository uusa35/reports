<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'imagable_id' => Report::all()->random()->id,
            'imagable_type' => 'App\Models\Report'
        ];
    }
}

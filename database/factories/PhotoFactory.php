<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

                'path'=>'2022/3',
                'filename'=>'profile.png',
                'approved'=>1,
                'is_main'=>1,
                'type'=>0,
                'orientation'=>$this->faker->randomElement(['portrait', 'landscape'])
        ];
    }
}

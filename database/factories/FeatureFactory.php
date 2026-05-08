<?php

namespace Database\Factories;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gender' =>1,
            'profile_id'=>2,
            'age' =>$this->faker->numberBetween(19,60),
            'height'=>$this->faker->numberBetween(130,200),
            'weight'=>$this->faker->numberBetween(45,90),
            'breast_size'=>$this->faker->numberBetween(60,120),
            'breast_type'=>$this->faker->boolean(),
            'hair_color_id'=>$this->faker->numberBetween(1,5),
            'eye_color_id'=>$this->faker->numberBetween(1,3),
            'languages'=>["4","2","1"],
            'smoker'=>$this->faker->boolean(),
            'private_apartament'=>$this->faker->boolean(),
            'creditcard_acceptance'=>$this->faker->boolean(),
            'whatsapp_acceptance'=>$this->faker->boolean(),
            'is_pornstar'=>$this->faker->boolean(),
            'nationality_id'=>1,
            'services'=>["4","11","23"],
        ];
    }
}

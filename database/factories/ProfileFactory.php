<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>2,
            'type_id'=>1,
            'name'=>$this->faker->firstName(),
            'email'=>$this->faker->email(),
            'phone'=>$this->faker->phoneNumber(),
            'description'=>$this->faker->text(500),
            'uid'=>$this->faker->uuid(),
            'web'=>null,
            'approved'=>1,
            'is_vip'=>$this->faker->boolean(),
            'active'=>$this->faker->boolean(),
            'can_be_reviewed'=>$this->faker->boolean(),
        ];
    }
}

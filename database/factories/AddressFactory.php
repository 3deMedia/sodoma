<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address'=>'calle del melocotón',
            'city_id'=>2,
            'region_id'=>$this->faker->numberBetween(1,30),
            'country_id'=>$this->faker->numberBetween(1,2),
            'travel_range_id'=>$this->faker->numberBetween(1,5),
            'latitude'=>$this->faker->latitude(41.39,41.40),
            'longitude'=>$this->faker->longitude(2.13,2.20),
        ];
    }
}

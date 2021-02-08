<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LugaresTuristicos;
use App\Models\User;

class LugaresTuristicosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LugaresTuristicos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->sentence(),
            'descripcion' => $this->faker->text(250),
            'contenido' => $this->faker->text(2000),
            'imagen'=> 'turismo/'. $this->faker->image('public/storage/turismo',700,500,null,false),
            'tipo' => $this->faker->randomElement(['Parque','Hotel','Restaurante','Iglesia']),
            'user_id' => User::all()->random()->id

        ];
    }
}

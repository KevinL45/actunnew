<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            //$categorie = ['Politique', 'Sport', 'Economie', 'Santé','Economie']
            $name = $this->faker->unique->word;
            return [
                'name' => $name,
                'alias' => Str::slug($name)
            ];
    }
}

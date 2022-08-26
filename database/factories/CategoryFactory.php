<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $name = $this->faker->unique()->word(20); //Genera una palabra de 20 caracteres para dicho campo. Este faker es unico, no se repite.

        return [
            'name' => $name, 
            'slug' => Str::slug($name)          //Con el metodo slug agrega un - por cada espacio en blanco.
        ];
    }
}

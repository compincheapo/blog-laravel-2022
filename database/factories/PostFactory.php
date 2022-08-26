<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(); //Creamos una sentencia unica por cada campo.
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'extract' => $this->faker->text(250), //Creamos un texto de 250 caracteres por campo.
            'body' => $this->faker->text(2000),
            'status' => $this->faker->randomElement([1,2]), //Creamos valores aleatorios. El campo puede tener el valor 1 o 2.
            'category_id' => Category::all()->random()->id, //Obtenemos de manera aleatoria el campo id de Category.
            'user_id' => User::all()->random()->id


        ];
    }
}

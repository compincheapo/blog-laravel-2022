<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory(100)->create();      //Creamos 100 posts.

        foreach($posts as $post){                   //De cada post creamos una imagen para asociarlo al mismo.
            Image::factory(1)->create([
                'imageable_id' => $post->id,        //Le pasamos el id del post y su clase.
                'imageable_type' => Post::class
            ]);
            $post->tags()->attach([             //A cada Post con el método tags() le asociamos su id (a la relacion de la tabla intermedia) y en attach() (método para asociar la otra tabla)
                rand(1,4),                      //añadimos los id de la entidad Tags (en este caso dos id). Rand elige valores según el rango especificado. 
                rand(5,8)
            ]);
        }
    }
}

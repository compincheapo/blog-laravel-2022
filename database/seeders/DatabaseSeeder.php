<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');  //Eliminamos la carpeta con las imagenes debido a que al ejecutarse migrate:fresh --seed no las elimina y vuelve a crear, sino que crea de forma incremental. 
        Storage::makeDirectory('posts'); // Crea una carpeta en blog\public\storage
        
        $this->call(RoleSeeder::class); /* Llamamos al seeder RoleSeeder. */

        $this->call(UserSeeder::class); //Llamamos al seeder de los usuarios.
        Category::factory(4)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class); //Llamamos al seeder de los posts.
    }
}

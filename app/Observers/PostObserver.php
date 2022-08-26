<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    public function creating(Post $post)
    {
        if (! \App::runningInConsole()){        /* En este if evitamos que se tomen valores que se crearon desde la consola, es decir, a través de los seeders. Si esto no se hace, tendremos problemas ya que al ejecutar el seeder, intentará tomar un usuario actualmente autentificado y no el especificado en PostFactory.  */
            $post->user_id = auth()->user()->id;    /* Antes de crear el post, le asignamos el id a el usuario actualmente autentificado.  */
        }                                           /* Esto se hace en backend debido a que si agregamos un input que realice esta asignación, lo que va a suceder es que al inspeccionar la página, este input se podrá modificar y asignar a un usuario incorrecto. */
    }                                           

   
    public function deleting(Post $post) /* Método que se ejecuta antes de eliminar el registro del post. */
    {
        if($post->image){                   /* Si dicho post tiene una imagen, se la elimina de la carpeta. */
            Storage::delete($post->image->url);
        }
    }

   
}

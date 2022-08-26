<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Post $post){ /* Verificamos que el usuario actualmente autentificado sea el creador del post. */
        if($user->id == $post->user_id){            /* Comparamos el id del usuario actualmente autentificado y del usuario que creó el post. */
            return true;
        }
        else{
            return false;
        }
    }

    public function published(?User $user, Post $post){      /* Verificamos que el post esté en un estado publicado y que no se permita al usuario por url entrar a uno que es borrador por su id */
        if ($post->status == 2){
            return true;    
        }
        else{
            return false;
        }
    }
}

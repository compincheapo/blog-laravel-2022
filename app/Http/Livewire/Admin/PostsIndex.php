<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination; /* En laravel livewire para paginar necesitamos de esta clase. */

class PostsIndex extends Component
{
    use WithPagination; /* Para usarlo en la clase debemos invocarlo dentro de la misma. */

    protected $paginationTheme = "bootstrap"; /* Con esto evitamos que la paginación se realice con Tailwind. Permitiendo así utilizar el estilo de bootstrap. */

    public $search;

    public function updatingSearch(){    /* Con esto hacemos que cada vez que se actualice la variable 'search', se actualice la página (llevandole a la primera donde están todos los registros). */
        $this->resetPage();             /* Sin esta función, cuando nos situemos en una determinada página y hagamos la busqueda, esta busqueda solo se hará en la página en la que nos encontremos.  */
    }
    public function render()
    {     


        $posts = Post::where('user_id', auth()->user()->id) /* Obtenemos los posts creados por el usuario actualmente autentificado. */
        ->where('name','LIKE', '%'. $this->search .'%')
        ->latest('id')
        ->paginate();    
       
        return view('livewire.admin.posts-index', compact('posts'));
    }
}

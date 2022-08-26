<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;                         /* Variable que se modifica a través de la vista. */

    protected $paginationTheme = "bootstrap";  /* Por defecto utiliza tailwind, por lo tanto, para la paginación le pedimos utilizar bootstrap. */

                                        /* Los métodos con nombre updating como updatingSearch tiene en cuenta la variable como el nombre lo especifica "search" y updating es por cada vez que se actualiza, se llama a este método automaticamente. */
    public function updatingSearch(){    /* Con esto hacemos que cada vez que se actualice la variable 'search', se actualice la página (llevandole a la primera donde están todos los registros). */
        $this->resetPage();             /* Sin esta función, cuando nos situemos en una determinada página y hagamos la busqueda, esta busqueda solo se hará en la página en la que nos encontremos con los registros que están en ella.  */
    }
    
    public function render()
    {
        $users = User::where('name', 'LIKE', '%' .$this->search. '%')
        ->orwhere('email', 'LIKE', '%' .$this->search. '%')->paginate();                  /* Obtenemos la lista de usuarios paginado. */
       
        return view('livewire.admin.users-index', compact('users'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.users.index')->only('index');          /* Aquellos usuarios con el privilegio admin.users.index podrán acceder al método index. */
        $this->middleware('can:admin.users.edit')->only('edit', 'update');  /* Aquellos usuarios con el privilegio admin.users.edit podrán aceder al método edit y al método update. */
    }
   
    public function index()
    {
        return view('admin.users.index');   
    }

    
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles); /* Almacenamos nuevos valores en la tabla intermedia o eliminamos. */
        
        return redirect()->route('admin.users.edit', $user)->with('info', 'Se asignó los roles correctamente');
    }

}

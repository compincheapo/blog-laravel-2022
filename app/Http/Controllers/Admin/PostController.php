<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.posts.index')->only('index');        
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');        
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    
    public function create()
    {
        $categories = Category::pluck('name', 'id'); /* pluck trae de los objetos el valor del campo que le especificamos. */
                                                    /* El segundo parametro de pluck es el nuevo campo del arreglo que se creó. En el formato: {"id": "name", "id2": "name2"} */
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    
    public function store(PostRequest $request)
    {
        /* Storage::put('posts', $request->file('file')); */ /* El método put coloca las imágenes que se almacenan en la carpeta temporal en una carpeta ubicada en public/storage que especifiquemos. En $request->file('file') esta especificada la ruta de la carpeta temporal. */
        
        $post =  Post::create($request->all());
        
        if ($request->file('file')){                                /* Verificamos si el usuario subio una imagen. */
            $url = Storage::put('posts', $request->file('file'));   /* Guardamos en $url la nueva dirección que va a tener la imágen. */
            
            $post->image()->create([                                /* Llamamos al método image de Post permitiendo asociar a la relación polimorfica entre las dos entidades.  */
                'url' => $url                                       /* Con esto toma la url que necesita la tabla intermedia, el id del post que esta llamando a dicho método y el tipo (Post). */
            ]);                     
        }                         
            

        if($request->tags){                          /* Si del formulario tenemos información de etiquetas.    */
            $post->tags()->attach($request->tags);   /* Utilizamos el método tags() del modelo post para permitir el almacenamiento en la tabla intermedia de valores tipo: {post_id, tag_id}  */  
        }

        return redirect()->route('admin.posts.edit', compact('post'));
    }
    
    public function edit(Post $post)
    {
        $this->authorize('author', $post);      /* Llamamaos al método de PostPolicy y le pasamos el post en el que estamos actualmente. */

        $categories = Category::pluck('name', 'id'); 
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

   
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post);              /* Validamos el usuario que quiere actualizar un post. */

        $post->update($request->all());

        if ($request->file('file')){
           $url = Storage::put('posts', $request->file('file'));

            if ($post->image){                      /* Elimnamos la imagen vieja. */
                Storage::delete($post->image->url);

                $post->image->update([              /* Actualizamos el registro de la bd dandole la nueva url. */  
                    'url' => $url
                ]);
            }
            else
            {
                $post->image()->create([          /* En caso de ser la primera imagen, creamos el registro en la tabla de la bd. */
                    'url' => $url
                ]);
            }
        }

        if($request->tags){                          
            $post->tags()->sync($request->tags);     /* Con el método sync evitamos datos duplicados. Si la colección de etiquetas que le pasamos del formulario, no hay alguna seleccionada, esta se eliminará de la tabla. */
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizó con éxito.');

    
    }
    
    public function destroy(Post $post)
    {
        $this->authorize('author', $post);                  /* Validamos el usuario que quiere eliminar un post. */

        $post->delete();
        
        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó con éxito.');

    }

}

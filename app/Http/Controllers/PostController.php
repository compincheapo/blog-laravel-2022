<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('status', 2)->latest('id')->paginate(8); /* Buscamos posts con estado 2, latest ordena de forma descendente por el campo especificado como parametro */

        return view('posts.index', compact('posts')); /* Pasamos a la vista con el metodo compact */
    }

    public function show(Post $post){
        $this->authorize('published', $post);
        $similares = Post::where('category_id', $post->category_id) /* Obtenemos los psots de la misma categoria */
        ->where('status', 2)    
        ->where('id', '!=', $post->id)
        ->latest('id')                                              /* Ordenado de forma descendente por id (últimos posts creados)*/
        ->take(4)
        ->get();                                                   /* Toma 4 de ese total */
        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category){
        $posts = Post::where('category_id', $category->id)
        ->where('status', 2)                            /* Estado 2, posts publicados. */
        ->latest('id')
        ->paginate(6);

        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag){
        $posts = $tag->posts()->where('status',2)->latest('id')->paginate(4);
       
        return view('posts.tag', compact('posts', 'tag'));
    }
}

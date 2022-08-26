<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color'];

    public function getRouteKeyName() /* Hacemos que laravel utilice el slug para obtener las categorías. Por lo tanto, la ruta también cambia. */
    {
        return "slug";
    }
    
    //Relación muchos a muchos 

    public function posts(){            //Una etiqueta pertenece a muchos posts.
        return $this->belongsToMany(Post::class);
    }
    
}

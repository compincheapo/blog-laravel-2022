<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug']; /* Habilitamos campos para asignación masiva */

    public function getRouteKeyName() /* Hacemos que laravel utilice el slug para obtener las categorías. Por lo tanto, la ruta también cambia. */
    {
        return "slug";
    }
 
     //Relación uno a muchos.

     public function posts(){               //Una categoria pertenece a muchos posts.
        return $this->hasMany(Post::class); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];     //En la asignación masiva evitamos que estos campos se puedan llenar.Los demás campos no definidos aca se podrán llenar.

    //Relación uno a muchos inversa (Quien lleva el id)

    public function user(){                     //Un post pertenece a un usuario.
        return $this->belongsTo(User::class);
    }

    public function category(){                 //Un post pertenece a una categoria.
        return $this->belongsTo(Category::class);       
    }

    //Relación muchos a muchos
    public function tags(){                     //Un post pertenece a muchas etiquetas.
        return $this->belongsToMany(Tag::class);
    }

    //Relación uno a uno polimorfica (para no crear muchas tablas innecesarias de imagenes)

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}

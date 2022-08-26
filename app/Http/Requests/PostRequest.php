<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;    
    }
        

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $post = $this->route()->parameter('post'); /* Con esto obtenemos el post que actualmente queremos actualizar. */

       $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',              /* in solo permite que los valores que le especifiquemos sean los unicos a ingresar. */
            'file' => 'image'
        ];

        if ($post) {                                                /* Como en la vista create no tenemos una variable post, verificamos antes de modificar la regla. */
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }
        
       if($this->status == 2){
           $rules = array_merge($rules, [       /* array_merge sirve para unir dos arreglos (En este caso el arreglo $rules y el arreglo especificado abajo). */     
               'category_id' => 'required',     /* El estado 2 es para publicar un post, por lo tanto, es obligatorio los campos que estamos especificando. En caso de estado 1 que es borrador, no obligaremos. */
               'tags' => 'required',
               'extract' => 'required',
               'body' => 'required'
           ]);                     
       }

       return $rules; 
    }
}

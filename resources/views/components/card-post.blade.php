@props(['post']) {{-- Recibimos el elemento de la vista category. --}}

 <article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden"> {{-- Rounded redondea el elemento. Overflow-hidden oculta lo que está por encima del articulo (En este caso la imágen). --}}
    @if ($post->image)
        <img class="w-full h-72 object-cover object-center"src="{{Storage::url($post->image->url)}}" alt="">
    @else
    <img class="w-full h-72 object-cover object-center"src="https://cdn.pixabay.com/photo/2015/05/22/19/14/matt-779551_960_720.jpg" alt="">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show', $post)}}">{{$post->name}}</a>
        </h1>

        <div class="text-gray-700 text-base">
            {!!$post->extract!!} {{-- Con esta modificación hacemos que laravel no evite las etiquetas html que lo hace por defecto. --}}
        </div>
    </div>

    <div class="px-6 pt-4 pb-2">
        @foreach($post->tags as $tag)
            <a href="{{route('posts.tag', $tag)}}" class="inline-block bg-{{$tag->color}}-600 hover:bg-{{$tag->color}}-400 px-3 rounded-full text-sm text-white">{{$tag->name}}</a>
        @endforeach
    </div>
</article>
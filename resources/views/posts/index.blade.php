<x-app-layout>  {{-- Extendemos la plantilla principal --}}

    <div class="container py-8"> {{-- Utilizamos tailwind para los estilos --}}
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> {{-- Hacemos responsive con grid cols segun pantalla --}}
            @foreach($posts as $post)
                <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url(@if($post->image) {{Storage::url($post->image->url)}}@else https://cdn.pixabay.com/photo/2015/05/22/19/14/matt-779551_960_720.jpg @endif)"> {{-- Storage::url retorna la url blog.test/storage/public + la url especificada en image que le pasamos como parametro. En el if tomamos al primer article de la iteración y lo modificamos a gusto. --}}
                    <div class="w-full h-full px-8 flex flex-col justify-center">
                            
                        <div>
                            @foreach($post->tags as $tag)
                               <a href="{{route('posts.tag', $tag)}}" class="inline-block px-3 h-6 bg-{{$tag->color}}-600 text-white rounded-full hover:bg-{{$tag->color}}-400 ">{{$tag->name}}</a>
                            @endforeach
                        </div>
                        
                        <h1 class="text 4xl text-white leading-8 font-bold mt-2">
                            <a href="{{route('posts.show', $post)}}">
                                {{$post->name}}
                            </a>
                        </h1>
                    </div>                                                                    {{-- blog.test está ubicada en el archivo .env en 'app_url'--}}
                </article>                                                 
            @endforeach
       </div>

       <div class="mt-4">
            {{$posts->links()}}
       </div>
    </div>
</x-app-layout>
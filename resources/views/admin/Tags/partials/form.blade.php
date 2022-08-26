<div class="form-group">                    {{-- form-group da estilo al label y el input --}}
    {!! Form::label('name', 'Nombre') !!}   {{-- form-control le da estilo al input --}}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la etiqueta...']) !!}
    
    @error('name')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">                    
    {!! Form::label('slug', 'Slug') !!}   
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la etiqueta...', 'readonly']) !!}
    
    @error('slug')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {{-- <label for="">Color</label>

    <select name="color" id="" class="form-control">
        <option value="red">Color rojo</option>
        <option value="green">Color verde</option>
        <option value="blue" selected >Color azul</option>
    </select> --}}
    {!! Form::label('color', 'Color') !!}
    {!! Form::select('color', $colors, null, ['class' => 'form-control']) !!}    
   
    @error('color')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
@extends('layouts.app')

@section('content')
<div class="content">
    <div>
        <h1>Agregar Favorito</h1>
    </div>
    <form method="POST" id="form_fav">
        @csrf
        <div class="row">
            <div class="col">
                <div class="mb-3 ">
                    <label class="form-label" for="">URL</label>
                    <input class="form-control" name="url" type="url">
                </div>
            </div>
            <div class="mb-3 ">
                <label class="form-label" for="">Titulo</label>
                <input class="form-control" name="titulo" type="text">
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="form-label" for="">Visibilidad</label>
                    <select class="form-select" name="visibilidad" id="visibilidad">
                        <option value="">Seleccione</option>
                        <option value="1">Publico</option>
                        <option value="2">Privado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Categorias</label>
                    
                    <select class="form-select" name="categorias[]" id="categorias" multiple>
                        @foreach($categorias as $categorias)
                        <option value="{{$categorias->id}}">{{$categorias->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 ">
                    <label class="form-label" for="">Descripcion</label>
                    <textarea style="height: 100px ;" class="form-control" name="descripcion" type="text"></textarea>
                </div>
            </div>
        </div>
        <div>
            <button type="button" onclick="guardarfavorito()" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection
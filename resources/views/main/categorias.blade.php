@extends('layouts.app')
@section('content')
<div class="content">
    <div class="tittle">
        <h1>Categorias Categoria</h1>
    </div>
    &nbsp;
    <div class="row">
        <div class="col">
            <table class="table scroll" id="table_fav">
                <thead>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @if(count($categorias) > 0)
                    @foreach($categorias as $categorias)
                    <tr>
                        <td>{{$categorias->id}}</td>
                        <td>{{$categorias->nombre}}</td>
                        @if($categorias->estado == 1)
                        <td><button class="btn btn-primary" onclick="privado(<?php echo $categorias->id ?>)" >Publica</button></td>
                        @else
                        <td><button class="btn btn-success" onclick="publico(<?php echo $categorias->id ?>)">Privada</button></td>
                        @endif
                        <td><button onclick="editarcat(<?php echo $categorias->id ?>)" class="btn btn-warning">Editar</button>&nbsp;<button onclick="eliminarcat(<?php echo $categorias->id ?>)" class="btn btn-danger">Eliminar</button></td>
                       
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="6">No hay resultados</td>
                    </tr>
                    
                    @endif
                </tbody>
                
            </table>
        </div>
        <div class="col">
            <div class="tittle">
                <h3>Agregar Categoria</h3>
            </div>
            <form method="POST" id="form_cat">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="">Nombre</label>
                    <input class="form-control" name="nombre_categoria" id="nombre_categoria" type="text">
                </div>
                <div id="buttons">
                    <button type="button" onclick="guardarCategoria()" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
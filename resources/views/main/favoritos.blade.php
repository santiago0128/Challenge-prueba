@extends('layouts.app')
@section('content')
<?php


use Illuminate\Support\Facades\DB;
use App\Models\Categorias;

$categorias = Categorias::getcat();


?>
<div class="content">
    <div class="mb-4 text-center" style="padding-top: 25px;">
        <h1>Ver Favorito</h1>
    </div>
    <div>
        <table class="table scroll">
            <thead>
                <th>#</th>
                <th>Url</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Categorias</th>
                <th>Visibilidad</th>
                @guest

                @else
                <th>Acciones</th>
                @endguest
            </thead>
            <tbody>
                @foreach ($favoritos as $favoritos)
                <tr>
                    <td>{{ $favoritos->id }}</td>
                    <td>{{ $favoritos->url }}</td>
                    <td>{{ $favoritos->titulo }}</td>
                    <td>{{ $favoritos->descripcion }}</td>
                    <td> <?php
                            $cat = explode(";", $favoritos->categorias);
                            for ($i = 0; $i < count($cat); $i++) {
                                $cat2 = Categorias::getcatid($cat[$i]);
                                foreach ($cat2 as $key) {
                                    echo $key->nombre . " / ";
                                }
                            }
                            ?> </td>
                    <td>@if($favoritos->visibles == 1)
                        Publico
                        @else
                        Privado
                        @endif
                    </td>
                    @guest
                    
                    @else
                    <td><button onclick="veredicion()" class="btn btn-warning">Editar</button>&nbsp;&nbsp;<button id="noedicion" onclick="noedicion()" style="display: none;" class="btn btn-danger">X</button></td>
                    @endguest

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="form_edicion" class="form-edit">
        <div class="container">
            <h2>Edicion</h2>
        </div>
        <form method="POST" id="form_fav_edit">
            @csrf
            <div class="row">
                @foreach ($favorito as $favorito)
                <div class="col">
                    <div class="mb-3 ">
                        <label class="form-label" for="">URL</label>
                        <input class="form-control" name="url" type="url" value="{{$favorito->url}}">
                    </div>
                </div>
                <div class="mb-3 ">
                    <label class="form-label" for="">Titulo</label>
                    <input class="form-control" name="titulo" type="text" value="{{$favorito->titulo}}">
                </div>
                <div class=" col">
                    <div class="mb-3">
                        <label class="form-label" for="">Visibilidad</label>
                        <select class="form-select" name="visibilidad" id="visibilidad">
                            @if($favorito->visibles == 1){
                            <option value="1">Publico</option>
                            <option value="2">Privado</option>
                            }@else
                            <option value="2">Privado</option>
                            <option value="1">Publico</option>
                            }
                            @endif
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
                        <textarea style="height: 100px ;" class="form-control" name="descripcion" type="text">{{$favorito->descripcion}}</textarea>
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $favorito->id ?>">
                <button type="button" onclick="updatefavorito()" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
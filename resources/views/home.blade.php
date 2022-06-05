@extends('layouts.app')
@section('content')
<?php
use App\Models\Categorias;
?>
<div class="content">
    <div class="card" style="padding-top: 25px ;">
        <div class="mb-4 container">
            <h1>Favoritos</h1>
        </div>
        <div class="col container">
            <a href="{{ url('/add') }}" class="btn btn-success">Agregar</a>
        </div>
        &nbsp;
        <div class="row justify-content-center">
            <div class="col-md-12">

                <table class="table scroll" id="tables">
                    <thead>
                        <th>Url</th>
                        <th>Titulo</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($favoritos as $favoritos)
                        <tr>
                           
                            <td>{{ $favoritos->url }}</td>
                            <td>{{ $favoritos->titulo }}</td>
                            <td><a href="/verfav?id=<?php echo $favoritos->id ?>" type="button" class="btn btn-primary">Ver</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    &nbsp;
    <div class="card" style="padding-top: 25px ;">
        <div class="mb-4 container">
            <h1>Favoritos Publicos</h1>
        </div>

        &nbsp;
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table scroll" id="tablepublico">
                    <thead>
                        <th>Url</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Categorias</th>
                    </thead>
                    <tbody>

                        @foreach ($favoritospublicos as $favoritospublicos)
                        <tr>
                            <td>{{ $favoritospublicos->url }}</td>
                            <td>{{ $favoritospublicos->titulo }}</td>
                            <td>{{ $favoritospublicos->descripcion }}</td>
                            <td> <?php $cat = explode(";", $favoritospublicos->categorias);
                                    for ($i = 0; $i < count($cat); $i++) {
                                        $cat2 = Categorias::getcatid($cat[$i]);
                                        foreach ($cat2 as $key) {
                                            echo $key->nombre . " / ";
                                        }
                                    }
                                    ?> </td>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\Categorias;

class ControllerFavoritos extends Controller
{
    public function add()
    {
        $id = Auth::id();
        $estado = 1;
        $categorias = Categorias::getcat();
        return view('main.add')->with('categorias', $categorias)
            ->with('usuario', $id);
    }

    public function addFavorito()
    {
        $url = $_POST['url'];
        $titulo = $_POST['titulo'];
        $visibilidad = $_POST['visibilidad'];
        $categorias = $_POST['categorias'];
        $descripcion = $_POST['descripcion'];
        $categorias = Favorito::insertfav($url, $titulo, $visibilidad, $categorias, $descripcion);
        return $categorias;
    }

    public function verfav()
    {
        $id = $_GET['id'];
        $favorito = Favorito::selectfavid($id);
        return view('main.favoritos')->with('favoritos', $favorito)->with('favorito', $favorito);
    }
    public function editForm()
    {
       $url= $_POST['url'];
       $titulo= $_POST['titulo'];
       $visibilidad= $_POST['visibilidad'];
       $descripcion= $_POST['descripcion'];
       $categorias= $_POST['categorias'];
       $id= $_POST['id'];
       $fav = Favorito::updatefav($url, $titulo, $visibilidad, $categorias, $descripcion, $id);
       return $fav;
    }
}

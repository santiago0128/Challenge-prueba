<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorias;

class ControllerCategorias extends Controller
{
    public function Categorias()
    {
        $categorias = Categorias::getcat();
        return view('main.categorias')->with('categorias',$categorias);
    }

    public function addCategoria()
    {
       $categoria_nombre = $_POST['nombre_categoria'];
       $id = Auth::id();
       $categorias = Categorias::insertcategoria($categoria_nombre, $id);
       return $categorias;

    }
    public function editCat()
    {
        $id = $_POST['id'];
        $categorias = Categorias::getcatid($id);
        return $categorias;

    }
    public function updateCat()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categorias = Categorias::updateCat($id, $nombre);
        return $categorias;

    }
    public function deletecat()
    {
        $id = $_POST['id'];
        $categorias = Categorias::deletecat($id);
        return $categorias;
    }
    public function deleteCategoria()
    {
       $categoria_nombre = $_POST['nombre_categoria'];
       $id = Auth::id();
       $categorias = Categorias::insertcategoria($categoria_nombre, $id);
       return $categorias;

    }
    public function getCat()
    {
        $categorias = Categorias::getcat();
        return $categorias;

    }
    public function publico()
    {
        $id = $_POST['id'];
        $categorias = Categorias::publico($id);
        return $categorias;

    }
    public function privado()
    {
        $id = $_POST['id'];
        $categorias = Categorias::privado($id);
        return $categorias;

    }
}

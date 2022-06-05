<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Favorito
{
   public static function insertfav($url, $titulo, $visibilidad, $categorias, $descripcion)
   {
      $categorias = implode(";", $categorias);
      $id = Auth::id();
      DB::table('favoritos')->insert(['url' => $url, 'titulo' => $titulo, 'descripcion' => $descripcion, 'categorias' => $categorias, 'visibles' => $visibilidad, 'usuarios' => $id]);
      return 1;
   }
   public static function updatefav($url, $titulo, $visibilidad, $categorias, $descripcion, $id)
   {
      $categorias = implode(";", $categorias);
      $categorias = DB::table('favoritos')
         ->where('id', $id)
         ->update(['url' => $url, 'titulo' => $titulo, 'descripcion' => $descripcion, 'categorias' => $categorias, 'visibles' => $visibilidad]);
      return 1;
   }

   public static function selectCategoriafav($id)
   {

      $categorias = DB::table('categorias')->where('id', $id)->get();
      return $categorias;
   }
   public static function selectfavid($id)
   {

      $favorito = DB::table('favoritos')->where('id', $id)->get();
      return $favorito;
   }
}

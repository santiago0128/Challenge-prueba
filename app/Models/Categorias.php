<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Categorias 
{
   public static function insertcategoria($nombre, $id){
       
     DB::insert('insert into categorias (nombre, estado, usuario) values (?, ?, ?)', [$nombre, 1, $id]);
     return 1;
      
   }
   public static function getcat(){
       
    $categorias = DB::table('categorias')->get();
    return $categorias;
      
   }
   public static function getcatbyusu($id){
       
    $categorias = DB::table('categorias')->where('usuario', $id)->get();
    return $categorias;
      
   }
   public static function getcatbyestado(){
       
    $categorias = DB::table('categorias')->where('estado', 1)->get();
    return $categorias;
      
   }
   public static function getcatid($id){
       
    $categorias = DB::table('categorias')->select('nombre','id')->where('id', $id)->get();
    return $categorias;
      
   }
   public static function deletecat($id){
       
    $categorias = DB::table('categorias')->where('id', $id)->delete();
    return 1;
      
   }
   public static function updateCat($id, $nombre){
       
    $categorias = DB::table('categorias')
    ->where('id', $id)
    ->update(['nombre' => $nombre]);
    return 1;
      
   }
   public static function privado($id){
       
    $categorias = DB::table('categorias')
    ->where('id', $id)
    ->update(['estado' => 2]);
    return 1;
      
   }
   public static function publico($id){
       
    $categorias = DB::table('categorias')
    ->where('id', $id)
    ->update(['estado' => 1]);
    return 1;
      
   }

     
}

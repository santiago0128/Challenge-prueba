<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $favoritos = DB::table('favoritos')->where('usuarios', $id)->get();
        $favoritospublicos = DB::table('favoritos')->where('visibles', 1)->orderByDesc('id')->get();
        return view('home')->with('favoritos', $favoritos)->with('favoritospublicos', $favoritospublicos);
      
    }
}

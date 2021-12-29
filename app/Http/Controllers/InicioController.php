<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //Obtener las recetas mas nuevas( Los querys para databases en la documentacion, se pueden usar con los modelos)    

    public function index(){

       // $nuevas = Receta::orderBy('created_at','DESC')->get(); //Traera los mas nuevos, es decir de forma decendente
      // $nuevas = Receta::latest()->get();  //lo mismo, pero solo fuciona cuando el created_at (campo que e crea automaticamente y se llena al usar los modelos) tiene algo
      // $nuevas = Receta::oldest()->get();  //es como el latest(funciona con el created) y me trae losmas viejos, es decir, los primeros que se an agregado
        $nuevas = Receta::latest('created_at')->limit(5)->get(); //tambien, hace lo mismo, pero adentro va de la columna que va a  tomar para ordenar 
        return $nuevas;
        return view('inicio.index');
    }
}

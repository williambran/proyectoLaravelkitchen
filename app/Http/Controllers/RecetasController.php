<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);  //lo que hace es proteger las funciones, y que solo funcionen cuando estn autenticada -- Va a proteger todos los metodos, excepto show
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Auth::user()->recetas->dd();
      // $recetas = auth()->user()->recetas;   //otra forma de trer las recetas, con relacion tinker (sirve para traer todas las recetas)

      // traer las recetas con paginacion (tenemos uqe moverle al view)
      $usuario = auth()->user();
      $recetas = Receta::where('user_id',$usuario->id)->paginate(5);  //paginate es metodo que se usa con el modelo, no con elokuens, por eso no sirve con la forma que se hace arriba, se cambia en el viewy se agrega el links al final
      //$usuario = auth()->user();
        return view('recetas.index')->with('recetas',$recetas)->with('usuario',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //una forma de sacar datos, desde el controller
        // DB::table('categoria_receta')->get()->pluck('nombre','id')->dd();
       
        //obtener categorias sin moelo. Directo de la base de datos
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');

       // CategoriaReceta::all(['id', 'nombre'])->dd();
     $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // dd($request['imagen']->store('upload-recetas','public'));
        //$request es la inforacion que vendra del input en la pagina
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);  // es el valor que viene de la funcion store

        //optener la rua de la imagen aplicandole el metodo storage para que nos de la ruta del servidor
        $ruta_imagen = $request['imagen']->store('upload-recetas','public');

        //importamos y usamos la clase Image de libreria intervation
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(550,550);

        $img->save();
//Se inserta a la base (ain usar modelo)
      //  DB::table('recetas')->insert([
            //'titulo'=> $data['titulo'],
          //  'ingredientes' => $data['ingredientes'],
        //    'user_id' => Auth::user()->id,
      //      'categoria_id' => $data['categoria'],
    //        'imagen' => $ruta_imagen,
  //          'preparacion' => $data['preparacion']
//
//
    //    ]);


    //Se agregaa la tabla recetas desde el metodo recetas, del user, pero da error, se debe de especificar en el modelo recetas que se van a meter esos atributos, con esto, en las tablas ya se agregara las fechas y actualizaciones
    Auth()->user()->recetas()->create([
            'titulo'=> $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']
            
            
    ]);



        return redirect()->action('RecetasController@index'); //se reedirecciona por medi del contrlador, no por router, si no por action


       // dd($request->all() );  //Funcion para volcar inf de una variable a la web
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        // Cuando entre a una receta por id, que le enseñe la receta especificada por el id
         $receta = Receta::findOrFail($id);
   //   dd($receta);

   //Se valida si esta autenticado, si si entoces valida si en sus reetas asignadas al usuario por medio de la relacion  belongstoMany a belongtoMany si tiene la receta que se va a mostrar
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;
        $onSession = (auth()->user()) ? true : false;

    //pasar la antidad de likes a la vista
       $likes = $receta->likes()->count();

        return view('recetas.show', compact('receta', 'like', 'likes','onSession') );
        
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //validar que solo el propietario puedea editarlo con ayuda de Policy

       
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        $receta = Receta::findOrFail($id);
        $this->authorize('view',$receta);  //sacamos la receta por el id, y se lo enviamos al policy para comprobar si es del usuario la receta a editar 
       // dd($receta);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request,en el reuqest va la informacion a acualizar 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //revisamos que se cumpla el policy
        $receta = Receta::findOrFail($id);
        $this->authorize('update', $receta);

        //validamos en la actualizacion de la receta
        $data= $request->validate([
            'titulo'=>'required|min:6',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'categoria' =>'required '
        ]);
     
        //Asignacion de valores
        
        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];
        //$receta->ingredientes = $data['ingredientes'];
        //$receta->categoria = $data['categoria'];


        //si el usuario edita la imagen
        if(request('imagen')){
        //optener la ruta de la imagen aplicandole el metodo storage para que nos de la ruta del servidor
        $ruta_imagen = $request['imagen']->store('upload-recetas','public');

        //importamos y usamos la clase Image de libreria intervation
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(550,550);

        $img->save();

        //asignamos 
        $receta->imagen = $ruta_imagen;
        }

        $receta->save();
        return redirect()->action('RecetasController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receta = Receta::findOrFail($id);
        //Ejecutar el policy
        $this->authorize('delete',$receta);
        $receta->delete();
        
        return redirect()->action('RecetasController@index');

    }
}

<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        //valida que tenes que esta con una sesion para poder editar,a nuestro usuario. solo podemos ver perfiles sin iniciar sesion
        $this->middleware('auth', ['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Mostrar perfiles
        return view('perfiles.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //aqui se va a bloquear la vista con ayuda del policy  para uausarios que no sean su formulario a editar
        $this->authorize('view',$perfil);

        //se usa el 'perfiles.edit' de .web
        return view('perfiles.edit',compact('perfil'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //ejecutar la validacion del policy
        $this->authorize('update', $perfil);
       
        //validar(hace que se marque en rojo as casillas del los imputs)
        $data = request()->validate([
            'nombre'=> 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);
        

        //si el usuario sube una imagen

        if($request['imagen']){
            //optener la rua de la imagen aplicandole el metodo storage para que nos de la ruta del servidor
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

             //importamos y usamos la clase Image de libreria intervation
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);

             $img->save();


             //Crar un arrego
             $array_imagen = ['imagen' => $ruta_imagen];
        }

        //Asignar nombre y URL
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

       //Asignar Biografia e imagen, por que no todo esta en una sola tabla
       // No se puede hacer esto, se debe de eliminar eliminar los elementos de $data que no se inlutyen en esta segunda tabla de la siguiente manera
       // auth()->user()->perfil() = $data['biografia'];
       
       unset($data['url']);
       unset($data['nombre']);

        //Asignamos bio
        auth()->user()->perfil()->update( array_merge(

            $data,
            $array_imagen ?? []
        ));

        //Guardar informacion


        //Redireccionar

        return redirect()->action('RecetasController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}

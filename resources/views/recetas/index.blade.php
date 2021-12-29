@extends('layouts.app')

@section('botones')

{{--aqui iban los botones, se llevaron a views/ui/navegacion --}}
@include('ui.navegacion')

@endsection



<!-- Se pone adentro de un  section para que aparesca abajo del navigation, dado que aravel nos da el @yiel para que todo aparezca abajo de eso, pero hay que especificarlo-->
@section('content')   
<h2 class="text-center mb-5">Administra tus recetas</h2>


<div class="col-md-10 mx-auto bg-white p-3 shadow">
   <table class="table">
      <thead class="bg-primary text-light">
          <tr>
              <th scole ="col">Titulo</th>
              <th scole ="col">Categoria</th>
              <th scole ="col">Acciones</th>


          </tr>
      </thead>

      <tbody>
          

            @foreach ($recetas as $receta)
            <tr>
                 <td> {{$receta->titulo}} </td>
                 <td> {{$receta->categoria->nombre}} </td>
                 <td>
                   <!-- Eliminar recetas  -->
               <!--   <form action="{{route('recetas.destroy', ['receta' => $receta->id ]) }}" method="POST">   -->
               <!--          @csrf   -->
               <!--         @method('DELETE') -->
               <!--         <input type="submit" class="btn btn-danger  mr-1" value="Eliminar &times;">  -->
               <!--     </form>   -->
               
               <!-- Eliminar receta con Vue, que sustituye lo de arriba -->
                <eliminar-receta
                    receta-id = {{$receta->id}}>
                 </eliminar-receta>
                    <a href="{{route('recetas.edit', ['reseta' => $receta->id]) }}" class="btn btn-dark mr-1">Editar</a>
                    <a href="{{route('recetas.show', ['reseta' => $receta->id]) }}" class="btn btn-success mr-1">Ver</a>
                 </td>


            </tr>    
            @endforeach
 
      </tbody>
    </table>
    <div class="col-12 mt-4 justify-content-center d-flex">
        {{$recetas->links()}}  {{-- Esto es para la paginacion--}}

    </div>
    <h2 class="text-center my-5"> Recetas que te gustan </h2>
    <div class="col-md mx-auto bg-white p-3">

        @if(count($usuario->meGusta) > 0)
        <ul class="list-group">
            @foreach($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{$receta->titulo}}</p>
                    <a class="btn btn-outline-success" href="{{route('recetas.show', ['reseta'=>$receta->id])}}"> Ver</a>
                </li>
            @endforeach

        </ul>
        @else
        <p class="text-center">Aun no tienes recetas que te gustan
            <small>Ponte bozo caperuzo</small>
        </p>


        @endif


    </div>
</div>




@endsection
<!-- colocamos directiva de codigo php o laravel , quien sabe-->




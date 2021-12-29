@extends('layouts.app')


@section('content')


<!--<h1>{{$receta}}</h1>-->



<article class="contenido-receta shadow "style="border-radius: 20px;">
    <h1 class="text-center mb-4 ">{{$receta->titulo}}</h1>
   
   
    <div class="imagen-receta ml-3 mr-3 mt-3">
        <img src="/storage/{{$receta->imagen}}" class="w-100" style="border-radius: 20px;"> <!-- esta clase de boostrap-->
    </div>


    <div class=""></div>
    <div class="receta-meta mt-2 ml-4">


        <p>
            <span class="font-weigth-bold text-primary ml-3"> Escrito en: </span>
            {{$receta->categoria->nombre}}
        </p>

        <p>
            <span class="font-weigth-bold text-primary ml-3"> Autor: </span>
          <!-- TODO: mostrar usuario-->
            {{$receta->autor->name}}
        </p>



        <p>
            <span class="font-weigth-bold text-primary ml-3"> Fecha: </span>
          <!-- TODO: mostrar usuario-->
          @php
              
              $fecha = $receta->created_at

          @endphp
              <fecha-receta fecha='{{$fecha}}'></fecha-receta>

        </p>


        

        <div class="ingredientes">
            <h2 class="my-3 text-primary ml-3">Ingredientes</h2>
            {!! $receta->ingredientes !!} <!--para no imprimir codigo html que estan guardados en la base de datos, ponemos !!  !!  y sin una s llaves {}-->
        </div>

        <div class="preparacion ml-3">
            <h2 class="my-3 text-primary ">Preparacion</h2>
            {!! $receta->preparacion !!} <!--para no imprimir codigo html que estan guardados en la base de datos, ponemos !!  !!  y sin una s llaves {}-->
        </div>

        <div class="justify-content-center row text-center">

            @if($onSession)
            <like-button
            receta-id= "{{$receta->id}}"
            like = "{{$like}}"   {{--lo pasamos como true(1), si no hay nada como un false--}}
            likes = {{$likes}}
            
            ></like-button>   
            @endif
        </div>

       

             
       


    </div>
</article>

@endsection 
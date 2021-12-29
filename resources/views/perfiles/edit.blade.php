@extends('layouts.app')



@section('styles')
  <!--Aqui se cargarian las hojas de estilos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
  


@section('botones')

<a href="{{route('recetas.index')}} " class="btn btn-primary mr-2">
    <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
      </svg>
    Volver</a>

@endsection



@section('content')  
        {{$perfil}}
        {{$perfil->usuario}}
        <h1 class="text-center">Edita mi perfil</h1>

        <div class="row justify-content-center mt-5">
            <div class="col-md-10 bg-white p3">
                <form  
                action="{{route('perfiles.update',['perfil' => $perfil->id])}}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        placeholder="Tu nombre"
                        value="{{$perfil->usuario->name}}"
                        >
  
                        @error('nombre')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
  
                        @enderror
                      </div>



                      <div class="form-group">
                        <label for="url">Sitio Web </label>
                        <input type="text"
                        name="url"
                        class="form-control @error('url') is-invalid @enderror"
                        id="url"
                        placeholder="Tu Sitio Web"
                        value="{{$perfil->usuario->url}}"
                        >
  
                        @error('url')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
  
                        @enderror

                      </div>




                      <div class="form-group mt-5">
                        <label for="biografia">Biografia</label>
                        <input 
                        type="hidden"
                        name="biografia"
                        id="biografia"
                        value="{{$perfil->biografia}}"
                        >
                        <trix-editor 
                        input="biografia"
                        class="form-control @error('biografia') is-invalid @enderror"

                        ></trix-editor>

                        @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>




                    <div class="form-group mt-4">
                        <label for="imagen">Tu Imagen</label>

                        <input 
                        id="imagen"
                        type="file"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen" 
                        
                        >

                      <!--  <img src=" " width="150px" height="120" id="imagePreview"> -->
                       <!-- <img id="imagePreview"/>  -->

                       @if($perfil->imagen)

                       <div class="mt-4">
                             <p>Imagen Actual: </p>
                            <img src="/storage/{{$perfil->imagen}}" style="width: 300px">

                        </div>

                        @error('imagen')
                             <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                             </span>
                        @enderror
                           
                       @endif

                    </div>
                

                <div class="form-group"> 
                  <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                </div>


                </form>
            </div>
        </div>
@endsection



@section('scripts')
        <!--Aqui se cargarian las scripts  -- "defer" se agrega para que se habilite la barra de l trix, el defer nos permite descargar de forma asyncrona el scrip y ejecutarlo al final deacuerdo al orede que aparecen en el html-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
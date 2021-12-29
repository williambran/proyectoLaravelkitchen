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
<!-- Se pone adentro de un  section para que aparesca abajo del navigation, dado que aravel nos da el @yiel para que todo aparezca abajo de eso, pero hay que especificarlo-->
@section('content')    
   <h2 class="text-center mb-5">Crear Nueva Receta</h2>

   

      <div class="row justify-content-center mt-5"> <!-- etiqueta boostrap-->
          <div class="col-md-8">   <!-- etiqueta boostrap-->
              <form method= "POST" action="{{ route('recetas.store')}}" enctype="multipart/form-data" novalidate>
                @csrf
                    <div class="form-group">
                      <label for="titulo">Titulo Receta</label>
                      <input type="text"
                      name="titulo"
                      class="form-control @error('titulo') is-invalid @enderror"
                      id="titulo"
                      placeholder="Titulo Receta"
                      value={{old('titulo')}}
                      >

                      @error('titulo')
                          <span class="invalid-feedback d-block" role="alert">
                              <strong>{{$message}}</strong>
                          </span>

                      @enderror


                    </div>
                    <div class="from-group">
                        <label for="categoria">Categoia</label>
                        
                        <select 
                        name="categoria"
                        class="form-control @error('categoria') is-invalid @enderror"
                        id="categoria"
                        > 
                        <option value="">-- Seleccione -</option>
                             @foreach($categorias as $categoria)
  
                               <option value="{{$categoria->id}}" {{old('categoria') == $categoria->id ? 'selected': ''}}>{{$categoria->nombre}}</option>
                            @endforeach
                        </select>

                        @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror


                        <div class="form-group mt-5">
                            <label for="preparacion">Preparacion</label>
                            <input 
                            type="hidden"
                            name="preparacion"
                            id="preparacion"
                            value="{{old('preparacion')}}">
                            <trix-editor 
                            input="preparacion"
                            class="form-control @error('preparacion') is-invalid @enderror"
                            ></trix-editor>

                            @error('preparacion')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="form-group mt-5">
                            <label for="ingredientes">Ingredientes</label>
                            <input 
                            type="hidden"
                            name="ingredientes"
                            id="ingredientes"
                            value="{{old('ingredientes')}}">
                            <trix-editor 
                            input="ingredientes"
                            class="form-control @error('ingredientes') is-invalid @enderror"

                            ></trix-editor>

                            @error('ingredientes')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group mt-4">
                            <label for="imagen">Imagen</label>

                            <input 
                            id="imagen"
                            type="file"
                            class="form-control @error('imagen') is-invalid @enderror"
                            name="imagen" 
                            onchange="filePreview(this);"
                            >

                            <label for="kakas">la imagen</label>

                          <!--  <img src=" " width="150px" height="120" id="imagePreview"> -->
                           <!-- <img id="imagePreview"/>  -->
                           <div id="imagePreview">

                           </div>

                        

                            @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>




                    </div>
                    <div class="form-group"> 
                      <input type="submit" class="btn btn-primary" value="Agregar Receta">
                    </div>

              </form>

          </div>
      </div>

@endsection

@section('scripts')
        <!--Aqui se cargarian las scripts  -- "defer" se agrega para que se habilite la barra de l trix, el defer nos permite descargar de forma asyncrona el scrip y ejecutarlo al final deacuerdo al orede que aparecen en el html-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>





 
    
@endsection
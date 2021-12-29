@extends('layouts.app')
@section('styles')
  <!--Aqui se cargarian las hojas de estilos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
  

@section('botones')

<a href="{{route('recetas.index')}} " class="btn btn-primary mr-2">Crear Receta</a>

@endsection
<!-- Se pone adentro de un  section para que aparesca abajo del navigation, dado que aravel nos da el @yiel para que todo aparezca abajo de eso, pero hay que especificarlo-->
@section('content')    
   <h2 class="text-center mb-5">Editar Receta: {{$receta->titulo}}</h2>

   
{{$receta}}
      <div class="row justify-content-center mt-5"> <!-- etiqueta boostrap-->
          <div class="col-md-8">   <!-- etiqueta boostrap-->
              <form method= "POST" action="{{ route('recetas.update',['receta'=> $receta->id])}}" enctype="multipart/form-data" novalidate>
                @csrf
<!-- -El metodo put no es soportado por html, asi que se le pone esta directiva de put aunque sea un post-->
                @method('put')
                    <div class="form-group">
                      <label for="titulo">Titulo Receta</label>
                      <input type="text"
                      name="titulo"
                      class="form-control @error('titulo') is-invalid @enderror"
                      id="titulo"
                      placeholder="Titulo Receta"
                      value="{{$receta->titulo}}">

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
  
                               <option value="{{$categoria->id}}" {{$receta->categoria_id == $categoria->id ? 'selected': ''}}>{{$categoria->nombre}}</option>
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
                            value="{{$receta->preparacion}}">
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
                            value="{{$receta->ingredientes}}">
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
                           <div class="mt-4">
                               <p>Imagen Actual: </p>
                               <img src="/storage/{{$receta->imagen}}" style="width: 300px" >

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
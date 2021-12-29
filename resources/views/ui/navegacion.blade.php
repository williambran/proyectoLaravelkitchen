
{{--Estas son las vistas--}}
<a href="{{route('recetas.create')}} " class="btn btn-primary mr-2">
    <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
    Crear Receta</a>
{{-- <a href="{{route('perfiles.edit',['perfil'=>$usuario->id])}} " class="btn btn-success mr-2">Editar Perfil</a> lo mismo de abajo pasandole el parametro de $usuario --}}
<a href="{{route('perfiles.edit',['perfil'=>auth()->user()->id])}} " class="btn btn-outline-success mr-2 text-uppercase dont-weight-bold">
    <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
      </svg>
    Editar Perfil</a>
<a href="{{route('perfiles.show',['perfil'=>$usuario->id])}} " class="btn btn-info mr-2" >
    <svg class="icono" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    Ver Perfil</a>
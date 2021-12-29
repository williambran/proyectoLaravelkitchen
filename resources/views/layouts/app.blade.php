<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts  El defer no-->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
@yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links , guest, valida si esta autenticaod -->
                        @guest     
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <!-- De mi usuario sacame el nombre nomas-->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}   
                                </a>
                                {{-- Aqui se ve el boton drop para ver perfio y cerrar sesion--}}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('perfiles.show',['perfil'=>auth()->user()->id])}}">
                                        {{ ('Ver perfil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('recetas.index')}}">
                                        {{ ('Ver Recetas') }}
                                    </a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5 ">
            <div class="row">
                @yield('botones')
            </div>

            <main class="py-4 mt-5 col-12">
                @yield('content')
            </main>

        </div>

    </div>
    @yield('scripts')

    <script>

        //este script era para el preview de imagenes pero no sirve
    $(document).on("change", "#imagen", function(input) {
     //   console.log(this.files);
        var files = input.files;
        var element = files;
        var supportedImages = ["image/jpeg", "image/png"]
        var reader = new FileReader();

        reader.onload = function(e){
                      //  $('#imagePreview').attr('src', e.target.result).width(200).height(150);   // Funciona usando el <img> y le pasamos los parametros
                      
                        $('#imagePreview').html("<img src='"+e.target.result+"' width= '80' height='65' '/> ");   // Funciona usando el <div>

                    }
        
                    reader.readAsDataURL(input.files[0]);
    })
    </script>



    <script>
    //    function createPreview(file) {
        //    var imgCodified = URL.createObjectURL(file);
        //    var img =  imgCodified

    //    let reader = new FileReader();

    //    reader.readAsDataURL(file)
    //    reader.onload = function() {
    //        let previe = document.getElementById('preview'), image = document.createElement('img');
    //        $('#imagePreview').append(image);
    //    }
    //    }
   // </script>

<script>
    function filePreview(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
              //  $('#imagePreview').attr('src', e.target.result).width(200).height(150);   // Funciona usando el <img> y le pasamos los parametros

                $('#imagePreview').html("<img src='"+e.target.result+"' width= '180' height='165' '/> ");   // Funciona usando el <div>

            }
            reader.readAsDataURL(input.files[0]);
        }
    } 

//        $("#imagen").change(function(){
//           filePreview(this);
//     });

</script>
    
</body>
</html>

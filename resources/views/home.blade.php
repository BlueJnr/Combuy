@extends('layouts.app')

@section('content')

    <div class="myslide">
        <div class="slider-wrapper theme-mi-slider">
            <div id="slider" class="nivoSlider">
                <img src="image/im1.jpg" alt="" title="#htmlcaption1" />
                <img src="image/im2.jpg" alt="" title="#htmlcaption2" />
                <img src="image/im3.jpg" alt="" title="#htmlcaption3" />
            </div>
            <div id="htmlcaption1" class="nivo-html-caption">
                <h1>Sean Bienvenidos</h1>
            </div>
            <div id="htmlcaption2" class="nivo-html-caption">
                <h1>Acerca de Nosotros</h1>
            </div>
            <div id="htmlcaption3" class="nivo-html-caption">
                <h1>Gracias por visitar</h1>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
    @endif
    <div class="mycaja">
        <div class="caja">
            <img src="image/sidebar_usuario-corporativo.png" >
            <h2 class="h2">USUARIO</h2>
            <h2> {{ Auth::user()->username }}  </h2>
            <button type="submit" class="bdiv ">Editar</button>
        </div>
        <div class="caja">
            <h2>Información Personal</h2>
            <h2 class="h2">NOMBRE</h2>
            <h2>{{ Auth::user()->name }}</h2>
            <h2 class="h2">APELLIDO</h2>
            <h2>{{ Auth::user()->lastname }}</h2>
            <p class="pdiv">
               
            </p>
            <a href="{{ url('usuario')}}">
            <button type="submit" class="bdiv ">Editar</button>
            </a>
           
        </div>
        <div class="caja">
            <h2>Información de mi negocio</h2>
            <h2 class="h2">NOMBRE</h2>
            <h2>{{ Auth::user()->name }}</h2>
            <h2 class="h2">APELLIDO</h2>
            <h2>{{ Auth::user()->lastname }}</h2>
            <p class="pdiv">
                
            </p>
            <a href="{{ url('empresa')}}">
            <button type="submit" class="bdiv ">Editar</button>
            </a>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.nivo.slider.js"></script>
     <script type="text/javascript">
        $(window).on('load', function() {
            $('#slider').nivoSlider();
        });
    </script>

@endsection


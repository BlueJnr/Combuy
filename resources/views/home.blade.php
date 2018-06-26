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
                <h1>Sean Bienvenidos a COMBUY</h1>
            </div>
            <div id="htmlcaption2" class="nivo-html-caption">
                <h1>Vende ya! </h1>
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
    <div class="mycaja" >
        <div class="caja" style="padding: 40px 10px;">
            <img src="image/sidebar_usuario-corporativo.png" >
            <h2 class="h2">USUARIO</h2>
            <h2> {{ Auth::user()->username }}  </h2>
            <a href="{{ url('/datauser')}}"> 
            <button type="submit" class="bdiv ">Editar</button>
            </a>
        </div>
        <div class="caja">
            <h1>INFORMACIÓN PERSONAL</h1>
            <h2 class="h2">Nombre</h2>
            <h2>{{ Auth::user()->name }}</h2>
            <h2 class="h2">Apellido</h2>
            <h2>{{ Auth::user()->lastname }}</h2>
            <p class="pdiv">
               
            </p>
            <a href="{{ url('usuario')}}"> 
            <button type="submit" class="bdiv ">Editar</button>
            </a>
           
        </div>
        <div class="caja">
            <h1>INFORMACIÓN PERSONAL</h1>
            <h2 class="h2">Descripción</h2>
            <h2>{{ $dato->descripcion }}</h2>
            <h2 class="h2">TELÉFONO</h2>
            <h2>{{ $dato->telefono }}</h2>
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


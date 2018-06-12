@extends('layouts.app')

@section('content')
@if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
@endif
<div class="caja">
            <img src="image/sidebar_usuario-corporativo.png" >
            <h2 class="h2">NOMBRE</h2>
            <h2>{{ Auth::user()->name }}</h2><h2>{{ Auth::user()->lastname }} </h2>
            <h2 class="h2">USUARIO</h2>
            <h2> {{ Auth::user()->username }}  </h2>
            <button type="submit" class="bdiv ">Editar</button>
        </div>
        <div class="caja">
            <h3>Información Personal</h3>
            <p class="pdiv">
               
            </p>
            <button type="submit" class="bdiv ">Editar</button>
        </div>
        <div class="caja">
            <h3>Información de mi negocio</h3>
            <p class="pdiv">
                
            </p>
            <a href="{{ url('empresa')}}">
            <button type="submit" class="bdiv ">Editar</button>
            </a>

        </div>

@endsection

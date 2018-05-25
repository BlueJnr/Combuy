@extends('layouts.app')

@section('content')
<div class="caja">
            <img src="image/sidebar_usuario-corporativo.png" >
            <h2 class="h2">NOMBRE</h2>
            <h2>{{ Auth::user()->id }}</h2><h2>{{ Auth::user()->lastname }} </h2>
            <h2 class="h2">USUARIO</h2>
            <h2> {{ Auth::user()->username }}  </h2>
            <button type="submit" class="bdiv ">Editar</button>
        </div>
        <div class="caja">
            <h3>Información Personal</h3>
            <p class="pdiv">
                Velit incurreret quibusdam. Quo ut despicationes. Officia do litteris. Nisi ut
                appellat. Hic te velit singulis, dolor admodum transferrem, ut offendit id
                eiusmod, se fore fabulas iis quae ad excepteur se occaecat o cernantur ita
                eiusmod nulla tempor incididunt iis pariatur legam nostrud laborum. Sint sed
                ullamco, e legam expetendis tractavissent.
            </p>
            <button type="submit" class="bdiv ">Editar</button>
        </div>
        <div class="caja">
            <h3>Información de mi negocio</h3>
            <p class="pdiv">
                Velit incurreret quibusdam. Quo ut despicationes. Officia do litteris. Nisi ut
                appellat. Hic te velit singulis, dolor admodum transferrem, ut offendit id
                eiusmod, se fore fabulas iis quae ad excepteur se occaecat o cernantur ita
                eiusmod nulla tempor incididunt iis pariatur legam nostrud laborum. Sint sed
                ullamco, e legam expetendis tractavissent.
            </p>
            <a href="{{ url('empresa')}}">
            <button type="submit" class="bdiv ">Editar</button>
            </a>

        </div>

@endsection

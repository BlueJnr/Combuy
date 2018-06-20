@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}
{!!Html::style('css/style.css')!!}


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="myform-top">
                <h3>Datos Personales</h3>
                </div>
                <div id="mensaje">
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                </div>
                <div id="mensaje_error">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
                <div class="myform-bottom">
                    <form role="form" action="{{ route('usuarioedit')}}" method="post" class="">
                    {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                             <div class="gr1 form-group">
                                <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Nombres..." class="form-control" id="name" autofocus>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">

                            <div class="gr1 form-group">
                            <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" placeholder="Apellidos..." class="form-control" id="lastname" >
                             </div>
                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">

                            <div class="gr1 form-group">
                            <input type="text" readonly="readonly" name="dni" value="{{ Auth::user()->dni }}" placeholder="DNI..." class="form-control" id="dni" >
                            </div>
                            @if ($errors->has('dni'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dni') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="gr1 form-group">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email..." class="form-control" id="email" >
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="mybtn" >Guardar cambios</button>
                    </form>
                </div>
        </div>
        <div class="col-md-4 col-md-offset-10">
        <a href="{{ url('/home') }}">
                    <button type="button" class="mybtn" >Regresar</button>
            </a>  
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection

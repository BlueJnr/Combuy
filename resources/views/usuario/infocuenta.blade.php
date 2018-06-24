@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}
{!!Html::style('css/style.css')!!}


<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="myform-top">
                    <h3>Datos Personales</h3>
            </div>
            <div id="mensaje">
                @if(Session::has('message'))
                    <div class="alert alert-success" id="message-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
            </div>
            <div class="myform-bottom">
                
                <form role="form" action="{{ route('datosusuario')}}" method="post" class="">
                {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                        <input type="text" name="username" value="{{ Auth::user()->username }}" 
                        placeholder="Username..." class="form-control" id="username" autofocus>
                        
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">

                        <input id="password" type="password" class="form-control"
                        name="password" placeholder="Contraseña..." >
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control"
                        placeholder="Confirma contraseña..." name="password_confirmation" >
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
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
<script>
        setInterval(function(){ 
            $("#message-success").fadeOut();
    }, 3000);
</script>
@endsection





@extends('layouts.app')


@section('content')


{!!Html::style('css/reg_ubicacion.css')!!}

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

                <div class="myform-top">
                          <h3><br>Registro de Productos</h3>
                  </div>
                    @if(Session::has('message'))

                          <div class="alert alert-success">
                              {{ Session::get('message') }}
                          </div>

                    @endif
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('producto.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                            <label for="tipo" class="col-md-4 control-label">Tipo</label>

                            <div class="col-md-6">
                                <input id="tipo" type="text" class="form-control" name="tipo" value="{{ old('tipo') }}" required autofocus>

                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('marca') ? ' has-error' : '' }}">
                            <label for="marca" class="col-md-4 control-label">Marca</label>

                            <div class="col-md-6">
                                <input id="marca" type="text" class="form-control" name="marca" value="{{ old('marca') }}" required autofocus>

                                @if ($errors->has('marca'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('caracteristica') ? ' has-error' : '' }}">
                            <label for="caracteristica" class="col-md-4 control-label">Caracteristica</label>

                            <div class="col-md-6">
                                <input id="caracteristica" type="text" class="form-control" name="caracteristica" value="{{ old('caracteristica') }}" required autofocus>

                                @if ($errors->has('caracteristica'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('caracteristica') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('precio') ? ' has-error' : '' }}">
                            <label for="precio" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-6">
                                <input id="precio" type="text" class="form-control" name="precio" value="{{ old('precio') }}" required autofocus>

                                @if ($errors->has('precio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('precio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

        </div>
    </div>
</div>
@endsection


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>COMBUY</title>

    {!!Html::style('css/app.css')!!}

<link rel="stylesheet" href="css/bootstrap.min.css">    <!--archivo bootstrap reducido-->
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!--Iconos-->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500" rel="stylesheet"> <!--fuente de google fonts-->
<link rel="stylesheet" href="css/login1.css"> <!--todos los que tengan my al inicio son de login.css los demas de bootstrap-->
<link href="image/favicon_logo.ico" rel="icon">
</head>
<body>
<div class="my-content" >
  <div class="container">
      <div class="row">
          <div class="col-sm-6 col-sm-offset-3 myform-cont">

                <div class="myform-top">
                         <div class="col-sm-12 my-sesion" >
                             <h1> Inicio de sesion </h1>
                         </div>
                         <div class="myform-top-left">
                             <h3>Ingresa a nuestro sitio.</h3>
                             <p>Digita tu usuario y contraseña:</p>
                         </div>
                         <div class="myform-top-right">
                           <i class="fa fa-key"></i>
                         </div>
                </div>

                  <div class="myform-bottom">
                      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                  <input id="username" type="text" class="form-control" name="username"
                                  placeholder="Usuario..." value="{{ old('username') }}" required autofocus>

                                  @if ($errors->has('username'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('username') }}</strong>
                                      </span>
                                  @endif

                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                                  <input id="password" type="password" class="form-control"
                                  placeholder="Contraseña..." name="password" required>

                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif

                          </div>
                          <button type="submit" class="mybtn">
                              Login
                          </button>

                          <div class="form-group">
                              <div class="col-md-6 ">
                                <h3 >¿No eres miembro?</h3>
                              </div>
                              <div class="col-md-6 ">
                                 <a href="{{ route('register') }}" class="my-registro">
                                     <h3>Registrate ahora</h3>
                                 </a>
                               </div>

                          </div>
                          <div class="col-md-12 ">
                              <a class="my-registro" href="{{ route('password.request') }}">
                                  Olvidó su contraseña?
                              </a>
                          </div>
                    </form>


                </div>
          </div>
      </div>
  </div>
</div>


<script src="js/bootstrap.min.js"></script>
</body>

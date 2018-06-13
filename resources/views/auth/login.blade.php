
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>COMBUY</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <link rel="stylesheet" href="css/responsiveslide.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="image/favicon_logo.ico" rel="icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">    <!--archivo bootstrap reducido-->
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css"> <!--Iconos-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500" rel="stylesheet"> <!--fuente de google fonts-->
    <link rel="stylesheet" href="css/login.css"> <!--todos los que tengan my al inicio son de login.css los demas de bootstrap-->

    <script>
        $(function() {
            $(".rslides").responsiveSlides({
                timeout: 5000
            });
        });
    </script>
</head>
<body>
<div class="slider-wrap">
    <ul class="rslides">
        <li><img src="image/im1.jpg" alt=""></li>
        <li><img src="image/im2.jpg" alt=""></li>
        <li><img src="image/im3.jpg" alt=""></li>
    </ul>


    <div class="my-content slider-container" >
        <div >
            <div class="row">
                <div class="col-sm-6 myform-cont" >
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
                        <form role="form" class="slider-form" method="POST" action="{{ route('login') }}">
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
                            <button type="submit" class="mybtn">Entrar</button>
                        </form>

                        <div >
                            <h3 >¿No eres miembro?</h3>
                            <a href="{{ route('register') }}" class="my-registro">
                                     <h3>Registrate ahora</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>

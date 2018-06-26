<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="image/favicon_logo.ico" rel="icon">
    <title>COMBUY</title>
    
    {!!Html::style('css/app.css')!!}
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/cuentas.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/reg_ubicacion1.css')!!}
    <script src="{{ asset('assets/sweetalert/sweetalert2.min.js')}}"></script>
    <link href="{{ asset('assets/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">

</head>

<body>
  <header>
    <div class="logo">
        <a href="{{ url('/') }} " class="log" >
            <span>
                <i  class="icon icon-cart">
                </i>
            </span>COMBUY
        </a>
    </div>

  
  
  <div class="nav">
      <nav class="navbar navbar-static-top" role="navigation">
          <ul class="ul1">
              <li class="l1">
                  <a href="{{ url('/') }}" ><span class=" span1"><i  class="icon icon-home"></i></span>Inicio</a>
              </li>
              <li class="l1">
                 
              </li>
              <li class="l1">
                  <a href="#" >
                      <span class="span4"><i class="icon-paste"></i></span>Productos</span>
                  </a>
                  <ul class="ul2">
                      <li class="l2">
                           <a href="{{ url('/producto/create') }}" >Ingresar</a>
                      </li>
                      <li class="l2">
                          <a href="{{ url('/producto') }}">Revisar </span>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="l1">
                  
              </li>
              <li class="l1">
                  <a href="#" ><span class="span5"><i class=" icon icon-happy"></i></span>Usuario</a>
                  <ul class="ul2">
                      <li class="l2 submenu">
                          <a href="{{ url('/home') }}" >Mi cuenta</a>
                      </li>
                      <li class="l2">
                          <a href="{{ route('logout') }}"
                            onclick="cerrar_sesion();">
                          Cerrar Sesion</span>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           {{ csrf_field() }}
                          </form>
                      </li>
                  </ul>
              </li>
          </ul>
      </nav>
  </div>

</header>


    @yield('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        
        function cerrar_sesion(){
            event.preventDefault();
            swal({
                    title: 'Seguro de cerrar sesion?',
                    text: "Tendrás que volver a iniciar!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        console.log(result.value);
                    if (result.value) {
                        swal(
                        'Cerrando...',
                        'Se cerró sesión correctamente.',
                        'warning'
                        )
                        document.getElementById('logout-form').submit();
                    }
                })
        }
    
    </script>

    @section('scripts')

    @show
    
    
</body>
</html>

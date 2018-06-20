@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}
<script src="{{ asset('assets/sweetalert/sweetalert2.min.js')}}"></script>
<link href="{{ asset('assets/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">

@include('infoempresa.modalregistro')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="myform-top">
                <h3><br>Datos de mi negocio</h3>    
            </div>
               
                @if(Session::has('message'))
                    <div class="alert alert-success" id="message-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h4>Corrige los siguientes errores:</h4>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="message-eliminar" class="alert alert-success alert-dismissible" role="alert" style="display:none">
                        <strong>Se eliminaron los datos correctamente.</strong>
                </div>

                <div id="opcnegocio">
                        <button type="button" class="btn btn-dark" id="actnegocio">Actualizar negocio</button>
                        <button type="button" class="btn btn-dark" id="vernegocio">Ver negocio</button>
                        <button type="button" class="btn btn-dark" id="verproductos">Ver productos</button>
                </div>
                <br>
            <div class="panel-body" id="contenedorForm">
                <form class="form-horizontal" method="post" action="{{ route('empresa.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    
                    <div class="form-group{{ $errors->has('ubicacion') ? ' has-error' : '' }}">
                        <label for="ubicacion" class="col-md-4 control-label">Ubicación</label>
                        <div class="col-md-2">
                            <a type="button" data-toggle='modal' data-target='#myModal'>
                                <img src="image/ubicacion-mapa.png" >
                            </a>
                        </div>
                        <div class="col-md-2">
                            <input id="latitud" type="text" class="form-control" name="latitud">
                        </div>
                        <div class="col-md-2" >
                                <input id="longitud" type="text" class="form-control" name="longitud">
                        </div>
                        
                    </div>
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                        <div class="col-md-6">
                            <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                            @if ($errors->has('descripcion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                        <label for="telefono" class="col-md-4 control-label">Telefono</label>

                        <div class="col-md-4">
                            <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required autofocus>

                            @if ($errors->has('telefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('Hora_inicio') ? ' has-error' : '' }}">
                        <label for="Hora_inicio" class="col-md-4 control-label">Hora Inicio</label>

                        <div class="col-md-2">
                            <input id="Hora_inicio" type="text" class="form-control" name="Hora_inicio" value="{{ old('Hora_inicio') }}" required autofocus>

                            @if ($errors->has('Hora_inicio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Hora_inicio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('Hora_fin') ? ' has-error' : '' }}">
                        <label for="Hora_fin" class="col-md-4 control-label">Hora Fin</label>

                        <div class="col-md-2">
                            <input id="Hora_fin" type="text" class="form-control" name="Hora_fin" value="{{ old('Hora_fin') }}" required autofocus>

                            @if ($errors->has('Hora_fin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Hora_fin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('ruc') ? ' has-error' : '' }}">
                        <label for="ruc" class="col-md-4 control-label">RUC</label>

                        <div class="col-md-2">
                            <input id="ruc" type="text" class="form-control" name="ruc" value="{{ old('ruc') }}" required autofocus>

                            @if ($errors->has('ruc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ruc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <!--BOTON REGISTRAR EN BLADE-->
                            <button type="submit" class="btn btn-success" id="registro">
                                    Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body" id="tablanegocio">
                <table class="table">
                    <thead>
                        <th>Nombre</th>
                        <th>Ruc</th>
                        <th>Descripcion</th>
                        <th>telefono</th>
                        <th>Apertura</th>
                        <th>Cierre</th>
                        
                    </thead> 
                    <tbody id="datos">
                            
                    </tbody>
                </table> 
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
    $(document).ready(function(){
       
        $('#contenedorForm').hide();
        $('#tablanegocio').hide();
        setInterval(function(){ 
            $("#message-success").fadeOut();
        }, 5000);
    });
    $("#actnegocio").click(function(){
        $('#contenedorForm').show();
        $('#tablanegocio').hide();
    });
    $("#vernegocio").click(function(){ 
        $('#contenedorForm').hide();
        $('#tablanegocio').show();
        Cargartabla();
    });
    $("#verproductos").click(function(){ 
        Redirectproductos();
    });
    function Cargartabla(){
        var route ="{{ url('mostrarnegocio') }}";
        var token=$("#token").val(); 
        var tablaDatos = $("#datos");
        
        $.get(route, function(res){
            tablaDatos.html('');
            $(res).each(function(key,value){ 
                if(value.descripcion==null ||
                   value.hora_fin==null ||
                   value.hora_inicio==null || 
                   value.telefono==null || 
                   value.ruc==null)
                {
                    tablaDatos.append("<tr><td>"+value.nombrenegocio+"</td><td>"+""+"</td><td>"+""+"</td><td>"+""+"</td><td>"+""+"</td><td>"+""+"</td><td>"+"<button value="+value.id+" OnClick='Eliminar(this);' class='btn btn-danger'>eliminar"+"</td><td>"+"<button OnClick='Redirect();' class='btn btn-info'>Agregar producto"+"</td></tr>");
                
                }
                else{
                    tablaDatos.append("<tr><td>"+value.nombrenegocio+"</td><td>"+value.ruc+"</td><td>"+value.descripcion+"</td><td>"+value.telefono+"</td><td>"+value.hora_inicio+"</td><td>"+value.hora_fin+"</td><td>"+"<button value="+value.id+" OnClick='Eliminar(this);' class='btn btn-danger'>eliminar"+"</td><td>"+"<button OnClick='Redirect();' class='btn btn-info'>Agregar producto"+"</td></tr>");
                
                }
           });
        });
    }
    
    function Redirect() {
        window.location="{{ url('/producto/create') }}";
     }
     function Redirectproductos() {
        window.location="{{ url('/producto') }}";
     }
    function Eliminar(btn){
        var identi=btn.value;
        var route =  "{{ url('eliminarnegocio') }}/"+identi;
        var token=$("#token").val();
        swal({
            title: 'Seguro de eliminar?',
            text: "No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si,eliminarlo!'
            }).then((result) => {
                console.log(result.value);
            if (result.value) {
                swal(
                'Eliminado!',
                'La sugerencia fue borrada.',
                'success'
                )
                $.ajax({
                    url:route,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(){
                        Cargartabla();
                        $("#message-eliminar").fadeIn();
                        setInterval(function(){ 
                                $("#message-eliminar").fadeOut();
                            }, 5000);
                    }
                });
            }
        })
    }
</script>
<script>
    document.getElementById("latitud").style.display = "none";
    document.getElementById("longitud").style.display = "none";
    document.getElementById("lat").style.display = "none";
    document.getElementById("long").style.display = "none"; 
    $("#registro").click(function(){
        if(document.getElementById("latitud").value=="" || document.getElementById("longitud").value==""){
            
        }
    });
    $("#guardarmodal").click(function(){
        document.getElementById("latitud").value=document.getElementById("lat").value;
        document.getElementById("longitud").value=document.getElementById("long").value;
    });
</script>

<script>
       map : false;
       marker : false;
       var coords = {};
       initMap = function() {
        document.getElementById("search").placeholder = "Ingrese dirección";
         //usamos la API para geolocalizar el usuario
            navigator.geolocation.getCurrentPosition(
              function (position){
                coords =  {
                  lng: position.coords.longitude,
                  lat: position.coords.latitude
                };
                setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
              },function(error){console.log(error);});
            

       }
       function setMapa(coords){

          map = new google.maps.Map(document.getElementById('mapa'), {
            center:new google.maps.LatLng(coords.lat,coords.lng),

            scrollwheel: false,
            zoom: 14,
            zoomControl: true,
            rotateControl : false,
            mapTypeControl: true,
            streetViewControl: false,
          });

          // Creamos el marcador
          marker = new google.maps.Marker({
          position: new google.maps.LatLng(coords.lat,coords.lng),
          draggable: true
          });
          document.getElementById("lat").value = coords.lat;
          document.getElementById("long").value = coords.lng;  
          // Le asignamos el mapa a los marcadores.
           marker.setMap(map);
           marker.addListener('click', toggleBounce);

            marker.addListener( 'dragend', function (event)
            {
              //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
              document.getElementById("lat").value = this.getPosition().lat();
              document.getElementById("long").value = this.getPosition().lng();
            });
       }
       function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }

      // función que se ejecuta al pulsar el botón buscar dirección
      getCoords = function()
      {
        // Creamos el objeto geodecoder
       var geocoder = new google.maps.Geocoder();

       address = document.getElementById('search').value;
       
       if(address!='')
       {
        // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
       geocoder.geocode({ 'address': address}, function(results, status)
       {
         if (status == 'OK')
         {
              // Mostramos las coordenadas obtenidas en el p con id coordenadas

         document.getElementById("lat").value=results[0].geometry.location.lat();
         document.getElementById("long").value=results[0].geometry.location.lng();
      // Posicionamos el marcador en las coordenadas obtenidas
         marker.setPosition(results[0].geometry.location);
          // Centramos el mapa en las coordenadas obtenidas
         map.setCenter(marker.getPosition());
         //agendaForm.showMapaEventForm();
         }
        });
       }

    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa6knjXrGMdqU3FLOIqmRmgIP9N9CjeJ0&callback=initMap"></script>

@endsection

@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}

@include('infoempresa.modalregistro')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="myform-top">
                        <h3><br>Datos de mi negocio</h3>    
            </div>
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('empresa.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nombre</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('ubicacion') ? ' has-error' : '' }}">
                        <label for="ubicacion" class="col-md-4 control-label">Ubicación</label>
                        <div class="col-md-2">
                            <a type="button" data-toggle='modal' data-target='#myModal'>
                                <img src="image/ubicacion-mapa.png" >
                            </a>
                        </div>
                        <div class="col-md-2">
                            <input id="latitud" type="text" class="form-control" name="latitud" display: "none"; required autofocus>
                        </div>
                        <div class="col-md-2" >
                                <input id="longitud" type="text" class="form-control" name="longitud" required autofocus>
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
                    <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                        <label for="tipo" class="col-md-4 control-label">Tipo Negocio</label>
                            <div class="col-md-4">  
                                <select id="selectortiponegocio" class="form-control" name="tipoproducto">
                                    <option disabled selected="selected" value="">Seleccione</option>
                                    <option value="bodega">BODEGA</option>
                                    <option value="libreria">LIBRERIA</option> 
                                </select>
                            </div>  
                        <br>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <!--BOTON REGISTRAR EN BLADE-->
                            {!!link_to('#',$title='Registrar', $attributes=['id'=>'registro','class'=>'btn btn-primary'],
                            $secure=null)!!}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById("latitud").style.display = "none";
    document.getElementById("longitud").style.display = "none";
    $("#registro").click(function(){
  
        var nom=$("#name").val(); 
        var lat=$("#latitud").val();
        var long=$("#longitud").val();
        var desc=$("#descripcion").val();
        var telf=$("#telefono").val();
        var hri=$("#Hora_inicio").val();
        var hrf=$("#Hora_fin").val();
        var rc=$("#ruc").val();
        var tiponegoc= $('#selectortiponegocio option:selected').attr('value');

        var route = "http://localhost/combuy/public/empresa";
        
        var token=$("#token").val(); 
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'POST',
            dataType:'json',
            data:{
                nombre:nom,
                latitud:lat,
                longitud:long,
                descripcion:desc,
                telefono:telf,
                horainicio:hri,
                horafin:hrf,
                ruc:rc,
                tiponegocio:tiponegoc
            }
        });
    });
</script>

<script>
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

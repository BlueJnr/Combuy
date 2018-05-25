@extends('layouts.app')

@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}

<div class="container">
    <div class="row">
        <div class="col-md-4">
          <button id="bodega" class="btn btn-default btn-tiponegocio" name="bodega">BODEGAS</button>
        
        </div>
        <div class="col-md-4">
          <button name="Farmacias" class="btn btn-default btn-establecimiento">Farmacias</button>
        </div>
        <div class="col-md-4">
          <button name="Librerias" class="btn btn-default btn-establecimiento">Librerias</button>
        </div>

                <div class="myform-top">
                          <h3><br>Revisión de productos</h3>
                  </div>

                <div class="panel-body">
                <table class="table">
                    <thead>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                    </thead>
                    <tbody id="datos">
                              
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  var tiponegocio = '';
  $('.btn-tiponegocio').click(function(){
    tiponegocio = $(this).attr("name");

    var tablaDatos = $("#datos");
    var route = "http://localhost/version_2/proyectoCalidad_Respaldo/public/productos";
    
    $.get(route, function(res){
      tablaDatos.html('');
      $(res).each(function(key,value){
        tablaDatos.append("<tr><td>"+value.Nom_producto+"</td></tr>");
      });
    });

  });
  
    
  
</script>

@endsection

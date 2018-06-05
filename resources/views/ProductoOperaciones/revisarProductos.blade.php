@extends('layouts.app')

@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}
<div id="msj-success" class="alert alert-success" role="alert" style="display:none">
  		<strong> Producto eliminado correctamente.</strong>
</div>

<div class="container">
    <div class="row">
     <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
        <div class="myform-top">
                      <h3><br>Revisión de productos</h3>
        </div>
        <div class="col-md-4">
          <button id="bodega" class="btn btn-default btn-tiponegocio" id="bodega" value="bodega">BODEGAS</button>
        </div>
        <div class="col-md-4">
          <button name="Librerias" class="btn btn-default btn-establecimiento" id="libreria" value="libreria">LIBRERIAS</button>
        </div>
        <br><br>
            <div class="panel-body" id="tablaproductos">
              <table class="table" >
                  <thead>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Descripción</th>
                      <th></th>
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
    var ids;
    var nomtiponegocio;
    
    function Eliminar(btn){
        
        ids=btn.value;

       


        var identi=ids;
        var route = "http://localhost/combuy_v1.1/Combuy/public/eliminarproducto/"+identi;
        var token=$("#token").val();
         $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success: function(){
                cargartabla();
                $("#msj-success1").fadeIn();
            }
        });
    }
    function cargartabla(){
        var route = "http://localhost/combuy_v1.1/Combuy/public/mostrarproductos/"+nomtiponegocio;
        var tablaDatos = $("#datos");
        $("#datos").empty();
        $.get(route, function(res){
            if(res){
                tablaDatos.html('');
                $(res).each(function(key,value){   
                    tablaDatos.append("<tr><td>"+value.nomproducto+"</td><td>"+value.nomtipo+"</td><td>"+value.descripcion+"</td><td>"+"<button value="+value.id+" OnClick='Eliminar(this);' class='btn btn-danger'>eliminar"+"</td></tr>");
                });
                
            }else{
                alert("No se ha ingresado un negocio");
            }
            
        });
    }
    $("#bodega").on( "click", function() {
        nomtiponegocio=$("#bodega").val();
        cargartabla();
    });
    $("#libreria").on( "click", function() {
        nomtiponegocio=$("#libreria").val();
        cargartabla();
    });
</script>

@endsection

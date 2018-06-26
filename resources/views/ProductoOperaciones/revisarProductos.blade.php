@extends('layouts.app')

@section('content')

{!!Html::style('css/reg_ubicacion1.css')!!}
{!!Html::style('css/reg_producto.css')!!}
<div id="msj-success" class="alert alert-success" role="alert" style="display:none">
  		<strong> Producto eliminado correctamente.</strong>
</div>

<div class="container">
    <div class="row">
     <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
        <div class="myform-top">
                      <h3><br>Revisión de productos</h3>
        </div>
        
            <div class="btntipo2">
                <button class="deslizar" id="combo" value="combo">Combo</button>
                <button name="unidad" class="deslizar" id="unidad" value="unidad">Unidad</button>
            </div>
            
            <div class="col-md-4 mv">  
                <div class="col-md-4"> 
                <button OnClick='Redirect();' class="llenar2">Agregar producto</button>
                </div>
                <div class="col-md-4"> 
                <button OnClick='Redirectnegocio();' class="llenar2">Mi negocio</button>
                </div>
               
            </div>
            
            
        <br><br>
            <div class="panel-body" id="tablaproductos">
              <table class="table" >
                  <thead>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Descripción</th>
                      <th>Etiqueta</th>
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
        var route = "{{ url('eliminarproducto') }}/"+identi;
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
    function Redirect() {
        window.location="{{ url('/producto/create') }}";
     }
     function Redirectnegocio() {
        window.location="{{ url('empresa') }}";
     }
    function cargartabla(){
        var route = "{{ url('mostrarproductos') }}/"+nomtiponegocio;
        var tablaDatos = $("#datos");
        $("#datos").empty();
        $.get(route, function(res){
            if(res){
                tablaDatos.html('');
                $(res).each(function(key,value){   
                    tablaDatos.append("<tr><td>"+value.nomproducto+"</td><td>"+value.nomtipo+"</td><td>"+value.descripcion+"</td><td>"+value.etiqueta+"</td><td>"+"<button value="+value.id+" OnClick='Eliminar(this);' class='btn btn-danger'>eliminar"+"</td></tr>");
                });
                
            }else{
                alert("No se ha ingresado un negocio");
            }
            
        });
    }
    $("#combo").on( "click", function() {
        nomtiponegocio=$("#combo").val();
        cargartabla();
    });
    $("#unidad").on( "click", function() {
        nomtiponegocio=$("#unidad").val();
        cargartabla();
    });
</script>

@endsection

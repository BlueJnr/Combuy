@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}

@include('ProductoOperaciones.modalregistro')

<div id="msj-success" class="alert alert-success" role="alert" style="display:none">
  		<strong> Producto agregado exitosamente.</strong>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                
                    <div class="myform-top">
                          <h3>Registro de Productos</h3>
                  </div>
                    @if(Session::has('message'))

                          <div class="alert alert-success">
                              {{ Session::get('message') }}
                          </div>

                    @endif
                    <div id="tiporegistro">
                        <button type="button" class="btn btn-dark" id="proexists">Productos existentes</button>
                        <button type="button" class="btn btn-dark" id="pronuevos">Productos nuevos</button>
                        
                    </div>
                    <br>
                    <div id="tipoempresa">
                        <button type="button" class="btn btn-dark" id="bodega" value="bodega">Bodega</button>
                        <button type="button" class="btn btn-dark" id="libreria" value="libreria">Libreria</button>
                    </div>
                    <div class="panel-body" id="contenedorForm">
                        <form class="form-horizontal" method="POST" action="{{ route('producto.store') }}">
                            
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                            
                            <label for="tiponego" class="col-md-4 control-label">Tipo negocio</label>
                            <div class="col-md-6">
                                <select id="selectortiponegocio" class="form-control" name="tiponego">
                                    <option disabled selected="selected" value="">Seleccione</option>
                                    <option value="bodega">BODEGA</option>
                                    <option value="farmacia">FARMACIA</option>
                                    <option value="libreria">LIBRERIA</option>
                                </select>
                            </div>
                            <br><br><br>
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre producto</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('marca') ? ' has-error' : '' }}">
                                <label for="tipo" class="col-md-4 control-label">Marca</label>

                                <div class="col-md-6">
                                    <input id="marca" type="text" class="form-control" name="marca" value="{{ old('marca') }}" required autofocus>

                                    @if ($errors->has('marca'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('marca') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                <label for="descripcion" class="col-md-4 control-label">Descripcion producto</label>

                                <div class="col-md-6">
                                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                    @if ($errors->has('descripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <label for="tipoproducto" class="col-md-4 control-label">Tipo producto</label>
                            <div class="col-md-6">
                                <select id="selectortipoproducto" class="form-control" name="tipoproducto">
                                    <option disabled selected="selected" value="">Seleccione</option>
                                    <option value="fritura">FRITURA</option>
                                    <option value="galleta">GALLETA</option> 
                                    <option value="gaseosa">GASEOSA</option> 
                                    <option value="chocolate">CHOCOLATE</option> 
                                    <option value="pastilla">PASTILLA</option>
                                </select>
                            </div>
                            <br><br><br>
                            <!--BOTON REGISTRAR EN BLADE-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!!link_to('#',$title='Registrar', $attributes=['id'=>'registro','class'=>'btn btn-primary'],
                                    $secure=null)!!}
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="panel-body" id="tablaproductos">
                    <table class="table">
                        <thead>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Descripcion</th>
                            
                        </thead> 
                        <tbody id="datos">
                                
                        </tbody>
                    </table>
                    
                </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#tablaproductos').hide();
        $('#contenedorForm').hide();
        $('#tipoempresa').hide();
        $('#selectortipo').hide();
    });
</script>
<script>
    var ids;
    var nomtiponegocio;
    function Cargartabla(){
        var route = "http://localhost/combuy/public/negocioproducto/"+nomtiponegocio;
        var token=$("#token").val(); 
        var tablaDatos = $("#datos");
        
        $.get(route, function(res){
            tablaDatos.html('');
            $(res).each(function(key,value){   
            tablaDatos.append("<tr><td>"+value.nomproducto+"</td><td>"+value.nomtipo+"</td><td>"+value.nommarca+"</td><td>"+value.descripcion+"</td><td>"+"<button value="+value.id+" OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal' class='btn btn-success'>agregar"+"</td></tr>");
            });
        });
    }
    function Mostrar(btn){
        ids=btn.value;
    }
    $("#proexists").on( "click", function() {
        $('#tipoempresa').show();
        $('#contenedorForm').hide();
    });
    $("#bodega").on( "click", function() {
        $('#tablaproductos').show();
        nomtiponegocio=$("#bodega").val();
        Cargartabla();
    });
    $("#libreria").on( "click", function() {
        $('#tablaproductos').show();
        nomtiponegocio=$("#libreria").val();
        Cargartabla();
    });
    $("#registrarmodal").click(function(){
        
        var identi=ids;
        var prec=$("#precio").val(); 
        var stoc=$("#stock").val();

        var route = "http://localhost/combuy/public/productos";
        
        var token=$("#token").val(); 
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'POST',
            dataType:'json',
            data:{
                id:identi,
                precio:prec,
                stock:stoc
            },
            success: function(){
                $("#myModal").modal('toggle');
                $("#msj-success").fadeIn();
            }
        });
    });
</script>
<script>
    $("#pronuevos").on( "click", function() {
        $('#tablaproductos').hide();
        $('#tipoempresa').hide();
        $('#contenedorForm').show();
        $('#tipoempresa_nreg').show();
        $('input[type="text"]').val('');
        document.getElementById("selectortiponegocio").selectedIndex=0;
        document.getElementById("selectortipoproducto").selectedIndex=0;
	});

    
    $("#registro").click(function(){
  
        var nom=$("#nombre").val(); 
        var marc=$("#marca").val();
        var desc=$("#descripcion").val();
        var tiponegoc= $('#selectortiponegocio option:selected').attr('value');
        var tipoprod= $('#selectortipoproducto option:selected').attr('value');

        var route = "http://localhost/combuy/public/producto";
        
        var token=$("#token").val(); 
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'POST',
            dataType:'json',
            data:{
                tiponegocio:tiponegoc,
                nombre:nom,
                descripcion:desc,
                marca:marc,
                tipoproducto:tipoprod,
            }
        });
    });
</script>
@endsection

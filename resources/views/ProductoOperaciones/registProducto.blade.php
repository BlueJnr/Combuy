@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}



@include('ProductoOperaciones.modalregistro')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                
                    <div class="myform-top">
                          <h3>Registro de Productos</h3>
                    </div>
                    <div id="message-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
                        <strong>Se agregó el producto correctamente.</strong>
                    </div>
                    @if(Session::has('message'))
                    <div class="alert alert-success" id="message">
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
                    <div id="tiporegistro">
                        <button type="button" class="btn btn-dark" id="proexists">Productos existentes</button>
                        <button type="button" class="btn btn-dark" id="pronuevos">Sugerencias</button>
                        <button type="button" class="btn btn-dark" id="verproductos">Ver Productos</button>
                        
                    </div>
                    <br>
                    <div id="tipoempresa">
                        <button type="button" class="btn btn-dark" id="combo" value="combo">Combo</button>
                        <button type="button" class="btn btn-dark" id="unidad" value="unidad">Unidad</button>
                    </div>
                    <div class="panel-body" id="contenedorForm">
                        <form class="form-horizontal" method="POST" action="{{ route('producto.store') }}">
                            
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                            
                            <label for="tiponego" class="col-md-4 control-label">Tipo negocio</label>
                            <div class="col-md-6">
                                <select id="selectortiponegocio" class="form-control" name="tiponego" required>
                                    <option disabled selected="selected" value="">--Seleccione--</option>
                                    <option value="bodega">bodega</option>
                                    <option value="libreria">libreria</option>
                                </select>
                            </div>
                            <br><br><br>
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre producto</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            
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
                                <select id="selectortipoproducto" class="form-control" name="tipoproducto" required>
                                    <option disabled selected="selected" value="">--Seleccione--</option>
                                    @foreach($tipoproducto as $tp)
                                        <option value="{{ $tp['id'] }}"> {{ $tp['nomtipo'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <br><br><br>
                            <!--BOTON REGISTRAR EN BLADE-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" id="registrodd">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="panel-body" id="tablaproductos">
                   <div id="lista-producto">

                   </div>
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
        $('#tablaproductos').hide();
        $('#contenedorForm').hide();
        $('#tipoempresa').hide();
        $('#selectortipo').hide();
        setInterval(function(){ 
            $("#message").fadeOut();
        },5000);

    });
    $("#verproductos").click(function(){ 
        Redirectproductos();
    });
    function Redirectproductos() {
        window.location="{{ url('/producto') }}";
     }
</script>
<script>
    var id_global;
    var nomtiponegocio;
    var listaproductos=function(){
        $.ajax({
            type:'get',
            url:"{{ url('negocioproducto') }}/"+nomtiponegocio,
            success: function(data){
                $('#lista-producto').empty().html(data);
            }
        });
    }
    $(document).on("click",".pagination li a",function(e){
        e.preventDefault();
        var url=$(this).attr("href");
         $.ajax({
            type:'get',
            url:url,
            success: function(data){
                $('#lista-producto').empty().html(data);
            }
        });
    });
    function Mostrar(id){
        id_global=id;
    }
    
   
    $("#proexists").on( "click", function() {
        
        $('#tipoempresa').show();
        $('#contenedorForm').hide();
    });
    $("#combo").on( "click", function() {
        $('#tablaproductos').show();
        nomtiponegocio=$("#combo").val();
        listaproductos();
       
    });
    $("#unidad").on( "click", function() {
        $('#tablaproductos').show();
        nomtiponegocio=$("#unidad").val();
        listaproductos();
    });
    $("#registrarmodal").click(function(){
       
        var identi=id_global;
        var prec=$("#precio").val(); 
        var stoc=$("#stock").val();
        var route ="{{ url('productos') }}";
        
        var token=$("#token").val(); 
        $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'POST',
            dataType:'json',
            data:{_token: token, precio: prec, stock: stoc , id:identi},
            success: function(data){
              if(data.success=='true'){
                  $("#myModal").modal('toggle');
                  $("#message-success").fadeIn();
                  setInterval(function(){ 
                        $("#message-success").fadeOut();
                    }, 3000);
              }else if(data.success=='false'){
                  $("#message-success2").fadeIn();
                  setInterval(function(){ 
                        $("#message-success2").fadeOut();
                    }, 3000);
              }
              else if(data.errors) {
                    if(data.errors.precio){
                        $('#precio-error').html(data.errors.precio[0] );
                    }
                    if(data.errors.stock){
                        $('#stock-error').html(data.errors.stock[0] );
                    }
                }
            },
            error: function(data){
                if(data.status==422){
                  console.clear();
              }
            }
        });
    });
    $("myModal").on("hidden.bs.modal",function(){
        $("#message-success2").fadeOut()
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
    
</script>
@endsection

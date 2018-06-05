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
                    @if(Session::has('message'))

                          <div class="alert alert-success">
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
                                <select id="selectortiponegocio" class="form-control" name="tiponego" required>
                                    <option disabled selected="selected" value="">--Seleccione--</option>
                                    <option value="bodega">BODEGA</option>
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
                    <table class="table">
                        <thead>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Tipo de producto</th>
                            <th></th>
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
    var array_datos=[];
    function Cargartabla(){
        var route = "{{ url('negocioproducto') }}/"+nomtiponegocio;
        var token=$("#token").val(); 
        var tablaDatos = $("#datos");
        
        $.get(route, function(res){
            tablaDatos.html('');
            $(res).each(function(key,value){   
                console.log(key);
            tablaDatos.append("<tr><td>"+value.nomproducto+"</td><td>"+value.descripcion+"</td><td>"+value.nomtipo+"</td><td>"+"<button value="+value.id+" OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal' class='btn btn-success'>agregar"+"</td><td>"+"<button value="+value.id+" id='boton' class='btn btn-danger'>boton"+"</td></tr>");
            array_datos[key]=value.id;
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
        var route ="{{ url('productos') }}";
        
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
               // $("#myModal").modal('toggle');
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
</script>
@endsection

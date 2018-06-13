@extends('layouts.app')


@section('content')

{!!Html::style('css/reg_ubicacion.css')!!}
{!!Html::style('css/style.css')!!}


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="myform-top">
                        <h3>Datos Personales</h3>
                </div>
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="myform-bottom">
                    <form role="form" action="{{ route('usuarioedit')}}" method="post" class="">
                    {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('form-firtsname') ? ' has-error' : '' }}">

                             <div class="gr1 form-group">
                                <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Nombres..." class="form-control" id="name" required autofocus>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">

                            <div class="gr1 form-group">
                            <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" placeholder="Apellidos..." class="form-control" id="lastname" required>
                             </div>
                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">

                            <div class="gr1 form-group">
                            <input type="text" readonly="readonly" name="dni" value="{{ Auth::user()->dni }}" placeholder="DNI..." class="form-control" id="dni" required>
                            </div>
                            @if ($errors->has('dni'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dni') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="gr1 form-group">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email..." class="form-control" id="email" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="mybtn">Guardar cambios</button>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

    $(document).ready(function(){
        
        $("#form-firtsname").val();




    });
</script>
<script>
    var id_global;
    var tipoproducto;
    var listaproductos=function(){
        $.ajax({
            type:'get',
            url:"{{ url('sugerencias') }}/"+tipoproducto,
            success: function(data){
                $('#lista-sugerencia').empty().html(data);
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
                $('#lista-sugerencia').empty().html(data);
            }
        });

    });
    function Mostrar(id){
        id_global=id;
    }
    $('#modaleditar').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });
    function Editar(id){
        var identi=id;
        route="{{ url('admin') }}/"+identi+"/edit";
        $.get(route,function(data){
            $("#nombre").val(data.nomproducto);
            $("#descripcion").val(data.descripcion);
            $("#id").val(data.id);
        });
    }
    function Eliminar(id){
        
        var identi=id;
        var token=$("#token").val();
         $.ajax({
            url:"{{ url('admin') }}/"+identi,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success: function(data){
                listaproductos();
                if(data.success=='true'){
                    $("#message-eliminar").fadeIn();
                    $("#message-editar").fadeOut();
                    $("#message-success").fadeOut();
                }
                
            }
        });
    }
    $("#modalactualizar").click(function(){
       var id=$("#id").val();
       var nombre=$("#nombre").val();
       var descripcion=$("#descripcion").val();
       var route ="{{ url('admin') }}/"+id;
      
       var token=$("#token").val(); 
       $.ajax({
           url:route,
           headers:{'X-CSRF-TOKEN':token},
           type:'PUT',
           dataType:'json',
           data:{
               nombre:nombre,
               id:id,
               descripcion:descripcion,
           },
           success:function(data) {
                if(data.success=='true'){
                    listaproductos();
                    $("#modaladmineditar").modal('toggle');
                    $("#message-editar").fadeIn();
                    $("#message-eliminar").fadeOut();
                    $("#message-success").fadeOut();
                }else if(data.success=='false'){
                    $("#message-success2").fadeIn();
                    $("#message-editar").fadeOut();
                    $("#message-eliminar").fadeOut();
                    $("#message-success").fadeOut();
                
                }
                else if(data.errors) {
                    if(data.errors.nombre){
                        $('#nombre-error').html(data.errors.nombre[0] );
                    }
                    if(data.errors.descripcion){
                        $('#descripcion-error').html(data.errors.descripcion[0] );
                    }
                }
            },
       });
    })
  
    $('#modanadmin').on('shown.bs.modal', function () {
        $('#etiqueta').focus();
    });
    $('body').on('click', '#modalaceptar', function(){
       
       var identi=id_global;
       var etic=$("#etiqueta").val(); 
       var route ="{{ url('admin') }}";
       $( '#etiqueta-error' ).html( "" );
       var token=$("#token").val(); 
       $.ajax({
           url:route,
           headers:{'X-CSRF-TOKEN':token},
           type:'POST',
           dataType:'json',
           data:{
               id:identi,
               etiqueta:etic,
           },
           success:function(data) {
                if(data.success=='true'){
                    listaproductos();
                    $("#modanadmin").modal('toggle');
                    $("#message-success").fadeIn();
                    $("#message-editar").fadeOut();
                    $("#message-eliminar").fadeOut();
                
                }else if(data.success=='false'){
                    $("#message-success2").fadeIn();
                    $("#message-editar").fadeOut();
                    $("#message-eliminar").fadeOut();
                    $("#message-success").fadeOut();
                
                
                }
                else if(data.errors) {
                    if(data.errors.etiqueta){
                        $('#etiqueta-error').html(data.errors.etiqueta[0] );
                    }
                }
            },
       });
       
   });
  
    $("#combo").on( "click", function() {
            $('#tablasugerencia').show();
            tipoproducto=$("#combo").val();
            listaproductos();
        });
    $("#unidad").on( "click", function() {
        $('#tablasugerencia').show();
        tipoproducto=$("#unidad").val();
        listaproductos();
    });
    
</script>
@endsection

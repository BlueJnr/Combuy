<table class="table table-bordered">
    <thead>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Tipo de producto</th>
        <th>Opciones</th>
    </thead> 
    <tbody>
            @foreach($sugerencias as $sugerencia)
            <tr>
                <td>{{$sugerencia->nomproducto}}</td>
                <td>{{$sugerencia->descripcion}}</td>
                <td>{{$sugerencia->nomtipo}}</td>
                <td>
                    <button value="{{$sugerencia->id}}" OnClick='Mostrar({{$sugerencia->id}});' data-toggle='modal' data-target='#modanadmin' class='btn btn-success'>aceptar</button>
                    <button value="{{$sugerencia->id}}" OnClick='Editar({{$sugerencia->id}});' data-toggle='modal' data-target='#modaladmineditar' class='btn btn-warning'>editar</button>
                    <button value="{{$sugerencia->id}}" OnClick='Eliminar({{$sugerencia->id}});' class='btn btn-danger'>eliminar</button>     
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
<div class="text-center">
    {!!$sugerencias->links()!!}
</div>
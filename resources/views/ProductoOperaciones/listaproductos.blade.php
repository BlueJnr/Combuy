<table class="table table-bordered">
    <thead>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Tipo de producto</th>
        <th>Accion</th>
    </thead> 
    <tbody>
            @foreach($productos as $product)
            <tr>
                <td>{{$product->nomproducto}}</td>
                <td>{{$product->descripcion}}</td>
                <td>{{$product->nomtipo}}</td>
                <td>
                <button value="{{$product->nomproducto}}" OnClick='Mostrar({{$product->id}});' data-toggle='modal' data-target='#myModal' class='btn btn-success'>agregar</td>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
<div class="text-center">
    {!!$productos->links()!!}
</div>
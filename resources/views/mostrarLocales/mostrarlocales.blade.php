@extends('layouts.app')


@section('content')


{!!Html::style('css/reg_ubicacion1.css')!!}

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

                <div class="myform-top">
                          <h3><br>Locales</h3>
                  </div>

                <div class="panel-body">
                <table class="table">
                    <thead>
                        <th>Empresa</th>

                    </thead>
                    @foreach($prod as $productos)
                    <tbody>
                        <td>{{$productos->Nom_producto}}</td>
                        
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

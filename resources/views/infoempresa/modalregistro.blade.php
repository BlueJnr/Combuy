<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Ubicacion
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" onload="mapa.initMap()">
                <div id="mapa" style="height: 300px; width:570px;"> </div>
                <br>
                <div>
                    <div class="col-md-9">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search">
                    </div>
                    <div class="col-md-2.5">
                        <input type="button" value="Buscar Dirección" onClick="getCoords()" class="btn btn-success">
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-6">
                <br>
                Latitud:<br>
                <input type="text" id="lat" name="lat" />
            </div>
            <div class="col-md-6">
                <br>
                Longitud:<br>
                <input type="text" id="long" name="long" /><br><br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarmodal">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
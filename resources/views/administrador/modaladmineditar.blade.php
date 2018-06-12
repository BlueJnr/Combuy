<div class="modal fade" id="modaladmineditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Editar sugerencia</h4>
        </div>
          <div class="modal-body">
               
                <div id="#message-success2" class="hide">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <strong>No se ha podido editar correctamente</strong> 
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id">
                <label for="nombre" class="col-md-4 control-label">Nombre</label>
                <input id="nombre" type="text" class="form-control" name="nombre">
                <span class="text-danger">
                        <strong id="nombre-error"></strong>
                </span>
                <br>  
                <label for="descripcion" class="col-md-4 control-label">Descripcion</label>
                <input id="descripcion" type="text" class="form-control" name="descripcion">
                <span class="text-danger">
                        <strong id="descripcion-error"></strong>
                </span>  
          </div>
          <div class="modal-footer">
            <div class="row">
                <div class="col-xs-6 text-center">
                  <button type="button" id="modalactualizar" class="btn btn-success ">Aceptar</button>
                </div>
                  <div class="col-xs-6 text-center">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" id=btncerrarmodal>Close</button>
                </div>
            </div>
          </div>
            
    </div>
  </div>
</div>
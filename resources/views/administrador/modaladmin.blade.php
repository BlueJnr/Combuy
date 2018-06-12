<div class="modal fade" id="modanadmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Completar registro de sugerencias</h4>
        </div>
          <div class="modal-body">
               
                <div id="#message-success2" class="hide">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <strong>La sugerencia ya existe</strong> 
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                
                <label for="etiqueta" class="col-md-4 control-label">Etiqueta</label>
                <input id="etiqueta" type="text" class="form-control" name="etiqueta" placeholder="Ingresa etiqueta">
                <span class="text-danger">
                        <strong id="etiqueta-error"></strong>
                </span>  
          </div>
          <div class="modal-footer">
            <div class="row">
                <div class="col-xs-6 text-center">
                  <button type="button" id="modalaceptar" class="btn btn-success ">Aceptar</button>
                </div>
                  <div class="col-xs-6 text-center">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" id=btncerrarmodal>Close</button>
                </div>
            </div>
          </div>
            
    </div>
  </div>
</div>
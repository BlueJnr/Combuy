<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Completar registro de producto</h4>
        </div>
          <div class="modal-body">
              
              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

              
                  <label for="precio" class="col-md-4 control-label">Precio</label>
                  <input id="precio" type="text" class="form-control" name="precio" placeholder="Ingresa el precio" required autofocus>
                  
                  <label for="stock" class="col-md-4 control-label">Stock</label>
                  <input id="stock" type="text" class="form-control" name="stock" placeholder="Ingresa el stock" required autofocus>
                  <div class="modal-footer">
                  </div>
            
            {!!link_to('#', $title='registrar', $attributes = ['id'=>'registrarmodal', 'class'=>'btn btn-primary'], $secure = null)!!}
                
          </div>
        
    </div>
  </div>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar Categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <form id='form_add' data-parsley-validate>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" required placeholder="Ingrese el mensaje" class="form-control"
                          data-parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                </div>
            </div>
            <div class="form-group text-right m-b-0">
                <button class="btn btn-primary waves-effect waves-light" type="button" id="btn_add_modal">Guardar</button>
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            </div>
        </form>
    </div>
    <script>
        $("#btn_add_modal").on('click', function(e){
            e.preventDefault();
            $('#form_add').parsley().validate();
            if ($('#form_add').parsley().isValid()){
                save_data();
            }
        });
    </script>
<?php

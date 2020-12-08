<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Responder</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <table class="table table-borderless mb-0">
            <thead class="thead-light">
            <tr>
                <th>Campo</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nombre</td>
                <td>
                    <?php
                    if($row->name!=""){
                        echo $row->name;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Correo</td>
                <td>
                    <?php
                    if($row->email!=""){
                        echo $row->email;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Comentario</td>
                <td>
                    <?php
                    if($row->comment!=""){
                        echo $row->comment;
                    }
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
        <form id='form_reply' novalidate>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="message">Mensaje</label>
                    <textarea type="text" name="message" id="message" required="" placeholder="Ingrese el mensaje" class="form-control" cols="5"
                    parsley-trigger="change" data-parsley-error-message="El campo es requerido"></textarea>
                </div>
            </div>
            <div class="form-group text-right m-b-0">
                <button class="btn btn-primary waves-effect waves-light" type="button" id="btn_reply">Enviar</button>
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                <input type="hidden" name="id_contact" id="id_contact" value="<?=$row->id_contact?>">
                <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            </div>
        </form>
    </div>
    <script>
        $("#btn_reply").on('click', function(e){
            e.preventDefault();
            $('#form_reply').parsley().validate();
            if ($('#form_reply').parsley().isValid()){
                reply_data();
            }
        });
    </script>
<?php

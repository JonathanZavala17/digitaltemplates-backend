<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Editar Cliente</h4>
                        <form id="form_edit" novalidate>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre">Nombre<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" required placeholder="Ingrese el nombre del cliente" class="form-control"
                                           parsley-trigger="change" data-parsley-error-message="El campo es requerido" value="<?=$data->name?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="address">Dirección</label>
                                    <input type="text" name="address" id="address" placeholder="Ingrese el año del vehículo" class="form-control" id="year" value="<?=$data->address?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="cellphone">Teléfono</label>
                                    <input type="text" name="cellphone" id="cellphone" placeholder="Ingrese el numero de telefono" class="form-control" data-toggle="input-mask" data-mask-format="0000-0000" maxlength="9" value="<?=$data->cellphone?>">
                                    <span class="font-13 text-muted">ej. "xxxx-xxxx"</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="hours">Horarios<span class="text-danger">*</span></label>
                                    <input type="text" name="hours"  placeholder="Ingrese el horario" class="form-control" id="hours" required parsley-trigger="change" data-parsley-error-message="El campo es requerido" value="<?=$data->hours?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="specialty">Especialidad<span class="text-danger">*</span></label>
                                    <input type="text" name="specialty" id="specialty" placeholder="Ingrese la especialidad" class="form-control" required parsley-trigger="change" data-parsley-error-message="El campo es requerido" value="<?=$data->specialty?>">
                                </div>
                            </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancelar</button>
                            <input type="hidden" value="<?=$data->id_medic?>" name="id_medic" id="id_medic">
                            <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!--end row-->
    </div><!--end container fluid-->
</div><!--end content-->

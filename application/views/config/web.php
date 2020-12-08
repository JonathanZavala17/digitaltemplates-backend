<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><i class="fe-home"></i> Editar información</h4>
                </div>
                <div class="card">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Datos de página</h4>
                        <p class="text-muted font-14 m-b-20">
                            Los campos marcados con <span class="text-danger">*</span> son requeridos.
                        </p>
                        <?php echo form_open('', array('id' => 'form', 'novalidate' => '')); ?>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="website">Nombre del Sitio<span class="text-danger">*</span></label>
                                <input type="text" name="website" id="website" required="" placeholder="Ingrese el nombre de la compania" class="form-control" value="<?=$row->name?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="address">Dirección<span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" required="" placeholder="Ingrese la direccion de la empresa" class="form-control" value="<?=$row->address;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="phone">Télefono<span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" required="" placeholder="Ingrese el télefono" class="form-control" value="<?=$row->phone?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido" data-toggle="input-mask" data-mask-format="+503 0000-0000" maxlength="13">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="email">Correo Eléctronico<span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" required="" placeholder="Ingrese la correo eléctronico" class="form-control" value="<?=$row->email;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                <span class="font-13 text-muted">Dirección de correo, a mostrar en la pagina.</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="email2">Correo Eléctronico Recibidor<span class="text-danger">*</span></label>
                                <input type="text" name="email2" id="email2" required placeholder="Ingrese el télefono" class="form-control" value="<?=$row->email_receiver?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                <span class="font-13 text-muted">Dirección de correo, donde caeran los mensajes enviados por los clientes.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="fb">Facebook</label>
                                <input type="text" name="fb" id="fb" placeholder="Ingrese el enlace de facebook" class="form-control" value="<?=$row->fb;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                <span class="font-13 text-muted">Enlace de la red social.</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="tw">Twitter</label>
                                <input type="text" name="tw" id="tw" placeholder="Ingrese el enlace de twitter" class="form-control" value="<?=$row->tw;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                <span class="font-13 text-muted">Enlace de la red social.</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="ig">Instagram</label>
                                <input type="text" name="ig" id="ig" placeholder="Ingrese el enlace de instagram" class="form-control" value="<?=$row->ig;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                <span class="font-13 text-muted">Enlace de la red social.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="mision">Mision<span class="text-danger">*</span></label>
                                <textarea type="text" name="mision" id="mision" required class="form-control" rows="4"
                                          parsley-trigger="change" data-parsley-error-message="El campo es requerido"><?=$row->mision;?></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="vision">Vision<span class="text-danger">*</span></label>
                                <textarea type="text" name="vision" id="vision" required class="form-control" rows="4"
                                          parsley-trigger="change" data-parsley-error-message="El campo es requerido"><?=$row->vision;?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="hours">Valores<span class="text-danger">*</span></label>
                                <input type="text" name="hours" id="hours" placeholder="Ingrese el horario de atencion" class="form-control" value="<?=$row->hours;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="valores">Valores<span class="text-danger">*</span></label>
                                <textarea type="text" name="valores" id="valores" required class="form-control" rows="3"
                                          parsley-trigger="change" data-parsley-error-message="El campo es requerido"><?=$row->mision;?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <label for="p_number">Logo del sitio web</label>
                                    <input type="file" name="fileinput" class="dropify" data-default-file="<?=base_url($row->logo_page)?>"  />
                                    <p class="text-muted text-center mt-2 mb-0">Logo actual</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancelar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div> <!-- container -->
</div> <!-- content -->
<input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

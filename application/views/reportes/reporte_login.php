<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><i class="mdi  mdi-folder-search-outline"></i> Reporte de Login</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Generación de Reporte</h4>
                        <span>Seleccione el rango de fechas que se mostrara el reporte</span>
                        <form id="form_add" data-parsley-validate class="mt-3" method="post" action="<?=base_url("admin/reporte_login/generar")?>" target="_blank">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="desde">Desde</label>
                                    <input type="text" name="desde" id="desde1" required  class="form-control datepicker" value="<?=$desde?>"
                                           data-parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="hasta">Hasta</label>
                                    <input type="text" name="hasta" id="hasta1" required  class="form-control datepicker" value="<?=$hasta?>"
                                           data-parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-success waves-effect waves-light" type="submit" id="btn_generate"><i class="mdi mdi-share"></i> Generar</button>
                                <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!--end row-->
    </div><!--end container fluid-->
</div><!--end content-->

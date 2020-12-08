<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">

                <div class="card" id="div_loading" style="display: none">
                    <div class="card-body text-center">
                        <h4 class="header-title">Cargando...</h4>
                        <p class="text-muted">Subiendo archivos</p>
                        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>

                <div class="card" id="main_div">
                    <div class="card-body">
                        <h4 class="header-title">Agregar Canción</h4>
                        <span>Los campos marcados con <span class="text-danger">*</span> son requeridos.</span>
                        <form id="form_add" data-parsley-validate class="mt-3">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="titulo">Titulo<span class="text-danger">*</span></label>
                                    <input type="text" name="titulo" id="titulo" required placeholder="Ingrese el titulo de la cancion" class="form-control"
                                           data-parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="artista">Artista<span class="text-danger">*</span></label>
                                    <input type="text" name="artista" id="artista" required placeholder="Ingrese el artista de la cancion" class="form-control"
                                           data-parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="mt-3">
                                        <label for="">Canción<span class="text-danger">*</span></label>
                                        <input type="file" name="fileinput" class="dropify" accept="audio/*" required data-parsley-error-message="El campo es requerido"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancelar</button>
                                <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!--end row-->
    </div><!--end container fluid-->
</div><!--end content-->

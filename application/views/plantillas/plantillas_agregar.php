<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Agregar Plantilla</h4>
                        <form id="form_add" data-parsley-validate class="mt-3">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="titulo">Título<span class="text-danger">*</span></label>
                                    <input type="text" name="titulo" id="titulo" required placeholder="Ingrese el titulo de la publicacion" class="form-control"
                                           data-parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="id_categoria">Categoría<span class="text-danger">*</span></label>
                                    <select name="id_categoria" id="id_categoria" class="form-control select2">
                                        <?php foreach ($rows as $cat): ?>
                                            <option value="<?=$cat->id_categoria?>"><?=$cat->nombre?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" id="descripcion" placeholder="Ingrese el titulo de la publicacion" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="document-editor">
                                        <div class="document-editor__toolbar"></div>
                                        <div class="document-editor__editable-container">
                                            <div class="document-editor__editable">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="mt-3">
                                        <label for="p_number">Imagen de la publicación</label>
                                        <input type="file" name="fileinput" class="dropify" />
                                    </div>
                                </div>
                            </div>-->
                            <!--<div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="specialty">Descripción<span class="text-danger">*</span></label>
                                    <textarea id="summernote" name="description"></textarea>
                                </div>
                            </div>-->
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




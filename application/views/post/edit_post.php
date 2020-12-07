<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Editar Publicación</h4>
                        <form id="form_edit" novalidate class="mt-3">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="title">Título<span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" required placeholder="Ingrese el titulo de la publicacion" class="form-control"
                                           parsley-trigger="change" data-parsley-error-message="El campo es requerido" value="<?=$data->title?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="id_category">Categoría<span class="text-danger">*</span></label>
                                    <select name="id_category" id="id_category" class="form-control select2">
                                        <?php foreach ($category as $row): ?>
                                            <option value="<?=$row->id_category?>"
                                            <?php if($data->id_category==$row->id_category) echo "selected"?>
                                            ><?=$row->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="mt-3">
                                        <label for="p_number">Imagen de la publicación</label>
                                        <input type="file" name="fileinput" class="dropify" data-default-file="<?=base_url($data->picture)?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="specialty">Descripción<span class="text-danger">*</span></label>
                                    <textarea id="summernote" name="description"><?=$data->description?></textarea>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancelar</button>
                                <input type="hidden" name="id_post" value="<?=$id_post?>">
                                <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!--end row-->
    </div><!--end container fluid-->
</div><!--end content-->

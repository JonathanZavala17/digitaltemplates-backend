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
                    <h4 class="page-title"><i class="<?=$page_icon?>"></i> <?=$page_title?></h4>
                </div>
                <div class="card">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Ajustes del perfil</h4>
                        <p class="text-muted font-14 m-b-20">
                            Los campos marcados con <span class="text-danger">*</span> son requeridos.
                        </p>
                        <?php echo form_open('', array('id' => 'form_profile', 'novalidate' => '')); ?>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="fname">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="fname" id="fname" required="" placeholder="Ingrese el nombre" class="form-control" value="<?=$row->first_name?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="lname">Apellido<span class="text-danger">*</span></label>
                                <input type="text" name="lname" id="lname" required="" placeholder="Ingrese el apellido" class="form-control" value="<?=$row->last_name;?>"
                                       parsley-trigger="change" data-parsley-error-message="El campo es requerido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username">Usuario </label>
                                <input type="text" name="username" id="username" required="" class="form-control" placeholder="Ingrese el nombre de usuario" value="<?php echo $row->username;?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" id="password" required placeholder="Ingrese la contraseña" class="form-control" value="<?=$password;?>">
                                <div class="checkbox checkbox-primary mb-1 mt-1">
                                    <input id="checkbox3" type="checkbox">
                                    <label for="checkbox3">Mostrar Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <label for="p_number">Foto de Perfil</label>
                                    <input type="file" name="fileinput" class="dropify" data-default-file="<?=base_url($row->picture);?>"  />
                                    <p class="text-muted text-center mt-2 mb-0">Logo actual</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancelar</button>
                            <input type="hidden" id="id_user" name="id_user" value="<?=$id_user;?>">
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div> <!-- container -->
</div> <!-- content -->

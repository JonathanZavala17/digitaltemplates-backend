<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Digital Templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistema Administrativo" name="description" />
    <meta content="Soluciones Ideales" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Plugins css -->
    <link href="<?=base_url();?>assets/admin/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/animate/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url("assets/admin/libs/bootstrap-table/bootstrap-table.min.css");?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url();?>assets/admin/libs/custombox/custombox.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/jquery-nice-select/nice-select.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/tablesaw/tablesaw.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/libs/izitoast/iziToast.min.css" rel="stylesheet" type="text/css" />


    <!-- App favicon -->
    <link href="<?=base_url();?>assets/logo.png" rel="icon" type="image/png">

    <!-- App css -->
    <link href="<?=base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/css/app.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/admin/css/loading.css" rel="stylesheet" type="text/css" />

    <?php if(isset($css)):?>
        <?php foreach ($css as $extra => $url): ?>
                <?php if(isset($url)):?>
                    <link href="<?=base_url("assets/admin/$url");?>" rel="stylesheet" type="text/css" />
                <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</head>

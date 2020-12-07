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

                <div class="row">

                    <div class="col-md-6 col-xl-3">
                        <a href="<?=base_url("admin/documentos")?>">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-blue border-blue border">
                                            <i class="mdi mdi-file-pdf font-22 avatar-title text-blue"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1">Documentos</h3>
                                            <p class="text-muted mb-1 text-truncate">Gestionar Documentos</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </a>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-3">
                        <a href="<?=base_url("admin/documentos")?>">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                            <i class="mdi mdi-cash font-30 avatar-title text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1">Planes</h3>
                                            <p class="text-muted mb-1 text-truncate">Administrar planes</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </a>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-3">
                        <a href="<?=base_url("admin/configuracion")?>">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                                            <i class="mdi mdi-cogs font-22 avatar-title text-pink"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1">Configurar</h3>
                                            <p class="text-muted mb-1 text-truncate">Configuracion de sitio web</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </a>
                    </div> <!-- end col-->

                </div>


            </div>
        </div>
        <!-- end page title -->



    </div> <!-- container -->

</div> <!-- content -->


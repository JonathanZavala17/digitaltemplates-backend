<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Información del usuario</h4>
                        <div class="table-responsive">
                          <div>
                            <img src="<?= base_url().$row->imagen ?>" style="width:100%;" class="image-responsive" alt="">
                          </div>
                            <table class="table mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>Campo</th>
                                    <th>Descripción</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Nombre</th>
                                    <td><?=$row->nombre." ".$row->apellido?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Correo</th>
                                    <td><?=$row->correo?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Telefono</th>
                                    <td><?=$row->telefono?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Direccion</th>
                                    <td><?=$row->direccion?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Usuario desde</th>
                                    <td><?php echo hora_A_P($row->hora_creacion)." - ".d_m_Y($row->fecha_creacion)?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!--end row-->
    </div><!--end container fluid-->
</div><!--end content-->

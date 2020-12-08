<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Ver Mensaje</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead class="thead-light">
            <tr>
                <th>Campo</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre</td>
                    <td>
                        <?php
                        if($row->name!=""){
                            echo $row->name;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td>
                        <?php
                        if($row->email!=""){
                            echo $row->email;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Direccion</td>
                    <td>
                        <?php
                        if($row->address!=""){
                            echo $row->address;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td>
                        <?php
                        if($row->phone!=""){
                            echo $row->phone;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Fecha Hora</td>
                    <td>
                        <?php
                        echo $row->date." ".$row->time;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Comentario</td>
                    <td>
                        <?php
                        if($row->comment!=""){
                            echo $row->comment;
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if($row->message_sent!=""){
                    ?>
                    <tr>
                        <td>Respuesta</td>
                        <td><?=$row->message_sent;?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    private $table = "usuarios";

    public function __construct()
    {
    	parent::__construct();
        $this->load->model('UtilsModel');
        $this->load->Model("UsersPageModel","users");
        $this->load->helper("Utilities_helper");
        $this->load->helper("layout_helper");
    }

    public function index()
	{
	    $data = array(
	        "page_title"=> "Usuarios Registrados",
	        "page_icon"=> "mdi mdi-account-multiple",
            "table"=>array(
                "ID"=>5,
                "Nombre"=>20,
                "Correo"=>20,
                "Direccion"=>15,
                "Telefono"=>15,
                "Estado"=>15,
                "Acciones"=>10,
            ),
        );
        $extras = array(
            'css' => array(),
            'js' => array(
                0 => "js/funciones/usuarios_script.js"
            ),
        );
        layout("template/admin",$data,$extras);
	}

	function get_data(){
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $order = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0 => 'id_usuario',
            1 => 'nombre',
            2 => 'correo',
            3 => 'direccion',
            4 => 'telefono',
        );
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $row = $this->users->get_collection($order, $search, $valid_columns, $length, $start, $dir);

        if ($row != 0) {
            $data = array();
            $n=1;
            foreach ($row as $rows) {
                $menudrop = '<div class="btn-group">
                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Menu <i class="fe-menu"></i></button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -159px, 0px);">';

                $menudrop .= "<a data-id='$rows->id_usuario' class='dropdown-item' href='#' id='modal_btn_edit' role='button' data-toggle='modal' data-target='#viewModal' data-refresh='true'><i class='mdi mdi-eye' ></i> Ver detalle</a>";

                $state = $rows->activo;
                if($state==1){
                    $txt = "Desactivar";
                    $show_text = "<span class='badge badge-success'>Activo</span>";
                    $icon = "mdi mdi-account-off-outline";
                }
                else{
                    $txt = "Activar";
                    $show_text = "<span class='badge badge-danger'>Inactivo</span>";
                    $icon = "mdi mdi-account-check-outline";
                }
                $menudrop .= "<a class='dropdown-item state_change' data-state='$txt'  id=" . $rows->id_usuario . " ><i class='$icon'></i> $txt</a>";

                $menudrop .= "<a class='dropdown-item delete_row'  id=".$rows->id_usuario." ><i class='mdi mdi-trash-can-outline'></i> Eliminar</a>";

                $menudrop .= "</div></div>";

                $data[] = array(
                    $n,
                    $rows->nombre." ".$rows->apellido,
                    $rows->correo,
                    $rows->telefono,
                    $rows->direccion,
                    $show_text,
                    $menudrop,
                );
                $n++;
            }
            $total = $this->users->total_rows();
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $data
            );
        } else {
            $data[] = array(
                "",
                "",
                "No se encontraron registros",
                "",
                "",
                "",
            );
            $output = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data
            );
        }
        echo json_encode($output);
        exit();
    }

    function ver_detalle($id=-1){
        if($this->input->method(TRUE) == "GET"){
            $row = $this->users->get_row_info($id);
            $data = array("row"=>$row);
            $this->load->view('admin/userspage/ver_detalle', $data);
        }
        else if($this->input->method(TRUE) == "POST"){
            $name = $this->input->post("name");
            $id_category = $this->input->post("id_category");
            $form = array(
                "name"=>$name,
            );
            $table = "category";
            $where = " id_category ='".$id_category."'";
            $this->UtilsModel->begin();
            $exits = $this->cat->exits_row($name);
            if($exits==0){
                $update = $this->UtilsModel->update($table,$form,$where);
                if($update){
                    $this->UtilsModel->commit();
                    $data['type'] = 'success';
                    $data['title'] = 'Exito';
                    $data['msg'] = 'Datos editado exitosamente!';
                }else{
                    $this->UtilsModel->rollback();
                    $data['type'] = 'error';
                    $data['title'] = 'Error';
                    $data['msg'] = 'No se pueden editar los datos!';
                }
            }else{
                $this->UtilsModel->rollback();
                $data['type'] = 'error';
                $data['title'] = 'Error';
                $data['msg'] = 'Ya existe un dato con el mismo nombre!';
            }
            echo json_encode($data);
        }
    }

    function delete(){
        if($this->input->method(TRUE) == "POST"){
            $id = $this->input->post("id");
            $where = " id_usuario ='".$id."'";
            $this->UtilsModel->begin();
            $delete = $this->UtilsModel->delete($this->table,$where);
            if ($delete) {
                $this->UtilsModel->commit();
                $data["type"] = "success";
                $data["title"] = "Información";
                $data["msg"] = "Registro eliminado con exito!";
            }
            else {
                $this->UtilsModel->rollback();
                $data["type"] = "Error";
                $data["title"] = "Alerta!";
                $data["msg"] = "El registro no pudo ser eliminado!";
            }
            echo json_encode($data);
        }
    }

    function state_change(){
        if($this->input->method(TRUE) == "POST"){
            $id = $this->input->post("id");
            $active = $this->users->get_state($id);
            if($active==1){
                $state = 0;
                $text = 'desactivado';
            }else{
                $state = 1;
                $text = 'activado';
            }

            $form = array(
                "activo" =>$state
            );
            $where = " id_usuario ='".$id."'";
            $this->UtilsModel->begin();
            $update = $this->UtilsModel->update($this->table,$form,$where);
            if($update) {
                $this->UtilsModel->commit();
                $data["type"] = "success";
                $data["title"] = "Información";
                $data["msg"] = "Registro $text con exito!";
            }
            else {
                $this->UtilsModel->rollback();
                $data["type"] = "Error";
                $data["title"] = "Alerta!";
                $data["msg"] = "Registro no pudo ser $text!";
            }
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Users.php */

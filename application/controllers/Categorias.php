<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Categorias extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UtilsModel');
        $this->load->Model("admin/CategoriesModel","cat");
        $this->load->helper("utilities_helper");
        $this->load->helper("layout_helper");
    }

    public function index()
    {
        $data = array(
            "page_title"=> "Categorias",
            "page_icon"=> "fe-grid",
            "buttons" => array(
                0 => array(
                    "icon"=> "fe-plus",
                    'url' => 'categorias/agregar',
                    'txt' => 'Agregar Categoria',
                    'modal' => true,
                ),
            ),
            "table"=>array(
                "ID"=>10,
                "Nombre"=>60,
                "Estado"=>20,
                "Acciones"=>10,
            ),
        );
        $extras = array(
            'css' => array(),
            'js' => array(
                0 => "js/funciones/category_functions.js"
            ),
        );
        layout("admin/template/admin",$data,$extras);
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
            0 => 'id_category',
            1 => 'name',
        );
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $rows = $this->cat->get_all_rows($order, $search, $valid_columns, $length, $start, $dir);

        if ($rows != 0) {
            $data = array();
            foreach ($rows as $row) {
                $menudrop = '<div class="btn-group">
                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Menu <i class="fe-menu"></i></button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -159px, 0px);">';

                $filename = base_url() . "admin/categorias/editar";
                $menudrop .= "<a data-id='$row->id_category' class='dropdown-item' href='" . $filename . "/" .$row->id_category. "' id='modal_btn_edit' role='button' data-toggle='modal' data-target='#viewModal' data-refresh='true'><i class='fe-edit' ></i> Editar</a>";

                $state = $row->active;
                if($state==1){
                    $txt = "Desactivar";
                    $show_text = "<span class='badge badge-blue'>Activo<span>";
                    $icon = "mdi mdi-account-off-outline";
                }
                else{
                    $txt = "Activar";
                    $show_text = "<span class='badge badge-danger'>Inactivo</span>";
                    $icon = "mdi mdi-account-check-outline";
                }
                $menudrop .= "<a class='dropdown-item state_change' data-state='$txt'  id=" . $row->id_category . " ><i class='$icon'></i> $txt</a>";

                $menudrop .= "</div></div>";

                $data[] = array(
                    $row->id_category,
                    $row->name,
                    $show_text,
                    $menudrop,
                );
            }
            $total = $this->cat->totalrows();
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $data
            );
        } else {
            $data[] = array(
                "",
                "No se encontraron registros",
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

    function agregar(){
        if($this->input->method(TRUE) == "GET"){
            $this->load->view('admin/category/add_category');
        }else if($this->input->method(TRUE) == "POST"){
            $name = mb_strtoupper($this->input->post("name"));
            $table = "category";
            $form_data = array(
                "name" => $name,
                "active" => 1
            );
            $this->UtilsModel->begin();
            $exits = $this->cat->exits_row($name);
            if($exits==0){
                $insert = $this->UtilsModel->insert($table, $form_data);
                if($insert){
                    $this->UtilsModel->commit();
                    $xdatos['type'] = 'success';
                    $xdatos['title'] = 'Alerta!';
                    $xdatos['msg'] = 'Registro agregado correctamente!';
                }else{
                    $this->UtilsModel->rollback();
                    $xdatos['type'] = 'error';
                    $xdatos['title'] = 'Alerta!';
                    $xdatos['msg'] = 'El registro no pudo ser agregado!';
                }
            }
            echo json_encode($xdatos);
        }
    }

    function editar($id=-1){
        if($this->input->method(TRUE) == "GET"){
            $row = $this->cat->get_row_info($id);
            $data = array("data"=>$row,"id_category"=>$id);
            $this->load->view('admin/category/edit_category', $data);
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

    function state_change(){
        if($this->input->method(TRUE) == "POST"){
            $id = $this->input->post("id");
            $active = $this->cat->get_state($id);
            if($active==1){
                $state = 0;
                $text = 'desactivado';
            }else{
                $state = 1;
                $text = 'activado';
            }
            $tabla = "category";
            $form = array(
                "active" =>$state
            );
            $where = " id_category ='".$id."'";
            $this->UtilsModel->begin();
            $update = $this->UtilsModel->update($tabla,$form,$where);
            if($update) {
                $this->UtilsModel->commit();
                $data["type"] = "success";
                $data["title"] = "Información";
                $data["msg"] = "Dato $text con exito!";
            }
            else {
                $this->UtilsModel->rollback();
                $data["type"] = "Error";
                $data["title"] = "Alerta!";
                $data["msg"] = "Dato no pudo ser $text!";
            }
            echo json_encode($data);
            exit();
        }
    }
}
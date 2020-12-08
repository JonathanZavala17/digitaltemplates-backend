<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantillas extends CI_Controller
{

    private $table = "plantillas";
    private $pk = "id_plantilla";
    private $file = "plantillas";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UtilsModel',"utils");
        $this->load->Model("PlantillasModel","plantillas");
        $this->load->helper("Utilities_helper");
        $this->load->helper("layout_helper");
    }

    public function index()
    {
        $data = array(
            "page_title"=> "Plantillas",
            "page_icon"=> "fe-file-text",
            "buttons" => array(
                array(
                    "icon"=> "fe-plus",
                    'url' => $this->file."/agregar",
                    'txt' => 'Agregar Plantillas',
                    'modal' => false,
                ),
            ),
            "table"=>array(
                "ID"=>10,
                "Titulo"=>20,
                "Categoria"=>20,
                "Ultima Act"=>20,
                "Estado"=>20,
                "Acciones"=>10,
            ),
        );
        $extras = array(
            'css' => array(),
            'js' => array(
                0 => "js/funciones/plantillas.js"
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
            0 => 'plantillas.id_plantilla',
            1 => 'plantillas.titulo',
        );
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $row = $this->plantillas->get_all_rows($order, $search, $valid_columns, $length, $start, $dir);

        if ($row != 0) {
            $data = array();
            foreach ($row as $rows) {
                $menudrop = '<div class="btn-group">
                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Menu <i class="fe-menu"></i></button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -159px, 0px);">';

                $filename = base_url() . "plantillas/editar";
                $menudrop .= "<a class='dropdown-item' href='" . $filename . "/" .$rows->id_plantilla. "' ><i class='fe-edit' ></i> Editar</a>";

                $state = $rows->estado;
                if($state=="Activo"){
                    $txt = "Desactivar";
                    $show_text = "<a class='text-success'>Activo<a>";
                    $icon = "mdi mdi-account-off-outline";
                }
                else{
                    $txt = "Activar";
                    $show_text = "<a class='text-danger'>Inactivo<a>";
                    $icon = "mdi mdi-account-check-outline";
                }

                $menudrop .= "<a class='dropdown-item state_change' data-state='$txt'  id=" . $rows->id_plantilla . " ><i class='$icon'></i> $txt</a>";

                $menudrop .= "<a class='dropdown-item delete_row'  id=".$rows->id_plantilla." ><i class='fe-trash'></i> Eliminar</a>";

                $menudrop .= "</div></div>";

                $data[] = array(
                    $rows->id_plantilla,
                    $rows->titulo,
                    $rows->categoria,
                    d_m_Y($rows->updated_at),
                    $show_text,
                    $menudrop,
                );
            }
            $total = $this->plantillas->totalrows();
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $data
            );
        } else {
            $data[] = array(
                "No se encontraron registros",
                "",
                "",
                "",
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

    function agregar(){
        if($this->input->method(TRUE) == "GET"){
            $category = $this->plantillas->get_categorias();
            $data = array(
              "rows"=>$category,
            );
            $extras = array(
                'css' => array(
                    'css/document_editor.css',
                ),
                'js' => array(
                    "js/funciones/plantillas.js",
                    "libs/ckeditor/ckeditor.js",
                ),
            );
            layout("plantillas/plantillas_agregar",$data,$extras);
        }
        else if($this->input->method(TRUE) == "POST"){
            $titulo = $this->input->post("titulo");
            $descripcion = $this->input->post("descripcion");
            $id_categoria = $this->input->post("id_categoria");
            $contenido = $this->input->post("contenido");

            $data = array(
                "titulo"=>$titulo,
                "id_categoria"=>$id_categoria,
                "descripcion"=>$descripcion,
                "contenido"=>$contenido,
            );
            $this->utils->begin();
            $insert = $this->utils->insert($this->table,$data);
            if($insert){
                $this->utils->commit();
                $xdatos['type'] = 'success';
                $xdatos['title'] = 'Éxito';
                $xdatos['msg'] = 'Plantilla agregado exitosamente!';
            }else{
                $this->utils->rollback();
                $xdatos['type'] = 'error';
                $xdatos['title'] = 'Error';
                $xdatos['msg'] = 'No se pudo guardar la plantilla!';
            }
            echo json_encode($xdatos);
        }
    }

    function editar($id=-1){
        if($this->input->method(TRUE) == "GET"){
            $row = $this->plantillas->get_row_info($id);
            $category = $this->plantillas->get_categorias();
            $data = array(
                "categorias"=>$category,
                "row"=>$row,
            );
            $extras = array(
                'css' => array(
                    'css/document_editor.css',
                ),
                'js' => array(
                    "js/funciones/plantillas.js",
                    "libs/ckeditor/ckeditor.js",
                ),
            );
            layout("plantillas/plantillas_editar",$data,$extras);
        }
        else if($this->input->method(TRUE) == "POST"){
            $id_plantilla = $this->input->post("id_plantilla");
            $titulo = $this->input->post("titulo");
            $descripcion = $this->input->post("descripcion");
            $id_categoria = $this->input->post("id_categoria");
            $contenido = $this->input->post("contenido");

            $data = array(
                "titulo"=>$titulo,
                "id_categoria"=>$id_categoria,
                "descripcion"=>$descripcion,
                "contenido"=>$contenido,
            );
            $where = " id_plantilla='".$id_plantilla."'";
            $this->utils->begin();
            $insert = $this->utils->update($this->table,$data,$where);
            if($insert){
                $this->utils->commit();
                $xdatos['type'] = 'success';
                $xdatos['title'] = 'Éxito';
                $xdatos['msg'] = 'Plantilla editada exitosamente!';
            }else{
                $this->utils->rollback();
                $xdatos['type'] = 'error';
                $xdatos['title'] = 'Error';
                $xdatos['msg'] = 'No se pudo editar la plantilla!';
            }
            echo json_encode($xdatos);

        }
    }

    function delete(){
        if($this->input->method(TRUE) == "POST"){
            $id = $this->input->post("id");
            $form = array(
                "estado"=>"Borrado"
            );
            $where = " id_plantilla ='".$id."'";
            $this->utils->begin();
            $delete = $this->utils->update($this->table,$form,$where);
            if($delete) {
                $this->utils->commit();
                $data["type"] = "success";
                $data["title"] = "Información";
                $data["msg"] = "Registro eliminado con exito!";
            }
            else {
                $this->utils->rollback();
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
            $row = $this->plantillas->get_row_info($id);
            if($row->estado=="Activo"){
                $state = "Inactivo";
                $text = 'Inactivado';
            }else{
                $state = "Activo";
                $text = 'Activado';
            }
            $form = array(
                "estado" =>$state
            );
            $where = " id_plantilla ='".$id."'";
            $this->utils->begin();
            $update = $this->utils->update($this->table,$form,$where);
            if($update) {
                $this->utils->commit();
                $data["type"] = "success";
                $data["title"] = "Información";
                $data["msg"] = "Registro $text con exito!";
            }
            else {
                $this->utils->rollback();
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller
{

    private $table = "documentos";
    private $pk = "id_documento";
    private $file = "documentos";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UtilsModel');
        $this->load->Model("DocumentosModel","documentos");
        $this->load->helper("Utilities_helper");
        $this->load->helper("layout_helper");
    }

    public function index()
    {
        $data = array(
            "page_title"=> "Documentos",
            "page_icon"=> "fe-file-text",
            "buttons" => array(
                array(
                    "icon"=> "fe-plus",
                    'url' => $this->file."/agregar",
                    'txt' => 'Agregar Documentos',
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
                0 => "js/funciones/documentos.js"
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
            0 => 'documentos.id_documento',
            1 => 'documentos.titulo',
        );
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        $row = $this->documentos->get_all_rows($order, $search, $valid_columns, $length, $start, $dir);

        if ($row != 0) {
            $data = array();
            foreach ($row as $rows) {
                $menudrop = '<div class="btn-group">
                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Menu <i class="fe-menu"></i></button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -159px, 0px);">';

                $filename = base_url() . "documentos/editar";
                $menudrop .= "<a class='dropdown-item' href='" . $filename . "/" .$rows->id_documento. "' ><i class='fe-edit' ></i> Editar</a>";

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

                $menudrop .= "<a class='dropdown-item state_change' data-state='$txt'  id=" . $rows->id_documento . " ><i class='$icon'></i> $txt</a>";

                $menudrop .= "<a class='dropdown-item delete_row'  id=".$rows->id_documento." ><i class='fe-trash'></i> Eliminar</a>";

                $menudrop .= "</div></div>";

                $data[] = array(
                    $rows->id_documento,
                    $rows->titulo,
                    $rows->categoria,
                    d_m_Y($rows->updated_at),
                    $show_text,
                    $menudrop,
                );
            }
            $total = $this->documentos->totalrows();
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
            $category = $this->documentos->get_categorias();
            $data = array(
              "rows"=>$category,
            );
            $extras = array(
                'css' => array(
                    //0 => 'libs/summernote/summernote-bs4.css',
                ),
                'js' => array(
                    "js/funciones/documentos.js",
                    "libs/ckeditor/ckeditor.js",
                    //1 => "libs/summernote/summernote-bs4.min.js",
                ),
            );
            layout("documentos/documentos_agregar",$data,$extras);
        }
        else if($this->input->method(TRUE) == "POST"){
            $titulo = $this->input->post("titulo");
            $id_categoria = $this->input->post("id_categoria");
            /*$description = $this->input->post("description");
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $id_user = $this->session->id_user;
            $url_title = url_title($title, '-', TRUE);*/

            $data = array(
                "titulo"=>$titulo,
                "id_categoria"=>$id_categoria,
            );
            $this->UtilsModel->begin();
            $insert = $this->UtilsModel->insert($this->table,$data);
            if($insert){
                $this->UtilsModel->commit();
                $xdatos['type'] = 'success';
                $xdatos['title'] = 'Éxito';
                $xdatos['msg'] = 'Documento agregado exitosamente!';
            }else{
                $this->UtilsModel->rollback();
                $xdatos['type'] = 'error';
                $xdatos['title'] = 'Error';
                $xdatos['msg'] = 'No se pudo guardar el documento!';
            }
            echo json_encode($xdatos);
        }
    }

    function editar($id=-1){
        if($this->input->method(TRUE) == "GET"){
            $row = $this->post->get_row_info($id);
            $category = $this->post->categories();
            $data = array(
                "data"=>$row,
                "category"=>$category,
                "id_post"=>$id
            );
            $extras = array(
                'css' => array(
                    0 => 'libs/summernote/summernote-bs4.css',
                ),
                'js' => array(
                    0 => "js/funciones/post_functions.js",
                    1 => "libs/summernote/summernote-bs4.min.js",
                ),
            );
            layout("admin/post/edit_post",$data,$extras);
        }
        else if($this->input->method(TRUE) == "POST"){
            $id_post = $this->input->post("id_post");
            $title = $this->input->post("title");
            $id_category = $this->input->post("id_category");
            $description = $this->input->post("description");
            $table = "post";
            $url_title = url_title($title, '-', TRUE);

            if ($_FILES["fileinput"]["name"] != "") {

                $_FILES['file']['name'] = $_FILES['fileinput']['name'];
                $_FILES['file']['type'] = $_FILES['fileinput']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['fileinput']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['fileinput']['error'];
                $_FILES['file']['size'] = $_FILES['fileinput']['size'];

                $config['upload_path'] = "./assets/img/post/";
                $config['allowed_types'] = 'jpg|jpeg|png|bmp';

                $info = new SplFileInfo( $_FILES['fileinput']['name']);
                $name = uniqid(date("dmYHi")).".".$info->getExtension();
                $config['file_name'] = $name;
                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')){
                    $url = 'assets/img/post/'.$name;
                    $data = array(
                        "title"=>$title,
                        "url"=>$url_title,
                        "id_category"=>$id_category,
                        "description"=>$description,
                        'picture'=>$url,
                    );
                    $where = "id_post='".$id_post."'";
                    $this->UtilsModel->begin();
                    $insert = $this->UtilsModel->update($table,$data,$where);
                    if($insert){
                        $this->UtilsModel->commit();
                        $xdatos['type'] = 'success';
                        $xdatos['title'] = 'Éxito';
                        $xdatos['msg'] = 'Registro editado exitosamente!';
                    }else{
                        $this->UtilsModel->rollback();
                        $xdatos['type'] = 'error';
                        $xdatos['title'] = 'Error';
                        $xdatos['msg'] = 'No se pudo editar el registro!';
                    }
                }else{
                    $xdatos["type"]="error";
                    $xdatos['title']='Alerta';
                    $xdatos["msg"]="Error al editar los datos";
                }
            }
            else{
                $data = array(
                    "title"=>$title,
                    "url"=>$url_title,
                    "id_category"=>$id_category,
                    "description"=>$description,
                );
                $where = "id_post='".$id_post."'";
                $this->UtilsModel->begin();
                $insert = $this->UtilsModel->update($table,$data,$where);
                if($insert){
                    $this->UtilsModel->commit();
                    $xdatos['type'] = 'success';
                    $xdatos['title'] = 'Éxito';
                    $xdatos['msg'] = 'Registro editado exitosamente!';
                }else{
                    $this->UtilsModel->rollback();
                    $xdatos['type'] = 'error';
                    $xdatos['title'] = 'Error';
                    $xdatos['msg'] = 'No se pudo editar el registro!';
                }
            }
            echo json_encode($xdatos);
        }
    }

    function delete(){
        if($this->input->method(TRUE) == "POST"){
            $id = $this->input->post("id");
            $tabla = "post";
            $where = " id_post ='".$id."'";
            $this->UtilsModel->begin();
            $delete = $this->UtilsModel->delete($tabla,$where);
            if($delete) {
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
            $active = $this->post->get_state($id);
            if($active==1){
                $state = 0;
                $text = 'desactivado';
            }else{
                $state = 1;
                $text = 'activado';
            }
            $tabla = "post";
            $form = array(
                "active" =>$state
            );
            $where = " id_post ='".$id."'";
            $this->UtilsModel->begin();
            $update = $this->UtilsModel->update($tabla,$form,$where);
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
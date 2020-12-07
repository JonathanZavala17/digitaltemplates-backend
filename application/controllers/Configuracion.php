<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("SettingsModel","settings");
        $this->load->model("UtilsModel");
        $this->load->helper("layout_helper");
    }

    public function index()
    {
        $id_store = $this->session->id_store;
        $departamento = $this->settings->get_departamento();
        $municipio = $this->settings->get_municipio(0);
        $row = $this->settings->get_settings($id_store);
        $data = array(
            "page_title"=> "Configuración",
            "page_icon"=> "fe-settings",
            "departamento"=>$departamento,
            "municipio"=>$municipio,
            "row"=>$row,
        );
        $extras = array(
            'css' => array(),
            'js' => array(
                0 => "js/funciones/settings_functions.js"
            ),
        );
        layout("config/settings",$data,$extras);
    }

    function save_changes(){

        if($this->input->method(TRUE) == "POST"){
            $id_store = $this->session->id_store;
            $company_name = $this->input->post("company");
            $address = $this->input->post("address");
            $departamento = $this->input->post("departamento");
            $municipio = $this->input->post("municipio");
            $cellphone = $this->input->post("cellphone");
            $email = $this->input->post("email");
            $webpage = $this->input->post("webpage");
            $nit = $this->input->post("nit");
            $nrc = $this->input->post("nrc");
            $code_enabled = $this->input->post("code_enabled");
            $table = "settings";
            $where = " id_setting='".$id_store."'";

            if ($_FILES["fileinput"]["name"] != "") {

                $_FILES['file']['name'] = $_FILES['fileinput']['name'];
                $_FILES['file']['type'] = $_FILES['fileinput']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['fileinput']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['fileinput']['error'];
                $_FILES['file']['size'] = $_FILES['fileinput']['size'];

                $config['upload_path'] = "./assets/admin/images/";
                $config['allowed_types'] = 'jpg|jpeg|png|bmp';

                $info = new SplFileInfo( $_FILES['fileinput']['name']);
                $name = uniqid(date("dmYHi")).".".$info->getExtension();
                $config['file_name'] = $name;
                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')){
                    $url = 'assets/admin/images/'.$name;
                    $data = array(
                        "name"=>$company_name,
                        "address"=>$address,
                        "id_departamento"=>$departamento,
                        "id_municipio"=>$municipio,
                        "cellphone"=>$cellphone,
                        "email"=>$email,
                        "webpage"=>$webpage,
                        "nit"=>$nit,
                        "nrc"=>$nrc,
                        "code_enabled"=>$code_enabled,
                        "logo"=>$url
                    );
                    $update = $this->UtilsModel->update($table,$data,$where);
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    if($update){
                        $xdatos["type"]="success";
                        $xdatos['title']='Información';
                        $xdatos["msg"]="Datos Actualizados";
                    }else
                    {
                        $xdatos["type"]="error";
                        $xdatos['title']='Alerta';
                        $xdatos["msg"]="Error al actualizar los datos";
                    }
                }else{
                    $xdatos["type"]="error";
                    $xdatos['title']='Alerta';
                    $xdatos["msg"]="Error al actualizar los datos";
                }
            }else{
                $data = array(
                    "name"=>$company_name,
                    "address"=>$address,
                    "id_departamento"=>$departamento,
                    "id_municipio"=>$municipio,
                    "cellphone"=>$cellphone,
                    "email"=>$email,
                    "webpage"=>$webpage,
                    "nit"=>$nit,
                    "code_enabled"=>$code_enabled,
                    "nrc"=>$nrc
                );
                $update = $this->UtilsModel->update($table,$data,$where);
                if($update){
                    $xdatos["type"]="success";
                    $xdatos['title']='Información';
                    $xdatos["msg"]="Datos Actualizados";
                }else
                {
                    $xdatos["type"]="error";
                    $xdatos['title']='Alerta';
                    $xdatos["msg"]="Error al actualizar los datos";
                }
            }
            echo json_encode($xdatos);
        }
    }

    function get_municipios()
    {
        $id_departamento = $this->input->post("id_departamento");
        $municipios = $this->settings->get_municipio($id_departamento);
        $option = "";
        $option .= "<option value='0'>Seleccione un municipio</option>";
        foreach ($municipios as  $value) {
            $option .= "<option value='".$value->id_municipio."'>".$value->nombre_municipio."</option>";
        }
        echo $option;
    }

}

/* End of file Controllername.php */

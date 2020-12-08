<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("SettingsModel","settings");
        $this->load->model("UtilsModel");
        $this->load->helper("layout_helper");
    }

    public function index()
    {
        $row = $this->settings->website();
        $data = array(
            "row"=>$row,
        );
        $extras = array(
            'css' => array(),
            'js' => array(
                0 => "js/scripts/info_functions.js"
            ),
        );
        layout("admin/config/web",$data,$extras);
    }

    function save_changes(){

        if($this->input->method(TRUE) == "POST"){
            $website = $this->input->post("website");
            $address = $this->input->post("address");
            $phone = $this->input->post("phone");
            $email = $this->input->post("email");
            $email2 = $this->input->post("email2");
            $fb = $this->input->post("fb");
            $tw = $this->input->post("tw");
            $ig = $this->input->post("ig");
            $mision = $this->input->post("mision");
            $vision = $this->input->post("vision");
            $valores = $this->input->post("valores");
            $hours = $this->input->post("hours");
            $table = "page_info";
            $where = "id_page=1";

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
                        "name"=>$website,
                        "address"=>$address,
                        "phone"=>$phone,
                        "email"=>$email,
                        "email_receiver"=>$email2,
                        "fb"=>$fb,
                        "tw"=>$tw,
                        "ig"=>$ig,
                        "mision"=>$mision,
                        "vision"=>$vision,
                        "valores"=>$valores,
                        "hours"=>$hours,
                        "logo_page"=>$url,
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
                    "name"=>$website,
                    "address"=>$address,
                    "phone"=>$phone,
                    "email"=>$email,
                    "email_receiver"=>$email2,
                    "fb"=>$fb,
                    "tw"=>$tw,
                    "ig"=>$ig,
                    "mision"=>$mision,
                    "vision"=>$vision,
                    "hours"=>$hours,
                    "valores"=>$valores,
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

}

/* End of file Controllername.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("SettingsModel");
        $this->load->model("UtilsModel");
        $this->load->helper("utilities_helper");
        $this->load->helper("layout_helper");

    }

    public function index()
    {
        $id_user = $this->session->id_user;
        $row = $this->SettingsModel->get_user($id_user);
        $password = decrypt($row->password,"eNcRiPt_K3Y");
        $data = array(
            "page_title"=> "Mi Perfil",
            "page_icon"=> "fe-user",
            "row"=>$row,
            "password"=>$password,
            "id_user"=>$id_user,
        );
        $extras = array(
            'css' => array(),
            'js' => array(
                0 => "js/funciones/settings_functions.js"
            ),
        );
        layout("config/profile",$data,$extras);
    }

    function save_changes(){

        if($this->input->method(TRUE) == "POST"){
            $id_user = $this->session->id_user;
            $fname = $this->input->post("fname");
            $lname = $this->input->post("lname");
            $username = $this->input->post("username");
            $password = encrypt($this->input->post("password"),"eNcRiPt_K3Y");
            $table = "users";
            $where = " id_user='".$id_user."'";

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
                        "first_name"=>$fname,
                        "last_name"=>$lname,
                        "username"=>$username,
                        "password"=>$password,
                        "picture"=>$url,
                    );
                    $update = $this->UtilsModel->update($table,$data,$where);
                    if($update){
                        $this->session->set_userdata('picture', 'assets/admin/images/'.$name);
                        $xdatos["type"]="success";
                        $xdatos['title']='Información';
                        $xdatos["msg"]="Datos Actualizados";
                    }else
                    {
                        $xdatos["type"]="error";
                        $xdatos['title']='Alerta';
                        $xdatos["msg"]="Error al actualizar los datos 12";
                    }
                }else{
                    $xdatos["type"]="error";
                    $xdatos['title']='Alerta';
                    $xdatos["msg"]="Error al actualizar los datos 1";
                }
            }else{
                $data = array(
                    "first_name"=>$fname,
                    "last_name"=>$lname,
                    "username"=>$username,
                    "password"=>$password,
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

/* End of file Profile.php */
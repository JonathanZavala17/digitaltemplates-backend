<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
    	$this->load->helper("layout_helper");
    	$this->load->model("UtilsModel","utils");
    	$this->load->model("DashboardModel","dash");
        $this->load->helper('utilities_helper');
        $this->load->library('user_agent');
    }

	public function index()
	{
        $data = array(
            "page_title"=> "Página Principal",
            "page_icon"=> "fe-home",
        );
        $extras = array(
            'css' => array(),
            'js' => array(),
        );
        layout("dashboard",$data,$extras);
	}

	function go_page(){

        $row = $this->dash->get_admin_data();
        $rows = $this->dash->get_admin_token();
        $time =  $rows->days." d ".$rows->hor." h ".$rows->min." m ".$rows->sec." s ";
        $ip_addr = getRealIP();
        $nav = $this->agent->browser();
        $nav_ver = $this->agent->version();
        $plataforma = $this->agent->platform();

        $form= array(
            "logueado"=>1,
            "ultima_act"=>date("Y-m-d H:i:s"),
            "ip_address"=> $ip_addr,
            "navegador"=>$nav,
            "navegador_version"=>$nav_ver,
            "plataforma"=>$plataforma,
        );
        $where = "id_usuario=1";
        $this->utils->begin();
        $update = $this->utils->update("usuarios",$form,$where);
        if($update){
            $this->utils->commit();
            $nombre = $row->nombre;
            $user_session = array(
                'nombre'  => $nombre,
                'id_usuario'  => 1,
                'time'  => $time,
                'token' => "1020",
                'logged_in' => TRUE
            );
            $this->session->set_userdata($user_session);
            redirect("","refresh");
        }

    }

}

/* End of file Dashboard.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{

    function get_admin_data(){
        return $this->db->get_where("usuarios",array("id_usuario"=>1))->row();
    }
    function get_admin_token(){
        return $this->db->get_where("tokens",array("id_token"=>10))->row();
    }

}

/* End of file .php */
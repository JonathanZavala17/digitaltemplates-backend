<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    private $table = "usuarios";

    function exits_username($username){
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0){
            return 1;
        }
        return 0;
    }

    function login($username,$password){
        $this->db->where('correo', $username);
        $this->db->where('password', $password);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0){
            return $query->row();
        }
        return null;
    }

}

/* End of file LoginModel.php */
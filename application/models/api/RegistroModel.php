<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistroModel extends CI_Model
{
    private $table = "usuarios";

    function existe_correo($string){
        $this->db->where('correo', $string);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? 1 : 0 ;
    }

    function user_info($id){
        $this->db->select('id_usuario, nombre, apellido, correo, direccion');
        $this->db->where('id_usuario', $id);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : null ;
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
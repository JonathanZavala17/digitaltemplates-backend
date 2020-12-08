<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model
{
    private $table = "usuarios";
    private $pk = "id_usuario";


    function GetRow($id){
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : null ;
    }

    function RowsList(){
        $this->db->where('estado', 'Activo');
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->result() : null ;
    }

}

/* End of file LoginModel.php */
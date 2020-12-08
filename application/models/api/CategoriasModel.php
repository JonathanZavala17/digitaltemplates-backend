<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasModel extends CI_Model
{
    private $table = "categorias";
    private $pk = "id_categoria";


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
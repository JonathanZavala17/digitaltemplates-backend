<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlantillasModel extends CI_Model
{
    private $table = "plantillas";
    private $pk = "id_plantilla";


    function GetRow($id){
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : null ;
    }

    function RowsList($id_categoria = ""){
        if($id_categoria!="") $this->db->where('id_categoria', $id_categoria);
        $this->db->where('estado', 'Activo');
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->result() : null ;
    }

}

/* End of file LoginModel.php */
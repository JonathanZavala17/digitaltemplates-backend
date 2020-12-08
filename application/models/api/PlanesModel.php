<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanesModel extends CI_Model
{
    private $table = "planes";
    private $pk = "id_plan";

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

    function GetRow($id){
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : null ;
    }

    function PlanesListado(){
        $this->db->where('estado', 'Activo');
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->result() : null ;
    }

}

/* End of file LoginModel.php */
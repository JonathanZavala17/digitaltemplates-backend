<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentosModel extends CI_Model
{
    private $table = "documentos";
    private $pk = "id_documento";


    function GetRow($id){
        $this->db->where($this->pk, $id);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : null ;
    }

    function RowsList($id = ""){
        if($id!="") $this->db->where('id_usuario', $id);
        $this->db->where('estado', 'Activo');
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->result() : null ;
    }

    function GetTagsList($id = ""){
        if($id!="") $this->db->where('id_documento', $id);
        $query = $this->db->get("documentos_valores");
        return ($query->num_rows() > 0) ? $query->result() : null ;
    }

}

/* End of file LoginModel.php */
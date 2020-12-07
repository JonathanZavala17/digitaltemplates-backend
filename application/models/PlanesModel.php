<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanesModel extends CI_Model
{
    private $table = "planes";
    private $pk = "id_plan";

    function get_all_rows($order, $search, $valid_columns, $length, $start, $dir)
    {
        $this->db->select('planes.*, planes.nombre as planes');
        if ($order !=	 null) {
            $this->db->order_by($order, $dir);
        }
        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $this->db->where('planes.estado !=', 'Borrado');
        $this->db->join('planes', 'planes.id_planes = planes.id_planes', 'left');
        $rows = $this->db->get($this->table);
        if ($rows->num_rows() > 0) {
            return $rows->result();
        } else {
            return 0;
        }
    }

    function totalrows(){
        $this->db->where('estado !=', 'Borrado');
        $rows = $this->db->get($this->table);
        return  ($rows->num_rows() > 0) ? $rows->num_rows() : null ;

    }

    function exits_row($name){
        $this->db->where('name', $name);
        $clients = $this->db->get("category");
        if ($clients->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_categorias()
    {
        $this->db->where('estado', 'Activo');
        $rows = $this->db->get("categorias");
        return ($rows->num_rows() > 0) ? $rows->result() : null;
    }

    function get_row_info($id){
        $this->db->where('id_category', $id);
        $clients = $this->db->get("category");
        if ($clients->num_rows() > 0) {
            return $clients->row();
        } else {
            return 0;
        }
    }

    function get_state($id){
        $this->db->where('active', 1);
        $this->db->where('id_category', $id);
        $clients = $this->db->get("category");
        if ($clients->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

/* End of file DoctorModel.php */
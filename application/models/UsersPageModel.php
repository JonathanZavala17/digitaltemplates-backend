<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersPageModel extends CI_Model
{
    private $table = "usuarios";

    function get_collection($order, $search, $valid_columns, $length, $start, $dir)
    {
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
        $clients = $this->db->get($this->table);
        if ($clients->num_rows() > 0) {
            return $clients->result();
        } else {
            return 0;
        }
    }

    function total_rows(){
        $clients = $this->db->get($this->table);
        if ($clients->num_rows() > 0) {
            return $clients->num_rows();
        } else {
            return 0;
        }
    }

    function exits_row($usuario){
        $this->db->where('usuario', $usuario);
        $row = $this->db->get($this->table);
        if ($row->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function exits_row_edit($usuario,$id){
        $this->db->where('id_usuario!=', $id);
        $this->db->where('usuario', $usuario);
        $row = $this->db->get($this->table);
        if ($row->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_row_info($id){
        $this->db->where('id_usuario', $id);
        $clients = $this->db->get($this->table);
        if ($clients->num_rows() > 0) {
            return $clients->row();
        } else {
            return 0;
        }
    }

    function get_state($id){
        $this->db->where('activo', 1);
        $this->db->where('id_usuario', $id);
        $clients = $this->db->get($this->table);
        if ($clients->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}

/* End of file UsuariosModel.php */

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReporteModel extends CI_Model
{

    function get_login($desde, $hasta){
        $this->db->select('CONCAT(u.nombre," ",u.apellido) as usuario, l.*,t.token as token, t.days as days, t.hor as hours, t.min as min, t.sec as sec');
        $this->db->join('tokens as t', 't.id_token = l.id_token', 'left');
        $this->db->join('usuarios as u', 'u.id_usuario = l.id_usuario', 'left');
        $this->db->where("l.fecha BETWEEN '$desde' AND '$hasta'");
        $row=$this->db->get('login as l');
        if($row->num_rows()>0) return $row->result();
        else return 0;
    }

}

/* End of file .php */
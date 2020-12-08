<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsModel extends CI_Model
{
    function get_settings($id_store){
        $this->db->select('s.name, s.address,s.id_departamento,s.code_enabled, s.id_municipio, s.cellphone, s.email, s.webpage, s.nit, s.nrc, s.logo, d.nombre_departamento, m.nombre_municipio');
        $this->db->where('s.id_setting', $id_store);
        $this->db->join('departamento as d', 'd.id_departamento = s.id_departamento', 'left');
        $this->db->join('municipio as m', 'm.id_municipio = s.id_municipio', 'left');
        $cars = $this->db->get("settings as s");
        if ($cars->num_rows() > 0) {
            return $cars->row();
        } else {
            return 0;
        }
    }
    function get_departamento(){
        $this->db->select('id_departamento,nombre_departamento');
        $cars = $this->db->get("departamento");
        if ($cars->num_rows() > 0) {
            return $cars->result();
        } else {
            return 0;
        }
    }
    function get_municipio($id_departamento){
        $this->db->select('id_municipio,nombre_municipio');
        if($id_departamento>0){
            $this->db->where('id_departamento_municipio', $id_departamento);
        }
        $cars = $this->db->get("municipio");
        if ($cars->num_rows() > 0) {
            return $cars->result();
        } else {
            return 0;
        }
    }
    function get_user($id_user){
        $this->db->where('id_user', $id_user);
        $cars = $this->db->get("users");
        if ($cars->num_rows() > 0) {
            return $cars->row();
        } else {
            return 0;
        }
    }

    function contacto(){
        $this->db->select('id_contact, name, email, phone, address, comment, DATE_FORMAT(date,"%d-%m-%Y") as date, time,message_sent');
        $this->db->where('id_contact', 1);
        $clients = $this->db->get("contact");
        if ($clients->num_rows() > 0) {
            return $clients->row();
        } else {
            return 0;
        }
    }
    function website(){
        $this->db->where('id_page', 1);
        $rows = $this->db->get("page_info");
        if ($rows->num_rows() > 0) return $rows->row();
    }

}

/* End of file .php */

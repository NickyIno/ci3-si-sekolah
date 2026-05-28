<?php

class Profile_Model extends CI_Model{
    public function getProfile(){
        $this->db->order_by('id', 'DESC'); 
        $this->db->limit(1);
        $query = $this->db->get('profil');
        return $query->row();
    }
    public function updateProfile($data){
        return $this->db->insert('profil', $data);
    }
}
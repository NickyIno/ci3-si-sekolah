<?php

class Galeri_Model extends CI_Model{
    public function getDataGaleri(){
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('galeri');
        return $data->result();
    }
    public function getDataGaleriById($id){  
        $this->db->where('id', $id);
        $data = $this->db->get('galeri');
        return $data->row();
    }
    public function getDataGaleriTerbaru(){
        $this->db->order_by('id', 'DESC'); 
        $this->db->limit(6);
        $data = $this->db->get('galeri');
        return $data->result();
    }
    public function deleteDataGaleriById($id){
        $this->db->where('id', $id);
        return $this->db->delete('galeri');
    }
    public function insertDataGaleri($data){
        return $this->db->insert('galeri', $data);
    }

    public function updateDataGaleri($data, $id){
        $this->db->where('id', $id);
        $this->db->update('galeri', $data);
    }

    public function countGaleri(){
        $data = $this->db->count_all('galeri');
        return $data;
    }
}

<?php

class Sarana_Model extends CI_Model{
    public function getDataSarana(){
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('sarana_prasarana');
        return $data->result();
    }
    public function getDataSaranaById($id){  
        $this->db->where('id', $id);
        $data = $this->db->get('sarana_prasarana');
        return $data->row();
    }
    public function deleteDataSaranaById($id){
        $this->db->where('id', $id);
        return $this->db->delete('sarana_prasarana');
    }
    public function insertDataSarana($data){
        return $this->db->insert('sarana_prasarana', $data);
    }

        public function getDataSaranaTerbaru(){
        $this->db->order_by('id', 'DESC'); 
        $this->db->limit(6);
        $data = $this->db->get('sarana_prasarana');
        return $data->result();
    }

    public function updateDataSarana($data, $id){
        $this->db->where('id', $id);
        $this->db->update('sarana_prasarana', $data);
    }
    public function countSarana(){
        $data = $this->db->count_all('sarana_prasarana');
        return $data;
    }
}
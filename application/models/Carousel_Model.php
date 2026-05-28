<?php

class Carousel_Model extends CI_Model{
    public function getDataCarousel(){
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('carousel');
        return $data->result();
    }
    public function getDataCarouselById($id){  
        $this->db->where('id', $id);
        $data = $this->db->get('carousel');
        return $data->row();
    }
    public function deleteDataCarouselById($id){
        $this->db->where('id', $id);
        return $this->db->delete('carousel');
    }
    public function insertDataCaraousel($data){
        return $this->db->insert('carousel', $data);
    }

    public function updateDataCaraousel($data, $id){
        $this->db->where('id', $id);
        $this->db->update('carousel', $data);
    }

       public function countCarousel(){
        $data = $this->db->count_all('carousel');
        return $data;
    }
}
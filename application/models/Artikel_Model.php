<?php

class Artikel_Model extends CI_Model {

    public function simpanArtikel($data)
    {
        return $this->db->insert('artikel', $data);
    }

    public function getDataArtikel(){
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('artikel');
        return $data->result();
    }

    public function getDataArtikelId($id){  
        $this->db->where('id', $id);
        $data = $this->db->get('artikel');
        return $data->row();
    }
    
    public function getDataArtikelBySlug($slug){  
        $this->db->where('slug', $slug);
        $data = $this->db->get('artikel');
        return $data->row();
    }

    public function getDataArtikelTerbaru(){
        $this->db->order_by('id', 'DESC'); 
        $this->db->limit(6);
        $data = $this->db->get('artikel');
        return $data->result();
    }

    public function updateDataArtikel($data, $id){
        $this->db->where('id', $id);
        $this->db->update('artikel', $data);
    }

    public function deleteArtikelById($id){
        $this->db->where('id', $id);
        return $this->db->delete('artikel');
        
    }

    public function countArtikel(){
        $data = $this->db->count_all('artikel');
        return $data;
    }
}

?>
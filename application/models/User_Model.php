<?php

class User_Model extends CI_Model{

    public function getDataUser(){
        $data = $this->db->get('user');
        return $data->result();
    }

    public function insertUser($data){
        $this->db->insert('user', $data);
    }

    public function getUserDetail($username) {
        $this->db->where('username', $username);
        $dataUser = $this->db->get('user');
        return $dataUser->row();
    }
    public function deleteUser($id){
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
    public function updateUser($id, $data){
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function countUser(){
        $data = $this->db->count_all('user');
        return $data;
    }
}
?>
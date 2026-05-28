<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property User_Model $User_Model
 */

class KelolaUser extends CI_Controller{
    
    public function __construct() {
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Profile_Model');
    $this->load->library('session');
    if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('User/index');
        }
    }

    // =====================
    // READ
    // =====================
    function index(){
        $data['users'] = $this->User_Model->getDataUser();
        $data['profil'] = $this->Profile_Model->getProfile();

        $this->load->view('templates/headerDashboard', $data);
        $this->load->view('admin/kelolaUser', $data);
        $this->load->view('templates/footerDashboard');
    }

    // =====================
    // CREATE
    // =====================
    public function simpanUser(){

        // --- validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('KelolaUser');
            return;
        }

        $data = [
            'nama'     => $this->input->post('nama', TRUE),
            'username' => $this->input->post('username', TRUE),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'     => $this->input->post('role', TRUE)
        ];

        // --- Menggunakan $this->db karena tidak ada insertUser di model ---
        $this->User_Model->insertUser($data);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
        redirect('KelolaUser');
        }
        
        // =====================
        // UPDATE
        // =====================
    public function updateUser(){

        // --- validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('KelolaUser');
            return;
        }

        $id = $this->input->post('id');

        $dataUpdate = [
            'nama'     => $this->input->post('nama', TRUE),
            'username' => $this->input->post('username', TRUE),
            'role'     => $this->input->post('role', TRUE)
        ];

        // Kalau password diisi, update password juga
        $password = $this->input->post('password');
        if (!empty($password)) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->User_Model->updateUser($id, $dataUpdate);

        if ($id == $this->session->userdata('user_id')) {
            $this->session->sess_destroy();
            redirect('User/index');
        }

        $this->session->set_flashdata('success', 'User berhasil diupdate!');
        redirect('KelolaUser');
    }


    // =====================
    // DELETE
    // =====================
    public function delete($id){
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Tidak bisa menghapus akun sendiri!');
            redirect('KelolaUser');
            return;
        }

        $this->User_Model->deleteUser($id);

        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('KelolaUser');
    }

}
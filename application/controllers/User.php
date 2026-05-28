<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property User_Model $User_Model
 */

class User extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Profile_Model');
    $this->load->library('session');
}

    function index() {
        $data['profil'] = $this->Profile_Model->getProfile();
        if ($this->session->userdata('is_login')) {
            redirect('Dashboard');
        }
        $this->load->view('templates/header',[
        'title' => 'Halaman Login',
        'profil' => $data['profil']
        ]

        );
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    public function cek_login() {
        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('User/index');
            return;
        }
        // --- AKHIR TAMBAHAN ---

        $usernameInput = $this->input->post('username', TRUE);
        $passwordInput = $this->input->post('password');
        $userData = $this->User_Model->getUserDetail($usernameInput);
        if ($userData && password_verify($passwordInput, $userData->password)) {
            $this->session->set_userdata([
                'user_id' => $userData->id,
                'username' => $userData->username,
                'role' => $userData->role,
                'is_login' => true
            ]);
            // --- PERBAIKAN: langsung ke Dashboard, tidak perlu lewat User/index ---
            redirect('Dashboard');
        }
        else{
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('User/index');
        }
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout() {
        $this->session->sess_destroy();
        redirect('User/index');
    }
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property User_Model $User_Model
 * @property Artikel_Model $Artikel_Model
 * @property Sarana_Model $Sarana_Model
 * @property Caraousel_Model $Carousel_Model
 */
class Dashboard extends CI_Controller{
    public function __construct() {
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Artikel_Model');
    $this->load->model('Sarana_Model');
    $this->load->model('Carousel_Model');
    $this->load->model('Profile_Model');
    


    $this->load->library('session');
    if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('User/index');
        }
}   

function index(){
    // 1. Definisikan semua data ke dalam array $data
    $data['title'] = 'Halaman Dashboard'; // Pindahkan title ke sini
    $data['jumlah_artikel'] = $this->Artikel_Model->countArtikel();
    $data['jumlah_carousel'] = $this->Carousel_Model->countCarousel();
    $data['jumlah_sarana'] = $this->Sarana_Model->countSarana();
    $data['jumlah_user'] = $this->User_Model->countUser();
    $data['artikel_baru'] = $this->Artikel_Model->getDataArtikelTerbaru();
    $data['sarana_baru'] = $this->Sarana_Model->getDataSaranaTerbaru();
    $data['profil'] = $this->Profile_Model->getProfile();
    $this->load->view('templates/headerDashboard', $data); 
    $this->load->view('admin/dashboard1', $data);
    $this->load->view('templates/footerDashboard');
}

}
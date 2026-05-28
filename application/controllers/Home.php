<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct() {
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Artikel_Model');
    $this->load->model('Sarana_Model');
    $this->load->model('Carousel_Model');
    $this->load->model('Profile_Model');
    $this->load->model('Galeri_Model');
    }

function index(){

    $data['artikel'] = $this->Artikel_Model->getDataArtikelTerbaru();
    $data['carousel'] = $this->Carousel_Model->getDataCarousel();
    $data['sarana'] = $this->Sarana_Model->getDataSaranaTerbaru();
    $data['profil'] = $this->Profile_Model->getProfile();
    $data['galeri'] = $this->Galeri_Model->getDataGaleriTerbaru();

    $this->load->view('templates/header', [
        'title'  => 'Halaman Dashboard',
        'profil' => $data['profil']
    ]);

    $this->load->view('home/home', $data);
    $this->load->view('templates/footer');
}
public function artikel($slug){
    $data['profil'] = $this->Profile_Model->getProfile();
    $data['artikel'] = $this->Artikel_Model->getDataArtikelBySlug($slug);
    
    if (empty($data['artikel'])) {
        redirect('Error_404');
        return; 
    }

    $this->db->where('slug', $slug);
    $this->db->set('viewer', 'viewer + 1', FALSE); 
    $this->db->update('artikel');
    
    $this->load->view('templates/header', [
        'title'  => $data['artikel']->judul, 
        'profil' => $data['profil']           
    ]);
    
    $this->load->view('home/artikel', $data);
    $this->load->view('templates/footer');
}

public function profile(){
    $data['profil'] = $this->Profile_Model->getProfile();
    $data['sarana'] = $this->Sarana_Model->getDataSarana();
    
    $this->load->view('templates/header', [
        'title'  => 'Profil Sekolah',
        'profil' => $data['profil']
    ]);
    $this->load->view('home/profile', $data);
    $this->load->view('templates/footer');
}

public function artikel_list(){
    $data['profil'] = $this->Profile_Model->getProfile();
    $data['artikel'] = $this->Artikel_Model->getDataArtikel();
    
    $this->load->view('templates/header', [
        'title'  => 'Artikel & Berita Sekolah',
        'profil' => $data['profil']
    ]);
    $this->load->view('home/artikelPage', $data);
    $this->load->view('templates/footer');
}

public function galeri(){
    $data['profil'] = $this->Profile_Model->getProfile();
    $data['galeri'] = $this->Galeri_Model->getDataGaleri();
    
    $this->load->view('templates/header', [
        'title'  => 'Galeri Kegiatan Sekolah',
        'profil' => $data['profil']
    ]);
    $this->load->view('home/GaleriPage', $data);
    $this->load->view('templates/footer');
}
}
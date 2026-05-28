<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property Carousel_Model $Carousel_Model
 * @property CI_Upload $upload
 */

class Carousel extends CI_Controller{
    
    public function __construct() {
    parent::__construct();
    $this->load->model('Carousel_Model');
    $this->load->model('User_Model');
    $this->load->model('Profile_Model');
    $this->load->library('session');
    $this->load->library('upload');
    if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('User/index');
        }
    }

    // =====================
    // READ
    // =====================
    function index(){
        $data['carousel'] = $this->Carousel_Model->getDataCarousel();
        $data['profil'] = $this->Profile_Model->getProfile();
        $data['title'] = "Kelola Caraousel/Banner";

        $this->load->view('templates/headerDashboard', $data);
        $this->load->view('admin/carousel', $data);
        $this->load->view('templates/footerDashboard');
    }

    // =====================
    // CREATE
    // =====================
    public function simpanCarousel(){

        // --- validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Carousel');
            return;
        }

        $config['upload_path']   = './assets/images/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name'] = TRUE;
        $config['detect_mime']  = TRUE;
        $config['mod_mime_fix'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('gambar')) {

            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
            redirect('Carousel');

        } else {

            $file = $this->upload->data('file_name');

            $data = [
                'judul'     => $this->input->post('judul', TRUE),
                'gambar'    => $file,
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];

            $this->Carousel_Model->insertDataCaraousel($data);

            $this->session->set_flashdata('success', 'Banner berhasil ditambahkan!');
            redirect('Carousel');
        }
    }

    // =====================
    // UPDATE
    // =====================
    public function update(){

        // --- validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Carousel');
            return;
        }

        $id = $this->input->post('id');

        $dataLama = $this->Carousel_Model->getDataCarouselById($id);

        $dataUpdate = [
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE)
        ];

        // kalau ada gambar baru
        if (!empty($_FILES['gambar']['name'])) {

            $config['upload_path']   = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['encrypt_name'] = TRUE;
            $config['detect_mime']  = TRUE;
            $config['mod_mime_fix'] = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {

                // hapus gambar lama
                if ($dataLama && file_exists('./assets/images/' . $dataLama->gambar)) {
                    unlink('./assets/images/' . $dataLama->gambar);
                }

                $file = $this->upload->data('file_name');
                $dataUpdate['gambar'] = $file;
            }
        }

        $this->Carousel_Model->updateDataCaraousel($dataUpdate, $id);

        $this->session->set_flashdata('success', 'Banner berhasil diupdate!');
        redirect('Carousel');
    }

    // =====================
    // DELETE
    // =====================
    public function delete($id){

        $data = $this->Carousel_Model->getDataCarouselById($id);

        if ($data) {

            if (file_exists('./assets/images/' . $data->gambar)) {
                unlink('./assets/images/' . $data->gambar);
            }

            $this->Carousel_Model->deleteDataCarouselById($id);

            $this->session->set_flashdata('success', 'Banner berhasil dihapus!');
        }

        redirect('Carousel');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property Galeri_Model $Galeri_Model
 * @property CI_Upload $upload
 */


class Galeri extends CI_Controller{
    
    public function __construct() {
        parent::__construct();

        $this->load->model('Galeri_Model');
        $this->load->model('Profile_Model');
        $this->load->model('User_Model');
        $this->load->library('session');
        $this->load->library('upload');

        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('User/index');
        }
    }

    // =====================
    // READ (HALAMAN UTAMA)
    // =====================
    public function index(){
        $data['galeri'] = $this->Galeri_Model->getDataGaleri();
        $data['profil'] = $this->Profile_Model->getProfile();
        $data['title'] = "Kelola Galeri";

        $this->load->view('templates/headerDashboard', $data);
        $this->load->view('admin/galeri', $data);
        $this->load->view('templates/footerDashboard');
    }

    // =====================
    // INSERT GALERI
    // =====================
    public function simpanGaleri(){

        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Galeri');
            return;
        }
        // --- AKHIR TAMBAHAN ---

        $config['upload_path']   = './assets/images/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name'] = TRUE;
        $config['detect_mime']  = TRUE;
        $config['mod_mime_fix'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('gambar')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
            redirect('Galeri');
        } else {

            $file = $this->upload->data('file_name');

            $data = [
                'judul'  => $this->input->post('judul', TRUE),
                'gambar' => $file,
                'tanggal' => date('Y-m-d H:i:s'),
                'user_id' => $this->session->userdata('user_id')
            ];

            $this->Galeri_Model->insertDataGaleri($data);

            $this->session->set_flashdata('success', 'Foto berhasil ditambahkan!');
            redirect('Galeri');
        }
    }

    // =====================
    // DELETE GALERI
    // =====================
    public function delete($id){

        $data = $this->Galeri_Model->getDataGaleriById($id);

        if ($data) {
            // hapus file lama
            if (file_exists('./assets/images/' . $data->gambar)) {
                unlink('./assets/images/' . $data->gambar);
            }

            $this->Galeri_Model->deleteDataGaleriById($id);

            $this->session->set_flashdata('success', 'Foto berhasil dihapus!');
        }

        redirect('Galeri');
    }

    // =====================
    // UPDATE GALERI
    // =====================
    public function updateGaleri(){

        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Galeri');
            return;
        }
        // --- AKHIR TAMBAHAN ---

        $id = $this->input->post('id');

        $dataLama = $this->Galeri_Model->getDataGaleriById($id);

        $updateData = [
            'judul' => $this->input->post('judul', TRUE)
        ];

        // kalau user upload gambar baru
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
                $updateData['gambar'] = $file;
            }
        }

        $this->Galeri_Model->updateDataGaleri($updateData, $id);

        $this->session->set_flashdata('success', 'Foto berhasil diupdate!');
        redirect('Galeri');
    }
}
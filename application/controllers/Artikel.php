<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property Artikel_Model $Artikel_Model
 * @property Profile_Model $Profile_Model
 * @property CI_Upload $upload
 */

class Artikel extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model('Artikel_Model');
        $this->load->model('Profile_Model');
        $this->load->library('session');
        $this->load->library('upload');

        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('error', 'Silakan login dulu!');
            redirect('User/index');
        }
    }

    // =====================
    // READ
    // =====================
    public function index(){

        $data['artikel'] = $this->Artikel_Model->getDataArtikel();
        $data['profil'] = $this->Profile_Model->getProfile();
        $data['title'] = 'Kelola Artikel';

        $this->load->view('templates/headerDashboard', $data);
        $this->load->view('admin/artikel', $data);
        $this->load->view('templates/footerDashboard');
    }



    // =====================
    // CREATE
    // =====================
    public function tambah(){

        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Artikel');
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
            redirect('Artikel');

        } else {

            $file = $this->upload->data('file_name');

            $data = [
                'judul'       => $this->input->post('judul', TRUE),
                'slug'        => $this->input->post('slug', TRUE),
                'deskripsi'   => $this->input->post('deskripsi', TRUE),
                'gambar'      => $file,
                'viewer'       => 0,
                'tanggal'  => date('Y-m-d H:i:s')
            ];

            $this->Artikel_Model->simpanArtikel($data);

            $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
            redirect('Artikel');
        }
    }

    // =====================
    // UPDATE
    // =====================
    public function update(){

        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Artikel');
            return;
        }
        // --- AKHIR TAMBAHAN ---

        $id = $this->input->post('id');

        $artikel = $this->Artikel_Model->getDataArtikelId($id);

        $dataUpdate = [
            'judul'     => $this->input->post('judul', TRUE),
            'slug'      => $this->input->post('slug', TRUE),
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

                // ha
                if ($artikel && file_exists('./assets/images/' . $artikel->gambar)) {
                    unlink('./assets/images/' . $artikel->gambar);
                }

                $file = $this->upload->data('file_name');
                $dataUpdate['gambar'] = $file;
            }
        }

        $this->Artikel_Model->updateDataArtikel($dataUpdate, $id);

        $this->session->set_flashdata('success', 'Artikel berhasil diupdate!');
        redirect('Artikel');
    }

    // =====================
    // DELETE
    // =====================
    public function delete($id){
        if ($this->input->method() !== 'post') {
            show_error('Method Not Allowed', 405);
            exit;
            }
        $artikel = $this->Artikel_Model->getDataArtikelId($id);

        if ($artikel) {

            if (file_exists('./assets/images/' . $artikel->gambar)) {
                unlink('./assets/images/' . $artikel->gambar);
            }

            $this->Artikel_Model->deleteArtikelById($id);

            $this->session->set_flashdata('success', 'Artikel berhasil dihapus!');
        }

        redirect('Artikel');
    }
}
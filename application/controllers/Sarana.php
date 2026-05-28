<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property Sarana_Model $Sarana_Model
 * @property CI_Upload $upload
 */

class Sarana extends CI_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model('Sarana_Model');
        $this->load->model('Profile_Model');
        $this->load->library('session');
        $this->load->library('upload');

        if (!$this->session->userdata('is_login')) {
            $this->session->set_flashdata('error', 'Login dulu ya!');
            redirect('User/index');
        }
    }

    // =====================
    // READ
    // =====================
    public function index(){

        $data['sarana'] = $this->Sarana_Model->getDataSarana();
        $data['profil'] = $this->Profile_Model->getProfile();
        $data['title'] = "Kelola Sarana & Prasarana";

        $this->load->view('templates/headerDashboard', $data);
        $this->load->view('admin/saranaPrasarana', $data);
        $this->load->view('templates/footerDashboard');
    }

    // =====================
    // CREATE
    // =====================
    public function simpanSarana(){

        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Nama Sarana', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('keadaan', 'Keadaan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Sarana');
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
            redirect('Sarana');

        } else {

            $file = $this->upload->data('file_name');

            $data = [
                'judul'   => $this->input->post('judul', TRUE),
                'gambar'  => $file,
                'jumlah'  => $this->input->post('jumlah', TRUE),
                'keadaan' => $this->input->post('keadaan', TRUE),
                'tanggal' => date('Y-m-d H:i:s')
            ];

            $this->Sarana_Model->insertDataSarana($data);

            $this->session->set_flashdata('success', 'Data sarana berhasil ditambahkan!');
            redirect('Sarana');
        }
    }

    // =====================
    // UPDATE
    // =====================
    public function update(){

        // --- TAMBAHAN: validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul', 'Nama Sarana', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('keadaan', 'Keadaan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Sarana');
            return;
        }
        // --- AKHIR TAMBAHAN ---

        $id = $this->input->post('id');

        $dataLama = $this->Sarana_Model->getDataSaranaById($id);

        $dataUpdate = [
            'judul'   => $this->input->post('judul', TRUE),
            'jumlah'  => $this->input->post('jumlah', TRUE),
            'keadaan' => $this->input->post('keadaan', TRUE)
        ];

        if (!empty($_FILES['gambar']['name'])) {

            $config['upload_path']   = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['encrypt_name'] = TRUE;
            $config['detect_mime']  = TRUE;
            $config['mod_mime_fix'] = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {

                if ($dataLama && file_exists('./assets/images/' . $dataLama->gambar)) {
                    unlink('./assets/images/' . $dataLama->gambar);
                }

                $file = $this->upload->data('file_name');
                $dataUpdate['gambar'] = $file;
            }
        }

        $this->Sarana_Model->updateDataSarana($dataUpdate, $id);

        $this->session->set_flashdata('success', 'Data berhasil diupdate!');
        redirect('Sarana');
    }

    // =====================
    // DELETE
    // =====================
    public function delete($id){

        $data = $this->Sarana_Model->getDataSaranaById($id);

        if ($data) {

            if (file_exists('./assets/images/' . $data->gambar)) {
                unlink('./assets/images/' . $data->gambar);
            }

            $this->Sarana_Model->deleteDataSaranaById($id);

            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        }

        redirect('Sarana');
    }
}
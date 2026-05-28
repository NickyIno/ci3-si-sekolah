<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property Profile_Model $Profile_Model
 * @property CI_Upload $upload
 */

class Profile extends CI_Controller{

    public function __construct(){
        parent::__construct();

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

        $data['profil'] = $this->Profile_Model->getProfile();
        $data['title'] = "Profile Sekolah";

        $this->load->view('templates/headerDashboard', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footerDashboard');
    }

    // =====================
    // UPDATE
    // =====================
    public function update(){

        // --- validasi server-side ---
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_sekolah',   'Nama Sekolah',   'required|trim');
        $this->form_validation->set_rules('kepala_sekolah', 'Kepala Sekolah', 'required|trim');
        $this->form_validation->set_rules('alamat',         'Alamat',         'required|trim');
        $this->form_validation->set_rules('visi',           'Visi',           'required|trim');
        $this->form_validation->set_rules('misi',           'Misi',           'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect('Profile');
            return;
        }
        // --- akhir validasi ---

        // Ambil data profil lama sebagai fallback
        $profil = $this->Profile_Model->getProfile();

        // Helper: pakai input baru kalau ada, fallback ke data lama
        $val = function($field, $old) {
            $new = $this->input->post($field, TRUE);
            return ($new !== NULL && $new !== '') ? $new : $old;
        };

        $dataUpdate = [
            'nama_sekolah'   => $val('nama_sekolah',   $profil->nama_sekolah   ?? ''),
            'kepala_sekolah' => $val('kepala_sekolah', $profil->kepala_sekolah ?? ''),
            'alamat'         => $val('alamat',         $profil->alamat         ?? ''),
            'visi'           => $val('visi',           $profil->visi           ?? ''),
            'misi'           => $val('misi',           $profil->misi           ?? ''),
            'profil'         => $val('profil',         $profil->profil         ?? ''),
            'tentang'        => $val('tentang',        $profil->tentang        ?? ''),
            'user_id'        => $this->session->userdata('user_id'),
        ];

        // ---- Upload logo baru ----
        if (!empty($_FILES['logo']['name'])) {

            $config = [
                'upload_path'   => './assets/images/',
                'allowed_types' => 'jpg|jpeg|png|webp|svg',
                'max_size'      => 2048,
                'encrypt_name'  => TRUE,
                'detect_mime'   => TRUE,
                'mod_mime_fix'  => TRUE,
            ];
            $this->upload->initialize($config);

            if ($this->upload->do_upload('logo')) {

                // Hapus logo lama (path konsisten dengan upload_path)
                if ($profil && !empty($profil->logo)) {
                    $old_logo = './assets/images/' . $profil->logo;
                    if (file_exists($old_logo)) {
                        unlink($old_logo);
                    }
                }

                $dataUpdate['logo'] = $this->upload->data('file_name');

            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('Profile');
                return;
            }

        } else {
            // Tidak ada upload baru → pertahankan logo lama
            $dataUpdate['logo'] = $profil->logo ?? NULL;
        }

        // ---- Upload foto kepala sekolah baru ----
        if (!empty($_FILES['foto_kepala_sekolah']['name'])) {

            $config = [
                'upload_path'   => './assets/images/',
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 2048,
                'encrypt_name'  => TRUE,
                'detect_mime'   => TRUE,
                'mod_mime_fix'  => TRUE,
            ];
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto_kepala_sekolah')) {

                // Hapus foto lama (path konsisten dengan upload_path)
                if ($profil && !empty($profil->foto_kepala_sekolah)) {
                    $old_foto = './assets/images/' . $profil->foto_kepala_sekolah;
                    if (file_exists($old_foto)) {
                        unlink($old_foto);
                    }
                }

                $dataUpdate['foto_kepala_sekolah'] = $this->upload->data('file_name');

            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('Profile');
                return;
            }

        } else {
            // Tidak ada upload baru → pertahankan foto lama
            $dataUpdate['foto_kepala_sekolah'] = $profil->foto_kepala_sekolah ?? NULL;
        }

        $this->Profile_Model->updateProfile($dataUpdate);

        $this->session->set_flashdata('success', 'Profil sekolah berhasil diupdate!');
        redirect('Profile');
    }
}
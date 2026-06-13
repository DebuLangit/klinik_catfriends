<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        // Memuat model untuk menarik data dari database
        $this->load->model('Klinik_model');
        
        // Mengambil data jadwal dokter beserta nama poli dan nama dokter
        // untuk ditampilkan di Landing Page publik
        $data['jadwal'] = $this->Klinik_model->get_jadwal_lengkap();
        
        // Memuat tampilan dengan tema hitam solid (header, konten landing, footer)
        $this->load->view('layout/header');
        $this->load->view('home/landing', $data);
        $this->load->view('layout/footer');
    }
    
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('id_pasien')) redirect('auth');
        $this->load->model('Klinik_model');
    }

    public function index() {
    // Cek login
    if (!$this->session->userdata('id_pasien')) {
        redirect('auth');
    }

    $id_pasien = $this->session->userdata('id_pasien');

    // MENGGANTI URUTAN JOIN: Pendaftaran -> Jadwal -> Dokter -> Poli
    $data['data_tiket'] = $this->db->query("
        SELECT p.*, j.hari, j.jam_mulai, pl.nama_poli, d.nama_dokter 
        FROM pendaftaran p
        JOIN jadwal_dokter j ON p.id_jadwal = j.id_jadwal
        JOIN dokter d ON j.id_dokter = d.id_dokter
        JOIN poli pl ON d.id_poli = pl.id_poli
        WHERE p.id_pasien = '$id_pasien'
        ORDER BY p.tanggal_kunjungan ASC
    ")->result_array();

    $this->load->view('layout/header');
    $this->load->view('pasien/dashboard', $data); 
    $this->load->view('layout/footer');
    }

    public function pendaftaran_baru() {
        $data['jadwal'] = $this->Klinik_model->get_jadwal_lengkap();
        $this->load->view('layout/header');
        $this->load->view('pasien/form_daftar', $data);
        $this->load->view('layout/footer');
    }

    public function simpan_daftar() {
        $metode_bayar = $this->input->post('metode_bayar');
        $no_bpjs = ($metode_bayar == 'BPJS') ? $this->input->post('no_bpjs') : NULL;
        $kode_booking = strtoupper(substr(md5(time()), 0, 8)); // Generate 8 karakter unik

        $data = [
            'kode_booking' => $kode_booking,
            'id_pasien' => $this->session->userdata('id_pasien'),
            'id_jadwal' => $this->input->post('id_jadwal'),
            'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
            'keluhan' => $this->input->post('keluhan'),
            'metode_bayar' => $metode_bayar,
            'no_bpjs' => $no_bpjs,
            'status' => 'Menunggu'
        ];
        
        $id_daftar = $this->Klinik_model->simpan_pendaftaran($data);
        redirect('pasien/tiket/'.$id_daftar);
    }

    public function tiket($id) {
        $data['tiket'] = $this->Klinik_model->get_tiket($id);
        $this->load->view('layout/header');
        $this->load->view('pasien/tiket', $data);
        $this->load->view('layout/footer');
    }

    public function detail_tiket($kode_booking) {
        // Pastikan pasien sudah login
        if (!$this->session->userdata('id_pasien')) {
            redirect('auth');
        }

        // Ambil data tiket berdasarkan kode booking
        $data['tiket'] = $this->Klinik_model->get_tiket_by_kode($kode_booking);

        // Jika tiket ditemukan, tampilkan halaman tiket
        if ($data['tiket']) {
            $this->load->view('layout/header');
            $this->load->view('pasien/tiket', $data);
            $this->load->view('layout/footer');
        } else {
            // Jika user iseng memasukkan kode booking yang salah di URL
            redirect('pasien');
        }
    }
}
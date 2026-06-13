<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik_model extends CI_Model {
    
    // Autentikasi
    public function get_pasien($no_hp) {
        return $this->db->get_where('pasien', ['no_hp' => $no_hp])->row_array();
    }

    public function register_pasien($data) {
        return $this->db->insert('pasien', $data);
    }

    // Mengambil data jadwal beserta nama dokter dan poli untuk form pendaftaran
    public function get_jadwal_lengkap() {
        $this->db->select('jadwal_dokter.*, dokter.nama_dokter, poli.nama_poli');
        $this->db->from('jadwal_dokter');
        $this->db->join('dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter');
        $this->db->join('poli', 'poli.id_poli = dokter.id_poli');
        return $this->db->get()->result_array();
    }

    // Pendaftaran
    public function simpan_pendaftaran($data) {
        $this->db->insert('pendaftaran', $data);
        return $this->db->insert_id();
    }

    public function get_riwayat_pasien($id_pasien) {
        $this->db->select('pendaftaran.*, jadwal_dokter.hari, jadwal_dokter.jam_mulai, jadwal_dokter.jam_selesai, dokter.nama_dokter, poli.nama_poli');
        $this->db->from('pendaftaran');
        $this->db->join('jadwal_dokter', 'jadwal_dokter.id_jadwal = pendaftaran.id_jadwal');
        $this->db->join('dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter');
        $this->db->join('poli', 'poli.id_poli = dokter.id_poli');
        $this->db->where('pendaftaran.id_pasien', $id_pasien);
        $this->db->order_by('pendaftaran.waktu_daftar', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_tiket($id_pendaftaran) {
        $this->db->select('pendaftaran.*, jadwal_dokter.hari, jadwal_dokter.jam_mulai, dokter.nama_dokter, poli.nama_poli, pasien.nama_pasien, pasien.nik');
        $this->db->from('pendaftaran');
        $this->db->join('jadwal_dokter', 'jadwal_dokter.id_jadwal = pendaftaran.id_jadwal');
        $this->db->join('dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter');
        $this->db->join('poli', 'poli.id_poli = dokter.id_poli');
        $this->db->join('pasien', 'pasien.id_pasien = pendaftaran.id_pasien');
        $this->db->where('pendaftaran.id_pendaftaran', $id_pendaftaran);
        return $this->db->get()->row_array();
    }

    public function get_tiket_by_kode($kode_booking) {
        $this->db->select('pendaftaran.*, jadwal_dokter.hari, jadwal_dokter.jam_mulai, dokter.nama_dokter, poli.nama_poli, pasien.nama_pasien, pasien.nik');
        $this->db->from('pendaftaran');
        $this->db->join('jadwal_dokter', 'jadwal_dokter.id_jadwal = pendaftaran.id_jadwal');
        $this->db->join('dokter', 'dokter.id_dokter = jadwal_dokter.id_dokter');
        $this->db->join('poli', 'poli.id_poli = dokter.id_poli');
        $this->db->join('pasien', 'pasien.id_pasien = pendaftaran.id_pasien');
        $this->db->where('pendaftaran.kode_booking', $kode_booking);
        
        return $this->db->get()->row_array();
    }
}
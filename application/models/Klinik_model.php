<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik_model extends CI_Model {

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function get_dokters() {
        return $this->db->get('dokters')->result_array();
    }

    public function daftar_pasien($data) {
        $this->db->insert('pendaftarans', $data);
        return $this->db->insert_id();
    }

    public function get_tiket($id_pendaftaran) {
        $this->db->select('pendaftarans.*, dokters.nama_dokter, users.nama as nama_pemilik');
        $this->db->from('pendaftarans');
        $this->db->join('dokters', 'dokters.id = pendaftarans.id_dokter');
        $this->db->join('users', 'users.id = pendaftarans.id_user');
        $this->db->where('pendaftarans.id', $id_pendaftaran);
        return $this->db->get()->row_array();
    }

    public function get_all_pendaftaran() {
        $this->db->select('pendaftarans.*, dokters.nama_dokter, users.nama as nama_pemilik');
        $this->db->from('pendaftarans');
        $this->db->join('dokters', 'dokters.id = pendaftarans.id_dokter');
        $this->db->join('users', 'users.id = pendaftarans.id_user');
        $this->db->order_by('tanggal_jadwal', 'ASC');
        return $this->db->get()->result_array();
    }
}
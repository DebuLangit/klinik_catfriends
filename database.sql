CREATE DATABASE IF NOT EXISTS db_klinik_kurnia;
USE db_klinik_kurnia;

CREATE TABLE poli (
    id_poli INT AUTO_INCREMENT PRIMARY KEY,
    nama_poli VARCHAR(50) NOT NULL,
    deskripsi TEXT
);

CREATE TABLE dokter (
    id_dokter INT AUTO_INCREMENT PRIMARY KEY,
    id_poli INT,
    nama_dokter VARCHAR(100) NOT NULL,
    foto_dokter VARCHAR(255),
    FOREIGN KEY (id_poli) REFERENCES poli(id_poli)
);

CREATE TABLE pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(16) UNIQUE NOT NULL,
    nama_pasien VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    alamat TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jadwal_dokter (
    id_jadwal INT AUTO_INCREMENT PRIMARY KEY,
    id_dokter INT,
    hari VARCHAR(10) NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    FOREIGN KEY (id_dokter) REFERENCES dokter(id_dokter)
);

CREATE TABLE pendaftaran (
    id_pendaftaran INT AUTO_INCREMENT PRIMARY KEY,
    kode_booking VARCHAR(10) UNIQUE NOT NULL,
    id_pasien INT,
    id_jadwal INT,
    tanggal_kunjungan DATE NOT NULL,
    keluhan TEXT,
    metode_bayar ENUM('Umum', 'BPJS', 'Asuransi') NOT NULL,
    no_bpjs VARCHAR(20) DEFAULT NULL,
    status ENUM('Menunggu', 'Diperiksa', 'Selesai', 'Batal') DEFAULT 'Menunggu',
    waktu_daftar DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien),
    FOREIGN KEY (id_jadwal) REFERENCES jadwal_dokter(id_jadwal)
);

-- 1. Mengisi Data Poli
INSERT INTO poli (nama_poli, deskripsi) VALUES
('Poli Umum', 'Melayani pemeriksaan kesehatan umum, konsultasi medis dasar, dan pembuatan surat keterangan sehat.'),
('Poli Gigi', 'Melayani pemeriksaan, pencabutan, penambalan, dan perawatan kesehatan gigi dan mulut.'),
('Poli KIA', 'Melayani Kesehatan Ibu dan Anak, termasuk imunisasi dasar dan pemeriksaan kehamilan.');

-- 2. Mengisi Data Dokter
INSERT INTO dokter (id_poli, nama_dokter, foto_dokter) VALUES
(1, 'dr. Andi Saputra', 'default.jpg'),
(2, 'drg. Budi Santoso', 'default.jpg'),
(3, 'dr. Citra Lestari, Sp.A', 'default.jpg'),
(1, 'dr. Diana Putri', 'default.jpg');

-- 3. Mengisi Data Pasien
-- Catatan: Password diset '123456'. Nanti di CI3, pastikan kamu menggunakan fungsi password_hash() saat fitur registrasi dibuat.
INSERT INTO pasien (nik, nama_pasien, no_hp, password, alamat) VALUES
('3301234567890001', 'Ahmad Faisal', '081234567890', '123456', 'Jl. Jenderal Soedirman No. 45, Purwokerto'),
('3301234567890002', 'Siti Aminah', '089876543210', '123456', 'Jl. Gatot Subroto, Cilacap'),
('3301234567890003', 'Bima Arya', '081122334455', '123456', 'Jl. Kaliurang Km 5, Yogyakarta');

-- 4. Mengisi Jadwal Praktek Dokter
INSERT INTO jadwal_dokter (id_dokter, hari, jam_mulai, jam_selesai) VALUES
(1, 'Senin', '08:00:00', '12:00:00'),
(1, 'Rabu', '08:00:00', '12:00:00'),
(2, 'Selasa', '16:00:00', '20:00:00'),
(2, 'Kamis', '16:00:00', '20:00:00'),
(3, 'Jumat', '08:00:00', '11:00:00'),
(4, 'Senin', '16:00:00', '20:00:00');

-- 5. Mengisi Data Pendaftaran / Transaksi Dummy
-- Menggunakan tanggal di bulan Juni 2026 agar relevan
INSERT INTO pendaftaran (kode_booking, id_pasien, id_jadwal, tanggal_kunjungan, keluhan, metode_bayar, no_bpjs, status) VALUES
('KLN-0001', 1, 1, '2026-06-15', 'Demam tinggi dan batuk berdahak sejak 3 hari yang lalu', 'BPJS', '0001234567890', 'Menunggu'),
('KLN-0002', 2, 3, '2026-06-16', 'Gigi geraham bawah kiri berlubang dan sering ngilu', 'Umum', NULL, 'Selesai'),
('KLN-0003', 3, 5, '2026-06-19', 'Jadwal imunisasi campak anak', 'Umum', NULL, 'Menunggu');
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card p-0 text-center border-2" style="border-color: #fff !important;">
            <div class="bg-white text-black p-3 border-bottom">
                <h4 class="mb-0 fw-bold">E-TIKET KLINIK KURNIA</h4>
            </div>
            <div class="p-5">
                <p class="text-muted small mb-1">KODE BOOKING</p>
                <h1 class="display-4 fw-bold mb-4" style="letter-spacing: 3px;"><?= $tiket['kode_booking'] ?></h1>
                
                <div class="row text-start border-top pt-4" style="border-color: #333 !important;">
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block">Nama Pasien</small>
                        <strong><?= $tiket['nama_pasien'] ?></strong>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block">Tanggal</small>
                        <strong><?= date('d M Y', strtotime($tiket['tanggal_kunjungan'])) ?></strong>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block">Hari / Jam</small>
                        <strong><?= $tiket['hari'] ?>, <?= substr($tiket['jam_mulai'],0,5) ?> WIB</strong>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block">Metode Bayar</small>
                        <strong><?= $tiket['metode_bayar'] ?></strong>
                    </div>
                    <div class="col-12 mt-2">
                        <small class="text-muted d-block">Tujuan Poli & Dokter</small>
                        <strong><?= $tiket['nama_poli'] ?> (<?= $tiket['nama_dokter'] ?>)</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 mb-5">
            <button onclick="window.print()" class="btn btn-outline-light me-2">CETAK PDF</button>
            <a href="<?= base_url('pasien') ?>" class="btn btn-primary">KEMBALI KE DASHBOARD</a>
        </div>
    </div>
</div>
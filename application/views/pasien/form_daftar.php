<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-5">
            <h3 class="mb-4 text-uppercase border-bottom pb-2" style="border-color: #333 !important;">Form Pendaftaran</h3>
            <form action="<?= base_url('pasien/simpan_daftar') ?>" method="post">
                
                <label class="small text-muted text-uppercase">Pilih Jadwal & Dokter</label>
                <select name="id_jadwal" class="form-select mb-3" required>
                    <option value="">-- Pilih Jadwal --</option>
                    <?php foreach($jadwal as $j): ?>
                        <option value="<?= $j['id_jadwal'] ?>">
                            <?= $j['nama_poli'] ?> - <?= $j['nama_dokter'] ?> | <?= $j['hari'] ?> (<?= substr($j['jam_mulai'],0,5) ?> - <?= substr($j['jam_selesai'],0,5) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label class="small text-muted text-uppercase">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" class="form-control mb-3" required>

                <label class="small text-muted text-uppercase">Keluhan Utama</label>
                <textarea name="keluhan" class="form-control mb-3" rows="3" required></textarea>

                <label class="small text-muted text-uppercase">Metode Pembayaran</label>
                <select name="metode_bayar" id="metode_bayar" class="form-select mb-3" required onchange="cekBPJS()">
                    <option value="Umum">Umum (Biaya Mandiri)</option>
                    <option value="BPJS">BPJS Kesehatan</option>
                    <option value="Asuransi">Asuransi Swasta</option>
                </select>

                <div id="form_bpjs" style="display: none;">
                    <label class="small text-muted text-uppercase">Nomor Kartu BPJS</label>
                    <input type="text" name="no_bpjs" class="form-control mb-4" placeholder="Masukkan 13 Digit Nomor BPJS">
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">KONFIRMASI PENDAFTARAN</button>
            </form>
        </div>
    </div>
</div>

<script>
function cekBPJS() {
    var metode = document.getElementById("metode_bayar").value;
    var formBpjs = document.getElementById("form_bpjs");
    if(metode === "BPJS") {
        formBpjs.style.display = "block";
    } else {
        formBpjs.style.display = "none";
    }
}
</script>
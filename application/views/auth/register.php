<div class='row align-items-center' style='min-height:75vh'>
    <div class='col-lg-5'>
        <div class='card p-5'>
            <h2>Registrasi Pasien</h2>
            <form action="<?= base_url('auth/register') ?>" method='post'>
                <input type='text' name='nik' class='form-control mb-2' placeholder='NIK' required>
                <input type='text' name='nama_pasien' class='form-control mb-2' placeholder='Nama' required>
                <input type='text' name='no_hp' class='form-control mb-2' placeholder='No HP' required>
                <textarea name='alamat' class='form-control mb-2' placeholder='Alamat' rows='2' required></textarea>
                <input type='password' name='password' class='form-control mb-3' placeholder='Password' required>
                <button class='btn btn-primary w-100'>Daftar</button>
            </form>
        </div>
    </div>
    <div class='col-lg-6 text-center'>
        <i class='bi bi-heart-pulse-fill' style='font-size:180px;color:#FF9800'></i>
    </div>
</div>
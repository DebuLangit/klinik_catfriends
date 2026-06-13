<div class='row align-items-center' style='min-height:75vh'>
    <div class='col-lg-6 text-center'>
        <i class='bi bi-person-circle' style='font-size:180px;color:#0D6EFD'></i>
    </div>
    <div class='col-lg-5'>
        <div class='card p-5'>
            <h2>Login Klinik Kurnia</h2>
            <form action="<?= base_url('auth') ?>" method='post'>
                <div class='mb-3'>
                    <input type='text' name='no_hp' class='form-control' placeholder='Nomor HP' required>
                </div>
                <div class='mb-3'>
                    <input type='password' name='password' class='form-control' placeholder='Password' required>
                </div>
                <button class='btn btn-primary w-100'>Masuk</button>
            </form>
            <p class='mt-3'>Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar</a></p>
        </div>
    </div>
</div>
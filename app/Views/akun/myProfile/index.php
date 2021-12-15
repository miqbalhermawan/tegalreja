<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
        <h2 class="fw-bolder">My Profile</h2>
      </div>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col">
          <div class="card mb-3" style="max-width: 700px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?= base_url(); ?>/img/<?= user()->user_image; ?>" class="img-fluid rounded-start" style="width: 600px;">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <h4>Username : <?= user()->username; ?></h4>
                    </li>
                    <?php if (user()->fullname) : ?>
                      <li class="list-group-item">Nama Lengkap : <?= user()->fullname; ?></li>
                    <?php endif; ?>
                    <li class="list-group-item">Email : <?= user()->email; ?></li>
                    <li class="list-group-item">Nomor Induk Kependudukan : <?= user()->nik; ?></li>
                    <li class="list-group-item">Nomor Kartu Keluarga : <?= user()->no_kk; ?></li>
                    <li class="list-group-item">Tanggal Lahir : <?= date('d-m-Y', strtotime(user()->tanggal_lahir)); ?></li>
                    <li class="list-group-item">Nomor Telepon : <?= user()->no_hp; ?></li>
                    <li class="list-group-item">Nama Ibu : <?= user()->nama_ibu; ?></li>
                    <li class="list-group-item d-inline text-end">
                      <a href="<?= base_url('/myProfile/edit'); ?>" class="btn btn-info btn-sm mb-2">Edit Profile</a>
                      <a href="<?= base_url('/myProfile/gantiPassword'); ?>" class="btn btn-warning btn-sm mb-2">Ganti Password</a>
                      <a href="<?= base_url('/'); ?>" class="btn btn-primary btn-sm mb-2">Kembali ke Beranda</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
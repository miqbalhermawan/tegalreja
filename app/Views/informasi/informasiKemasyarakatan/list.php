<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-newspaper"></i></div>
        <h2 class="fw-bolder">Informasi</h2>
      </div>
    </div>
    <div class="row d-flex justify-content-lg-between mb-3">
      <div class="col-md-6">
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukan keyword pencarian.." name="keyword">
            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
          </div>
        </form>
      </div>
      <?php if (in_groups('super-admin') || in_groups('admin')) : ?>
        <div class="col d-flex justify-content-md-end mb-3">
          <a href="/informasiKemasyarakatan/create" class="btn btn-primary">Tambah Informasi</a>
        </div>
      <?php endif; ?>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
    <?php foreach ($informasi as $info) : ?>
      <div class="row">
        <div class="col">
          <div class="card mb-3 w-100">
            <a href="/informasiKemasyarakatan/<?= encrypt_url($info['id']); ?>" class="text-decoration-none link-dark stretched-link">
              <div class="row g-0">
                <div class="col-md-4">
                  <img src="/img/<?= $info['foto_info1']; ?>" class="img-fluid rounded-start" style="height:200px;">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?= $info['judul']; ?></h5>
                    <p class="card-text"><?= substr($info['informasi'], 0, 300); ?></p>
                    <p class="card-text"><small class="text-muted"><?= date('d-m-Y h:m:s', strtotime($info['created_at'])); ?></small></p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?= $pager->links('informasi', 'pagination'); ?>
  </div>
</div>

<?= $this->endSection(); ?>
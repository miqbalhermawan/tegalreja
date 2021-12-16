<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="row">
    <div id="carouselInformasi" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <?php $i = 0;
        foreach ($informasi as $info) : ?>
          <?php if ($i == 0) {
            $actives = 'active';
          } else {
            $actives = '';
          } ?>
          <button type="button" data-bs-target="#carouselInformasi" data-bs-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></button>
        <?php if ($i++ == 2) break;
        endforeach; ?>
      </div>
      <div class="carousel-inner">
        <?php $i = 0;
        foreach ($informasi as $info) : ?>
          <?php if ($i == 0) {
            $actives = 'active';
          } else {
            $actives = '';
          } ?>
          <div class="carousel-item <?= $actives; ?>">
            <img src="/img/<?= $info['foto_info1']; ?>" style="width: 100%; height: 30rem;">
            <div class="carousel-caption d-none d-md-block">
              <h3><?= $info['judul']; ?></h3>
              <p><?= substr($info['informasi'], 0, 200); ?></p>
            </div>
          </div>
        <?php if ($i++ == 2) break;
        endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselInformasi" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselInformasi" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-newspaper"></i></div>
        <h2 class="fw-bolder">Informasi</h2>
      </div>
    </div>
    <div class="row gx-5">
      <?php foreach ($informasi as $info) : ?>
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="/img/<?= $info['foto_info1']; ?>" style="height: 250px;" alt="..." />
            <div class="card-body p-4">
              <a class="text-decoration-none link-dark stretched-link" href="/informasiKemasyarakatan/<?= encrypt_url($info['id']); ?>">
                <div class="h5 card-title mb-3"><?= $info['judul']; ?></div>
              </a>
              <p class="card-text mb-0"><?= substr($info['informasi'], 0, 100); ?></p>
            </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-flex align-items-end justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="small">
                    <div class="text-muted"><?= date('d-m-Y, H:i', strtotime($info['created_at'])); ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="text-end mb-5 mb-xl-0">
        <a class="text-decoration-none" href="<?= base_url('/informasiKemasyarakatan/list'); ?>">
          Informasi Lainnya
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>

  <?= $this->endSection(); ?>
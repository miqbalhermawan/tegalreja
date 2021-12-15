<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-newspaper"></i></div>
        <h2 class="fw-bolder"><?= $informasi['judul']; ?></h2>
      </div>
    </div>

    <hr>
    <?php if (empty($informasi['foto_info2'] || $informasi['foto_info3'])) : ?>
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
          <img class="img-fluid rounded-3 my-3" src="/img/<?= $informasi['foto_info1']; ?>" />
        </div>
      </div>
    <?php elseif (empty($informasi['foto_info3'])) : ?>
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
          <img class="img-fluid rounded-3 my-3" src="/img/<?= $informasi['foto_info1']; ?>" />
        </div>
      </div>
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
          <img class="img-fluid rounded-3 my-3" src="/img/<?= $informasi['foto_info2']; ?>" />
        </div>
      </div>
    <?php else : ?>
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="d-flex justify-content-center">
          <img class="img-fluid rounded-3 my-3" src="/img/<?= $informasi['foto_info1']; ?>" />
        </div>
      </div>
      <div class="row gx-5 align-items-center">
        <div class="col-lg-6 col-xl-6">
          <div class="d-flex justify-content-center">
            <img class="img-fluid rounded-3 my-3" src="/img/<?= $informasi['foto_info2']; ?>" />
          </div>
        </div>
        <div class="col-lg-6 col-xl-6">
          <div class="d-flex justify-content-center">
            <img class="img-fluid rounded-3 my-3" src="/img/<?= $informasi['foto_info3']; ?>" />
          </div>
        </div>
      </div>
    <?php endif; ?>

    <hr>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-10 col-xl-10">
        <div class="text-center">
          <div class="fs-4 mb-4 fst-italic"><?= $informasi['informasi']; ?></div>
        </div>
      </div>
    </div>
    <hr>

    <div class="row gx-5">
      <div class="col d-flex justify-content-end">
        <div class="d-inline">
          <?php if (in_groups('super-admin') || in_groups('admin')) :  ?>
            <a href="/informasiKemasyarakatan/edit/<?= encrypt_url($informasi['id']); ?>" class="btn btn-info mb-2">Edit</a>
            <form action="/informasiKemasyarakatan/<?= encrypt_url($informasi['id']); ?>" method="post" class="d-inline">
              <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('Apakah anda yakin ingin menghapus informasi ini?')">Hapus</button>
            </form>
          <?php endif; ?>
          <a href="/informasiKemasyarakatan/list" class="btn btn-success mb-2">Kembali ke List Informasi Kemasyarakatan</a>
        </div>
      </div>
    </div>

  </div>
</div>

<?= $this->endSection(); ?>
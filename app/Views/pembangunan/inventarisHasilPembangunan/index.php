<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-archive"></i></div>
        <h2 class="fw-bolder">Inventaris Hasil Pembangunan</h2>
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
          <a href="/inventarisHasilPembangunan/create" class="btn btn-primary">Tambah Inventaris Pembangunan</a>
        </div>
    </div>
    <div class="row d-flex justify-content-lg-start mb-3">
      <form action="/inventarisHasilPembangunan/import" method="post" enctype="multipart/form-data">
        <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
        <!-- Import Excel input-->
        <div class="input-group mb-3">
          <input type="file" class="form-control" id="import_excel" name="import_excel" accept=".xls,.xlsx">
          <button class="btn btn-primary" type="submit">Upload</button>
          <div class="invalid-feedback">
            <?= $validation->getError('import_excel'); ?>
          </div>
        </div>
      </form>
    </div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success mt-3" role="alert">
      <?= session()->getFlashdata('pesan'); ?>
    </div>
  <?php endif; ?>
  <div class="row gx-5 my-2">
    <div class="col">
      <div class="table-responsive mb-3">
        <table class="table table-hover table-bordered">
          <thead class="table-dark align-middle text-center">
            <tr>
              <th scope="col">Nomor</th>
              <th scope="col">Nomor Urut</th>
              <th scope="col">Nama Pembangunan</th>
              <th scope="col">Volume</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $n = 1 + (10 * ($currentPage - 1)); ?>
            <?php foreach ($inventarisPembangunan as $i) : ?>
              <tr>
                <th scope="row"><?= $n++; ?></th>
                <td><?= $i['no_urut']; ?></td>
                <td><?= $i['nama_pembangunan']; ?></td>
                <td><?= $i['volume']; ?></td>
                <td><?= $i['lokasi']; ?></td>
                <td><?= $i['keterangan']; ?></td>
                <td>
                  <a href="/inventarisHasilPembangunan/<?= encrypt_url($i['id']); ?>" class="btn btn-success">Detail</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?= $pager->links('inventaris_pembangunan', 'pagination'); ?>
    </div>
  </div>
  </div>
</div>

<?= $this->endSection(); ?>
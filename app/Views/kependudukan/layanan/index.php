<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 mt-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <di class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-bounding-box"></i></div>
        <h2 class="fw-bolder">Layanan Kependudukan</h2>
    </div>
    <div class="row d-flex justify-content-lg-between mb-3">
      <div class="col-md-6">
        <?php if (in_groups('super-admin') || in_groups('admin')) : ?>
          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Masukan keyword pencarian.." name="keyword">
              <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
      <div class="col d-flex justify-content-md-end mb-3">
        <a href="/layanan/create" class="btn btn-primary">Tambah Layanan</a>
      </div>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive mb-3">
          <table class="table table-hover table-bordered table-saran">
            <thead class="table-dark align-middle text-center">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Input</th>
                <th scope="col">Nomor Induk Kependudukan</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jenis Layanan</th>
                <th scope="col">Keperluan Pengajuan Layanan</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 + (10 * ($currentPage - 1)); ?>
              <?php foreach ($layanan as $l) : ?>
                <tr>
                  <th scope="row"><?= $i++; ?></th>
                  <td><?= date('d F Y, H:i', strtotime($l['created_at'])); ?></td>
                  <td><?= $l['nik']; ?></td>
                  <td><?= $l['nama']; ?></td>
                  <td><?= $l['jenis_layanan']; ?></td>
                  <td><?= $l['keterangan']; ?></td>
                  <td><?= $l['no_hp']; ?></td>
                  <td><?= $l['status']; ?></td>
                  <td>
                    <a href="/layanan/<?= encrypt_url($l['id']); ?>" class="btn btn-success">Detail</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('layanan', 'pagination'); ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
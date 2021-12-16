<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 mt-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <di class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
        <h2 class="fw-bolder">Saran Pembangunan</h2>
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
      <div class="col d-flex justify-content-md-end mb-3">
        <a href="/inputSaranPembangunan/create" class="btn btn-primary">Tambah Saran Pembangunan</a>
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
          <?php if (in_groups('user')) : ?>
            <table class="table table-hover table-bordered table-saran">
              <thead class="table-dark align-middle text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal Input</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Saran Pembangunan</th>
                  <th scope="col">Lokasi</th>
                  <th scope="col">Foto Lokasi</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                <?php foreach ($saranPembangunan as $s) : ?>
                  <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= date('d-m-Y, H:i', strtotime($s['created_at'])); ?></td>
                    <td><?= $s['nama']; ?></td>
                    <td><?= $s['saran']; ?></td>
                    <td><?= $s['lokasi']; ?></td>
                    <td><img src="/img/<?= $s['foto_lokasi']; ?>" class="lokasi"></td>
                    <?php if ($s['user_id'] == user()->id) : ?>
                      <td>
                        <a href="/inputSaranPembangunan/<?= encrypt_url($s['id']); ?>" class="btn btn-success">Detail</a>
                      </td>
                    <?php else : ?>
                      <td></td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else : ?>
            <table class="table table-hover table-bordered table-saran">
              <thead class="table-dark align-middle text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal Input</th>
                  <th scope="col">Nomor Induk Kependudukan</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Saran Pembangunan</th>
                  <th scope="col">Lokasi</th>
                  <th scope="col">Foto Lokasi</th>
                  <th scope="col">Foto Diri</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                <?php foreach ($saranPembangunan as $s) : ?>
                  <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= date('d-m-Y, H:i', strtotime($s['created_at'])); ?></td>
                    <td><?= $s['nik']; ?></td>
                    <td><?= $s['nama']; ?></td>
                    <td><?= $s['saran']; ?></td>
                    <td><?= $s['lokasi']; ?></td>
                    <td><img src="/img/<?= $s['foto_lokasi']; ?>" class="lokasi"></td>
                    <td><img src="/img/<?= $s['foto_diri']; ?>" class="orang"></td>
                    <td>
                      <a href="/inputSaranPembangunan/<?= encrypt_url($s['id']); ?>" class="btn btn-success">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
        <?= $pager->links('saran_pembangunan', 'pagination'); ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
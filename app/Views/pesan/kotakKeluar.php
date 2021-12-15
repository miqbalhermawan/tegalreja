<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-messenger"></i></div>
        <h2 class="fw-bolder">Kotak Keluar</h2>
      </div>
    </div>
    <div class="row d-flex justify-content-lg-end mb-3">
      <div class="col text-end">
        <a href="/pesan/kotakMasuk" class="btn btn-primary mb-3">Kotak Masuk (<?= $count_inbox; ?>)</a>
        <a href="/pesan" class="btn btn-success mb-3">Menu Pesan</a>
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
          <table class="table table-hover table-bordered">
            <thead class="table-dark align-middle text-center">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal & Jam Keluar</th>
                <th scope="col">Ke</th>
                <th scope="col">Pesan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($pesan as $p) : ?>
                <tr>
                  <th scope="row"><?= $i++; ?></th>
                  <td><?= date('d F Y, H:i', strtotime($p['tanggal'])); ?></td>
                  <td><?= $p['fullname']; ?></td>
                  <td><?= $p['pesan']; ?></td>
                  <td class="text-center">
                    <form action="/pesan/<?= encrypt_url($p['pesan_id']); ?>" method="post" class="d-inline">
                      <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus Pesan</button>
                    </form>
                    <a href="/pesan/detail/<?= encrypt_url($p['pesan_id']); ?>" class="btn btn-success">Lihat Pesan</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
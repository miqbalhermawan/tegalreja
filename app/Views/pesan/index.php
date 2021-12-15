<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-messenger"></i></div>
        <h2 class="fw-bolder">Pesan</h2>
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
      <div class="col text-end">
        <a href="/pesan/kotakMasuk" class="btn btn-primary mb-3">Kotak Masuk (<?= $count_inbox; ?>)</a>
        <a href="/pesan/kotakKeluar" class="btn btn-success mb-3">Kotak Keluar</a>
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
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 + (10 * ($currentPage - 1)); ?>
              <?php foreach ($users as $user) : ?>
                <tr>
                  <th scope="row"><?= $i++; ?></th>
                  <td><?= $user['username']; ?></td>
                  <td><?= $user['email']; ?></td>
                  <td class="text-center">
                    <a href="/pesan/create/<?= encrypt_url($user['id']); ?>" class="btn btn-success">Kirim Pesan</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('users', 'pagination'); ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
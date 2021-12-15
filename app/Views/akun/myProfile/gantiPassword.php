<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-3">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
      <h1 class="fw-bolder">Ganti Password</h1>
      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success mt-3" role="alert">
          <?= session()->getFlashdata('pesan'); ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/myProfile/gantiPassword/<?= user()->id; ?>" method="post">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <!-- Password Lama input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('currentPassword')) ? 'is-invalid' : ''; ?>" id="currentPassword" name="currentPassword" type="password" placeholder="Masukan Password Lama" />
            <label for="currentPassword">Password Lama</label>
            <div class="invalid-feedback">
              <?= $validation->getError('currentPassword'); ?>
            </div>
          </div>
          <!-- Password Baru input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('newPassword')) ? 'is-invalid' : ''; ?>" id="newPassword" name="newPassword" type="password" placeholder="Masukan Password Lama" />
            <label for="newPassword">Password Baru</label>
            <div class="invalid-feedback">
              <?= $validation->getError('newPassword'); ?>
            </div>
          </div>
          <!-- Konfirmasi Password input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('repeatPassword')) ? 'is-invalid' : ''; ?>" id="repeatPassword" name="repeatPassword" type="password" placeholder="Masukan Password Lama" />
            <label for="repeatPassword">Konfirmasi Password</label>
            <div class="invalid-feedback">
              <?= $validation->getError('repeatPassword'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Ubah Password</button>
            <a href="/myProfile" class="btn btn-success">Kembali ke My Profile</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
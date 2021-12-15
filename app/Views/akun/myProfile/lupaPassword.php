<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-key"></i></div>
      <h1 class="fw-bolder">Lupa Password</h1>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/lupaPassword/updateLupaPassword" method="post">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <!-- Username input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" type="text" placeholder="Masukan Username" value="<?= old('username'); ?>" autocomplete="off" />
            <label for="username">Username</label>
            <div class="invalid-feedback">
              <?= $validation->getError('username'); ?>
            </div>
          </div>
          <!-- NIK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" value="<?= old('nik'); ?>" autocomplete="off" />
            <label for="nik">Nomor Induk Kependudukan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nik'); ?>
            </div>
          </div>
          <!-- NO KK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan No Kartu Keluarga" value="<?= old('no_kk'); ?>" autocomplete="off" />
            <label for="no_kk">Nomor Kartu Keluarga</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_kk'); ?>
            </div>
          </div>
          <!-- fullname input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" type="text" placeholder="Masukan Nama Lengkap" value="<?= old('fullname'); ?>" autocomplete="off" />
            <label for="fullname">Nama Lengkap</label>
            <div class="invalid-feedback">
              <?= $validation->getError('fullname'); ?>
            </div>
          </div>
          <!-- Tanggal Lahir input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" type="date" placeholder="Masukan Tanggal Lahir" value="<?= old('tanggal_lahir'); ?>" />
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_lahir'); ?>
            </div>
          </div>
          <!-- Nama Ibu input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama_ibu')) ? 'is-invalid' : ''; ?>" id="nama_ibu" name="nama_ibu" type="text" placeholder="Masukan Nama Ibu" value="<?= old('nama_ibu'); ?>" autocomplete="off" />
            <label for="nama_ibu">Nama Ibu</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_ibu'); ?>
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
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
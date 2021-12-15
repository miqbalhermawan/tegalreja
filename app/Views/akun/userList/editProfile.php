<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-bounding-box"></i></div>
      <h1 class="fw-bolder">Edit Profile</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/userList/updateProfile/<?= encrypt_url($user->userid); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <input type="hidden" name="fotoProfileLama" value="<?= $user->user_image; ?>">
          <!-- Username input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('username')) ? old('username') : $user->username; ?>" />
            <label for="username">Username</label>
            <div class="invalid-feedback">
              <?= $validation->getError('username'); ?>
            </div>
          </div>
          <!-- Email input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" type="email" placeholder="Masukan Email" value="<?= (old('email')) ? old('email') : $user->email; ?>" />
            <label for="email">Email</label>
            <div class="invalid-feedback">
              <?= $validation->getError('email'); ?>
            </div>
          </div>
          <!-- NIK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" value="<?= (old('nik')) ? old('nik') : $user->nik; ?>" />
            <label for="nik">Nomor Induk Kependudukan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nik'); ?>
            </div>
          </div>
          <!-- No KK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan No KK" value="<?= (old('no_kk')) ? old('no_kk') : $user->no_kk; ?>" />
            <label for="no_kk">Nomor Kartu Keluarga</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_kk'); ?>
            </div>
          </div>
          <!-- Nama input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('fullname')) ? old('fullname') : $user->fullname; ?>" />
            <label for="fullname">Nama Lengkap</label>
            <div class="invalid-feedback">
              <?= $validation->getError('fullname'); ?>
            </div>
          </div>
          <!-- Tanggal Lahir input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" type="date" placeholder="Masukan Tanggal Lahir" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $user->tanggal_lahir; ?>" />
            <label for="tanggal_lahir">Tanggal Lahir</label>
          </div>
          <!-- No HP input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" type="number" placeholder="Masukan No Hp" value="<?= (old('no_hp')) ? old('no_hp') : $user->no_hp; ?>" />
            <label for="no_hp">Nomor Telepon</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_hp'); ?>
            </div>
          </div>
          <!-- Nama Ibu input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama_ibu')) ? 'is-invalid' : ''; ?>" id="nama_ibu" name="nama_ibu" type="text" placeholder="Masukan Nama Ibu" value="<?= (old('nama_ibu')) ? old('nama_ibu') : $user->nama_ibu; ?>" autocomplete="off" />
            <label for="nama_ibu">Nama Ibu</label>
          </div>
          <!-- Foto Profile input-->
          <div class="mb-3">
            <label for="user_image" class="form-label">Foto Profile</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/<?= $user->user_image; ?>" class="img-thumbnail img-preview-user">
            </div>
            <input class="form-control <?= ($validation->hasError('user_image')) ? 'is-invalid' : ''; ?>" type="file" id="user_image" name="user_image" onchange="previewImgProfile()">
            <div class="invalid-feedback">
              <?= $validation->getError('user_image'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Edit Profile</button>
            <a href="/userList/<?= encrypt_url($user->userid); ?>" class="btn btn-success">Kembali ke Detail User</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
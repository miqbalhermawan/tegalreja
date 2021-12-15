<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
      <h1 class="fw-bolder">Edit Saran Pembangunan</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/inputSaranPembangunan/update/<?= encrypt_url($saranPembangunan['id']); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <input type="hidden" name="fotoLokasiLama" value="<?= $saranPembangunan['foto_lokasi']; ?>">
          <input type="hidden" name="fotoDiriLama" value="<?= $saranPembangunan['foto_diri']; ?>">
          <!-- NIK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="text" placeholder="Masukan NIK" autofocus value="<?= (old('nik')) ? old('nik') : $saranPembangunan['nik']; ?>" disabled />
            <label for="nik">Nomor Induk Kependudukan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nik'); ?>
            </div>
          </div>
          <!-- Nama input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('nama')) ? old('nama') : $saranPembangunan['nama']; ?>" disabled />
            <label for="nama">Nama Lengkap</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama'); ?>
            </div>
          </div>
          <!-- Saran Pembangunan input-->
          <div class="form-floating mb-3">
            <textarea class="form-control <?= ($validation->hasError('saran')) ? 'is-invalid' : ''; ?>" id="saran" name="saran" type="text" placeholder="Masukan Saran Anda" style="height: 200px"><?= (old('saran')) ? old('saran') : $saranPembangunan['saran']; ?></textarea>
            <label for="saran">Saran Pembangunan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('saran'); ?>
            </div>
          </div>
          <!-- Lokasi input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : ''; ?>" id="lokasi" name="lokasi" type="text" placeholder="Masukan Lokasi" value="<?= (old('lokasi')) ? old('lokasi') : $saranPembangunan['lokasi']; ?>" />
            <label for="lokasi">Lokasi</label>
            <div class="invalid-feedback">
              <?= $validation->getError('lokasi'); ?>
            </div>
          </div>
          <!-- Foto Lokasi input-->
          <div class="mb-3">
            <label for="foto_lokasi" class="form-label">Foto Lokasi</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/<?= $saranPembangunan['foto_lokasi']; ?>" class="img-thumbnail img-preview-lokasi">
            </div>
            <input class="form-control <?= ($validation->hasError('foto_lokasi')) ? 'is-invalid' : ''; ?>" type="file" id="foto_lokasi" name="foto_lokasi" onchange="previewImgLokasi()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_lokasi'); ?>
            </div>
          </div>
          <!-- Foto Diri input-->
          <div class="mb-3">
            <label for="foto_diri" class="form-label">Foto Diri</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/<?= $saranPembangunan['foto_diri']; ?>" class="img-thumbnail img-preview-diri">
            </div>
            <input class="form-control <?= ($validation->hasError('foto_diri')) ? 'is-invalid' : ''; ?>" type="file" id="foto_diri" name="foto_diri" onchange="previewImgDiri()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_diri'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Edit Saran</button>
            <a href="/inputSaranPembangunan/<?= encrypt_url($saranPembangunan['id']); ?>" class="btn btn-success">Kembali ke Detail Saran Pembangunan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-newspaper"></i></div>
      <h1 class="fw-bolder">Tambah Informasi Kemasyarakatan</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/informasiKemasyarakatan/update/<?= encrypt_url($informasi['id']); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <input type="hidden" name="fotoInfo1Lama" value="<?= $informasi['foto_info1']; ?>">
          <input type="hidden" name="fotoInfo2Lama" value="<?= $informasi['foto_info2']; ?>">
          <input type="hidden" name="fotoInfo3Lama" value="<?= $informasi['foto_info3']; ?>">
          <!-- Judul input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" type="text" placeholder="Masukan judul Lengkap" value="<?= (old('judul')) ? old('judul') : $informasi['judul']; ?>" autocomplete="off" />
            <label for="judul">Judul</label>
            <div class="invalid-feedback">
              <?= $validation->getError('judul'); ?>
            </div>
          </div>
          <!-- Informasi input-->
          <div class="form-floating mb-3">
            <textarea class="form-control <?= ($validation->hasError('informasi')) ? 'is-invalid' : ''; ?>" id="informasi" name="informasi" type="text" placeholder="Masukan informasi" style="height: 200px"><?= (old('informasi')) ? old('informasi') : $informasi['informasi']; ?></textarea>
            <label for="informasi">Informasi Kemasyarakatan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('informasi'); ?>
            </div>
          </div>
          <!-- Foto Info 1 input-->
          <div class="mb-3">
            <label for="foto_info1" class="form-label">Foto Informasi 1</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/<?= $informasi['foto_info1']; ?>" class="img-thumbnail img-preview-info1">
            </div>
            <input class="form-control mb-2 <?= ($validation->hasError('foto_info1')) ? 'is-invalid' : ''; ?>" type="file" id="foto_info1" name="foto_info1" onchange="previewImgInfo1()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_info1'); ?>
            </div>
          </div>
          <!-- Foto Info 2 input-->
          <div class="mb-3">
            <label for="foto_info2" class="form-label">Foto Informasi 2</label>
            <div class="col-sm-5 mb-2">
              <?php if (!empty($informasi['foto_info2'])) : ?>
                <img src="/img/<?= $informasi['foto_info2']; ?>" class="img-thumbnail img-preview-info2">
              <?php else : ?>
                <img src="/img/info.png" class="img-thumbnail img-preview-info2">
              <?php endif; ?>
            </div>
            <input class="form-control mb-2 <?= ($validation->hasError('foto_info2')) ? 'is-invalid' : ''; ?>" type="file" id="foto_info2" name="foto_info2" onchange="previewImgInfo2()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_info2'); ?>
            </div>
          </div>
          <!-- Foto Info 3 input-->
          <div class="mb-3">
            <label for="foto_info3" class="form-label">Foto Informasi 3</label>
            <div class="col-sm-5 mb-2">
              <?php if (!empty($informasi['foto_info3'])) : ?>
                <img src="/img/<?= $informasi['foto_info3']; ?>" class="img-thumbnail img-preview-info3">
              <?php else : ?>
                <img src="/img/info.png" class="img-thumbnail img-preview-info3">
              <?php endif; ?>
            </div>
            <input class="form-control mb-2 <?= ($validation->hasError('foto_info3')) ? 'is-invalid' : ''; ?>" type="file" id="foto_info3" name="foto_info3" onchange="previewImgInfo3()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_info3'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit" id="submit">Edit Informasi</button>
            <a href="/informasiKemasyarakatan/<?= encrypt_url($informasi['id']); ?>" class="btn btn-success">Kembali ke Detail Informasi Kemasyarakatan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
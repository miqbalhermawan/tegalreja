<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-3">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-archive"></i></div>
      <h1 class="fw-bolder">Edit Inventaris Hasil Pembangunan</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/inventarisHasilPembangunan/update/<?= encrypt_url($inventarisPembangunan['id']); ?>" method="post">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <!-- No urut input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_urut')) ? 'is-invalid' : ''; ?>" id="no_urut" name="no_urut" type="number" placeholder="Masukan Nomor Urut" value="<?= (old('no_urut')) ? old('no_urut') : $inventarisPembangunan['no_urut'] ?>" autocomplete="off" />
            <label for="no_urut">Nomor Urut</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_urut'); ?>
            </div>
          </div>
          <!-- Nama Pembangunan input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama_pembangunan')) ? 'is-invalid' : ''; ?>" id="nama_pembangunan" name="nama_pembangunan" type="text" placeholder="Masukan Nama Pembangunan" value="<?= (old('nama_pembangunan')) ? old('nama_pembangunan') : $inventarisPembangunan['nama_pembangunan'] ?>" autocomplete="off" />
            <label for="nama_pembangunan">Nama Pembangunan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_pembangunan'); ?>
            </div>
          </div>
          <!-- volume input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('volume')) ? 'is-invalid' : ''; ?>" id="volume" name="volume" type="text" placeholder="Masukan volume Lengkap" value="<?= (old('volume')) ? old('volume') : $inventarisPembangunan['volume'] ?>" autocomplete="off" />
            <label for="volume">Volume</label>
            <div class="invalid-feedback">
              <?= $validation->getError('volume'); ?>
            </div>
          </div>
          <!-- biaya input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('biaya')) ? 'is-invalid' : ''; ?>" id="biaya" name="biaya" type="text" placeholder="Masukan Biaya" value="<?= (old('biaya')) ? old('biaya') : $inventarisPembangunan['biaya'] ?>" autocomplete="off" />
            <label for="biaya">Biaya</label>
            <div class="invalid-feedback">
              <?= $validation->getError('biaya'); ?>
            </div>
          </div>
          <!-- lokasi input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('lokasi')) ? 'is-invalid' : ''; ?>" id="lokasi" name="lokasi" type="text" placeholder="Masukan Lokasi" value="<?= (old('lokasi')) ? old('lokasi') : $inventarisPembangunan['lokasi'] ?>" autocomplete="off" />
            <label for="lokasi">Lokasi</label>
            <div class="invalid-feedback">
              <?= $validation->getError('lokasi'); ?>
            </div>
          </div>
          <!-- keterangan input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" type="text" placeholder="Masukan keterangan" value="<?= (old('keterangan')) ? old('keterangan') : $inventarisPembangunan['keterangan'] ?>" autocomplete="off" />
            <label for="keterangan">Keterangan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('keterangan'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Ubah Inventaris</button>
            <a href="/inventarisHasilPembangunan/<?= encrypt_url($inventarisPembangunan['id']); ?>" class="btn btn-success">Kembali ke Detail Inventaris Hasil Pembangunan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
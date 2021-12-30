<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-3">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
      <h1 class="fw-bolder">Edit Data Penduduk</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/cekDataDiri/update/<?= encrypt_url($dataDiri['id']); ?>" method="post">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <!-- NIK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" value="<?= (old('nik')) ? old('nik') : $dataDiri['nik'] ?>" autocomplete="off" />
            <label for="nik">Nomor Induk Kependudukan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nik'); ?>
            </div>
          </div>
          <!-- NO KK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan No Kartu Keluarga" value="<?= (old('no_kk')) ? old('no_kk') : $dataDiri['no_kk'] ?>" autocomplete="off" />
            <label for="no_kk">Nomor Kartu Keluarga</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_kk'); ?>
            </div>
          </div>
          <!-- Nama input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('nama')) ? old('nama') : $dataDiri['nama'] ?>" autocomplete="off" />
            <label for="nama">Nama Lengkap</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama'); ?>
            </div>
          </div>
          <!-- Tempat Lahir input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Masukan Tempat Lahir" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $dataDiri['tempat_lahir'] ?>" autocomplete="off" />
            <label for="tempat_lahir">Tempat Lahir</label>
            <div class="invalid-feedback">
              <?= $validation->getError('tempat_lahir'); ?>
            </div>
          </div>
          <!-- Tanggal Lahir input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" type="date" placeholder="Masukan Tanggal Lahir" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $dataDiri['tanggal_lahir'] ?>" />
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <div class="invalid-feedback">
              <?= $validation->getError('tanggal_lahir'); ?>
            </div>
          </div>
          <!-- Jenis Kelamin input-->
          <div class="form-floating mb-3">
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
              <option selected>Pilih Jenis Kelamin</option>
              <option value="LAKI-LAKI" <?= set_select('jenis_kelamin', 'LAKI-LAKI', ($dataDiri['jenis_kelamin'] == "LAKI-LAKI") ? true : false); ?>>LAKI-LAKI</option>
              <option value="PEREMPUAN" <?= set_select('jenis_kelamin', 'PEREMPUAN', ($dataDiri['jenis_kelamin'] == "PEREMPUAN") ? true : false); ?>>PEREMPUAN</option>
            </select>
            <label for="floatingSelect">Jenis Kelamin</label>
          </div>
          <!-- RT input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : ''; ?>" id="rt" name="rt" type="number" placeholder="Masukan RT" value="<?= (old('rt')) ? old('rt') : $dataDiri['rt'] ?>" autocomplete="off" />
            <label for="rt">RT</label>
            <div class="invalid-feedback">
              <?= $validation->getError('rt'); ?>
            </div>
          </div>
          <!-- RW input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ''; ?>" id="rw" name="rw" type="number" placeholder="Masukan RW" value="<?= (old('rw')) ? old('rw') : $dataDiri['rw'] ?>" autocomplete="off" />
            <label for="rw">RW</label>
            <div class="invalid-feedback">
              <?= $validation->getError('rw'); ?>
            </div>
          </div>
          <!-- Nama Ayah input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama_ayah')) ? 'is-invalid' : ''; ?>" id="nama_ayah" name="nama_ayah" type="text" placeholder="Masukan Nama Ayah" value="<?= (old('nama_ayah')) ? old('nama_ayah') : $dataDiri['nama_ayah'] ?>" autocomplete="off" />
            <label for="nama_ayah">Nama Ayah</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_ayah'); ?>
            </div>
          </div>
          <!-- Nama Ibu input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama_ibu')) ? 'is-invalid' : ''; ?>" id="nama_ibu" name="nama_ibu" type="text" placeholder="Masukan Nama Ibu" value="<?= (old('nama_ibu')) ? old('nama_ibu') : $dataDiri['nama_ibu'] ?>" autocomplete="off" />
            <label for="nama_ibu">Nama Ibu</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_ibu'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Ubah Data</button>
            <a href="/cekDataDiri/<?= encrypt_url($dataDiri['id']); ?>" class="btn btn-success">Kembali ke Detail Data Penduduk</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
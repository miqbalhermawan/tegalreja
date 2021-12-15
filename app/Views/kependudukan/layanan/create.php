<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-bounding-box"></i></div>
      <h1 class="fw-bolder">Tambah Layanan Kependudukan</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/layanan/save" method="post" enctype="multipart/form-data">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <!-- NIK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" autofocus value="<?= (old('nik')) ? old('nik') : user()->nik; ?>" autocomplete="off" />
            <label for="nik">Nomor Induk Kependudukan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nik'); ?>
            </div>
          </div>
          <!-- No KK input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan No KK" value="<?= (old('no_kk')) ? old('no_kk') : user()->no_kk; ?>" autocomplete="off" />
            <label for="no_kk">Nomor Kartu Keluarga</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_kk'); ?>
            </div>
          </div>
          <!-- Nama input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('nama')) ? old('nama') : user()->fullname; ?>" autocomplete="off" />
            <label for="nama">Nama Lengkap</label>
            <div class="invalid-feedback">
              <?= $validation->getError('nama'); ?>
            </div>
          </div>
          <!-- jenis layanan input-->
          <div class="form-floating mb-3">
            <select class="form-select" id="jenis_layanan" name="jenis_layanan">
              <option selected>Pilih Jenis Layanan</option>
              <option value="Surat Keterangan Umum" <?= set_select('jenis_layanan', 'Surat Keterangan Umum'); ?>>Surat Keterangan Umum (KTP + KK)</option>
              <option value="Surat Keterangan Tidak Mampu" <?= set_select('jenis_layanan', 'Surat Keterangan Tidak Mampu'); ?>>Surat Keterangan Tidak Mampu (KTP + KK)</option>
              <option value="Surat Keterangan Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Usaha'); ?>>Surat Keterangan Usaha (KTP + KK)</option>
              <option value="Surat Keterangan Domisili Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Domisili Usaha'); ?>>Surat Keterangan Domisili Usaha (KTP + KK)</option>
              <option value="Pengantar SKCK" <?= set_select('jenis_layanan', 'Pengantar SKCK'); ?>>Pengantar SKCK (KTP + KK)</option>
              <option value="Aktivasi/Sinkronisasi KTP Vaksin" <?= set_select('jenis_layanan', 'Aktivasi/Sinkronisasi KTP Vaksin'); ?>>Aktivasi/Sinkronisasi KTP Vaksin (KTP + KK)</option>
              <option value="Pengajuan KTP" <?= set_select('jenis_layanan', 'Pengajuan KTP'); ?>>Pengajuan KTP (Surat Kehilangan KTP + KK)</option>
              <option value="Pengajuan Perubahan Kartu Keluarga" <?= set_select('jenis_layanan', 'Pengajuan Perubahan Kartu Keluarga'); ?>>Pengajuan Perubahan Kartu Keluarga (KTP + KK Lama + Surat Kematian / Kelahiran)</option>
              <option value="Pengajuan Surat Kelahiran" <?= set_select('jenis_layanan', 'Pengajuan Surat Kelahiran'); ?>>Pengajuan Surat Kelahiran (KTP + KK + Surat Keterangan Lahir)</option>
              <option value="Pengajuan Surat Kematian" <?= set_select('jenis_layanan', 'Pengajuan Surat Kematian'); ?>>Pengajuan Surat Kematian (KTP + KK + Surat Keterangan Kematian)</option>
              <option value="Pengajuan Surat Kehilangan" <?= set_select('jenis_layanan', 'Pengajuan Surat Kehilangan'); ?>>Pengajuan Surat Kehilangan (KTP + KK)</option>
            </select>
            <label for="floatingSelect">Jenis Layanan</label>
          </div>
          <!-- Keterangan input-->
          <div class="form-floating mb-3">
            <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" type="text" placeholder="Masukan keterangan" style="height: 200px"><?= old('keterangan'); ?></textarea>
            <label for="keterangan">Keperluan Pengajuan Layanan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('keterangan'); ?>
            </div>
          </div>
          <!-- No HP input-->
          <div class="form-floating mb-3">
            <input class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" type="number" placeholder="Masukan no_hp" value="<?= (old('no_hp')) ? old('no_hp') : user()->no_hp; ?>" autocomplete="off" />
            <label for="no_hp">Nomor Telepon</label>
            <div class="invalid-feedback">
              <?= $validation->getError('no_hp'); ?>
            </div>
          </div>
          <!-- Foto KTP input-->
          <div class="mb-3">
            <label for="foto_ktp" class="form-label">Foto KTP</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/ktp.jpg" class="img-thumbnail img-preview-ktp">
            </div>
            <input class="form-control <?= ($validation->hasError('foto_ktp')) ? 'is-invalid' : ''; ?>" type="file" id="foto_ktp" name="foto_ktp" onchange="previewImgKtp()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_ktp'); ?>
            </div>
          </div>
          <!-- Foto KK input-->
          <div class="mb-3">
            <label for="foto_kk" class="form-label">Foto KK</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/kk.png" class="img-thumbnail img-preview-kk">
            </div>
            <input class="form-control <?= ($validation->hasError('foto_kk')) ? 'is-invalid' : ''; ?>" type="file" id="foto_kk" name="foto_kk" onchange="previewImgKk()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_kk'); ?>
            </div>
          </div>
          <!-- Foto lain-lain input-->
          <div class="mb-3">
            <label for="foto_lain" class="form-label">Foto Syarat Lainnya</label>
            <div class="col-sm-5 mb-2">
              <img src="/img/syarat.png" class="img-thumbnail img-preview-lain">
            </div>
            <input class="form-control <?= ($validation->hasError('foto_lain')) ? 'is-invalid' : ''; ?>" type="file" id="foto_lain" name="foto_lain" onchange="previewImgLain()">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_lain'); ?>
            </div>
          </div>
          <!-- syarat -->
          <div class="mb-3">
            <p class="fst-italic fs-6">Keterangan</p>
            <ul class="fst-italic fs-6">
              <li>Untuk pengajuan KTP bisa menginputkan foto surat kehilangan KTP dari kepolisian di Foto KTP</li>
              <li>Foto syarat lainnya digunakan untuk menginput persyaratan lain seperti foto surat kematian atau foto surat kelahiran dari rumah sakit</li>
              <li>Untuk Pengajuan KTP, Pengajuan Perubahan Kartu Keluarga, Pengajuan Surat Kelahiran, Pengajuan Surat Kematian, dan Pengajuan Surat Kehilangan tetap harus mendatangi kantor desa untuk pengurusannya</li>
              <li>Operasional Desa hari senin s/d kamis jam 08.00 s/d 14.00 dan hari jumat jam 08.00 s/d 11.00</li>
              <li>Harap membawa semua persyaratan saat datang ke kantor desa</li>
            </ul>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Tambah Layanan</button>
            <a href="/layanan" class="btn btn-success">Kembali ke Layanan Kependudukan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
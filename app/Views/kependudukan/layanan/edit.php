<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-bounding-box"></i></div>
      <h1 class="fw-bolder">Edit Layanan Kependudukan</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <?php if (in_groups('user')) : ?>
          <form action="/layanan/update/<?= encrypt_url($layanan['id']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
            <input type="hidden" name="fotoKtpLama" value="<?= $layanan['foto_ktp']; ?>">
            <input type="hidden" name="fotoKkLama" value="<?= $layanan['foto_kk']; ?>">
            <input type="hidden" name="fotoLainLama" value="<?= $layanan['foto_lain']; ?>">
            <!-- NIK input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" value="<?= (old('nik')) ? old('nik') : $layanan['nik']; ?>" autocomplete="off" />
              <label for="nik">Nomor Induk Kependudukan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('nik'); ?>
              </div>
            </div>
            <!-- No KK input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan no_kk" value="<?= (old('no_kk')) ? old('no_kk') : $layanan['no_kk']; ?>" autocomplete="off" />
              <label for="no_kk">Nomor Induk Kependudukan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('no_kk'); ?>
              </div>
            </div>
            <!-- Nama input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('nama')) ? old('nama') : $layanan['nama']; ?>" autocomplete="off" />
              <label for="nama">Nama Lengkap</label>
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>
            <!-- Jenis Layanan input-->
            <div class="form-floating mb-3">
              <select class="form-select" id="jenis_layanan" name="jenis_layanan">
                <option selected>Pilih Jenis Layanan</option>
                <option value="Surat Keterangan Umum" <?= set_select('jenis_layanan', 'Surat Keterangan Umum', ($layanan['jenis_layanan'] == "Surat Keterangan Umum") ? true : false); ?>>Surat Keterangan Umum (KTP + KK)</option>
                <option value="Surat Keterangan Tidak Mampu" <?= set_select('jenis_layanan', 'Surat Keterangan Tidak Mampu', ($layanan['jenis_layanan'] == "Surat Keterangan Tidak Mampu") ? true : false); ?>>Surat Keterangan Tidak Mampu (KTP + KK)</option>
                <option value="Surat Keterangan Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Usaha', ($layanan['jenis_layanan'] == "Surat Keterangan Usaha") ? true : false); ?>>Surat Keterangan Usaha (KTP + KK)</option>
                <option value="Surat Keterangan Domisili Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Domisili Usaha', ($layanan['jenis_layanan'] == "Surat Keterangan Domisili Usaha") ? true : false); ?>>Surat Keterangan Domisili Usaha (KTP + KK)</option>
                <option value="Pengantar SKCK" <?= set_select('jenis_layanan', 'Pengantar SKCK', ($layanan['jenis_layanan'] == "Pengantar SKCK") ? true : false); ?>>Pengantar SKCK (KTP + KK)</option>
                <option value="Aktivasi/Sinkronisasi KTP Vaksin" <?= set_select('jenis_layanan', 'Aktivasi/Sinkronisasi KTP Vaksin', ($layanan['jenis_layanan'] == "Aktivasi/Sinkronisasi KTP Vaksin") ? true : false); ?>>Aktivasi/Sinkronisasi KTP Vaksin (KTP + KK)</option>
                <option value="Pengajuan KTP" <?= set_select('jenis_layanan', 'Pengajuan KTP', ($layanan['jenis_layanan'] == "Pengajuan KTP") ? true : false); ?>>Pengajuan KTP (Surat Kehilangan KTP + KK)</option>
                <option value="Pengajuan Perubahan Kartu Keluarga" <?= set_select('jenis_layanan', 'Pengajuan Perubahan Kartu Keluarga', ($layanan['jenis_layanan'] == "Pengajuan Perubahan Kartu Keluarga") ? true : false); ?>>Pengajuan Perubahan Kartu Keluarga (KTP + KK Lama + Surat Kematian / Kelahiran)</option>
                <option value="Pengajuan Surat Kelahiran" <?= set_select('jenis_layanan', 'Pengajuan Surat Kelahiran', ($layanan['jenis_layanan'] == "Pengajuan Surat Kelahiran") ? true : false); ?>>Pengajuan Surat Kelahiran (KTP + KK + Surat Keterangan Lahir)</option>
                <option value="Pengajuan Surat Kematian" <?= set_select('jenis_layanan', 'Pengajuan Surat Kematian', ($layanan['jenis_layanan'] == "Pengajuan Surat Kematian") ? true : false); ?>>Pengajuan Surat Kematian (KTP + KK + Surat Keterangan Kematian)</option>
                <option value="Pengajuan Surat Kehilangan" <?= set_select('jenis_layanan', 'Pengajuan Surat Kehilangan', ($layanan['jenis_layanan'] == "Pengajuan Surat Kehilangan") ? true : false); ?>>Pengajuan Surat Kehilangan (KTP + KK)</option>
              </select>
              <label for="floatingSelect">Jenis Layanan</label>
            </div>
            <!-- Keterangan input-->
            <div class="form-floating mb-3">
              <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" type="text" placeholder="Masukan Keperluan Anda" style="height: 200px"><?= (old('keterangan')) ? old('keterangan') : $layanan['keterangan']; ?></textarea>
              <label for="keterangan">Keperluan Pengajuan Layanan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('keterangan'); ?>
              </div>
            </div>
            <!-- no HP input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" type="number" placeholder="Masukan Nomor Telepon" value="<?= (old('no_hp')) ? old('no_hp') : $layanan['no_hp']; ?>" autocomplete="off" />
              <label for="no_hp">Nomor Telepon</label>
              <div class="invalid-feedback">
                <?= $validation->getError('no_hp'); ?>
              </div>
            </div>
            <!-- Foto KTP input-->
            <div class="mb-3">
              <label for="foto_ktp" class="form-label">Foto KTP</label>
              <div class="col-sm-5 mb-2">
                <img src="/img/<?= $layanan['foto_ktp']; ?>" class="img-thumbnail img-preview-ktp">
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
                <img src="/img/<?= $layanan['foto_kk']; ?>" class="img-thumbnail img-preview-kk">
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
                <?php if (!empty($layanan['foto_lain'])) : ?>
                  <img src="/img/<?= $layanan['foto_lain']; ?>" class="img-thumbnail img-preview-lain">
                <?php else : ?>
                  <img src="/img/syarat.png" class="img-thumbnail img-preview-lain">
                <?php endif; ?>
              </div>
              <input class="form-control <?= ($validation->hasError('foto_lain')) ? 'is-invalid' : ''; ?>" type="file" id="foto_lain" name="foto_lain" onchange="previewImgLain()">
              <div class="invalid-feedback">
                <?= $validation->getError('foto_lain'); ?>
              </div>
            </div>
            <!-- Submit Button-->
            <div class="d-grid">
              <button class="btn btn-primary mb-3" type="submit">Edit Layanan</button>
              <a href="/layanan/<?= encrypt_url($layanan['id']); ?>" class="btn btn-success">Kembali ke Detail Saran Pembangunan</a>
            </div>
          </form>
        <?php elseif (in_groups('super-admin')) : ?>
          <form action="/layanan/update/<?= encrypt_url($layanan['id']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
            <input type="hidden" name="fotoKtpLama" value="<?= $layanan['foto_ktp']; ?>">
            <input type="hidden" name="fotoKkLama" value="<?= $layanan['foto_kk']; ?>">
            <input type="hidden" name="fotoLainLama" value="<?= $layanan['foto_lain']; ?>">
            <!-- NIK input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" value="<?= (old('nik')) ? old('nik') : $layanan['nik']; ?>" autocomplete="off" />
              <label for="nik">Nomor Induk Kependudukan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('nik'); ?>
              </div>
            </div>
            <!-- No KK input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan no_kk" value="<?= (old('no_kk')) ? old('no_kk') : $layanan['no_kk']; ?>" autocomplete="off" />
              <label for="no_kk">Nomor Induk Kependudukan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('no_kk'); ?>
              </div>
            </div>
            <!-- Nama input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('nama')) ? old('nama') : $layanan['nama']; ?>" autocomplete="off" />
              <label for="nama">Nama Lengkap</label>
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>
            <!-- Jenis Layanan input-->
            <div class="form-floating mb-3">
              <select class="form-select" id="jenis_layanan" name="jenis_layanan">
                <option selected>Pilih Jenis Layanan</option>
                <option value="Surat Keterangan Umum" <?= set_select('jenis_layanan', 'Surat Keterangan Umum', ($layanan['jenis_layanan'] == "Surat Keterangan Umum") ? true : false); ?>>Surat Keterangan Umum (KTP + KK)</option>
                <option value="Surat Keterangan Tidak Mampu" <?= set_select('jenis_layanan', 'Surat Keterangan Tidak Mampu', ($layanan['jenis_layanan'] == "Surat Keterangan Tidak Mampu") ? true : false); ?>>Surat Keterangan Tidak Mampu (KTP + KK)</option>
                <option value="Surat Keterangan Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Usaha', ($layanan['jenis_layanan'] == "Surat Keterangan Usaha") ? true : false); ?>>Surat Keterangan Usaha (KTP + KK)</option>
                <option value="Surat Keterangan Domisili Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Domisili Usaha', ($layanan['jenis_layanan'] == "Surat Keterangan Domisili Usaha") ? true : false); ?>>Surat Keterangan Domisili Usaha (KTP + KK)</option>
                <option value="Pengantar SKCK" <?= set_select('jenis_layanan', 'Pengantar SKCK', ($layanan['jenis_layanan'] == "Pengantar SKCK") ? true : false); ?>>Pengantar SKCK (KTP + KK)</option>
                <option value="Aktivasi/Sinkronisasi KTP Vaksin" <?= set_select('jenis_layanan', 'Aktivasi/Sinkronisasi KTP Vaksin', ($layanan['jenis_layanan'] == "Aktivasi/Sinkronisasi KTP Vaksin") ? true : false); ?>>Aktivasi/Sinkronisasi KTP Vaksin (KTP + KK)</option>
                <option value="Pengajuan KTP" <?= set_select('jenis_layanan', 'Pengajuan KTP', ($layanan['jenis_layanan'] == "Pengajuan KTP") ? true : false); ?>>Pengajuan KTP (Surat Kehilangan KTP + KK)</option>
                <option value="Pengajuan Perubahan Kartu Keluarga" <?= set_select('jenis_layanan', 'Pengajuan Perubahan Kartu Keluarga', ($layanan['jenis_layanan'] == "Pengajuan Perubahan Kartu Keluarga") ? true : false); ?>>Pengajuan Perubahan Kartu Keluarga (KTP + KK Lama + Surat Kematian / Kelahiran)</option>
                <option value="Pengajuan Surat Kelahiran" <?= set_select('jenis_layanan', 'Pengajuan Surat Kelahiran', ($layanan['jenis_layanan'] == "Pengajuan Surat Kelahiran") ? true : false); ?>>Pengajuan Surat Kelahiran (KTP + KK + Surat Keterangan Lahir)</option>
                <option value="Pengajuan Surat Kematian" <?= set_select('jenis_layanan', 'Pengajuan Surat Kematian', ($layanan['jenis_layanan'] == "Pengajuan Surat Kematian") ? true : false); ?>>Pengajuan Surat Kematian (KTP + KK + Surat Keterangan Kematian)</option>
                <option value="Pengajuan Surat Kehilangan" <?= set_select('jenis_layanan', 'Pengajuan Surat Kehilangan', ($layanan['jenis_layanan'] == "Pengajuan Surat Kehilangan") ? true : false); ?>>Pengajuan Surat Kehilangan (KTP + KK)</option>
              </select>
              <label for="floatingSelect">Jenis Layanan</label>
            </div>
            <!-- Keterangan input-->
            <div class="form-floating mb-3">
              <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" type="text" placeholder="Masukan Keperluan Anda" style="height: 200px"><?= (old('keterangan')) ? old('keterangan') : $layanan['keterangan']; ?></textarea>
              <label for="keterangan">Keperluan Pengajuan Layanan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('keterangan'); ?>
              </div>
            </div>
            <!-- no HP input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" type="number" placeholder="Masukan Nomor Telepon" value="<?= (old('no_hp')) ? old('no_hp') : $layanan['no_hp']; ?>" autocomplete="off" />
              <label for="no_hp">Nomor Telepon</label>
              <div class="invalid-feedback">
                <?= $validation->getError('no_hp'); ?>
              </div>
            </div>
            <!-- Foto KTP input-->
            <div class="mb-3">
              <label for="foto_ktp" class="form-label">Foto KTP</label>
              <div class="col-sm-5 mb-2">
                <img src="/img/<?= $layanan['foto_ktp']; ?>" class="img-thumbnail img-preview-ktp">
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
                <img src="/img/<?= $layanan['foto_kk']; ?>" class="img-thumbnail img-preview-kk">
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
                <?php if (!empty($layanan['foto_lain'])) : ?>
                  <img src="/img/<?= $layanan['foto_lain']; ?>" class="img-thumbnail img-preview-lain">
                <?php else : ?>
                  <img src="/img/syarat.png" class="img-thumbnail img-preview-lain">
                <?php endif; ?>
              </div>
              <input class="form-control <?= ($validation->hasError('foto_lain')) ? 'is-invalid' : ''; ?>" type="file" id="foto_lain" name="foto_lain" onchange="previewImgLain()">
              <div class="invalid-feedback">
                <?= $validation->getError('foto_lain'); ?>
              </div>
            </div>
            <!-- Status input-->
            <div class="form-floating mb-3">
              <select class="form-select" id="status" name="status">
                <option selected>Pilih Status</option>
                <option value="Dalam Proses" <?= set_select('status', 'Dalam Proses', ($layanan['status'] == "Dalam Proses") ? true : false); ?>>Dalam Proses</option>
                <option value="Dapat Diambil" <?= set_select('status', 'Dapat Diambil', ($layanan['status'] == "Dapat Diambil") ? true : false); ?>>Dapat Diambil</option>
              </select>
              <label for="floatingSelect">Status</label>
            </div>
            <!-- Submit Button-->
            <div class="d-grid">
              <button class="btn btn-primary mb-3" type="submit">Edit Layanan</button>
              <a href="/layanan/<?= encrypt_url($layanan['id']); ?>" class="btn btn-success">Kembali ke Detail Saran Pembangunan</a>
            </div>
          </form>
        <?php else : ?>
          <form action="/layanan/update/<?= encrypt_url($layanan['id']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
            <input type="hidden" name="fotoKtpLama" value="<?= $layanan['foto_ktp']; ?>">
            <input type="hidden" name="fotoKkLama" value="<?= $layanan['foto_kk']; ?>">
            <input type="hidden" name="fotoLainLama" value="<?= $layanan['foto_lain']; ?>">
            <!-- NIK input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" type="number" placeholder="Masukan NIK" value="<?= (old('nik')) ? old('nik') : $layanan['nik']; ?>" disabled />
              <label for="nik">Nomor Induk Kependudukan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('nik'); ?>
              </div>
            </div>
            <!-- No KK input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" id="no_kk" name="no_kk" type="number" placeholder="Masukan no_kk" value="<?= (old('no_kk')) ? old('no_kk') : $layanan['no_kk']; ?>" disabled />
              <label for="no_kk">Nomor Induk Kependudukan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('no_kk'); ?>
              </div>
            </div>
            <!-- Nama input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" type="text" placeholder="Masukan Nama Lengkap" value="<?= (old('nama')) ? old('nama') : $layanan['nama']; ?>" disabled />
              <label for="nama">Nama Lengkap</label>
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>
            <!-- Jenis Layanan input-->
            <div class="form-floating mb-3">
              <select class="form-select" id="jenis_layanan" name="jenis_layanan" disabled>
                <option selected>Pilih Jenis Layanan</option>
                <option value="Surat Keterangan Umum" <?= set_select('jenis_layanan', 'Surat Keterangan Umum', ($layanan['jenis_layanan'] == "Surat Keterangan Umum") ? true : false); ?>>Surat Keterangan Umum (KTP + KK)</option>
                <option value="Surat Keterangan Tidak Mampu" <?= set_select('jenis_layanan', 'Surat Keterangan Tidak Mampu', ($layanan['jenis_layanan'] == "Surat Keterangan Tidak Mampu") ? true : false); ?>>Surat Keterangan Tidak Mampu (KTP + KK)</option>
                <option value="Surat Keterangan Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Usaha', ($layanan['jenis_layanan'] == "Surat Keterangan Usaha") ? true : false); ?>>Surat Keterangan Usaha (KTP + KK)</option>
                <option value="Surat Keterangan Domisili Usaha" <?= set_select('jenis_layanan', 'Surat Keterangan Domisili Usaha', ($layanan['jenis_layanan'] == "Surat Keterangan Domisili Usaha") ? true : false); ?>>Surat Keterangan Domisili Usaha (KTP + KK)</option>
                <option value="Pengantar SKCK" <?= set_select('jenis_layanan', 'Pengantar SKCK', ($layanan['jenis_layanan'] == "Pengantar SKCK") ? true : false); ?>>Pengantar SKCK (KTP + KK)</option>
                <option value="Aktivasi/Sinkronisasi KTP Vaksin" <?= set_select('jenis_layanan', 'Aktivasi/Sinkronisasi KTP Vaksin', ($layanan['jenis_layanan'] == "Aktivasi/Sinkronisasi KTP Vaksin") ? true : false); ?>>Aktivasi/Sinkronisasi KTP Vaksin (KTP + KK)</option>
                <option value="Pengajuan KTP" <?= set_select('jenis_layanan', 'Pengajuan KTP', ($layanan['jenis_layanan'] == "Pengajuan KTP") ? true : false); ?>>Pengajuan KTP (Surat Kehilangan KTP + KK)</option>
                <option value="Pengajuan Perubahan Kartu Keluarga" <?= set_select('jenis_layanan', 'Pengajuan Perubahan Kartu Keluarga', ($layanan['jenis_layanan'] == "Pengajuan Perubahan Kartu Keluarga") ? true : false); ?>>Pengajuan Perubahan Kartu Keluarga (KTP + KK Lama + Surat Kematian / Kelahiran)</option>
                <option value="Pengajuan Surat Kelahiran" <?= set_select('jenis_layanan', 'Pengajuan Surat Kelahiran', ($layanan['jenis_layanan'] == "Pengajuan Surat Kelahiran") ? true : false); ?>>Pengajuan Surat Kelahiran (KTP + KK + Surat Keterangan Lahir)</option>
                <option value="Pengajuan Surat Kematian" <?= set_select('jenis_layanan', 'Pengajuan Surat Kematian', ($layanan['jenis_layanan'] == "Pengajuan Surat Kematian") ? true : false); ?>>Pengajuan Surat Kematian (KTP + KK + Surat Keterangan Kematian)</option>
                <option value="Pengajuan Surat Kehilangan" <?= set_select('jenis_layanan', 'Pengajuan Surat Kehilangan', ($layanan['jenis_layanan'] == "Pengajuan Surat Kehilangan") ? true : false); ?>>Pengajuan Surat Kehilangan (KTP + KK)</option>
              </select>
              <label for="floatingSelect">Jenis Layanan</label>
            </div>
            <!-- Keterangan input-->
            <div class="form-floating mb-3">
              <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" type="text" placeholder="Masukan Keperluan Anda" style="height: 200px" disabled><?= (old('keterangan')) ? old('keterangan') : $layanan['keterangan']; ?></textarea>
              <label for="keterangan">Keperluan Pengajuan Layanan</label>
              <div class="invalid-feedback">
                <?= $validation->getError('keterangan'); ?>
              </div>
            </div>
            <!-- no HP input-->
            <div class="form-floating mb-3">
              <input class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" type="number" placeholder="Masukan Nomor Telepon" value="<?= (old('no_hp')) ? old('no_hp') : $layanan['no_hp']; ?>" disabled />
              <label for="no_hp">Nomor Telepon</label>
              <div class="invalid-feedback">
                <?= $validation->getError('no_hp'); ?>
              </div>
            </div>
            <!-- Foto Lokasi input-->
            <div class="mb-3">
              <label for="foto_ktp" class="form-label">Foto KTP</label>
              <div class="col-sm-5 mb-2">
                <img src="/img/<?= $layanan['foto_ktp']; ?>" class="img-thumbnail img-preview-ktp">
              </div>
              <input class="form-control <?= ($validation->hasError('foto_ktp')) ? 'is-invalid' : ''; ?>" type="file" id="foto_ktp" name="foto_ktp" onchange="previewImgKtp()" disabled>
              <div class="invalid-feedback">
                <?= $validation->getError('foto_ktp'); ?>
              </div>
            </div>
            <!-- Foto Diri input-->
            <div class="mb-3">
              <label for="foto_kk" class="form-label">Foto KK</label>
              <div class="col-sm-5 mb-2">
                <img src="/img/<?= $layanan['foto_kk']; ?>" class="img-thumbnail img-preview-kk">
              </div>
              <input class="form-control <?= ($validation->hasError('foto_kk')) ? 'is-invalid' : ''; ?>" type="file" id="foto_kk" name="foto_kk" onchange="previewImgKk()" disabled>
              <div class="invalid-feedback">
                <?= $validation->getError('foto_kk'); ?>
              </div>
            </div>
            <!-- Foto lain-lain input-->
            <div class="mb-3">
              <label for="foto_lain" class="form-label">Foto Syarat Lainnya</label>
              <div class="col-sm-5 mb-2">
                <?php if (!empty($layanan['foto_lain'])) : ?>
                  <img src="/img/<?= $layanan['foto_lain']; ?>" class="img-thumbnail img-preview-lain">
                <?php else : ?>
                  <img src="/img/syarat.png" class="img-thumbnail img-preview-lain">
                <?php endif; ?>
              </div>
              <input class="form-control <?= ($validation->hasError('foto_lain')) ? 'is-invalid' : ''; ?>" type="file" id="foto_lain" name="foto_lain" onchange="previewImgLain()" disabled>
              <div class="invalid-feedback">
                <?= $validation->getError('foto_lain'); ?>
              </div>
            </div>
            <!-- Status input-->
            <div class="form-floating mb-3">
              <select class="form-select" id="status" name="status">
                <option selected>Pilih Status</option>
                <option value="Dalam Proses" <?= set_select('status', 'Dalam Proses', ($layanan['status'] == "Dalam Proses") ? true : false); ?>>Dalam Proses</option>
                <option value="Dapat Diambil" <?= set_select('status', 'Dapat Diambil', ($layanan['status'] == "Dapat Diambil") ? true : false); ?>>Dapat Diambil</option>
              </select>
              <label for="floatingSelect">Status</label>
            </div>
            <!-- Submit Button-->
            <div class="d-grid">
              <button class="btn btn-primary mb-3" type="submit">Edit Layanan</button>
              <a href="/layanan/<?= encrypt_url($layanan['id']); ?>" class="btn btn-success">Kembali ke Detail Saran Pembangunan</a>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
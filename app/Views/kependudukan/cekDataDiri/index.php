<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
        <h2 class="fw-bolder">Data Penduduk</h2>
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
      <?php if (in_groups('super-admin') || in_groups('admin')) : ?>
        <div class="col d-flex justify-content-md-end mb-3">
          <a href="/cekDataDiri/create" class="btn btn-primary">Tambah Data Penduduk</a>
        </div>
      <?php endif; ?>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive mb-3">
          <?php if (in_groups('user')) : ?>
            <table class="table table-hover table-bordered">
              <thead class="table-dark align-middle text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">RT</th>
                  <th scope="col">RW</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                <?php foreach ($dataDiri as $d) : ?>
                  <tr>
                    <th scope="row" class="text-center"><?= $i++; ?></th>
                    <td><?= $d['nama']; ?></td>
                    <td class="text-center"><?= $d['jenis_kelamin']; ?></td>
                    <td class="text-center"><?= $d['rt']; ?></td>
                    <td class="text-center"><?= $d['rw']; ?></td>
                    <?php if (user()->no_kk == $d['no_kk']) : ?>
                      <td class="text-center">
                        <a href="/cekDataDiri/<?= encrypt_url($d['id']); ?>" class="btn btn-success">Detail</a>
                      </td>
                    <?php else : ?>
                      <td></td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else : ?>
            <table class="table table-hover table-bordered">
              <thead class="table-dark align-middle text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nomor Induk Kependudukan</th>
                  <th scope="col">No Kartu Keluarga</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Tempat Lahir</th>
                  <th scope="col">Tanggal Lahir</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">RT</th>
                  <th scope="col">RW</th>
                  <th scope="col">Nama Ayah</th>
                  <th scope="col">Nama Ibu</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                <?php foreach ($dataDiri as $d) : ?>
                  <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $d['nik']; ?></td>
                    <td><?= $d['no_kk']; ?></td>
                    <td><?= $d['nama']; ?></td>
                    <td><?= $d['tempat_lahir']; ?></td>
                    <td><?= date('d-m-Y', strtotime($d['tanggal_lahir'])); ?></td>
                    <td><?= $d['jenis_kelamin']; ?></td>
                    <td><?= $d['rt']; ?></td>
                    <td><?= $d['rw']; ?></td>
                    <td><?= $d['nama_ayah']; ?></td>
                    <td><?= $d['nama_ibu']; ?></td>
                    <td>
                      <a href="/cekDataDiri/<?= encrypt_url($d['id']); ?>" class="btn btn-success">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
        <?= $pager->links('penduduk', 'pagination'); ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
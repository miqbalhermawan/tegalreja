<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
        <h2 class="fw-bolder">Detail Data Diri</h2>
      </div>
    </div>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col" colspan="2" class="text-center">Data Diri - <?= $dataDiri['nama']; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Nomor Induk Kependudukan</th>
                <td><?= $dataDiri['nik']; ?></td>
              </tr>
              <tr>
                <th>Nomor Kartu Keluarga</th>
                <td><?= $dataDiri['no_kk']; ?></td>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <td><?= $dataDiri['nama']; ?></td>
              </tr>
              <tr>
                <th>Tempat Lahir</th>
                <td><?= $dataDiri['tempat_lahir']; ?></td>
              </tr>
              <tr>
                <th>Tanggal Lahir</th>
                <td><?= date('d-m-Y', strtotime($dataDiri['tanggal_lahir'])); ?></td>
              </tr>
              <tr>
                <th>Jenis Kelamin</th>
                <td><?= $dataDiri['jenis_kelamin']; ?></td>
              </tr>
              <tr>
                <th>RT</th>
                <td><?= $dataDiri['rt']; ?></td>
              </tr>
              <tr>
                <th>RW</th>
                <td><?= $dataDiri['rw']; ?></td>
              </tr>
              <tr>
                <th>Nama Ayah</th>
                <td><?= $dataDiri['nama_ayah']; ?></td>
              </tr>
              <tr>
                <th>Nama Ibu</th>
                <td><?= $dataDiri['nama_ibu']; ?></td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" class="text-end">
                <?php if (in_groups('super-admin') || in_groups('admin')) :  ?>
                  <a href="/cekDataDiri/edit/<?= encrypt_url($dataDiri['id']); ?>" class="btn btn-info">Edit</a>
                  <form action="/cekDataDiri/<?= encrypt_url($dataDiri['id']); ?>" method="post" class="d-inline">
                    <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                  </form>
                <?php endif; ?>
                <a href="/cekDataDiri" class="btn btn-success">Kembali ke Data Penduduk</a>
              </td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>
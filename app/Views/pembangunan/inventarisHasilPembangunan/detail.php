<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-archive"></i></div>
        <h2 class="fw-bolder">Detail Inventaris Hasil Pembangunan</h2>
      </div>
    </div>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col" colspan="2" class="text-center">Inventaris Hasil Pembangunan - <?= $inventarisPembangunan['nama_pembangunan']; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Nomor Urut</th>
                <td><?= $inventarisPembangunan['no_urut']; ?></td>
              </tr>
              <tr>
                <th>Nama Pembangunan</th>
                <td><?= $inventarisPembangunan['nama_pembangunan']; ?></td>
              </tr>
              <tr>
                <th>Volume</th>
                <td><?= $inventarisPembangunan['volume']; ?></td>
              </tr>
              <tr>
                <th>Biaya</th>
                <td><?= "Rp." . number_format($inventarisPembangunan['biaya'], 2, ".", ",");; ?></td>
              </tr>
              <tr>
                <th>Lokasi</th>
                <td><?= $inventarisPembangunan['lokasi']; ?></td>
              </tr>
              <tr>
                <th>Keterangan</th>
                <td><?= $inventarisPembangunan['keterangan']; ?></td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" class="text-end">
                <?php if (in_groups('super-admin') || in_groups('admin')) : ?>
                  <a href="/inventarisHasilPembangunan/edit/<?= encrypt_url($inventarisPembangunan['id']); ?>" class="btn btn-info">Edit</a>
                  <form action="/inventarisHasilPembangunan/<?= encrypt_url($inventarisPembangunan['id']); ?>" method="post" class="d-inline">
                    <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                  </form>
                <?php endif; ?>
                <a href="/inventarisHasilPembangunan" class="btn btn-success">Kembali ke Inventaris Hasil Pembangunan</a>
              </td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>
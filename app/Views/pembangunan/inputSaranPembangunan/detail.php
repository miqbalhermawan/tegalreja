<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
        <h2 class="fw-bolder">Detail Saran Pembangunan</h2>
      </div>
    </div>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col" colspan="2" class="text-center">Saran Pembangunan dari - <?= $saranPembangunan['nama']; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Tanggal Input</th>
                <td><?= date('d F Y, H:i', strtotime($saranPembangunan['created_at'])); ?></td>
              </tr>
              <tr>
                <th>Nomor Induk Kependudukan</th>
                <td><?= $saranPembangunan['nik']; ?></td>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <td><?= $saranPembangunan['nama']; ?></td>
              </tr>
              <tr>
                <th>Saran Pembangunan</th>
                <td><?= $saranPembangunan['saran']; ?></td>
              </tr>
              <tr>
                <th>Lokasi</th>
                <td><?= $saranPembangunan['lokasi']; ?></td>
              </tr>
              <tr>
                <th>Foto Lokasi</th>
                <td class="d-flex justify-content-center"><img src="/img/<?= $saranPembangunan['foto_lokasi']; ?>" class="lokasi-detail"></td>
              </tr>
              <tr>
                <th>Foto Diri</th>
                <td class="d-flex justify-content-center"><img src="/img/<?= $saranPembangunan['foto_diri']; ?>" class="orang-detail"></td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" class="text-end">
                <?php if ($saranPembangunan['user_id'] == user()->id) : ?>
                  <a href="/inputSaranPembangunan/edit/<?= encrypt_url($saranPembangunan['id']); ?>" class="btn btn-info">Edit</a>
                <?php endif; ?>
                <?php if (in_groups('super-admin') || $saranPembangunan['user_id'] == user()->id) : ?>
                  <form action="/inputSaranPembangunan/<?= encrypt_url($saranPembangunan['id']); ?>" method="post" class="d-inline">
                    <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                  </form>
                <?php endif; ?>
                <a href="/inputSaranPembangunan" class="btn btn-success">Kembali ke Saran Pembangunan</a>
              </td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>
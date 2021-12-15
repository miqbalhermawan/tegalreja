<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-bounding-box"></i></div>
        <h2 class="fw-bolder">Detail Layanan Kependudukan</h2>
      </div>
    </div>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col" colspan="2" class="text-center">Permintaan Layanan dari - <?= $layanan['nama']; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Tanggal Input</th>
                <td><?= date('d F Y, H:i', strtotime($layanan['created_at'])); ?></td>
              </tr>
              <tr>
                <th>Nomor Induk Kependudukan</th>
                <td><?= $layanan['nik']; ?></td>
              </tr>
              <tr>
                <th>Nomor Kartu Keluarga</th>
                <td><?= $layanan['no_kk']; ?></td>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <td><?= $layanan['nama']; ?></td>
              </tr>
              <tr>
                <th>Jenis Layanan</th>
                <td><?= $layanan['jenis_layanan']; ?></td>
              </tr>
              <tr>
                <th>Keperluan Pengajuan Layanan</th>
                <td><?= $layanan['keterangan']; ?></td>
              </tr>
              <tr>
                <th>Nomor Telepon</th>
                <td><?= $layanan['no_hp']; ?></td>
              </tr>
              <tr>
                <th>Foto KTP</th>
                <td class="d-flex justify-content-center"><img src="<?= base_url(); ?>/img/<?= $layanan['foto_ktp']; ?>" class="lokasi-detail"></td>
              </tr>
              <tr>
                <th>Foto KK</th>
                <td class="d-flex justify-content-center"><img src="<?= base_url(); ?>/img/<?= $layanan['foto_kk']; ?>" class="orang-detail"></td>
              </tr>
              <?php if ($layanan['foto_lain']) : ?>
                <tr>
                  <th>Foto Lain</th>
                  <td class="d-flex justify-content-center"><img src="<?= base_url(); ?>/img/<?= $layanan['foto_lain']; ?>" class="orang-detail"></td>
                </tr>
              <?php endif; ?>
              <tr>
                <th>Status</th>
                <td><?= $layanan['status']; ?></td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" class="text-end">
                <a href="/layanan/cetak/<?= encrypt_url($layanan['id']); ?>" class="btn btn-outline-danger">Cetak Bukti Input</a>
                <?php if ($layanan['status'] == 'Dalam Proses' || $layanan['status'] == 'Pilih Status') : ?>
                  <a href="/layanan/edit/<?= encrypt_url($layanan['id']); ?>" class="btn btn-info">Edit</a>
                  <?php if (in_groups('super-admin') || in_groups('user')) : ?>
                    <form action="/layanan/<?= encrypt_url($layanan['id']); ?>" method="post" class="d-inline">
                      <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
                <a href="/layanan" class="btn btn-success">Kembali ke Layanan Kependudukan</a>
              </td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
        <h2 class="fw-bolder">Detail User</h2>
      </div>
    </div>
    <div class="row gx-5 my-2">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col" colspan="2" class="text-center">Data Diri - <?= $user->username; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Nomor Induk Kependudukan</th>
                <td><?= $user->nik; ?></td>
              </tr>
              <tr>
                <th>Nomor Kartu Keluarga</th>
                <td><?= $user->no_kk; ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><?= $user->email; ?></td>
              </tr>
              <tr>
                <th>Username</th>
                <td><?= $user->username; ?></td>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <td><?= $user->fullname; ?></td>
              </tr>
              <tr>
                <th>Tanggal Lahir</th>
                <td><?= date('d-m-Y', strtotime($user->tanggal_lahir)); ?></td>
              </tr>
              <tr>
                <th>Nomor Telepon</th>
                <td><?= $user->no_hp; ?></td>
              </tr>
              <tr>
                <th>Nama Ibu</th>
                <td><?= $user->nama_ibu; ?></td>
              </tr>
              <tr>
                <th>Role</th>
                <td><?= $user->name; ?></td>
              </tr>
              <tr>
                <th>Foto Profil</th>
                <td><img src="<?= base_url(); ?>/img/<?= $user->user_image; ?>" class="orang-detail"></td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="2" class="text-end">
                <?php if (in_groups('super-admin')) : ?>
                  <a href="/userList/edit/<?= encrypt_url($user->userid); ?>" class="btn btn-outline-info">Edit Role</a>
                  <a href="/userList/editProfile/<?= encrypt_url($user->userid); ?>" class="btn btn-info">Edit Profile</a>
                  <form action="/userList/<?= encrypt_url($user->userid); ?>" method="post" class="d-inline">
                    <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                    <button type="submit" class="btn btn-secondary" onclick="return confirm('Apakah anda yakin ingin mereset password user ini?')">Reset Password</button>
                  </form>
                  <form action="/userList/<?= encrypt_url($user->userid); ?>" method="post" class="d-inline">
                    <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                  </form>
                <?php endif; ?>
                <a href="/userList" class="btn btn-success">Kembali ke Daftar Pengguna</a>
              </td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>
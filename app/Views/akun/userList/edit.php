<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-3">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
      <h1 class="fw-bolder">Edit Role User</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/userList/update/<?= encrypt_url($user->userid); ?>" method="post">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">

          <!-- Nama input-->
          <div class="form-floating mb-3">
            <input class="form-control" id="username" name="username" type="text" value="<?= $user->username; ?>" disabled />
            <label for="nama">Username</label>
          </div>
          <!-- Role input-->
          <div class="form-floating mb-3">
            <select class="form-select" id="group_id" name="group_id">
              <option selected>Pilih Role</option>
              <option value="1" <?= set_select('group_id', '1', ($user->name == "super-admin") ? true : false); ?>>Super Admin</option>
              <option value="2" <?= set_select('group_id', '2', ($user->name == "admin") ? true : false); ?>>Admin</option>
              <option value="3" <?= set_select('group_id', '3', ($user->name == "user") ? true : false); ?>>User</option>
            </select>
            <label for="floatingSelect">Role</label>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Ubah Data</button>
            <a href="/userList/<?= encrypt_url($user->userid); ?>" class="btn btn-success">Kembali ke Detail User</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
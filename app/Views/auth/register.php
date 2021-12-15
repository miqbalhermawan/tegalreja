<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-plus"></i></div>
      <h1 class="fw-bolder"><?= lang('Auth.register') ?></h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="<?= route_to('register') ?>" method="post">
          <?= csrf_field() ?>
          <?= view('Myth\Auth\Views\_message_block') ?>
          <!-- Username input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" type="text" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" autofocus autocomplete="off" />
            <label for="username"><?= lang('Auth.username') ?></label>
          </div>
          <!-- email input -->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" type="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" autocomplete="off" />
            <label for="email"><?= lang('Auth.email') ?></label>
          </div>
          <!-- nik input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.nik')) : ?>is-invalid<?php endif ?>" name="nik" type="number" aria-describedby="nikHelp" placeholder="<?= lang('Auth.nik') ?>" value="<?= old('nik') ?>" autocomplete="off" />
            <label for="nik">Nomor Induk Kependudukan</label>
          </div>
          <!-- no_kk input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.no_kk')) : ?>is-invalid<?php endif ?>" name="no_kk" type="number" aria-describedby="no_kkHelp" placeholder="<?= lang('Auth.no_kk') ?>" value="<?= old('no_kk') ?>" autocomplete="off" />
            <label for="no_kk">Nomor Kartu Keluarga</label>
          </div>
          <!-- Fullname input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" type="text" placeholder="<?= lang('Auth.fullname') ?>" value="<?= old('fullname') ?>" autofocus autocomplete="off" />
            <label for="fullname">Nama Lengkap</label>
          </div>
          <!-- Tanggal Lahir input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.tanggal_lahir')) : ?>is-invalid<?php endif ?>" id="tanggal_lahir" name="tanggal_lahir" type="date" placeholder="Masukan Tanggal Lahir" value="<?= old('tanggal_lahir'); ?>" />
            <label for="tanggal_lahir">Tanggal Lahir</label>
          </div>
          <!-- no_hp input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.no_hp')) : ?>is-invalid<?php endif ?>" name="no_hp" type="text" placeholder="<?= lang('Auth.no_hp') ?>" value="<?= old('no_hp') ?>" autofocus autocomplete="off" />
            <label for="no_hp">Nomor Telepon</label>
          </div>
          <!-- Nama Ibu input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.nama_ibu')) : ?>is-invalid<?php endif ?>" id="nama_ibu" name="nama_ibu" type="text" placeholder="Masukan Nama Ibu" value="<?= old('nama_ibu'); ?>" autocomplete="off" />
            <label for="nama_ibu">Nama Ibu</label>
          </div>
          <!-- Password input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" type="password" name="password" placeholder="<?= lang('Auth.password') ?>" />
            <label for="password"><?= lang('Auth.password') ?></label>
          </div>
          <!-- Password confirm input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" type="password" name="pass_confirm" placeholder="<?= lang('Auth.repeatPassword') ?>" />
            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Register</button>
          </div>
          <div class="text-center">
            <p><a href="<?= route_to('login') ?>" class="small"><?= lang('Auth.alreadyRegistered') ?> <?= lang('Auth.signIn') ?></a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
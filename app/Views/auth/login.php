<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-key"></i></div>
      <h1 class="fw-bolder">Login</h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="<?= route_to('login') ?>" method="post">
          <?= csrf_field() ?>
          <?= view('Myth\Auth\Views\_message_block') ?>
          <?php if ($config->validFields === ['email']) : ?>
            <!-- Email input-->
            <div class="form-floating mb-3">
              <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" type="email" name="login" placeholder="<?= lang('Auth.email') ?>" value="<?= old('login'); ?>" autocomplete="off" />
              <label for="login"><?= lang('Auth.email') ?></label>
              <div class="invalid-feedback">
                <?= session('errors.login') ?>
              </div>
            </div>
          <?php else : ?>
            <!-- Username input-->
            <div class="form-floating mb-3">
              <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" type="text" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" value="<?= old('login'); ?>" autocomplete="off" />
              <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
              <div class="invalid-feedback">
                <?= session('errors.login') ?>
              </div>
            </div>
          <?php endif; ?>
          <!-- Password input-->
          <div class="form-floating mb-3">
            <input class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" type="password" name="password" placeholder="<?= lang('Auth.password') ?>" />
            <label for="password"><?= lang('Auth.password') ?></label>
          </div>
          <?php if ($config->allowRemembering) : ?>
            <div class="form-check">
              <label class="form-check-input">
                <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                <?= lang('Auth.rememberMe') ?>
              </label>
            </div>
          <?php endif; ?>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Login</button>
          </div>

          <?php if ($config->activeResetter) : ?>
            <div class="text-center">
              <p><a class="small" href="<?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
            </div>
          <?php endif; ?>

          <?php if ($config->allowRegistration) : ?>
            <div class="text-center">
              <p><a class="small" href="<?= route_to('register') ?>">Buat Akun</a></p>
            </div>
          <?php endif; ?>

          <div class="text-center">
            <p><a class="small" href="<?= base_url(); ?>/lupaPassword">Lupa Password</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <!-- Contact form-->
  <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
    <div class="text-center mb-5">
      <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-messenger"></i></div>
      <h1 class="fw-bolder">Kirim Pesan ke <?= $penerima['fullname']; ?></h1>
    </div>
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-8 col-xl-6">
        <form action="/pesan/save/<?= encrypt_url($penerima['id']); ?>" method="post">
          <input type="hidden" name="{csrf_token}" value="{csrf_hash}">
          <!-- Pesan input-->
          <div class="form-floating mb-3">
            <textarea class="form-control <?= ($validation->hasError('pesan')) ? 'is-invalid' : ''; ?>" id="pesan" name="pesan" type="text" placeholder="Masukan pesan Anda" style="height: 200px"><?= old('pesan'); ?></textarea>
            <label for="pesan">Pesan</label>
            <div class="invalid-feedback">
              <?= $validation->getError('pesan'); ?>
            </div>
          </div>
          <!-- Submit Button-->
          <div class="d-grid">
            <button class="btn btn-primary mb-3" type="submit">Kirim Pesan</button>
            <a href="/pesan" class="btn btn-success">Kembali Menu Pesan</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
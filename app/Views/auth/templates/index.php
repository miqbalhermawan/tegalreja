<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Desa Tegalreja</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/logo.png" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?= base_url(); ?>/css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <!-- Navigation-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container px-5">
        <a class="navbar-brand" href="/"><img src="<?= base_url(); ?>/assets/logo.png" alt="" width="30" height="24"> Desa Tegalreja</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('tentangDesa'); ?>">Tentang Desa</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('informasiKemasyarakatan'); ?>">Informasi Kemasyarakatan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('login'); ?>"><i class="bi bi-key"></i> Login</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <?= $this->renderSection('content'); ?>
  </main>
  <!-- Footer-->
  <footer class="w-100 bg-dark py-4 mt-auto">
    <div class="container px-5">
      <div class="row">
        <div class="col-xs-3">
          <div class="small m-0 text-white text-center">Copyright &copy; Desa Tegalreja 2021</div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url(); ?>/js/scripts.js"></script>
</body>

</html>
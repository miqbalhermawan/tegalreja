<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= $title; ?></title>
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
    <?= $this->include('layout/navbar'); ?>

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

  <?= $this->renderSection('javascript'); ?>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url(); ?>/js/scripts.js"></script>
</body>

</html>
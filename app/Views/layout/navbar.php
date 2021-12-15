<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container px-5">
    <a class="navbar-brand" href="/"><img src="<?= base_url(); ?>/assets/logo.png" alt="" width="30" height="24"> Desa Tegalreja</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/'); ?>">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('tentangDesa'); ?>">Tentang Desa</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('informasiKemasyarakatan'); ?>">Informasi Kemasyarakatan</a></li>
        <?php if (logged_in()) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownLayananKependudukan" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Layanan Kependudukan</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownLayananKependudukan">
              <li><a class="dropdown-item" href="<?= base_url('cekDataDiri'); ?>">Cek Data Diri</a></li>
              <li><a class="dropdown-item" href="<?= base_url('layanan'); ?>">Layanan</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownLayananPembangunan" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Layanan Pembangunan</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownLayananPembangunan">
              <li><a class="dropdown-item" href="<?= base_url('inputSaranPembangunan'); ?>">Input Saran Pembangunan</a></li>
              <li><a class="dropdown-item" href="<?= base_url('inventarisHasilPembangunan'); ?>">Inventaris Hasil Pembangunan</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownInformasiDesa" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= base_url(); ?>/img/<?= user()->user_image; ?>" alt="" width="30" height="24"> <?= user()->username; ?></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownInformasiDesa">
              <?php if (in_groups('super-admin') || in_groups('admin')) : ?>
                <li><a class="dropdown-item" href="<?= base_url('userList'); ?>"><i class="bi bi-person-lines-fill"></i> User List</a></li>
                <hr>
              <?php endif; ?>
              <li><a class="dropdown-item" href="<?= base_url('myProfile'); ?>"><i class="bi bi-person"></i> My Profile</a></li>
              <?php
              $pesanModel = new \App\Models\Pesan\PesanModel();
              $count_inbox = $pesanModel->where('id_penerima', user()->id)
                ->where('dibaca', 0)
                ->countAllResults();
              ?>
              <li><a class="dropdown-item" href="<?= base_url('pesan'); ?>"><i class="bi bi-chat"></i> Pesan (<?= $count_inbox; ?>)</a></li>
              <hr>
              <li><a class="dropdown-item" href="<?= base_url('logout'); ?>"><i class="bi bi-arrow-left-circle"></i> Logout</a></li>
            </ul>
          </li>
        <?php else : ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('login'); ?>"><i class="bi bi-key"></i> Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
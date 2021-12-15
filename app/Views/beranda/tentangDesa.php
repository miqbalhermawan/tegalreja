<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container px-5 my-3 py-5">
  <div class="bg-light rounded-3 py-5 px-4 px-md-12 mb-3">
    <div class="row gx-5">
      <div class="col text-center mb-3">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><img src="<?= base_url(); ?>/assets/logo.png"></div>
        <h2 class="fw-bolder">Desa Tegalreja</h2>
      </div>
    </div>
    <div class="row gx-5">
      <div class="col">
        <div class="embed-responsive mb-3">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31682.900855798354!2d108.838025!3d-6.96648!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fa0cc0537a1ff%3A0x5027a76e35670b0!2sTegalreja%2C%20Banjarharjo%2C%20Brebes%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1637375730494!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
    <div class="row gx-5">
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <div class="card border-primary mb-3 text-center w-75">
          <div class="card-header">
            <h1>Total Penduduk</h1>
          </div>
          <div class="card-body">
            <h1 class="card-title" style="font-size: 50px; font-weight:700"><?= $jumlah_penduduk; ?></h1>
            <h3 class="card-text">
              Orang
            </h3>
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="card border-dark mb-3 w-75 text-center">
          <div class="card-header">Penduduk Berdasarkan Jenis Kelamin</div>
          <div class="card-body">
            <canvas id="jenis_kelamin"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-5">
      <div class="col d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk Berdasarkan Tahun Lahir</div>
          <div class="card-body">
            <canvas id="tahun_lahir" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-5">
      <div class="col d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk Berdasarkan RW</div>
          <div class="card-body">
            <canvas id="rw" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-5">
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk RW 1 Berdasarkan RT</div>
          <div class="card-body">
            <canvas id="rw1" height="100"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk RW 2 Berdasarkan RT</div>
          <div class="card-body">
            <canvas id="rw2" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-5">
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk RW 3 Berdasarkan RT</div>
          <div class="card-body">
            <canvas id="rw3" height="100"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk RW 4 Berdasarkan RT</div>
          <div class="card-body">
            <canvas id="rw4" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row gx-5 d-flex justify-content-center">
      <div class="col-lg-6 d-flex justify-content-center">
        <div class="card border-dark mb-3 w-100 text-center">
          <div class="card-header">Penduduk RW 5 Berdasarkan RT</div>
          <div class="card-body">
            <canvas id="rw5" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url(); ?>/js/chart.min.js"></script>
<script>
  const jenis_kelamin = document.getElementById('jenis_kelamin');
  let dataJenisKelamin = [];
  let labelJenisKelamin = [];

  <?php foreach ($jenis_kelamin->getResult() as $key => $value) : ?>
    dataJenisKelamin.push(<?= $value->jumlah; ?>);
    labelJenisKelamin.push('<?= $value->jenis_kelamin; ?>');
  <?php endforeach; ?>

  const dataPerJenisKelamin = {
    datasets: [{
      data: dataJenisKelamin,
      backgroundColor: [
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
    }],
    labels: labelJenisKelamin,
    hoverOffset: 4
  }

  const chartJenisKelamin = new Chart(jenis_kelamin, {
    type: 'doughnut',
    data: dataPerJenisKelamin
  })

  const tahunLahir = document.getElementById('tahun_lahir');
  let dataTahunLahir = [];
  let labelDataTahunLahir = [];

  <?php foreach ($tahun_lahir->getResult() as $key => $value) : ?>
    dataTahunLahir.push(<?= $value->jumlah; ?>)
    labelDataTahunLahir.push('<?= $value->tahun_lahir; ?>')
  <?php endforeach; ?>

  const dataPerTahunLahir = {
    datasets: [{
      label: 'jumlah',
      data: dataTahunLahir,
      backgroundColor: 'rgba(47, 134, 166, 0.5)',
      borderColor: 'rgb(47, 134, 166)',
      borderWidth: 1,
    }],
    labels: labelDataTahunLahir,
  }

  const chartDataTahunLahir = new Chart(tahunLahir, {
    type: 'bar',
    data: dataPerTahunLahir
  })

  const rw = document.getElementById('rw');
  let dataRw = [];
  let labelDataRw = [];

  <?php foreach ($rw->getResult() as $key => $value) : ?>
    dataRw.push(<?= $value->jumlah; ?>)
    labelDataRw.push('<?= $value->rw; ?>')
  <?php endforeach; ?>

  const dataPerRw = {
    datasets: [{
      label: 'jumlah',
      data: dataRw,
      backgroundColor: 'rgba(22, 30, 84, 0.5)',
      borderColor: 'rgb(22, 30, 84)',
      borderWidth: 1,
    }],
    labels: labelDataRw,
  }

  const chartDataRw = new Chart(rw, {
    type: 'bar',
    data: dataPerRw
  })

  const rw1 = document.getElementById('rw1');
  let dataRw1 = [];
  let labelDataRw1 = [];

  <?php foreach ($rw1->getResult() as $key => $value) : ?>
    dataRw1.push(<?= $value->jumlah; ?>)
    labelDataRw1.push('<?= $value->rt; ?>')
  <?php endforeach; ?>

  const dataPerRw1 = {
    datasets: [{
      label: 'jumlah',
      data: dataRw1,
      backgroundColor: 'rgba(136, 224, 239, 0.5)',
      borderColor: 'rgb(136, 224, 239)',
      borderWidth: 1,
    }],
    labels: labelDataRw1,
  }

  const chartDataRw1 = new Chart(rw1, {
    type: 'bar',
    data: dataPerRw1
  })

  const rw2 = document.getElementById('rw2');
  let dataRw2 = [];
  let labelDataRw2 = [];

  <?php foreach ($rw2->getResult() as $key => $value) : ?>
    dataRw2.push(<?= $value->jumlah; ?>)
    labelDataRw2.push('<?= $value->rt; ?>')
  <?php endforeach; ?>

  const dataPerRw2 = {
    datasets: [{
      label: 'jumlah',
      data: dataRw2,
      backgroundColor: 'rgba(255, 81, 81, 0.5)',
      borderColor: 'rgb(255, 81, 81)',
      borderWidth: 1,
    }],
    labels: labelDataRw2,
  }

  const chartDataRw2 = new Chart(rw2, {
    type: 'bar',
    data: dataPerRw2
  })

  const rw3 = document.getElementById('rw3');
  let dataRw3 = [];
  let labelDataRw3 = [];

  <?php foreach ($rw3->getResult() as $key => $value) : ?>
    dataRw3.push(<?= $value->jumlah; ?>)
    labelDataRw3.push('<?= $value->rt; ?>')
  <?php endforeach; ?>

  const dataPerRw3 = {
    datasets: [{
      label: 'jumlah',
      data: dataRw3,
      backgroundColor: 'rgba(117, 49, 136, 0.5)',
      borderColor: 'rgb(117, 49, 136)',
      borderWidth: 1,
    }],
    labels: labelDataRw3,
  }

  const chartDataRw3 = new Chart(rw3, {
    type: 'bar',
    data: dataPerRw3
  })

  const rw4 = document.getElementById('rw4');
  let dataRw4 = [];
  let labelDataRw4 = [];

  <?php foreach ($rw4->getResult() as $key => $value) : ?>
    dataRw4.push(<?= $value->jumlah; ?>)
    labelDataRw4.push('<?= $value->rt; ?>')
  <?php endforeach; ?>

  const dataPerRw4 = {
    datasets: [{
      label: 'jumlah',
      data: dataRw4,
      backgroundColor: 'rgba(229, 153, 52, 0.5)',
      borderColor: 'rgb(229, 153, 52)',
      borderWidth: 1,
    }],
    labels: labelDataRw4,
  }

  const chartDataRw4 = new Chart(rw4, {
    type: 'bar',
    data: dataPerRw4
  })

  const rw5 = document.getElementById('rw5');
  let dataRw5 = [];
  let labelDataRw5 = [];

  <?php foreach ($rw5->getResult() as $key => $value) : ?>
    dataRw5.push(<?= $value->jumlah; ?>)
    labelDataRw5.push('<?= $value->rt; ?>')
  <?php endforeach; ?>

  const dataPerRw5 = {
    datasets: [{
      label: 'jumlah',
      data: dataRw5,
      backgroundColor: 'rgba(30, 81, 40, 0.5)',
      borderColor: 'rgb(30, 81, 40)',
      borderWidth: 1,
    }],
    labels: labelDataRw5,
  }

  const chartDataRw5 = new Chart(rw5, {
    type: 'bar',
    data: dataPerRw5
  })
</script>
<?= $this->endSection(); ?>
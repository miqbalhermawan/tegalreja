<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
  <style>
    /* Judul */
    h1 {
      text-align: center;
    }

    /* Tabel */

    thead tr th,
    tbody tr td {
      border: 1px solid black;
      text-align: left;
      text-transform: capitalize;
      font-size: 13px;
    }


    tbody tr td {
      padding-top: 5px;
      padding-bottom: 5px;
      font-size: 13px;
      text-align: left;
    }

    table {
      border-collapse: collapse;
    }

    thead {
      padding-bottom: 5px;
    }

    .right {
      text-align: right;
      text-decoration: underline;
    }
  </style>
  <title><?= $title; ?></title>
</head>

<body>
  <h1>Bukti Permintaan Layanan</h1>
  <table>
    <tbody>
      <tr>
        <td>Tanggal Input</td>
        <td><?= date('d-m-Y, H:i', strtotime($layanan['created_at'])); ?></td>
      </tr>
      <tr>
        <td>Nomor Induk Kependudukan</td>
        <td><?= $layanan['nik']; ?></td>
      </tr>
      <tr>
        <td>Nomor Kartu Keluarga</td>
        <td><?= $layanan['no_kk']; ?></td>
      </tr>
      <tr>
        <td>Nama Lengkap</td>
        <td><?= $layanan['nama']; ?></td>
      </tr>
      <tr>
        <td>Jenis Layanan</td>
        <td><?= $layanan['jenis_layanan']; ?></td>
      </tr>
      <tr>
        <td>Keperluan Pengajuan Layanan</td>
        <td><?= $layanan['keterangan']; ?></td>
      </tr>
      <tr>
        <td>Nomor Telepon</td>
        <td><?= $layanan['no_hp']; ?></td>
      </tr>
      <tr>
        <td>Status</td>
        <td><?= $layanan['status']; ?></td>
      </tr>
    </tbody>
  </table>

  <p>Keterangan</p>
  <ul>
    <li>Untuk pengajuan KTP bisa menginputkan foto surat kehilangan KTP dari kepolisian di Foto KTP</li>
    <li>Foto syarat lainnya digunakan untuk menginput persyaratan lain seperti foto surat kematian atau foto surat kelahiran dari rumah sakit</li>
    <li>Untuk Pengajuan KTP, Pengajuan Perubahan Kartu Keluarga, Pengajuan Surat Kelahiran, Pengajuan Surat Kematian, dan Pengajuan Surat Kehilangan tetap harus mendatangi kantor desa untuk pengurusannya</li>
    <li>Pengajuan layanan online hari senin s/d kamis jam 08.00 s/d 12.00 dan hari jum'at jam 08.00 s/d jam 11.00</li>
    <li>Harap membawa semua persyaratan saat datang ke kantor desa</li>
  </ul>

  <br><br><br><br><br>
  <p class="right"><?= user()->fullname; ?></p>
</body>

</html>
<?php

namespace App\Controllers;

use App\Models\Kependudukan\CekDataDiriModel;

class TentangDesa extends BaseController
{
  protected $cekDataDiriModel;

  public function __construct()
  {
    $this->cekDataDiriModel = new CekDataDiriModel();
  }

  public function index()
  {
    $jumlah_penduduk = $this->cekDataDiriModel->countAllResults();
    $penduduk_jenis_kelamin = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, jenis_kelamin')->groupBy('jenis_kelamin')->get();
    $penduduk_rw = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, rw')->groupBy('rw')->get();
    $penduduk_rw1 = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, rw, rt')->where('rw =', 1)->groupBy('rt')->get();
    $penduduk_rw2 = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, rw, rt')->where('rw =', 2)->groupBy('rt')->get();
    $penduduk_rw3 = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, rw, rt')->where('rw =', 3)->groupBy('rt')->get();
    $penduduk_rw4 = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, rw, rt')->where('rw =', 4)->groupBy('rt')->get();
    $penduduk_rw5 = $this->cekDataDiriModel->select('COUNT(id) AS jumlah, rw, rt')->where('rw =', 5)->groupBy('rt')->get();
    $tahun_lahir_penduduk = $this->cekDataDiriModel->select('YEAR(tanggal_lahir) AS tahun_lahir, COUNT(id) AS jumlah')->groupBy('YEAR(tanggal_lahir)')->get();

    $data = [
      'title' => 'Tentang Desa | Desa Tegalreja',
      'jumlah_penduduk' => $jumlah_penduduk,
      'jenis_kelamin' => $penduduk_jenis_kelamin,
      'rw' => $penduduk_rw,
      'rw1' => $penduduk_rw1,
      'rw2' => $penduduk_rw2,
      'rw3' => $penduduk_rw3,
      'rw4' => $penduduk_rw4,
      'rw5' => $penduduk_rw5,
      'tahun_lahir' => $tahun_lahir_penduduk
    ];
    return view('beranda/tentangDesa', $data);
  }
}

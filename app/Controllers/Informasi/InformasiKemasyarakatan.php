<?php

namespace App\Controllers\Informasi;

use App\Controllers\BaseController;

use App\Models\Informasi\InformasiKemasyarakatanModel;

class InformasiKemasyarakatan extends BaseController
{
  protected $informasiKemasyarakatanModel;

  public function __construct()
  {
    $this->informasiKemasyarakatanModel = new InformasiKemasyarakatanModel();
  }

  public function index()
  {
    $data = [
      'title' => 'Informasi Kemasyarakatan | Desa Tegalreja',
      'informasi' => $this->informasiKemasyarakatanModel->orderBy('id', 'desc')->findAll(6)
    ];

    return view('informasi/informasiKemasyarakatan/index', $data);
  }

  public function list()
  {
    $currentPage = $this->request->getVar('page_informasi') ? $this->request->getVar('page_informasi') : 1;

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $informasi = $this->informasiKemasyarakatanModel->search($keyword);
    } else {
      $informasi = $this->informasiKemasyarakatanModel->orderBy('id', 'desc');
    }

    $data = [
      'title' => 'List Informasi Kemasyarakatan | Desa Tegalreja',
      'informasi' => $informasi->paginate(10, 'informasi'),
      'pager' => $this->informasiKemasyarakatanModel->pager,
      'currentPage' => $currentPage
    ];
    return view('informasi/informasiKemasyarakatan/list', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Detail Informasi Kemasyarakatan | Desa Tegalreja',
      'informasi' => $this->informasiKemasyarakatanModel->getInformasi($id)
    ];

    // Jika data tidak ada
    if (empty($data['informasi'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Informasi tidak ditemukan');
    }

    return view('informasi/informasiKemasyarakatan/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Informasi Kemasyarakatan | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('informasi/informasiKemasyarakatan/create', $data);
  }

  public function save()
  {
    // Validasi input
    if (!$this->validate([
      'judul' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'informasi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'foto_info1' => [
        'rules' => 'uploaded[foto_info1]|max_size[foto_info1,10240]|is_image[foto_info1]|mime_in[foto_info1,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => '{field} harus dipilih.',
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_info2' => [
        'rules' => 'max_size[foto_info2,10240]|is_image[foto_info2]|mime_in[foto_info2,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_info3' => [
        'rules' => 'max_size[foto_info3,10240]|is_image[foto_info3]|mime_in[foto_info3,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/informasiKemasyarakatan/create')->withInput();
    }

    // ambil gambar
    $fileFotoInfo1 = $this->request->getFile('foto_info1');
    $fileFotoInfo2 = $this->request->getFile('foto_info2');
    $fileFotoInfo3 = $this->request->getFile('foto_info3');

    // generate nama file random
    $namaFotoInfo1 = $fileFotoInfo1->getRandomName();

    if ($fileFotoInfo2->getError() == 4) {
      $namaFotoInfo2 = '';
    } else {
      $namaFotoInfo2 = $fileFotoInfo2->getRandomName();
      $fileFotoInfo2->move('img', $namaFotoInfo2);
    }

    if ($fileFotoInfo3->getError() == 4) {
      $namaFotoInfo3 = '';
    } else {
      $namaFotoInfo3 = $fileFotoInfo3->getRandomName();
      $fileFotoInfo3->move('img', $namaFotoInfo3);
    }

    // pindahkan file ke folder img
    $fileFotoInfo1->move('img', $namaFotoInfo1);

    $this->informasiKemasyarakatanModel->save([
      'user_id' => user()->id,
      'judul' => $this->request->getVar('judul'),
      'informasi' => $this->request->getVar('informasi'),
      'foto_info1' => $namaFotoInfo1,
      'foto_info2' => $namaFotoInfo2,
      'foto_info3' => $namaFotoInfo3
    ]);

    session()->setFlashdata('pesan', 'Informasi berhasil ditambahkan.');

    return redirect()->to('/informasiKemasyarakatan/list');
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->informasiKemasyarakatanModel->delete($id);
    session()->setFlashdata('pesan', 'Informasi berhasil dihapus.');
    return redirect()->to('/informasiKemasyarakatan/list');
  }

  public function edit($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Informasi Kemasyarakatan | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'informasi' => $this->informasiKemasyarakatanModel->getInformasi($id)
    ];

    return view('informasi/informasiKemasyarakatan/edit', $data);
  }

  public function update($id)
  {
    $id = decrypt_url($id);
    // Validasi input
    if (!$this->validate([
      'judul' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'informasi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'foto_info1' => [
        'rules' => 'max_size[foto_info1,10240]|is_image[foto_info1]|mime_in[foto_info1,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_info2' => [
        'rules' => 'max_size[foto_info2,10240]|is_image[foto_info2]|mime_in[foto_info2,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_info3' => [
        'rules' => 'max_size[foto_info3,10240]|is_image[foto_info3]|mime_in[foto_info3,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/informasiKemasyarakatan/edit/' . encrypt_url($id))->withInput();
    }

    $fileFotoInfo1 = $this->request->getFile('foto_info1');
    $fileFotoInfo2 = $this->request->getFile('foto_info2');
    $fileFotoInfo3 = $this->request->getFile('foto_info3');

    if ($fileFotoInfo1->getError() == 4) {
      $namaFotoInfo1 = $this->request->getVar('fotoInfo1Lama');
    } else {
      $namaFotoInfo1 = $fileFotoInfo1->getRandomName();
      $fileFotoInfo1->move('img', $namaFotoInfo1);
      unlink('img/' . $this->request->getVar('fotoInfo1Lama'));
    }

    if ($fileFotoInfo2->getError() == 4) {
      $namaFotoInfo2 = $this->request->getVar('fotoInfo2Lama');
    } else {
      $namaFotoInfo2 = $fileFotoInfo2->getRandomName();
      $fileFotoInfo2->move('img', $namaFotoInfo2);
      if ($this->request->getVar('fotoInfo2Lama')) {
        unlink('img/' . $this->request->getVar('fotoInfo2Lama'));
      }
    }

    if ($fileFotoInfo3->getError() == 4) {
      $namaFotoInfo3 = $this->request->getVar('fotoInfo3Lama');
    } else {
      $namaFotoInfo3 = $fileFotoInfo3->getRandomName();
      $fileFotoInfo3->move('img', $namaFotoInfo3);
      if ($this->request->getVar('fotoInfo3Lama')) {
        unlink('img/' . $this->request->getVar('fotoInfo3Lama'));
      }
    }

    $this->informasiKemasyarakatanModel->save([
      'id' => $id,
      'user_id' => user()->id,
      'judul' => $this->request->getVar('judul'),
      'informasi' => $this->request->getVar('informasi'),
      'foto_info1' => $namaFotoInfo1,
      'foto_info2' => $namaFotoInfo2,
      'foto_info3' => $namaFotoInfo3
    ]);
    session()->setFlashdata('pesan', 'Informasi berhasil diupdate.');
    return redirect()->to('/informasiKemasyarakatan/list');
  }
}

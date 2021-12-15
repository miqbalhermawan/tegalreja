<?php

namespace App\Controllers\Pembangunan;

use App\Controllers\BaseController;

use App\Models\Pembangunan\InputSaranPembangunanModel;

class InputSaranPembangunan extends BaseController
{
  protected $inputSaranPembangunanModel;

  public function __construct()
  {
    $this->inputSaranPembangunanModel = new InputSaranPembangunanModel();
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_saran_pembangunan') ? $this->request->getVar('page_saran_pembangunan') : 1;

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $saranPembangunan = $this->inputSaranPembangunanModel->search($keyword);
    } else {
      $saranPembangunan = $this->inputSaranPembangunanModel;
    }

    $data = [
      'title' => 'Input Saran Pembangunan | Desa Tegalreja',
      'saranPembangunan' => $saranPembangunan->paginate(5, 'saran_pembangunan'),
      'pager' => $this->inputSaranPembangunanModel->pager,
      'currentPage' => $currentPage
    ];
    return view('pembangunan/inputSaranPembangunan/index', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Detail Saran Pembangunan | Desa Tegalreja',
      'saranPembangunan' => $this->inputSaranPembangunanModel->getSaranPembangunan($id)
    ];

    // Jika data tidak ada
    if (empty($data['saranPembangunan'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Saran Pembangunan tidak ditemukan');
    }

    return view('pembangunan/inputSaranPembangunan/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Saran Pembangunan | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('pembangunan/inputSaranPembangunan/create', $data);
  }

  public function save()
  {
    // Validasi input
    if (!$this->validate([
      // 'nik' => [
      //   'rules' => 'required|min_length[16]|max_length[16]|integer',
      //   'errors' => [
      //     'required' => '{field} harus diisi.',
      //     'min_length' => '{field} minimal 16 angka.',
      //     'max_length' => '{field} maximal 16 angka.',
      //     'integer' => '{field} harus berupa angka'
      //   ]
      // ],
      // 'nama' => [
      //   'rules' => 'required',
      //   'errors' => [
      //     'required' => '{field} harus diisi.',
      //   ]
      // ],
      'saran' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'lokasi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'foto_lokasi' => [
        'rules' => 'uploaded[foto_lokasi]|max_size[foto_lokasi,5120]|is_image[foto_lokasi]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => '{field} harus dipilih.',
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_diri' => [
        'rules' => 'uploaded[foto_diri]|max_size[foto_diri,5120]|is_image[foto_diri]|mime_in[foto_diri,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => '{field} harus dipilih.',
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/inputSaranPembangunan/create')->withInput();
    }

    // ambil gambar
    $fileFotoLokasi = $this->request->getFile('foto_lokasi');
    $fileFotoDiri = $this->request->getFile('foto_diri');

    // generate nama file random
    $namaFotoLokasi = $fileFotoLokasi->getRandomName();
    $namaFotoDiri = $fileFotoDiri->getRandomName();

    // pindahkan file ke folder img
    $fileFotoLokasi->move('img', $namaFotoLokasi);
    $fileFotoDiri->move('img', $namaFotoDiri);

    $this->inputSaranPembangunanModel->save([
      'user_id' => user()->id,
      'nik' => user()->nik,
      'nama' => user()->fullname,
      'saran' => $this->request->getVar('saran'),
      'lokasi' => $this->request->getVar('lokasi'),
      'foto_lokasi' => $namaFotoLokasi,
      'foto_diri' => $namaFotoDiri
    ]);

    session()->setFlashdata('pesan', 'Saran berhasil ditambahkan.');

    return redirect()->to('/inputSaranPembangunan');
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->inputSaranPembangunanModel->delete($id);
    session()->setFlashdata('pesan', 'Saran berhasil dihapus.');
    return redirect()->to('/inputSaranPembangunan');
  }

  public function edit($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Saran Pembangunan  | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'saranPembangunan' => $this->inputSaranPembangunanModel->getSaranPembangunan($id)
    ];

    return view('pembangunan/inputSaranPembangunan/edit', $data);
  }

  public function update($id)
  {
    $id = decrypt_url($id);
    // Validasi input
    if (!$this->validate([
      // 'nik' => [
      //   'rules' => 'required|min_length[16]|max_length[16]|integer',
      //   'errors' => [
      //     'required' => '{field} harus diisi.',
      //     'min_length' => '{field} minimal 16 angka.',
      //     'max_length' => '{field} maximal 16 angka.',
      //     'integer' => '{field} harus berupa angka'
      //   ]
      // ],
      // 'nama' => [
      //   'rules' => 'required',
      //   'errors' => [
      //     'required' => '{field} harus diisi.',
      //   ]
      // ],
      'saran' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'lokasi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'foto_lokasi' => [
        'rules' => 'max_size[foto_lokasi,5120]|is_image[foto_lokasi]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_diri' => [
        'rules' => 'max_size[foto_diri,5120]|is_image[foto_diri]|mime_in[foto_diri,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/inputSaranPembangunan/edit/' . encrypt_url($id))->withInput();
    }

    $fileFotoLokasi = $this->request->getFile('foto_lokasi');
    $fileFotoDiri = $this->request->getFile('foto_diri');

    // cek gambar lama atau baru
    if ($fileFotoLokasi->getError() == 4) {
      $namaFotoLokasi = $this->request->getVar('fotoLokasiLama');
    } else {
      // generate nama file random
      $namaFotoLokasi = $fileFotoLokasi->getRandomName();
      // pindah gambar
      $fileFotoLokasi->move('img', $namaFotoLokasi);
      // hapus file yang lama
      unlink('img/' . $this->request->getVar('fotoLokasiLama'));
    }

    if ($fileFotoDiri->getError() == 4) {
      $namaFotoDiri = $this->request->getVar('fotoDiriLama');
    } else {
      $namaFotoDiri = $fileFotoDiri->getRandomName();
      $fileFotoDiri->move('img', $namaFotoDiri);
      unlink('img/' . $this->request->getVar('fotoDiriLama'));
    }

    $this->inputSaranPembangunanModel->save([
      'id' => $id,
      'user_id' => user()->id,
      'nik' => user()->nik,
      'nama' => user()->fullname,
      'saran' => $this->request->getVar('saran'),
      'lokasi' => $this->request->getVar('lokasi'),
      'foto_lokasi' => $namaFotoLokasi,
      'foto_diri' => $namaFotoDiri
    ]);

    session()->setFlashdata('pesan', 'Saran berhasil diupdate.');

    return redirect()->to('/inputSaranPembangunan');
  }
}

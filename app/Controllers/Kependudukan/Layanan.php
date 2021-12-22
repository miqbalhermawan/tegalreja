<?php

namespace App\Controllers\Kependudukan;

use App\Controllers\BaseController;

use App\Models\Kependudukan\LayananModel;

class Layanan extends BaseController
{
  protected $layananModel;

  public function __construct()
  {
    $this->layananModel = new LayananModel();
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_layanan') ? $this->request->getVar('page_layanan') : 1;

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $layanan = $this->layananModel->search($keyword);
    } else {
      $layanan = $this->layananModel;
    }

    if (in_groups('user')) {
      $layanan = $this->layananModel->where('user_id', user()->id);
    } else {
      $layanan = $this->layananModel;
    }

    $data = [
      'title' => 'Layanan Kependudukan | Desa Tegalreja',
      'layanan' => $layanan->paginate(10, 'layanan'),
      'pager' => $this->layananModel->pager,
      'currentPage' => $currentPage
    ];

    return view('kependudukan/layanan/index', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Detail Layanan Kependudukan | Desa Tegalreja',
      'layanan' => $this->layananModel->getLayanan($id)
    ];

    // Jika data tidak ada
    if (empty($data['layanan'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Layanan tidak ditemukan');
    }

    return view('kependudukan/layanan/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Layanan Kependudukan | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('kependudukan/layanan/create', $data);
  }

  public function save()
  {
    // Validasi input
    if (!$this->validate([
      'nik' => [
        'rules' => 'required|min_length[16]|max_length[16]|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'min_length' => '{field} minimal 16 angka.',
          'max_length' => '{field} maximal 16 angka.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'no_kk' => [
        'rules' => 'required|min_length[16]|max_length[16]|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'min_length' => '{field} minimal 16 angka.',
          'max_length' => '{field} maximal 16 angka.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'keterangan' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'no_hp' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'foto_ktp' => [
        'rules' => 'uploaded[foto_ktp]|max_size[foto_ktp,5120]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => '{field} harus dipilih.',
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_kk' => [
        'rules' => 'uploaded[foto_kk]|max_size[foto_kk,5120]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => '{field} harus dipilih.',
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ],
      'foto_lain' => [
        'rules' => 'max_size[foto_lain,5120]|is_image[foto_lain]|mime_in[foto_lain,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/layanan/create')->withInput();
    }

    // ambil gambar
    $fileFotoKtp = $this->request->getFile('foto_ktp');
    $fileFotoKk = $this->request->getFile('foto_kk');
    $fileFotoLain = $this->request->getFile('foto_lain');

    // generate nama file random
    $namaFotoKtp = $fileFotoKtp->getRandomName();
    $namaFotoKk = $fileFotoKk->getRandomName();

    // pindahkan file ke folder img
    $fileFotoKtp->move('img', $namaFotoKtp);
    $fileFotoKk->move('img', $namaFotoKk);

    if ($fileFotoLain->getError() == 4) {
      $namaFotoLain = '';
    } else {
      $namaFotoLain = $fileFotoLain->getRandomName();
      $fileFotoLain->move('img', $namaFotoLain);
    }

    $this->layananModel->save([
      'user_id' => user()->id,
      'nik' => $this->request->getVar('nik'),
      'no_kk' => $this->request->getVar('no_kk'),
      'nama' => $this->request->getVar('nama'),
      'jenis_layanan' => $this->request->getVar('jenis_layanan'),
      'keterangan' => $this->request->getVar('keterangan'),
      'no_hp' => $this->request->getVar('no_hp'),
      'foto_ktp' => $namaFotoKtp,
      'foto_kk' => $namaFotoKk,
      'foto_lain' => $namaFotoLain,
      'status' => 'Dalam Proses'
    ]);

    session()->setFlashdata('pesan', 'Layanan berhasil ditambahkan.');

    return redirect()->to('/layanan');
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->layananModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/layanan');
  }

  public function edit($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Layanan Kependudukan | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'layanan' => $this->layananModel->getLayanan($id)
    ];

    return view('kependudukan/layanan/edit', $data);
  }

  public function update($id)
  {
    $id = decrypt_url($id);
    // Validasi input
    if (in_groups('user')) {
      if (!$this->validate([
        'nik' => [
          'rules' => 'required|min_length[16]|max_length[16]|integer',
          'errors' => [
            'required' => '{field} harus diisi.',
            'min_length' => '{field} minimal 16 angka.',
            'max_length' => '{field} maximal 16 angka.',
            'integer' => '{field} harus berupa angka'
          ]
        ],
        'no_kk' => [
          'rules' => 'required|min_length[16]|max_length[16]|integer',
          'errors' => [
            'required' => '{field} harus diisi.',
            'min_length' => '{field} minimal 16 angka.',
            'max_length' => '{field} maximal 16 angka.',
            'integer' => '{field} harus berupa angka'
          ]
        ],
        'nama' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} harus diisi.',
          ]
        ],
        'keterangan' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} harus diisi.',
          ]
        ],
        'foto_ktp' => [
          'rules' => 'max_size[foto_ktp,5120]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar'
          ]
        ],
        'foto_kk' => [
          'rules' => 'max_size[foto_kk,5120]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar'
          ]
        ],
        'foto_lain' => [
          'rules' => 'max_size[foto_lain,5120]|is_image[foto_lain]|mime_in[foto_lain,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar'
          ]
        ]
      ])) {
        return redirect()->to('/layanan/edit/' . encrypt_url($id))->withInput();
      }

      $fileFotoKtp = $this->request->getFile('foto_ktp');
      $fileFotoKk = $this->request->getFile('foto_kk');
      $fileFotoLain = $this->request->getFile('foto_lain');

      // cek gambar lama atau baru
      if ($fileFotoKtp->getError() == 4) {
        $namaFotoKtp = $this->request->getVar('fotoKtpLama');
      } else {
        // generate nama file random
        $namaFotoKtp = $fileFotoKtp->getRandomName();
        // pindah gambar
        $fileFotoKtp->move('img', $namaFotoKtp);
        // hapus file yang lama
        unlink('img/' . $this->request->getVar('fotoKtpLama'));
      }

      if ($fileFotoKk->getError() == 4) {
        $namaFotoKk = $this->request->getVar('fotoKkLama');
      } else {
        $namaFotoKk = $fileFotoKk->getRandomName();
        $fileFotoKk->move('img', $namaFotoKk);
        unlink('img/' . $this->request->getVar('fotoKkLama'));
      }

      if ($fileFotoLain->getError() == 4) {
        $namaFotoLain = $this->request->getVar('fotoLainLama');
      } else {
        $namaFotoLain = $fileFotoLain->getRandomName();
        $fileFotoLain->move('img', $namaFotoLain);
        if ($this->request->getVar('fotoLainLama')) {
          unlink('img/' . $this->request->getVar('fotoLainLama'));
        }
      }

      $this->layananModel->save([
        'id' => $id,
        'user_id' => user()->id,
        'nik' => $this->request->getVar('nik'),
        'no_kk' => $this->request->getVar('no_kk'),
        'nama' => $this->request->getVar('nama'),
        'jenis_layanan' => $this->request->getVar('jenis_layanan'),
        'keterangan' => $this->request->getVar('keterangan'),
        'no_hp' => $this->request->getVar('no_hp'),
        'foto_ktp' => $namaFotoKtp,
        'foto_kk' => $namaFotoKk,
        'foto_lain' => $namaFotoLain
      ]);
    } elseif (in_groups('super-admin')) {
      if (!$this->validate([
        'nik' => [
          'rules' => 'required|min_length[16]|max_length[16]|integer',
          'errors' => [
            'required' => '{field} harus diisi.',
            'min_length' => '{field} minimal 16 angka.',
            'max_length' => '{field} maximal 16 angka.',
            'integer' => '{field} harus berupa angka'
          ]
        ],
        'no_kk' => [
          'rules' => 'required|min_length[16]|max_length[16]|integer',
          'errors' => [
            'required' => '{field} harus diisi.',
            'min_length' => '{field} minimal 16 angka.',
            'max_length' => '{field} maximal 16 angka.',
            'integer' => '{field} harus berupa angka'
          ]
        ],
        'nama' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} harus diisi.',
          ]
        ],
        'keterangan' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} harus diisi.',
          ]
        ],
        'foto_ktp' => [
          'rules' => 'max_size[foto_ktp,5120]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar'
          ]
        ],
        'foto_kk' => [
          'rules' => 'max_size[foto_kk,5120]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar'
          ]
        ],
        'foto_lain' => [
          'rules' => 'max_size[foto_lain,5120]|is_image[foto_lain]|mime_in[foto_lain,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'max_size' => 'Ukuran gambar terlalu besar',
            'is_image' => 'Yang anda pilih bukan gambar',
            'mime_in' => 'Yang anda pilih bukan gambar'
          ]
        ]
      ])) {
        return redirect()->to('/layanan/edit/' . encrypt_url($id))->withInput();
      }

      $fileFotoKtp = $this->request->getFile('foto_ktp');
      $fileFotoKk = $this->request->getFile('foto_kk');
      $fileFotoLain = $this->request->getFile('foto_lain');

      // cek gambar lama atau baru
      if ($fileFotoKtp->getError() == 4) {
        $namaFotoKtp = $this->request->getVar('fotoKtpLama');
      } else {
        // generate nama file random
        $namaFotoKtp = $fileFotoKtp->getRandomName();
        // pindah gambar
        $fileFotoKtp->move('img', $namaFotoKtp);
        // hapus file yang lama
        unlink('img/' . $this->request->getVar('fotoKtpLama'));
      }

      if ($fileFotoKk->getError() == 4) {
        $namaFotoKk = $this->request->getVar('fotoKkLama');
      } else {
        $namaFotoKk = $fileFotoKk->getRandomName();
        $fileFotoKk->move('img', $namaFotoKk);
        unlink('img/' . $this->request->getVar('fotoKkLama'));
      }

      if ($fileFotoLain->getError() == 4) {
        $namaFotoLain = $this->request->getVar('fotoLainLama');
      } else {
        $namaFotoLain = $fileFotoLain->getRandomName();
        $fileFotoLain->move('img', $namaFotoLain);
        if ($this->request->getVar('fotoLainLama')) {
          unlink('img/' . $this->request->getVar('fotoLainLama'));
        }
      }

      $this->layananModel->save([
        'id' => $id,
        'user_id' => user()->id,
        'nik' => $this->request->getVar('nik'),
        'no_kk' => $this->request->getVar('no_kk'),
        'nama' => $this->request->getVar('nama'),
        'jenis_layanan' => $this->request->getVar('jenis_layanan'),
        'keterangan' => $this->request->getVar('keterangan'),
        'no_hp' => $this->request->getVar('no_hp'),
        'foto_ktp' => $namaFotoKtp,
        'foto_kk' => $namaFotoKk,
        'foto_lain' => $namaFotoLain,
        'status' => $this->request->getVar('status')
      ]);
    } else {
      $this->layananModel->save([
        'id' => $id,
        'status' => $this->request->getVar('status')
      ]);
    }

    session()->setFlashdata('pesan', 'Layanan berhasil diupdate.');

    return redirect()->to('/layanan');
  }

  public function cetak($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Cetak PDF',
      'layanan' => $this->layananModel->getLayanan($id)
    ];
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',    // format - A4, for example, default ''
      'default_font_size' => 0,     // font size - default 0
      'default_font' => '',    // default font family
      'margin_left' => 25,
      'margin_right' => 15,
      'margin_top' => 20,
      'orientation' => 'P'      // L - landscape, P - portrait
    ]);
    $html = view('kependudukan/layanan/layanan_pdf', $data);
    $mpdf->WriteHTML($html);
    $mpdf->Output('layanan.pdf', 'D');
  }
}

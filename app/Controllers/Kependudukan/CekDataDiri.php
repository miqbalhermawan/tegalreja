<?php

namespace App\Controllers\Kependudukan;

use App\Controllers\BaseController;

use App\Models\Kependudukan\CekDataDiriModel;

class CekDataDiri extends BaseController
{
  protected $cekDataDiriModel;

  public function __construct()
  {
    $this->cekDataDiriModel = new CekDataDiriModel();
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_penduduk') ? $this->request->getVar('page_penduduk') : 1;

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $dataDiri = $this->cekDataDiriModel->search($keyword);
    } else {
      $dataDiri = $this->cekDataDiriModel;
    }

    $data = [
      'title' => 'Cek Data Diri | Desa Tegalreja',
      'dataDiri' => $dataDiri->paginate(10, 'penduduk'),
      'pager' => $this->cekDataDiriModel->pager,
      'currentPage' => $currentPage
    ];

    return view('kependudukan/cekDataDiri/index', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Detail Data Diri | Desa Tegalreja',
      'dataDiri' => $this->cekDataDiriModel->getDataDiri($id)
    ];

    // Jika data tidak ada
    if (empty($data['dataDiri'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Data diri tidak ditemukan');
    }

    return view('kependudukan/cekDataDiri/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Data Penduduk  | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('kependudukan/cekDataDiri/create', $data);
  }

  public function save()
  {
    // Validasi input
    if (!$this->validate([
      'nik' => [
        'rules' => 'required|is_unique[penduduk.nik]|min_length[16]|max_length[16]|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'is_unique' => '{field} tidak boleh sama.',
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
      'tempat_lahir' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'tanggal_lahir' => [
        'rules' => 'required|valid_date',
        'errors' => [
          'required' => '{field} harus diisi.',
          'valid_date' => '{field} tidak valid.'
        ]
      ],
      'rt' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'rw' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'nama_ayah' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'nama_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ]
    ])) {
      return redirect()->to('/cekDataDiri/create')->withInput();
    }

    $this->cekDataDiriModel->save([
      'user_id' => user()->id,
      'nik' => $this->request->getVar('nik'),
      'no_kk' => $this->request->getVar('no_kk'),
      'nama' => $this->request->getVar('nama'),
      'tempat_lahir' => $this->request->getVar('tempat_lahir'),
      'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
      'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
      'rt' => $this->request->getVar('rt'),
      'rw' => $this->request->getVar('rw'),
      'nama_ayah' => $this->request->getVar('nama_ayah'),
      'nama_ibu' => $this->request->getVar('nama_ibu')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/cekDataDiri');
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->cekDataDiriModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/cekDataDiri');
  }

  public function edit($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Data Penduduk  | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'dataDiri' => $this->cekDataDiriModel->getDataDiri($id)
    ];

    return view('kependudukan/cekDataDiri/edit', $data);
  }

  public function update($id)
  {
    $id = decrypt_url($id);
    // cek nik
    $dataDiriLama = $this->cekDataDiriModel->getDataDiri($id);
    if ($dataDiriLama['nik'] == $this->request->getVar('nik')) {
      $rule_nik = 'required|min_length[16]|max_length[16]|integer';
    } else {
      $rule_nik = 'required|is_unique[penduduk.nik]|min_length[16]|max_length[16]|integer';
    }

    if (!$this->validate([
      'nik' => [
        'rules' => $rule_nik,
        'errors' => [
          'required' => '{field} harus diisi.',
          'is_unique' => '{field} tidak boleh sama.',
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
      'tempat_lahir' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'tanggal_lahir' => [
        'rules' => 'required|valid_date',
        'errors' => [
          'required' => '{field} harus diisi.',
          'valid_date' => '{field} tidak valid.'
        ]
      ],
      'rt' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'rw' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'nama_ayah' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'nama_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ]
    ])) {
      return redirect()->to('/cekDataDiri/edit/' . encrypt_url($id))->withInput();
    }

    $this->cekDataDiriModel->save([
      'id' => $id,
      'user_id' => user()->id,
      'nik' => $this->request->getVar('nik'),
      'no_kk' => $this->request->getVar('no_kk'),
      'nama' => $this->request->getVar('nama'),
      'tempat_lahir' => $this->request->getVar('tempat_lahir'),
      'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
      'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
      'rt' => $this->request->getVar('rt'),
      'rw' => $this->request->getVar('rw'),
      'nama_ayah' => $this->request->getVar('nama_ayah'),
      'nama_ibu' => $this->request->getVar('nama_ibu')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diupdate.');

    return redirect()->to('/cekDataDiri');
  }
}

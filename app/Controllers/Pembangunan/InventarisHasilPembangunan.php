<?php

namespace App\Controllers\Pembangunan;

use App\Controllers\BaseController;

use App\Models\Pembangunan\InventarisHasilPembangunanModel;

class InventarisHasilPembangunan extends BaseController
{
  protected $inventarisHasilPembangunanModel;

  public function __construct()
  {
    $this->inventarisHasilPembangunanModel = new InventarisHasilPembangunanModel();
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_inventaris_pembangunan') ? $this->request->getVar('page_inventaris_pembangunan') : 1;

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $inventarisPembangunan = $this->inventarisHasilPembangunanModel->search($keyword);
    } else {
      $inventarisPembangunan = $this->inventarisHasilPembangunanModel;
    }

    $data = [
      'title' => 'Inventaris Hasil Pembangunan | Desa Tegalreja',
      'inventarisPembangunan' => $inventarisPembangunan->paginate(10, 'inventaris_pembangunan'),
      'pager' => $this->inventarisHasilPembangunanModel->pager,
      'currentPage' => $currentPage
    ];
    return view('pembangunan/inventarisHasilPembangunan/index', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Detail Data Diri | Desa Tegalreja',
      'inventarisPembangunan' => $this->inventarisHasilPembangunanModel->getInventarisPembangunan($id)
    ];

    // Jika data tidak ada
    if (empty($data['inventarisPembangunan'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Inventaris Pembangunan tidak ditemukan');
    }

    return view('pembangunan/inventarisHasilPembangunan/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Inventaris Hasil Pembangunan | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('pembangunan/inventarisHasilPembangunan/create', $data);
  }

  public function save()
  {
    // Validasi input
    if (!$this->validate([
      'no_urut' => [
        'rules' => 'required|is_unique[inventaris_pembangunan.no_urut]|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'is_unique' => '{field} tidak boleh sama.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'nama_pembangunan' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'volume' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'biaya' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'lokasi' => [
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
      ]
    ])) {
      return redirect()->to('/inventarisHasilPembangunan/create')->withInput();
    }

    $this->inventarisHasilPembangunanModel->save([
      'user_id' => user()->id,
      'no_urut' => $this->request->getVar('no_urut'),
      'nama_pembangunan' => $this->request->getVar('nama_pembangunan'),
      'volume' => $this->request->getVar('volume'),
      'biaya' => $this->request->getVar('biaya'),
      'lokasi' => $this->request->getVar('lokasi'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Inventaris berhasil ditambahkan.');

    return redirect()->to('/inventarisHasilPembangunan');
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->inventarisHasilPembangunanModel->delete($id);
    session()->setFlashdata('pesan', 'Inventaris berhasil dihapus.');
    return redirect()->to('/inventarisHasilPembangunan');
  }

  public function edit($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Inventaris Hasil Pembangunan | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'inventarisPembangunan' => $this->inventarisHasilPembangunanModel->getInventarisPembangunan($id)
    ];

    return view('pembangunan/inventarisHasilPembangunan/edit', $data);
  }

  public function update($id)
  {
    $id = decrypt_url($id);
    // cek nik
    $inventarisPembangunanLama = $this->inventarisHasilPembangunanModel->getInventarisPembangunan($id);
    if ($inventarisPembangunanLama['no_urut'] == $this->request->getVar('no_urut')) {
      $rule_noUrut = 'required|integer';
    } else {
      $rule_noUrut = 'required|is_unique[inventaris_pembangunan.no_urut]|integer';
    }

    if (!$this->validate([
      'no_urut' => [
        'rules' => $rule_noUrut,
        'errors' => [
          'required' => '{field} harus diisi.',
          'is_unique' => '{field} tidak boleh sama.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'nama_pembangunan' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'volume' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.',
        ]
      ],
      'biaya' => [
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'lokasi' => [
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
      ]
    ])) {
      return redirect()->to('/inventarisHasilPembangunan/edit/' . encrypt_url($id))->withInput();
    }

    $this->inventarisHasilPembangunanModel->save([
      'id' => $id,
      'user_id' => user()->id,
      'no_urut' => $this->request->getVar('no_urut'),
      'nama_pembangunan' => $this->request->getVar('nama_pembangunan'),
      'volume' => $this->request->getVar('volume'),
      'biaya' => $this->request->getVar('biaya'),
      'lokasi' => $this->request->getVar('lokasi'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Inventaris berhasil diupdate.');

    return redirect()->to('/inventarisHasilPembangunan');
  }
}

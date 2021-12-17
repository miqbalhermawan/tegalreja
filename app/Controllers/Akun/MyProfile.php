<?php

namespace App\Controllers\Akun;

use App\Controllers\BaseController;

use \Myth\Auth\Password;

use App\Models\Akun\UserListModel;

class MyProfile extends BaseController
{
  protected $userListModel;

  public function __construct()
  {
    $this->userListModel = new UserListModel();
  }

  public function index()
  {
    $data = [
      'title' => 'My Profile | Desa Tegalreja'
    ];

    return view('akun/myProfile/index', $data);
  }

  public function gantiPassword()
  {
    $data = [
      'title' => 'Ganti Password | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('akun/myProfile/gantiPassword', $data);
  }

  public function updatePassword()
  {
    if (!$this->validate([
      'currentPassword' => [
        'label' => 'Password saat ini',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi'
        ]
      ],
      'newPassword' => [
        'label' => 'Password baru',
        'rules' => 'required|min_length[8]|max_length[20]',
        'errors' => [
          'required' => '{field} harus diisi',
          'min_length' => '{field} minimal 8 karakter & maksimal 20 karakter',
          'max_length' => '{field} minimal 8 karakter & maksimal 20 karakter'
        ]
      ],
      'repeatPassword' => [
        'label' => 'Konfirmasi Password baru',
        'rules' => 'required|matches[newPassword]',
        'errors' => [
          'required' => '{field} harus diisi',
          'matches' => '{field} tidak sama'
        ]
      ]
    ])) {
      return redirect()->to('/myProfile/gantiPassword')->withInput();
    };

    if (!Password::verify($this->request->getPost('currentPassword'), user()->password_hash)) {
      session()->setFlashdata('pesan', 'Password saat ini tidak sesuai.');
      return redirect()->to('/myProfile/gantiPassword');
    }

    $this->userListModel->save([
      'id' => user()->id,
      'password_hash' => Password::hash($this->request->getPost('newPassword'))
    ]);
    session()->setFlashdata('pesan', 'Berhasil ganti password.');
    return redirect()->to('/myProfile/gantiPassword');
  }

  public function edit()
  {
    $data = [
      'title' => 'Edit Profile | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('akun/myProfile/edit', $data);
  }

  public function update()
  {
    // cek username
    if (user()->username == $this->request->getVar('username')) {
      $rule_username = 'required';
    } else {
      $rule_username = 'required|is_unique[users.nik]';
    }

    // cek email
    if (user()->email == $this->request->getVar('email')) {
      $rule_email = 'required';
    } else {
      $rule_email = 'required|is_unique[users.email]';
    }

    // cek nik
    // if (user()->nik == $this->request->getVar('nik')) {
    //   $rule_nik = 'required|min_length[16]|max_length[16]|integer';
    // } else {
    //   $rule_nik = 'required|is_unique[users.nik]|min_length[16]|max_length[16]|integer';
    // }

    if (!$this->validate([
      'username' => [
        'label' => 'Username',
        'rules' => $rule_username,
        'errors' => [
          'required' => '{field} harus diisi',
          'is_unique' => '{field} tidak boleh sama.'
        ]
      ],
      'email' => [
        'label' => 'Email',
        'rules' => $rule_email,
        'errors' => [
          'required' => '{field} harus diisi',
          'is_unique' => '{field} tidak boleh sama.',
        ]
      ],
      // 'nik' => [
      //   'label' => 'Nomor Induk Kependudukan',
      //   'rules' => $rule_nik,
      //   'errors' => [
      //     'required' => '{field} harus diisi.',
      //     'is_unique' => '{field} tidak boleh sama.',
      //     'min_length' => '{field} minimal 16 angka.',
      //     'max_length' => '{field} maximal 16 angka.',
      //     'integer' => '{field} harus berupa angka'
      //   ]
      // ],
      // 'no_kk' => [
      //   'label' => 'Nomor Kartu Keluarga',
      //   'rules' => 'required|min_length[16]|max_length[16]|integer',
      //   'errors' => [
      //     'required' => '{field} harus diisi.',
      //     'min_length' => '{field} minimal 16 angka.',
      //     'max_length' => '{field} maximal 16 angka.',
      //     'integer' => '{field} harus berupa angka'
      //   ]
      // ],
      'no_hp' => [
        'label' => 'No Telepon',
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} hatus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'user_image' => [
        'label' => 'Foto Profile',
        'rules' => 'max_size[user_image,2048]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/myProfile/edit')->withInput();
    };

    $fileFotoProfile = $this->request->getFile('user_image');

    if ($fileFotoProfile->getError() == 4) {
      $namaFotoProfile = $this->request->getVar('fotoProfileLama');
    } else {
      $namaFotoProfile = $fileFotoProfile->getRandomName();
      $fileFotoProfile->move('img', $namaFotoProfile);
      if (user()->user_image != 'default.svg') {
        unlink('img/' . $this->request->getVar('fotoProfileLama'));
      }
    }

    $this->userListModel->save([
      'id' => user()->id,
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'nik' => user()->nik,
      'no_kk' => user()->no_kk,
      'fullname' => user()->fullname,
      'no_hp' => $this->request->getVar('no_hp'),
      'tanggal_lahir' => user()->tanggal_lahir,
      'nama_ibu' => user()->nama_ibu,
      'user_image' => $namaFotoProfile
    ]);
    session()->setFlashdata('pesan', 'Berhasil Edit Profile.');
    return redirect()->to('/myProfile');
  }

  public function lupaPassword()
  {
    $data = [
      'title' => 'Lupa Password | Desa Tegalreja',
      'validation' => \Config\Services::validation()
    ];

    return view('akun/myProfile/lupaPassword', $data);
  }

  public function updateLupaPassword()
  {
    if (!$this->validate([
      'username' => [
        'label' => 'Username|is_not_unique[users.username]',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi',
          'is_not_unique' => '{field} tidak ditemukan'
        ]
      ],
      'nik' => [
        'label' => 'NIK',
        'rules' => 'required|min_length[16]|max_length[16]|integer|is_not_unique[users.nik]',
        'errors' => [
          'required' => '{field} harus diisi.',
          'is_unique' => '{field} tidak boleh sama.',
          'min_length' => '{field} minimal 16 angka.',
          'max_length' => '{field} maximal 16 angka.',
          'integer' => '{field} harus berupa angka',
          'is_not_unique' => '{field} tidak ditemukan'
        ]
      ],
      'no_kk' => [
        'label' => 'No KK',
        'rules' => 'required|min_length[16]|max_length[16]|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'min_length' => '{field} minimal 16 angka.',
          'max_length' => '{field} maximal 16 angka.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'fullname' => [
        'label' => 'Nama Lengkap',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'tanggal_lahir' => [
        'label' => 'Tanggal Lahir',
        'rules' => 'required|valid_date',
        'errors' => [
          'required' => '{field} harus diisi.',
          'valid_date' => '{field} tidak valid.'
        ]
      ],
      'nama_ibu' => [
        'label' => 'Nama Ibu',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'newPassword' => [
        'label' => 'Password baru',
        'rules' => 'required|min_length[8]|max_length[20]',
        'errors' => [
          'required' => '{field} harus diisi',
          'min_length' => '{field} minimal 8 karakter & maksimal 20 karakter',
          'max_length' => '{field} minimal 8 karakter & maksimal 20 karakter'
        ]
      ],
      'repeatPassword' => [
        'label' => 'Konfirmasi Password baru',
        'rules' => 'required|matches[newPassword]',
        'errors' => [
          'required' => '{field} harus diisi',
          'matches' => '{field} tidak sama'
        ]
      ]
    ])) {
      return redirect()->to('/lupaPassword')->withInput();
    }

    $username = $this->request->getVar('username');
    $nik = $this->request->getVar('nik');
    $no_kk = $this->request->getVar('no_kk');
    $fullname = $this->request->getVar('fullname');
    $tanggal_lahir = $this->request->getVar('tanggal_lahir');
    $nama_ibu = $this->request->getVar('nama_ibu');

    $user = $this->userListModel->select('*')->where('nik', $nik)->get()->getRow();

    if ($username == $user->username && $no_kk == $user->no_kk && $fullname == $user->fullname && $tanggal_lahir == $user->tanggal_lahir && $nama_ibu == $user->nama_ibu) {
      $this->userListModel->save([
        'id' => $user->id,
        'password_hash' => Password::hash($this->request->getPost('newPassword'))
      ]);
      return redirect()->to('/login');
    } else {
      session()->setFlashdata('pesan', 'Data Tidak Sesuai!');
      return redirect()->to('/lupaPassword')->withInput();
    }
  }
}

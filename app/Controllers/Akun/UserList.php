<?php

namespace App\Controllers\Akun;

use App\Controllers\BaseController;

use App\Models\Akun\UserListModel;

use \Myth\Auth\Password;

class UserList extends BaseController
{
  protected $userListModel;

  public function __construct()
  {
    $this->userListModel = new UserListModel();
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;

    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $user = $this->userListModel->search($keyword);
    } else {
      $user = $this->userListModel;
    }

    $data = [
      'title' => 'User List | Desa Tegalreja',
      'users' => $user->paginate(10, 'users'),
      'pager' => $user->pager,
      'currentPage' => $currentPage
    ];

    return view('akun/userList/index', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Detail User | Desa Tegalreja',
      'user' => $this->userListModel->getDetail($id)
    ];
    if (empty($data['user'])) {
      return redirect()->to('/userList');
    }

    return view('akun/userList/detail', $data);
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->userListModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/userList');
  }

  public function edit($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Role User | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'user' => $this->userListModel->getDetail($id)
    ];

    return view('akun/userList/edit', $data);
  }

  public function update($id)
  {
    $id = decrypt_url($id);
    $db      = \Config\Database::connect();
    $builder = $db->table('auth_groups_users');
    $builder->set('group_id', $this->request->getVar('group_id'));
    $builder->where('user_id', $id);
    $builder->update();

    session()->setFlashdata('pesan', 'Data berhasil diupdate.');

    return redirect()->to('/userList');
  }

  public function resetPassword($id)
  {
    $id = decrypt_url($id);
    $nik = $this->userListModel->select('nik')->where('id', $id)->get()->getRow();

    $this->userListModel->save([
      'id' => $id,
      'password_hash' => Password::hash($nik->nik)
    ]);

    session()->setFlashdata('pesan', 'Password berhasil direset.');

    return redirect()->to('/userList');
  }

  public function editProfile($id)
  {
    $id = decrypt_url($id);
    $data = [
      'title' => 'Form Ubah Role User | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'user' => $this->userListModel->getDetail($id)
    ];

    return view('akun/userList/editProfile', $data);
  }

  public function updateProfile($id)
  {
    $id = decrypt_url($id);
    $userLama = $this->userListModel->getDetail($id);

    // dd($userLama);
    // cek username
    if ($userLama->username == $this->request->getVar('username')) {
      $rule_username = 'required';
    } else {
      $rule_username = 'required|is_unique[users.nik]';
    }

    // cek email
    if ($userLama->email == $this->request->getVar('email')) {
      $rule_email = 'required';
    } else {
      $rule_email = 'required|is_unique[users.email]';
    }

    // cek nik
    if ($userLama->nik == $this->request->getVar('nik')) {
      $rule_nik = 'required|min_length[16]|max_length[16]|integer';
    } else {
      $rule_nik = 'required|is_unique[users.nik]|min_length[16]|max_length[16]|integer';
    }

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
      'nik' => [
        'label' => 'Nomor Induk Kependudukan',
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
        'label' => 'Nomor Kartu Keluarga',
        'rules' => 'required|min_length[16]|max_length[16]|integer',
        'errors' => [
          'required' => '{field} harus diisi.',
          'min_length' => '{field} minimal 16 angka.',
          'max_length' => '{field} maximal 16 angka.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'no_hp' => [
        'label' => 'No Telepon',
        'rules' => 'required|integer',
        'errors' => [
          'required' => '{field} hatus diisi.',
          'integer' => '{field} harus berupa angka'
        ]
      ],
      'nama_ibu' => [
        'label' => 'Nama Ibu',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],
      'user_image' => [
        'label' => 'Foto Profile',
        'rules' => 'max_size[user_image,10240]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {
      return redirect()->to('/userList/editProfile/' . encrypt_url($id))->withInput();
    };

    $fileFotoProfile = $this->request->getFile('user_image');

    if ($fileFotoProfile->getError() == 4) {
      $namaFotoProfile = $this->request->getVar('fotoProfileLama');
    } else {
      $namaFotoProfile = $fileFotoProfile->getRandomName();
      $fileFotoProfile->move('img', $namaFotoProfile);
      if ($userLama->user_image != 'default.svg') {
        unlink('img/' . $this->request->getVar('fotoProfileLama'));
      }
    }

    $this->userListModel->save([
      'id' => $id,
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'nik' => $this->request->getVar('nik'),
      'no_kk' => $this->request->getVar('no_kk'),
      'fullname' => $this->request->getVar('fullname'),
      'no_hp' => $this->request->getVar('no_hp'),
      'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
      'nama_ibu' => $this->request->getVar('nama_ibu'),
      'user_image' => $namaFotoProfile
    ]);
    session()->setFlashdata('pesan', 'Berhasil Edit Profile.');
    return redirect()->to('/userList');
  }
}

<?php

namespace App\Controllers\Pesan;

use App\Controllers\BaseController;

use App\Models\Akun\UserListModel;

use App\Models\Pesan\PesanModel;


class Pesan extends BaseController
{
  protected $userListModel;
  protected $pesanModel;

  public function __construct()
  {
    $this->userListModel = new UserListModel();
    $this->pesanModel = new PesanModel();
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

    $count_inbox = $this->pesanModel->where('id_penerima', user()->id)
      ->where('dibaca', 0)
      ->countAllResults();

    $data = [
      'title' => 'Pesan | Desa Tegalreja',
      'users' => $user->paginate(10, 'users'),
      'count_inbox' => $count_inbox,
      'pager' => $user->pager,
      'currentPage' => $currentPage
    ];

    return view('pesan/index', $data);
  }

  public function create($id)
  {
    $id = decrypt_url($id);

    $data = [
      'title' => 'Kirim Pesan | Desa Tegalreja',
      'validation' => \Config\Services::validation(),
      'penerima' => $this->userListModel->find($id)
    ];

    // dd($data['penerima']);

    return view('pesan/create', $data);
  }

  public function save($id)
  {
    $id = decrypt_url($id);
    if (!$this->validate([
      'pesan' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ]
    ])) {
      return redirect()->to('/pesan/create/' . encrypt_url($id))->withInput();
    }

    $this->pesanModel->save([
      'id_pengirim' => user()->id,
      'id_penerima' => $id,
      'pesan' => $this->request->getVar('pesan'),
      'dibaca' => 0
    ]);

    session()->setFlashdata('pesan', 'Pesan berhasil dikirim.');

    return redirect()->to('/pesan/kotakKeluar');
  }

  public function inbox()
  {
    $pesan = $this->pesanModel
      ->select('users.fullname AS fullname, pesan.pesan AS pesan, pesan.id AS pesan_id, pesan.created_at AS tanggal')
      ->join('users', 'users.id=pesan.id_pengirim', 'left')
      ->where('id_penerima', user()->id)
      ->orderBy('pesan_id', 'desc')
      ->findAll();

    $data = [
      'title' => 'Kotak Masuk | Desa Tegalreja',
      'pesan' => $pesan
    ];

    return view('/pesan/kotakMasuk', $data);
  }

  public function outbox()
  {
    $count_inbox = $this->pesanModel->where('id_penerima', user()->id)
      ->where('dibaca', 0)
      ->countAllResults();

    $pesan = $this->pesanModel
      ->select('users.fullname AS fullname, pesan.pesan AS pesan, pesan.id AS pesan_id, pesan.created_at AS tanggal')
      ->join('users', 'users.id=pesan.id_penerima', 'left')
      ->where('id_pengirim', user()->id)
      ->orderBy('pesan_id', 'desc')
      ->findAll();

    $data = [
      'title' => 'Kotak Masuk | Desa Tegalreja',
      'pesan' => $pesan,
      'count_inbox' => $count_inbox
    ];

    return view('/pesan/kotakKeluar', $data);
  }

  public function detail($id)
  {
    $id = decrypt_url($id);
    $pesan = $this->pesanModel->find($id);

    // dd($pesan);

    if ($pesan['id_penerima'] == user()->id) {
      $pesan['dibaca'] = 1;
      $this->pesanModel->save($pesan);
    }


    $penerima = $this->userListModel->find($pesan['id_penerima']);
    $pengirim = $this->userListModel->find($pesan['id_pengirim']);

    $data = [
      'title' => 'Detail Pesan | Desa Tegalreja',
      'pesan' => $pesan,
      'penerima' => $penerima,
      'pengirim' => $pengirim
    ];

    return view('/pesan/detail', $data);
  }

  public function delete($id)
  {
    $id = decrypt_url($id);
    $this->pesanModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/pesan/kotakKeluar');
  }
}

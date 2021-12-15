<?php

namespace App\Models\Kependudukan;

use CodeIgniter\Model;

class CekDataDiriModel extends Model
{
  protected $table      = 'penduduk';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'user_id',
    'nik',
    'no_kk',
    'nama',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'rt',
    'rw',
    'nama_ayah',
    'nama_ibu'
  ];

  public function getDataDiri($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }

  public function search($keyword)
  {
    // return $this->table('penduduk')->like('nama', $keyword)->orLike('nik', $keyword);

    $builder = $this->table('penduduk');
    $builder->like('nik', $keyword);
    $builder->orLike('no_kk', $keyword);
    $builder->orLike('nama', $keyword);

    return $builder;
  }
}

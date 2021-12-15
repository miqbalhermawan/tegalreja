<?php

namespace App\Models\Kependudukan;

use CodeIgniter\Model;

class LayananModel extends Model
{
  protected $table      = 'layanan';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'user_id',
    'nik',
    'no_kk',
    'nama',
    'jenis_layanan',
    'keterangan',
    'no_hp',
    'foto_ktp',
    'foto_kk',
    'foto_lain',
    'status'
  ];

  public function getLayanan($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }

  public function search($keyword)
  {
    $builder = $this->table('layanan');
    $builder->like('nik', $keyword);
    $builder->orLike('nama', $keyword);
    $builder->orLike('jenis_layanan', $keyword);

    return $builder;
  }
}

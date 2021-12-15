<?php

namespace App\Models\Pembangunan;

use CodeIgniter\Model;

class InputSaranPembangunanModel extends Model
{
  protected $table      = 'saran_pembangunan';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'user_id',
    'nik',
    'nama',
    'saran',
    'lokasi',
    'foto_lokasi',
    'foto_diri'
  ];

  public function getSaranPembangunan($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }

  public function search($keyword)
  {
    $builder = $this->table('saran_pembangunan');
    $builder->like('nik', $keyword);
    $builder->orLike('nama', $keyword);
    $builder->orLike('saran', $keyword);

    return $builder;
  }
}

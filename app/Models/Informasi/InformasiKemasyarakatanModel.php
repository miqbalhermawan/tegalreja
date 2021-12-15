<?php

namespace App\Models\Informasi;

use CodeIgniter\Model;

class InformasiKemasyarakatanModel extends Model
{
  protected $table      = 'informasi_kemasyarakatan';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'user_id',
    'judul',
    'informasi',
    'foto_info1',
    'foto_info2',
    'foto_info3'
  ];

  public function getInformasi($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }

  public function search($keyword)
  {
    $builder = $this->table('informasi_kemasyarakatan');
    $builder->like('judul', $keyword);
    $builder->orLike('informasi', $keyword);
    return $builder;
  }
}

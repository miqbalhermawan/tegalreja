<?php

namespace App\Models\Pembangunan;

use CodeIgniter\Model;

class InventarisHasilPembangunanModel extends Model
{
  protected $table      = 'inventaris_pembangunan';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'user_id',
    'no_urut',
    'nama_pembangunan',
    'volume',
    'biaya',
    'lokasi',
    'keterangan'
  ];

  public function getInventarisPembangunan($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }

  public function search($keyword)
  {
    $builder = $this->table('inventaris_pembangunan');
    $builder->like('no_urut', $keyword);
    $builder->orLike('nama_pembangunan', $keyword);
    $builder->orLike('lokasi', $keyword);

    return $builder;
  }

  public function cekData($no_urut)
  {
    return $this->table('inventaris_pembangunan')->where('no_urut', $no_urut)->get()->getRowArray();
  }
}

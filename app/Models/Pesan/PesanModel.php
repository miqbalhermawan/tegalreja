<?php

namespace App\Models\Pesan;

use CodeIgniter\Model;

class PesanModel extends Model
{
  protected $table      = 'pesan';
  protected $useTimestamps = true;
  protected $allowedFields = [
    'id_pengirim',
    'id_penerima',
    'pesan',
    'dibaca'
  ];
}

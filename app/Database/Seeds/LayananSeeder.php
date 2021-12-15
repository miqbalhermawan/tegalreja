<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class LayananSeeder extends Seeder
{
  public function run()
  {

    $faker = \Faker\Factory::create('id_ID');
    for ($i = 0; $i < 10; $i++) {
      $data = [
        'nik' => $faker->nik,
        'no_kk' => $faker->nik,
        'nama'    => $faker->name(),
        'jenis_layanan'    => "Surat Keterangan Umum",
        'keterangan'    => $faker->paragraph(),
        'no_hp'    => $faker->phoneNumber(),
        'foto_ktp'    => 'ktp.jpg',
        'foto_kk'    => 'kk.png',
        'created_at' => Time::createFromTimestamp($faker->unixTime()),
        'updated_at' => Time::now()
      ];
      $this->db->table('layanan')->insert($data);
    }
  }
}

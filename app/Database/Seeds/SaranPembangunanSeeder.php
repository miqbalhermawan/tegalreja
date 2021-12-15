<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class SaranPembangunanSeeder extends Seeder
{
  public function run()
  {

    $faker = \Faker\Factory::create('id_ID');
    for ($i = 0; $i < 50; $i++) {
      $data = [
        'nik' => $faker->nik,
        'nama'    => $faker->name(),
        'saran'    => $faker->paragraph(),
        'lokasi'    => $faker->streetName(),
        'foto_lokasi'    => 'lokasi.jpg',
        'foto_diri'    => 'orang.png',
        'created_at' => Time::createFromTimestamp($faker->unixTime()),
        'updated_at' => Time::now()
      ];
      $this->db->table('saran_pembangunan')->insert($data);
    }
  }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class InventarisHasilPembangunanSeeder extends Seeder
{
  public function run()
  {

    $faker = \Faker\Factory::create('id_ID');
    for ($i = 0; $i < 50; $i++) {
      $data = [
        'no_urut' => $faker->randomNumber(5, false),
        'nama_pembangunan'    => 'ini isian pembangunan ...',
        'volume'    => 'ini isian volume ..',
        'biaya'    => '500000000',
        'lokasi'    => $faker->streetName(),
        'keterangan'    => $faker->paragraph(),
        'created_at' => Time::createFromTimestamp($faker->unixTime()),
        'updated_at' => Time::now()
      ];
      $this->db->table('inventaris_pembangunan')->insert($data);
    }
  }
}

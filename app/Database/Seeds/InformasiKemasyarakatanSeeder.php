<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class InformasiKemasyarakatanSeeder extends Seeder
{
  public function run()
  {

    $faker = \Faker\Factory::create('id_ID');
    for ($i = 0; $i < 50; $i++) {
      $data = [
        'user_id' => '1',
        'judul'    => $faker->words(3, true),
        'informasi'    => $faker->paragraphs(5, true),
        'foto_info1'    => 'desa.jpeg',
        'foto_info2'    => 'desa.jpeg',
        'foto_info3'    => 'desa.jpeg',
        'created_at' => Time::createFromTimestamp($faker->unixTime()),
        'updated_at' => Time::now()
      ];
      $this->db->table('informasi_kemasyarakatan')->insert($data);
    }
  }
}

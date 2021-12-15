<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class PendudukSeeder extends Seeder
{
  public function run()
  {

    $faker = \Faker\Factory::create('id_ID');
    for ($i = 0; $i < 50; $i++) {
      $data = [
        'user_id' => 1,
        'nik' => $faker->nik,
        'no_kk' => $faker->nik,
        'nama'    => $faker->name($gender = 'female'),
        'tempat_lahir'    => $faker->city,
        'tanggal_lahir'    => $faker->date(),
        'jenis_kelamin'    => 'Perempuan',
        'rt'    => $faker->randomDigitNotNull(),
        'rw'    => $faker->randomDigitNotNull(),
        'nama_ayah'    => $faker->name($gender = 'male'),
        'nama_ibu'    => $faker->name($gender = 'female'),
        'created_at' => Time::createFromTimestamp($faker->unixTime()),
        'updated_at' => Time::now()
      ];
      $this->db->table('penduduk')->insert($data);
    }
  }
}

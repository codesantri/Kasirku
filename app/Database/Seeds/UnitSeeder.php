<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $units = [
            'PCS',
            'BOX',
            'KOTAK',
            'LITER',
            'LUSIN',
            'BUAH',
            'KG',
            'BUNGKUS',
            'DUS',
            'BOTOL',
            'KARUNG',
            'KALENG'
        ];

        $faker = Factory::create('id_ID');
        foreach ($units as $unit) {
            $data = [
                'name' => $unit,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now(),
            ];
            $this->db->table('units')->insert($data);
        }
    }
}

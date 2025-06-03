<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Bahan Pokok',
            'Makanan',
            'Minuman',
            'Alat Tulis',
        ];

        $faker = Factory::create('id_ID');
        foreach ($categories as $category) {
            $data = [
                'name' => $category,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now(),
            ];
            $this->db->table('categories')->insert($data);
        }
    }
}

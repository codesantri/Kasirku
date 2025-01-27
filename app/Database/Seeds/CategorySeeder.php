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
            'Makanan Ringan',
            'Minuman',
            'Produk Kebersihan',
            'Perlengkapan Rumah Tangga',
            'Obat-obatan',
            'Peralatan Dapur',
            'Produk Bayi',
            'Bumbu Dapur',
            'Cemilan Tradisional',
            'Produk Susu',
            'Rokok dan Tembakau',
            'Es Krim dan Dessert',
            'Peralatan Tulis dan Kantor',
            'Perlengkapan Pribadi',
            'Mainan Anak',
            'Sembako',
            'Produk Musiman',
            'Perlengkapan Kendaraan',
            'Lain-lain',
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

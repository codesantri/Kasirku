<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Config\Database;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $db = Database::connect(); // Koneksi database

        // Ambil ID kategori dari database
        $categories = $db->table('categories')->select('id')->get()->getResultArray();
        $categoryIds = array_column($categories, 'id'); // Mengambil hanya ID

        $units = range(1, 12); // unit_id antara 1-12

        // Daftar nama produk yang akan di-generate
        $productNames = [
            'Beras Super',
            'Gula Pasir',
            'Minyak Goreng',
            'Mie Instan',
            'Teh Celup',
            'Teh Botol',
            'Susu Formula',
            'Air Mineral',
            'Keripik Singkong',
            'Biskuit Kaleng',
        ];

        // Menambahkan produk acak sesuai jumlah item dalam $productNames
        foreach ($productNames as $name) {
            $db->table('products')->insert([
                'name'          => $name,
                'code'          => strtoupper($faker->bothify('??###')),
                'category_id'   => $faker->randomElement($categoryIds),
                'unit_id'       => $faker->randomElement($units),
                'capital_price' => $faker->numberBetween(5000, 50000),
                'sell_price'    => $faker->numberBetween(7000, 70000),
                'stock'         => $faker->numberBetween(10, 100),
                'image'         => null,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}

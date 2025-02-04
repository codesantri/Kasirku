<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $categories = range(1, 20);  // category_id antara 1-20
        $units = range(1, 12);       // unit_id antara 1-12

        // Menyediakan beberapa nama produk acak
        $productNames = [
            'Beras Super',
            'Gula Pasir',
            'Minyak Goreng',
            'Susu Cair',
            'Sabun Cuci Piring',
            'Keripik Singkong',
            'Mie Instan',
            'Teh Celup',
            'Sikat Gigi',
            'Pasta Gigi',
            'Panci Stainless',
            'Kain Lap Dapur',
            'Tisu Toilet',
            'Permen Karet',
            'Susu Formula',
            'Kecap Manis',
            'Saus Tomat',
            'Coklat Batangan',
            'Paket Sekolah',
            'Pelampung Renang',
            'Bantal Tidur',
            'Botol Minum',
            'Tempat Sampah',
            'Sapu Lantai',
            'Gunting Kain',
            'Kipas Angin',
            'Speaker Portable',
            'Piring Plastik',
            'Kursi Lipat',
            'Meja Makan',
            'Lampu LED',
            'Gelas Plastik',
            'Senter Tangan',
            'Peta Dunia',
            'Tas Belanja',
            'Alat Tulis Kantor',
            'Pensil Warna',
            'Pulpen Hitam',
            'Kertas Foto',
            'Kertas HVS',
            'Tisu Wajah',
            'Shampoo',
            'Sabun Mandi',
            'Pembersih Lantai',
            'Cairan Pencuci Piring',
            'Pembersih Wajah',
            'Deodoran',
            'Penjepit Rambut',
            'Tepung Terigu',
            'Roti Tawar',
            'Selai Kacang',
            'Pepsodent',
            'Colgate',
            'Detergen',
            'Bubuk Kopi',
            'Teh Botol',
            'Coklat Bubuk',
            'Air Mineral',
            'Susu Sapi',
            'Kopi Susu',
            'Peralatan Dapur',
            'Panci Anti Lengket'
        ];

        // Menambahkan 100 data produk acak
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name'          => $faker->randomElement($productNames),
                'code'          => strtoupper($faker->bothify('??###')),
                'category_id'   => $faker->randomElement($categories),
                'unit_id'       => $faker->randomElement($units),
                'capital_price' => $faker->numberBetween(5000, 50000),
                'sell_price'    => $faker->numberBetween(7000, 70000),
                'stock'         => $faker->numberBetween(10, 100),
                'image'         => null,
                'created_at'    => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),  // konversi DateTime ke string
                'updated_at'    => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),  // konversi DateTime ke string
            ];
            // Menyimpan data produk ke tabel
            $this->db->table('products')->insert($data);
        }
    }
}

<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menginisialisasi Faker untuk menghasilkan data dummy
        $faker = Factory::create();
        $this->db->table('users')->insert([
            'name'      => 'Murtaki',
            'email'     => 'murtaki@example.com',  // Ganti dengan email yang sesuai
            'password'  => password_hash('adminpassword', PASSWORD_DEFAULT), // Password terenkripsi
            'role'      => 'admin', // Role admin
            'avatar'    => null, // Gambar avatar
            'created_at' => Time::now(), // Waktu pembuatan sekarang
            'updated_at' => Time::now(), // Waktu pembaruan sekarang
        ]);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [
            'nama' => 'darth',
            'harga'    => 'darth@theempire.com',
            'stok'    => 'darth@theempire.com',
            'gambar'    => $faker->image('./uploadsSeeder', 720, 720, 'animals', true, true, 'cats', true),
            'created_by'    => 0,
            'created_date'    => date('Y-m-d H:i:s'),
        ];

        $this->db->table('barang')->insert($data);
    }
}

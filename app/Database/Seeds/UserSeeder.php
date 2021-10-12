<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 100; $i++) {

            $data = [
                'username' => $faker->userName(),
                'password' => $faker->password(),
                'salt' => $faker->password(),
                'avatar' => NULL,
                'role' => 1,
                'created_by' => 0,
                'created_date' => date("Y-m-d H:i:s")
            ];

            $this->db->table('user')->insert($data);
        }
    }
}

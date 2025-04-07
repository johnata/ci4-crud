<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

/**
 * Database seeder for generating fake user data.
 */
class FakeUserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];
        // generate 100 users for testing
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_id' => $faker->randomElement([1, 2]), // Assuming 1 is active and 2 is inactive
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        // Insere os usuários na tabela "users"
        $this->db->table('users')->insertBatch($data);
    }
}

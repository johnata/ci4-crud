<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'  => 'Admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'name'  => 'Usuário Teste',
                'email' => 'user@example.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
            ]
        ];

        // Insere os dados na tabela "users"
        $this->db->table('users')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user' => 'CSTMR-0002',
                'username' => 'Albar Rudin 02',
                'password' => password_hash('customerpass2', PASSWORD_DEFAULT),
                'email' => 'albar@customer.com',
                'full_name' => 'AlbarUdin',
                'phone_number' => '085201456432',
                'role' => 'customer',
                'address' => 'Jl. Patriot 1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_user' => 'SELL-0001',
                'username' => 'Al-muchalif',
                'password' => password_hash('seller123', PASSWORD_DEFAULT),
                'email' => 'Al-Muchalif@seller.com',
                'full_name' => 'AL - Muchalif',
                'phone_number' => '08524354652432',
                'role' => 'Seller',
                'address' => 'Jl. Binagriya 1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Using Query Builder to insert data
        $this->db->table('users')->insertBatch($data);
    }

}

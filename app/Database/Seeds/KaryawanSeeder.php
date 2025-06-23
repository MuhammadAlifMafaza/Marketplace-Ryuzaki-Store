<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_karyawan' => 'ADMN-0001',
                'username' => 'adminAlif',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'email' => 'alif@admin.com',
                'phone_number' => '085201465428',
                'full_name' => 'Alif Mafaza',
                'jabatan' => 'admin',
                'department' => 'Administrasi, Customer Service, Operasional',
                'alamat' => 'Jl. Hj. Sukoharjo No.42',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_karyawan' => 'OWNR-0001',
                'username' => 'ownerAlif',
                'password' => password_hash('owner123', PASSWORD_DEFAULT),
                'email' => 'alif@owner.com',
                'phone_number' => '085201122228',
                'full_name' => 'Alif Mafaza',
                'jabatan' => 'owner',
                'department' => 'Direksi, Keuangan, Business Development, Marketing & Branding, Legal & Perizinan',
                'alamat' => 'Jl. Surakarta No.22',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_karyawan' => 'KURI-0001',
                'username' => 'kurirAlif',
                'password' => password_hash('kurir123', PASSWORD_DEFAULT),
                'email' => 'alif@kurir.com',
                'phone_number' => '080341231234',
                'full_name' => 'Alif Mafaza',
                'jabatan' => 'kurir',
                'department' => 'Logistik, Gudang, Operasional Lapangan, Keamanan dan Prosedur',
                'alamat' => 'Jl. Jendral Sudirman No.34',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Insert data into 'karyawan' table
        $this->db->table('karyawan')->insertBatch($data);
    }
}

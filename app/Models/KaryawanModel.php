<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $allowedFields = [
        'id_karyawan', 'username', 'password', 'email', 'phone_number', 'full_name', 
        'img_profile', 'jabatan', 'department', 'alamat', 'created_at', 'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

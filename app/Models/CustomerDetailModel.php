<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerDetailModel extends Model
{
    protected $table            = 'customer_detail';
    protected $primaryKey       = 'id_customer';
    protected $useAutoIncrement = False;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = False;
    protected $allowedFields    = ['id_customer', 'membership_level', 'total_spent'];
    protected $useTimestamps    = True;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $allowedFields = ['id_order', 'id_customer', 'order_date', 'total_amount', 'status', 'notes', 'updated_at'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

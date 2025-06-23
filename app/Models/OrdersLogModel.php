<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersLogModel extends Model
{
    protected $table = 'order_logs';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_order', 'status', 'changed_by', 'changed_at', 'note'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentsModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id_payment';
    protected $allowedFields    = ['id_payment', 'id_order', 'method', 'channel', 'payment_api_id', 'amount', 'status', 'payment_date', 'callback_data'];

    // Dates
    protected $useTimestamps    = True;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingsModel extends Model
{
    protected $table = 'shippings';
    protected $primaryKey = 'id_shipping';
    protected $allowedFields = ['id_shipping', 'id_order', 'courier_id', 'shipping_date', 'delivered_date', 'status', 'note', 'proof_delivery'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

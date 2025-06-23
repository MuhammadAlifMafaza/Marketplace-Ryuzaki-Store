<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersItemsModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id_order_item';
    protected $allowedFields = ['id_order_item', 'id_order', 'id_product', 'quantity', 'price_per_unit'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

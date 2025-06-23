<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSubCategoriesModel extends Model
{
    protected $table            = 'product_sub_categories';
    protected $primaryKey       = '';
    protected $allowedFields    = ['id_product', 'id_sub_category'];

    // Dates
    protected $useTimestamps    = True;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}

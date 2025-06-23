<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductReviewModel extends Model
{
    protected $table            = 'product_reviews';
    protected $primaryKey       = 'id_review';
    protected $allowedFields    = ['id_review', 'id_order', 'id_customer', 'id_product', 'rating', 'review_text', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps    = True;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}

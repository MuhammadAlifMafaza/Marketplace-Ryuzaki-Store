<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCategoriesModel extends Model
{
    protected $table = 'sub_categories';
    protected $primaryKey = 'id_sub_category';
    protected $allowedFields = ['id_sub_category', 'id_master_category', 'name_sub_category', 'type'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

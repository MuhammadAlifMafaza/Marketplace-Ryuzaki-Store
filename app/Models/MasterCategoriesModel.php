<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterCategoriesModel extends Model
{
    protected $table = 'master_categories';
    protected $primaryKey = 'id_master_category';
    protected $allowedFields = ['id_master_category', 'name_category', 'description'];

    // Dates
    protected $useTimestamps = True;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

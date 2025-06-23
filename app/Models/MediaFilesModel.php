<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaFilesModel extends Model
{
    protected $table            = 'media_files';
    protected $primaryKey       = 'id_media';
    protected $useAutoIncrement = True;
    protected $allowedFields    = [
        'id_media', 'source_type', 'source_id', 'file_name', 
        'file_path', 'file_type', 'uploaded_at'
    ];

    // Dates
    protected $useTimestamps    = True;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}

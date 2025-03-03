<?php

namespace App\Models;

use CodeIgniter\Model;

class TriviaModel extends Model
{
    protected $table = 'trivia';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'description',
        'difficulty',
        'created_by',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
}

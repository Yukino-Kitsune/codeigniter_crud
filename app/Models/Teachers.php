<?php

namespace App\Models;

class Teachers extends \CodeIgniter\Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'surname'];
}
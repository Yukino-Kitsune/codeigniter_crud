<?php

namespace App\Models;

use CodeIgniter\Model;

class Groups extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['group_name'];
}
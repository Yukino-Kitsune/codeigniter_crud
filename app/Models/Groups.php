<?php

namespace App\Models;

use CodeIgniter\Model;

class Groups extends Model
{
    public static function getAll()
    {
        $db = db_connect();
        $query = 'select * from `groups`;';
        $result = $db->query($query);
        return $result->getResult('array');
    }
}
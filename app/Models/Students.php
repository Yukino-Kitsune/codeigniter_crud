<?php

namespace App\Models;

use CodeIgniter\Model;

class Students extends Model
{
    # TODO Пока не понятно, зачем нужны эти поля. Вроде как они используются при работе с бд по-другому.
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'surname', 'group_id'];

    public static function getAll()
    {
        $obj = new Students();
        return $obj->select('id, name, surname, group_name, students.group_id')
            ->join('groups', 'students.group_id = `groups`.group_id')->findAll();
    }
}
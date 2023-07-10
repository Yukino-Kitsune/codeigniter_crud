<?php

namespace App\Models;

class Subjects extends \CodeIgniter\Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['subject_name', 'teacher_id'];

    public function getAll()
    {
        $obj = new Subjects();
        return $obj->select('subjects.id, subject_name, name, surname, teacher_id')
            ->join('teachers', 'teachers.id = subjects.teacher_id')->findAll();
    }
}
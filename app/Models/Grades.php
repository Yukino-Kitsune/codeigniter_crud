<?php

namespace App\Models;

class Grades extends \CodeIgniter\Model
{
    protected $table = 'grades';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['grade', 'subject_id', 'student_id'];
}
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



    public static function getAll(){
        $obj = new Students();
        return $obj->select('id, name, surname, group_name, students.group_id')
                        ->join('groups', 'students.group_id = `groups`.group_id')->findAll();
    }

    public static function getOne($id){
        $obj = new Students();
        return $obj->find($id);
    }

    public static function insertOne($data){
        $obj = new Students();
        $obj->insert($data);
        return $obj;
    }

    public static function updateOne($data){
        $obj = new Students();
        $obj->update($data['id'], array_slice($data, 1)); # TODO переделать
        return $obj;
    }

    public static function deleteOne($id){
        $obj = new Students();
        $obj->delete($id);
        return $obj;
    }
}
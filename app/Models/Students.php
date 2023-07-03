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
        $db = db_connect();
//        $query = 'select id, name, surname, group_name from `students` join `groups` on students.group_id = `groups`.group_id;';
        $query = 'select id, name, surname, group_name, students.group_id from students join `groups`
                    on students.group_id = `groups`.group_id;';
        $result = $db->query($query);
        return $result->getResult('array');
    }

    public static function getOne($id){
        $db = db_connect();
        $query = sprintf('select id, name, surname, group_name, students.group_id from students join `groups`
                    on students.group_id = `groups`.group_id where id = %d', $id);
        $result = $db->query($query);
        return $result->getRowArray();
    }

    public static function insertOne($data){ # INFO insertOne потому что insert уже определен в BaseModel и я не могу его переопределить
        $db = db_connect();
        $query = sprintf('insert into `students` (name, surname, group_id) values("%s", "%s", "%d");',
                            $data['name'], $data['surname'], $data['group_id']);
        $result = $db->query($query);
        if($result == false) return false;
        return true;
    }

    public static function updateOne($data){ # INFO То же самое, что и с insertOne
        $db = db_connect();
        $query = sprintf('update `students` set name = "%s", surname = "%s", group_id = %d where id = %d;', $data['name'], $data['surname'], $data['group_id'], $data['id']);
        $result = $db->query($query);
        if($result == false) return false;
        return true;
    }

    public static function deleteOne($id){ # INFO То же самое
        $db = db_connect();
        $query = sprintf('DELETE FROM `students` WHERE id = %d;', $id);
        $result = $db->query($query);
        if($result == false) return false;
        return true;
    }
}
<?php

namespace App\Controllers;

use App\Models\Groups;
use App\Models\Students;
use CodeIgniter\Controller;

class StudentsController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Студенты';
        $data['content'] = 'students/index';
        $data['data'] = Students::getAll();
        $data['session'] = $this->session;
        $data['isAdmin'] = $this->session->get('isAdmin'); # TODO Может быть в какой-то момент в сессии не будет этого поля, возможно нужна проверка
        return view('includes/template', $data);
    }

    public function create()
    {
        $data['title'] = 'Создание студента';
        $data['content'] = 'students/create';
        $data['data'] = Groups::getAll();
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $data['group_id'] =$this->request->getPost('group_id');
        $obj = new Students();
        $result = $obj->insert($data); # TODO Проверить, что будет, если неудача
//        if (!$result) {
//            $this->session->set(['msg' => 'fail']);
//        }
        return $this->response->redirect(site_url('/students'));
    }

    public function edit(int $id)
    {
        $obj = new Students();
        $data['data'] = $obj->find($id);
        if ($data['data'] == null)
        {
            $this->session->set([
                'msg' => 'Ошибка! Студент не найден',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/students'));
        }
        $data['title'] = 'Изменение студента';
        $data['content'] = 'students/edit';
        $data['groups'] = Groups::getAll();
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $data['group_id'] = $this->request->getPost('group_id');
        $obj = new Students();
        $result = $obj->update($id, $data);
//        if (!$result) {
//            $this->session->set(['msg' => 'fail']);
//        }
        return $this->response->redirect(site_url('/students'));
    }

    public function delete(int $id)
    {
        $obj = new Students();
        $result = $obj->delete($id);
//        if (!$result) {
//            $this->session->set(['msg' => 'fail']);
//        }
        return $this->response->redirect(site_url('/students'));
    }
}
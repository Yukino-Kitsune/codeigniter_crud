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
        return view('includes/template', $data);
    }

    public function create()
    {
        $data['title'] = 'Создание студента';
        $data['content'] = 'students/create';
        $data['data'] = Groups::getAll();
        return view('includes/template', $data);
    }

    public function store()
    {
        $data['name'] = $_POST['name'];
        $data['surname'] = $_POST['surname'];
        $data['group_id'] = $_POST['group_id'];
        # TODO Сделать проверку входных данных
        $obj = new Students();
        $result = $obj->insert($data); # TODO Проверить, что будет, если неудача
        if ($result) {
            $this->session->set(['msg' => 'success']);
        } else {
            $this->session->set(['msg' => 'fail']);
        }
        return $this->response->redirect(site_url('/students'));
    }

    public function edit($id)
    {
        $data['title'] = 'Изменение студента';
        $data['content'] = 'students/edit';
        $obj = new Students();
        $data['data'] = $obj->find($id);
        $data['groups'] = Groups::getAll();
        return view('includes/template', $data);
    }

    public function update()
    {
        $data['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['surname'] = $_POST['surname'];
        $data['group_id'] = $_POST['group_id'];
        # TODO Сделать проверку входных данных
        $obj = new Students();
        $result = $obj->update($data['id'], array_slice($data, 1)); # TODO переделать
        if ($result) {
            $this->session->set(['msg' => 'success']);
        } else {
            $this->session->set(['msg' => 'fail']);
        }
        return $this->response->redirect(site_url('/students'));
    }

    public function delete($id)
    {
        $obj = new Students();
        $result = $obj->delete($id);
        if ($result) {
            $this->session->set(['msg' => 'success']);
        } else {
            $this->session->set(['msg' => 'fail']);
        }
        return $this->response->redirect(site_url('/students'));
    }
}
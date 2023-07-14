<?php

namespace App\Controllers;

use App\Models\Groups;
use App\Models\Students;
use CodeIgniter\Database\Exceptions\DatabaseException;

class StudentsController extends BaseController
{

    public function index()
    {
        $data['title'] = 'Студенты';
        $data['content'] = 'students/index';
        $data['data'] = Students::getAll();
        $data['session'] = $this->session;
        $data['isAdmin'] = $this->session->get('isAdmin');
        return view('includes/template', $data);
    }

    public function create()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/students');
        }
        $data['title'] = 'Создание студента';
        $data['content'] = 'students/create';
        $data['data'] = (new Groups())->findAll();
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/students');
        }
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $data['group_id'] = $this->request->getPost('group_id');
        $obj = new Students();
        try {
            $obj->insert($data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка!' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/students'));
        }
        return $this->response->redirect(site_url('/students'));
    }

    public function edit(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/students');
        }
        $obj = new Students();
        $data['data'] = $obj->find($id);
        if ($data['data'] == null) {
            $this->session->set([
                'msg' => 'Ошибка! Студент не найден',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/students'));
        }
        $data['title'] = 'Изменение студента';
        $data['content'] = 'students/edit';
        $data['groups'] = (new Groups())->findAll();
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function update()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/students');
        }
        $id = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $data['group_id'] = $this->request->getPost('group_id');
        $obj = new Students();
        try {
            $obj->update($id, $data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка!' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/students'));
        }
        return $this->response->redirect(site_url('/students'));
    }

    public function delete(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/students');
        }
        $obj = new Students();
        $obj->delete($id);
        return $this->response->redirect(site_url('/students'));
    }
}
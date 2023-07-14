<?php

namespace App\Controllers;

use App\Models\Teachers;
use CodeIgniter\Database\Exceptions\DatabaseException;

class TeachersController extends BaseController
{
    public function index()
    {
        $obj = new Teachers();
        $data['title'] = 'Преподаватели';
        $data['content'] = 'teachers/index';
        $data['data'] = $obj->findAll();
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data['data']);
        }
        $data['session'] = $this->session;
        $data['isAdmin'] = $this->session->get('isAdmin');
        return view('includes/template', $data);
    }

    public function create()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/teachers');
        }
        $data['title'] = 'Преподаватели';
        $data['content'] = 'teachers/create';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/teachers');
        }
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $obj = new Teachers();
        try {
            $obj->insert($data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка!' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/students'));
        }
        return $this->response->redirect(site_url('/teachers'));
    }

    public function edit(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/teachers');
        }
        $obj = new Teachers();
        $data['data'] = $obj->find($id);
        if ($data['data'] == null) {
            $this->session->set([
                'msg' => 'Ошибка! Преподаватель не найден',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/teachers'));
        }
        $data['title'] = 'Изменение преподавателя';
        $data['content'] = 'teachers/edit';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function update()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/teachers');
        }
        $id = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $obj = new Teachers();
        try {
            $obj->update($id, $data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка!' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/teachers'));
        }
        return $this->response->redirect(site_url('/teachers'));
    }

    public function delete(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/teachers');
        }
        $obj = new Teachers();
        $obj->delete($id);
        return $this->response->redirect(site_url('/teachers'));
    }


}
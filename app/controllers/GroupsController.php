<?php

namespace App\Controllers;

use App\Models\Groups;
use CodeIgniter\Database\Exceptions\DatabaseException;

class GroupsController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Группы';
        $data['content'] = 'groups/index';
        $data['data'] = (new Groups())->findAll();
        $data['session'] = $this->session;
        $data['isAdmin'] = $this->session->get('isAdmin');
        return view('includes/template', $data);
    }

    public function create()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/groups');
        }
        $data['title'] = 'Создание группы';
        $data['content'] = 'groups/create';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/groups');
        }
        $data['group_name'] = $this->request->getPost('group_name');
        try {
            (new Groups())->insert($data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/groups'));
        }
        return $this->response->redirect(site_url('/groups'));
    }

    public function edit(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/groups');
        }
        $data['data'] = (new Groups())->find($id);
        if ($data['data'] == null) {
            $this->session->set([
                'msg' => 'Ошибка! Группа не найдена',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/groups'));
        }
        $data['title'] = 'Изменение группы';
        $data['content'] = 'groups/edit';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function update()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/groups');
        }
        $id = $this->request->getPost('id');
        $data['group_name'] = $this->request->getPost('group_name');
        try {
            (new Groups())->update($id, $data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка! ' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/groups'));
        }
        return $this->response->redirect(site_url('groups'));
    }

    public function delete($id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/groups');
        }
        (new Groups())->delete($id);
        return $this->response->redirect(site_url('/groups'));
    }
}
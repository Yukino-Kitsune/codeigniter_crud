<?php

namespace App\Controllers;

use App\Models\Teachers;

class TeachersController extends BaseController
{
    public function index()
    {
        $obj = new Teachers();
        $data['title'] = 'Преподаватели';
        $data['content'] = 'teachers/index';
        $data['data'] = $obj->findAll();
        $data['session'] = $this->session;
        $data['isAdmin'] = $this->session->get('isAdmin');
        return view('includes/template', $data);
    }

    public function create()
    {
        $data['title'] = 'Преподаватели';
        $data['content'] = 'teachers/create';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $obj = new Teachers();
        $result = $obj->insert($data);
//        if (!$result) {
//            $this->session->set(['msg' => 'fail']);
//        }
        return $this->response->redirect(site_url('/teachers'));
    }

    public function edit(int $id)
    {
        $obj = new Teachers();
        $data['data'] = $obj->find($id);
        if ($data['data'] == null)
        {
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
        $id = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('name');
        $data['surname'] = $this->request->getPost('surname');
        $obj = new Teachers();
        $result = $obj->update($id, $data);
//        if (!$result) {
//            $this->session->set(['msg' => 'fail']);
//        }
        return $this->response->redirect(site_url('/teachers'));
    }

    public function delete(int $id)
    {
        $obj = new Teachers();
        $result = $obj->delete($id);
//        if (!$result) {
//            $this->session->set(['msg' => 'fail']);
//        }
        return $this->response->redirect(site_url('/teachers'));
    }


}
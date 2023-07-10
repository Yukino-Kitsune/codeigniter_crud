<?php

namespace App\Controllers;

use App\Models\Subjects;

class SubjectsController extends BaseController
{
    public function index()
    {
        if($this->request->isAJAX())
        {
            $obj = new Subjects();
            $subjects = $obj->getAll();
            $data['data'] = $subjects;
            $data['isAdmin'] = $this->session->get('isAdmin');
            return $this->response->setJSON($data);
        } else
        {
            $data['title'] = 'Дисциплины';
            $data['content'] = 'subjects/index';
            $data['session'] = $this->session;
            $data['isAdmin'] = $this->session->get('isAdmin');
            return view('includes/template', $data);
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data['name'] = $this->request->getPost('subject_name');
        $data['surname'] = $this->request->getPost('surname');
        $data['group_id'] = $this->request->getPost('group_id');
        $kek = json_decode($this->request->getBody(), true);

        $obj = new Students();
        try {
            $obj->update($id, $data);
        } catch (DatabaseException $e)
        {
            $this->session->set([
                'msg' => 'Ошибка!'.$e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/students'));
        }
        return $this->response->redirect(site_url('/students'));
    }

}
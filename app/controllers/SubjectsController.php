<?php

namespace App\Controllers;

use App\Models\Subjects;
use CodeIgniter\Database\Exceptions\DatabaseException;

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

    public function store()
    {
        if($this->session->has('isAdmin') && $this->session->get('isAdmin') == 0) {
            return; # TODO CHECK
        }
        $data['subject_name'] = $this->request->getPost('subject_name');
        $data['teacher_id'] = $this->request->getPost('teacher_id');
        $obj = new Subjects();
        try {
            $id = $obj->insert($data);
        } catch (DatabaseException $e)
        {
            $result['msg'] = $e->getMessage();
            return $this->response->setJSON($data);
        }
        $result['msg'] = 'success';
        $result['id'] = $id;
        return $this->response->setJSON($result);
    }

    public function update()
    {
        if($this->session->has('isAdmin') && $this->session->get('isAdmin') == 0) {
            return; # TODO CHECK
        }
        $id = $this->request->getPost('id');
        $data['subject_name'] = $this->request->getPost('subject_name');
        $data['teacher_id'] = $this->request->getPost('teacher_id');

        $obj = new Subjects();
        try {
            $obj->update($id, $data);
        } catch (DatabaseException $e)
        {
            $result['msg'] = $e->getMessage();
            return $this->response->setJSON($data);
        }
        $result['msg'] = 'success';
        return $this->response->setJSON($result);
    }

    public function delete(int $id)
    {
        if($this->session->has('isAdmin') && $this->session->get('isAdmin') == 0) {
            return; # TODO CHECK
        }
        $obj = new Subjects();
        $obj->delete($id); # INFO Интересно, что бд не вызывает исключение если удалять несуществующий id
        $result['msg'] = 'success';
        return $this->response->setJSON($result);
    }

}
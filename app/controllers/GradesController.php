<?php

namespace App\Controllers;

use App\Models\Grades;
use App\Models\Students;
use App\Models\Subjects;
use CodeIgniter\Database\Exceptions\DatabaseException;

class GradesController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Оценки';
        $data['content'] = 'grades/index';
        $data['data'] = (new Grades())
            ->select('grades.id, grade, subjects.subject_name, students.name, students.surname')
            ->join('students', 'grades.student_id = students.id')
            ->join('subjects', 'grades.subject_id = subjects.id')
            ->findAll();
        $data['session'] = $this->session;
        $data['isAdmin'] = $this->session->get('isAdmin');
        return view('includes/template', $data);
    }

    public function create()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/grades');
        }
        $data['title'] = 'Создание оценки';
        $data['content'] = 'grades/create';
        $data['subjects'] = (new Subjects())->findAll();
        $data['students'] = (new Students())->findAll();
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/grades');
        }
        $data['grade'] = $this->request->getPost('grade');
        $data['subject_id'] = $this->request->getPost('subject_id');
        $data['student_id'] = $this->request->getPost('student_id');
        try {
            (new Grades())->insert($data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка!' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/grades'));
        }
        return $this->response->redirect(site_url('/grades'));
    }

    public function edit(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/grades');
        }
        $data['data'] = (new Grades())->find($id);
        if ($data['data'] == null) {
            $this->session->set([
                'msg' => 'Ошибка! Оценка не найден',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/grades'));
        }
        $data['title'] = 'Изменение оценки';
        $data['content'] = 'grades/edit';
        $data['subjects'] = (new Subjects())->findAll();
        $data['students'] = (new Students())->findAll();
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function update()
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/grades');
        }
        $id = $this->request->getPost('id');
        $data['subject_id'] = $this->request->getPost('subject_id');
        $data['student_id'] = $this->request->getPost('student_id');
        try {
            (new Grades())->update($id, $data);
        } catch (DatabaseException $e) {
            $this->session->set([
                'msg' => 'Ошибка!' . $e->getMessage(),
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/grades'));
        }
        return $this->response->redirect(site_url('/grades'));
    }

    public function delete(int $id)
    {
        if (!$this->session->get('isAdmin')) {
            return $this->response->redirect('/grades');
        }
        (new Grades())->delete($id);
        return $this->response->redirect(site_url('/grades'));
    }
}
<?php

namespace App\Controllers;
use App\Models\Groups;
use App\Models\Students;
use CodeIgniter\Controller;

class StudentsController extends BaseController
{
    public function index(){
        $data['title'] = 'Студенты';
        $data['content'] = 'students/index';
        $data['data'] = Students::getAll();
        return view('includes/template', $data);
    }

    public function create(){
        $data['title'] = 'Создание студента';
        $data['content'] = 'students/create';
        $data['data'] = Groups::getAll();
        return view('includes/template', $data);
    }

    public function store(){
        $data['name'] = $_POST['name'];
        $data['surname'] = $_POST['surname'];
        $data['group_id'] = $_POST['group_id'];
        # TODO Сделать проверку входных данных
        $result = Students::insertOne($data);
        if($result) {$this->session->set(['msg'=>'success']);}
        else {$this->session->set(['msg'=>'fail']);}
        return $this->response->redirect(site_url('/students'));
    }

    public function edit($id){
        $data['title'] = 'Изменение студента';
        $data['content'] = 'students/edit';
        $data['data'] = Students::getOne($id);
        $data['groups'] = Groups::getAll();
        return view('includes/template', $data);
    }

    public function update(){
        $data['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['surname'] = $_POST['surname'];
        $data['group_id'] = $_POST['group_id'];
        # TODO Сделать проверку входных данных
        $result = Students::updateOne($data);
        if($result) {$this->session->set(['msg'=>'success']);}
        else {$this->session->set(['msg'=>'fail']);}
        return $this->response->redirect(site_url('/students'));
    }

    public function delete($id){
        $result = Students::deleteOne($id);
        if($result) {$this->session->set(['msg'=>'success']);}
        else {$this->session->set(['msg'=>'fail']);}
        return $this->response->redirect(site_url('/students'));
    }
}
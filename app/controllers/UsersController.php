<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Авторизация';
        $data['content'] = 'users/auth';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function login()
    {
        $obj = new Users();
        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $result = $obj->where('username', $login)->first();
        if($result == null)
        {
            $this->session->set([
                'msg' => 'Ошибка! Пользователь не найден',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/'));
        }
        if(password_verify($password, $result['password']))
        {
            $this->session->set([
                'msg' => 'Ошибка! Неверный пароль',
                'msg_type' => 'alert-danger'
            ]);
            return $this->response->redirect(site_url('/'));
        }
        $this->session->set([
            'username' => $result['username'],
            'isAdmin' => $result['isAdmin'],
        ]);
        return $this->response->redirect(site_url('/students'));
    }

    public function logout()
    {
        $this->session->remove('username');
        $this->session->remove('isAdmin');
        return $this->response->redirect(site_url('/'));
    }

    public function reg()
    {
        $data['title'] = 'Авторизация';
        $data['content'] = 'users/reg';
        $data['session'] = $this->session;
        return view('includes/template', $data);
    }

    public function store()
    {
        $obj = new Users();
        $data['username'] = $this->request->getPost('login');
        $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $adminPassword = $this->request->getPost('admin_password');
        $data['isAdmin'] = $adminPassword == getenv('adminPassword') ? 1 : 0;
        # TODO не очень нравится условие. Пока не знаю как по-другому проверить.
        if(strlen($adminPassword) > 0 && $data['isAdmin'])
        {
            $this->session->set([
                'msg' => 'Ошибка! Неверный пароль администратора',
                'msg_type' => 'alert-danger'
            ]);
        }
        $result = $obj->insert($data);
        print $result;
        return $this->response->redirect(site_url('/'));
    }
}
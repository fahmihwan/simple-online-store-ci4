<?php

namespace App\Controllers;


class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->UserModel =  new \App\Models\UserModel();
    }

    public function register()
    {
        if ($this->request->getvar()) {
            $this->validation->run($this->request->getVar(), 'register');
            $errors = $this->validation->getErrors();

            // jika tidak ada error jalankan
            if (!$this->validation->getErrors()) {
                $userEntities = new \App\Entities\UserEntities();
                $userEntities->setPassword($this->request->getVar('password'));
                $userEntities->username = $this->request->getVar('username');
                $userEntities->created_by = 0;
                $userEntities->created_date = date('Y-m-d H:i:s');
                $this->UserModel->save($userEntities);
                return view('login');
            }

            $this->session->setFlashdata('errors', $errors);
        }

        return view('register');
    }

    public function login()
    {
        if ($this->request->getVar()) {
            $this->validation->run($this->request->getVar(), 'login');

            $username = $this->request->getVar('username');

            if ($user = $this->UserModel->where('username', $username)->first()) {
                if ($user->password === md5($user->salt . $this->request->getVar('password'))) {

                    $this->session->set([
                        'username' => $user->username,
                        'id' => $user->id,
                        'isLoggedIn' => TRUE,
                        'role' => $user->role,
                    ]);
                    return redirect()->to('home/index');
                } else {
                    $this->session->setFlashdata('errors', ['Password Salah']);
                }
            } else {
                $this->session->setFlashdata('errors', ['Anda belum terdaftar']);
            }
            return view('login');
        }
        return view('login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('auth/login'));
    }
}

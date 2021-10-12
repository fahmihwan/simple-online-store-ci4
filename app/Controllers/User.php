<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'users' => $this->UserModel->paginate(10),
            'pager' => $this->UserModel->pager,
        ];

        return view('user/index', [
            'data' => $data,
        ]);
    }
}

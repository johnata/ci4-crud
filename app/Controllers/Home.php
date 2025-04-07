<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home',
            'description' => 'Welcome to CodeIgniter 4 CRUD application.',
        ];
        return view('welcome_message', $data);
    }
}

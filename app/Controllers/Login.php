<?php
namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if ($this->request->getMethod() == "post")
        {            
            $user = $this->request->getVar('user');
            $password = $this->request->getVar('password');

            $result     = $this->userModel->login($user, md5(md5($password)));
            if($result)
            {
                $this->session->set($result);
                // return redirect()->route('home/');
                return redirect()->to(site_url("user"));
            }
            else
            {
                $this->session->setFlashdata("msg", "Wrong Password");
                // return redirect()->route('login');
                return redirect()->to(site_url("login"));
            }
        } else {
            echo view("login");
        }
    }
 
    public function logout()
    {
        $this->session->destroy();
        // return redirect()->to('/login');
        return redirect()->to(site_url("login"));
    }
}

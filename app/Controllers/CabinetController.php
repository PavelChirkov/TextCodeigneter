<?php

namespace App\Controllers;


use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class LoginController extends ResourceController
{

    private $user;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->user = new User;     
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('users/login');
    }

    public function log_on()
    {
        $login = $this->request->getVar('login');

        $password = md5($this->request->getVar('password'));

        $tUser = $this->user->where('login', $login)->first();
        
        print_r($tUser);
        print_r($password);

        if ($password == $tUser['password']){
            echo "Password matches.";
        }
        else {
            echo "Password incorrect.";
        }
    }
}

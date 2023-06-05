<?php

namespace App\Controllers;


use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class CabinetController extends ResourceController
{

    private $session;
    private $user;
    private $id;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $id = $this->session->get("user_id");
        $this->id = $id;
        $user = new User; 
        $this->user = $user->where('id', $id)->first();  
        /*print_r($id);  
        print_r($this->session->get());*/
        if($id != "0"){
            return redirect()->to(site_url('login'));
            exit();
        }
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        /*print_r("cabinet");
        print_r($this->user);
       /* print_r($this->session->get());
        return view('cabinet/index');*/
    }
    public function logout(){

    }
}

<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\Note; 
use CodeIgniter\RESTful\ResourceController;

class CabinetController extends ResourceController
{

    private $session, $user, $id;

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
        return view('cabinet/index',array('user' => $this->user));
        /*print_r("cabinet");
        
       /* print_r($this->session->get());
        return view('cabinet/index');*/
    }
    public function noteAdd(int $id=0){ 
        return view('cabinet/note/add',array('user' => $this->user, 'id' => $id));
    }
    public function noteSave(){ 
        print_r($_POST);
        $id = $this->user["id"];

        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('notes/create', [
                'validation' => $this->validator
            ]);
            return view('cabinet/note/add',array('user' => $this->user, 'id' => $id));
        }
        $note = new Note();
        $note->save([
            'title' => $this->request->getVar('title'),
            'user_id' => $id,
            'parent' =>$this->request->getVar('parent'),
            'text'  => $this->request->getVar('text'),
            'description'  => $this->request->getVar('description')
        ]);
        session()->setFlashdata('success', 'Success! post created.');
        return redirect()->to('/cabinet/note/view/'.$note->insertID);
    }
    public function noteView(int $id=0){
        $note = new Note();
        $note = $note->find($id); 
        /*print_r($note);*/
        return view('cabinet/note/view',array('user' => $this->user, 'note' => $note));
    }
}

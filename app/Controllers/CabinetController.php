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
        $parent = $this->request->getVar('parent');
        $note = new Note();
        $note->save([
            'title' => $this->request->getVar('title'),
            'user_id' => $id,
            'status' => $this->request->getVar('status'),
            'parent' =>$this->request->getVar('parent'),
            'text'  => $this->request->getVar('text'),
            'description'  => $this->request->getVar('description')
        ]);
        session()->setFlashdata('success', 'Success! post created.');
        if($parent > 0){
            return redirect()->to('/cabinet/note/view/'.$parent);
        }else{
            return redirect()->to('/cabinet/note/view/'.$note->insertID);
        }
        
    }
    public function noteView(int $id=0){
        $note = new Note();
        $note = $note->find($id); 

        //все дочерние элементы
        $noteAll = new Note();
        $noteAll = $noteAll->where('parent', $id)->findAll();

        return view('cabinet/note/view',array('user' => $this->user, 'note' => $note, 'noteAll' => $noteAll));
    }
    public function noteUpdate(int $id=0){

        /*header('Content-Type: application/json');*/

        $data = $this->request->getVar();
        $data['id'] = $id;
        $note = new Note();
        $note->save($data);
      
        $note = new Note();
        $return = $note->where('id', $id)->first();
        return $return['text'];
    }
}

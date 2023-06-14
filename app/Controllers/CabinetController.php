<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\Note;
use App\Models\Tagging;
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
        if ($id != "0") {
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
        $notes  = $this->getNoteLimit(0, 10);
        return view('cabinet/index', ['user' => $this->user, 'notes' => $notes]);
    }
    public function noteAdd(int $id = 0)
    {
        return view('cabinet/note/add', array('user' => $this->user, 'id' => $id));
    }
    public function noteSave()
    {
        print_r($_POST);
        $id = $this->user["id"];

        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            // 'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('notes/create', [
                'validation' => $this->validator
            ]);
            return view('cabinet/note/add', array('user' => $this->user, 'id' => $id));
        }
        $parent = $this->request->getVar('parent');
        $note = new Note();
        $action = $this->request->getVar('action');
        if ($action == "edit") {
            $data = [
                'title' => $this->request->getVar('title'),
                'status' => $this->request->getVar('status'),
                'text'  => $this->request->getVar('text'),
                'description'  => $this->request->getVar('description')
            ];
            $note->update($parent, $data);
            return redirect()->to('/cabinet/note/edit/' . $parent);
            exit();
        } else {
            $note->save([
                'title' => $this->request->getVar('title'),
                'user_id' => $id,
                'status' => $this->request->getVar('status'),
                'parent' => $this->request->getVar('parent'),
                'text'  => $this->request->getVar('text'),
                'description'  => $this->request->getVar('description')
            ]);
        }
        session()->setFlashdata('success', 'Success! post created.');
        if ($parent > 0) {
            return redirect()->to('/cabinet/note/view/' . $parent);
        } else {
            return redirect()->to('/cabinet/note/view/' . $note->insertID);
        }
    }
    public function noteView(int $id = 0)
    {
        $note = new Note();
        $note = $note->find($id);

        //все дочерние элементы
        $noteAll = new Note();
        $noteAll = $noteAll->where('parent', $id)->findAll();

        return view('cabinet/note/view', array('user' => $this->user, 'note' => $note, 'noteAll' => $noteAll));
    }
    public function noteUpdate(int $id = 0)
    {

        /*header('Content-Type: application/json');*/

        $data = $this->request->getVar();
        $data['id'] = $id;
        $note = new Note();
        $note->save($data);

        $note = new Note();
        $return = $note->where('id', $id)->first();
        return $return['text'];
    }
    public function noteEditFull(int $id = 0)
    {

        $id = (int)$id;
        $note = new Note();
        $note = $note->find($id);

        $tag = new Tagging();
        $tag = $tag->where(['user_id' => $this->user["id"], "note_id" => $id])->findAll();

        return  view('cabinet/note/edit', array('user' => $this->user, 'note' => $note, 'tag' => $tag));
    }
    public function tagSave(int $id = 0)
    {

        $id_user = $this->user["id"];
        $tag = new Tagging();
        $data = [
            'title' => $this->request->getVar('title'),
            'user_id' => $id_user,
            'note_id' => $id,
            'status' => "pending",
            'parent' => "",
            'text'  => $this->request->getVar('text'),
            'settings'  => ""
        ];
        /*print_r($data);*/
        $tag->save($data);
        return redirect()->to('/cabinet/note/edit/' . $id);
    }

    public function mapNote(int $id){
        ///пока 3 уровня вложенности
        $map = [];
        $n = $this->getNodeId($id); 
        $map[$n['id']] = $n;
        $id = $n['id'];
        $p = $this->getNodesParent($id);
        foreach($p as $row){
            $map[$n['id']]['desc'][$row['id']]['id'] = $row['id'];
            $map[$n['id']]['desc'][$row['id']]['title'] = $row["title"];
            $p2 = $this->getNodesParent($row['id']);
            $map[$n['id']]['desc'][$row['id']]['desc'] = $p2;
        }
        /*print "<pre>";
        print_r($map);
        print "</pre>";*/
        return view('cabinet/note/map', array('map' => $map ));
    }


    //////note all
    private function getNoteLimit(int $limit = 0, int $offset = 0)
    {
        $note = new Note();
        return $note->select('id, title, status')->where(['user_id' => $this->user["id"], "parent" => "0"])->findAll($limit, $offset);
    }
    private function getNodeId(int $id = 0)
    {
        $note = new Note();
        return $note->select('id, title')->where(['user_id' => $this->user["id"], "id" => $id])->first();
    }
    private function getNodesParent(int $id = 0)
    {
        $note = new Note();
        return $note->select('id, title')->where(['user_id' => $this->user["id"], "parent" => $id])->findAll();
    }
}

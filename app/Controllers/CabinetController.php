<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\Note;
use App\Models\Tagging;
use App\Models\Image;
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

        $image = new Image();
        $image = $image->where(['user_id' => $this->user["id"], "note_id" => $id])->first();

        return  view('cabinet/note/edit', array('user' => $this->user, 'note' => $note, 'tag' => $tag, 'image' => $image));
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

    public function mapNote(int $id)
    {
        ///пока 3 уровня вложенности
        $map = [];
        $n = $this->getNodeId($id);
        $map[$n['id']] = $n;
        $id = $n['id'];
        $t = '';
        $map = $this->ShowTree($id,1); 
        return view('cabinet/map/all', array('n' => $n,'map' => $map));
    }
    public function imageNote(int $id)
    {
        $image = $this->gIN($id);

        if(isset($image["id"])){
            $this->deleteFileImage($image["id"]);
            $this->loadImage($id);
        }else{
            $this->loadImage($id);
        }
        return redirect()->to('/cabinet/note/edit/' . $id);
    }
    public function imageDelete(int $id)
    {
        $image = $this->gI($id);
        $this->deleteFileImage($id);
        return redirect()->to('/cabinet/note/edit/' . $image['note_id'] );
    }
    
    public function userProfile(){
       
        $message = session()->getFlashdata('message');
        return view('cabinet/user/profile', array('user' => $this->user,'message'=>$message));
    }
    public function userProfileUpdate(){

        $user_id = $this->user["id"];
        $user = new User();
        $data = [
            'login' => $this->request->getVar('login'),
            'description'  => $this->request->getVar('description')
        ];
        $user->update($user_id, $data);
        session()->setFlashdata('message', 'Данные пользователя были изменены');
        return redirect()->to('/cabinet/user/');
    }

    private function gI(int $id){
        $image = new Image();
        return  $image->where(['user_id' => $this->user["id"], "id" => $id])->first();
    }
    private function gIN(int $id){
        $image = new Image();
        return  $image->where(['user_id' => $this->user["id"], "note_id" => $id])->first();
    }
    
    private function deleteFileImage(int $id){
        $image = $this->gI($id);
        unlink('./upload/' .  $image['note_id'] . '/' . $image['name']);
        $image = new Image();
        $image = $image->where(['id' => $id, 'user_id' => $this->user["id"]])->delete();
    }

    private function loadImage(int $id){
        if ($_FILES['file']['type'] == "image/jpeg") {
            
            $endFile = ".jpg";
            $namefile = md5(date("Y-m-d H:i:s"));
            $nf = 'upload/' . $id;

            if (!is_dir($nf)) {
                mkdir('upload/' . $id, 0644);
            }

            $uploaddir = $nf . '/';

            $uploadfile = $uploaddir . $namefile . $endFile;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $id_user = $this->user["id"];
                $image = new Image();
                $data = [
                    'title' => $_FILES['file']['name'],
                    'user_id' => $id_user,
                    'note_id' => $id,
                    'status' => "pending",
                    'name'  => $namefile . $endFile,
                ];
                $image->save($data);
            }
        }
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

    private function ShowTree(int $ParentID,int $parent) { 

        $db = \Config\Database::connect();
        $sSQL ="SELECT * FROM note WHERE parent = ".$ParentID." ";
        $query = $db->query($sSQL);
        $return = "";

        $parent = (int) $parent;


        if($query->getResult()){
           
            $return .= '<ul';
            
            if($parent == 1) $return .=' class="treeCSS" '; 
            
            $parent++;

            $return .= '>';
                foreach($query->getResult('array') as $row){
                    $id = $row['id']; 
                    $return .= '<li>';
                    $return .= '<div class="textBold"><a herf="#">'.$row['title'].'</a></div>';
                    $return .= '<div class="description">'.$row['description'].'<div class="panel"><a href="" title="Добавить дочерний текст" alt="Добавить дочерний текст" ><img src="/img/plus.svg" style="width:18px;height:18px;" /></a></div></div>';
                    $return .= $this->ShowTree($id, $parent);
                    $return .= '</li>';
                }
            $return .= '</ul>';
 
        }
       
        return $return;
    }
        
        //ShowTree(0, 0); 
}

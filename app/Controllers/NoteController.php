<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Note;

class NoteController extends ResourceController
{
    private $note;

    public function __construct(){
        helper(['form','url','session']);
        $this->sesion = \Config\Services::session();
        $this->note = new Note;
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $notes = $this->note->orderBy('id','desc')->findAll();
        return view('notes/index',compact('notes'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $notes = $this->note->find($id);
        if($notes) {
            return view('notes/show', compact('notes'));
        }
        else {
            return redirect()->to('/notes');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('notes/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('notes/create', [
                'validation' => $this->validator
            ]);
        }

        $this->note->save([
            'title' => $this->request->getVar('title'),
            'user_id' => '1',
            'description'  => $this->request->getVar('description')
        ]);
        session()->setFlashdata('success', 'Success! post created.');
        return redirect()->to(site_url('/notes'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $notes = $this->note->find($id);
        if($notes) {
            return view('notes/edit', compact('notes'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! no post found.');
            return redirect()->to('/notes');
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('notes/create', [
                'validation' => $this->validator
            ]);
        }

        $this->note->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'user_id' => '1',
            'description'  => $this->request->getVar('description')
        ]);
        session()->setFlashdata('success', 'Success! post updated.');
        return redirect()->to(base_url('/notes'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->note->delete($id);
        session()->setFlashdata('success', 'Success! post deleted.');
        return redirect()->to(base_url('/notes'));
    }
}

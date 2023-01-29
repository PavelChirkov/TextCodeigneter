<?php

namespace App\Controllers;


use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{

    private $user;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->post = new User;     
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $posts = $this->user->orderBy('id', 'desc')->findAll();
        return view('user/index', compact('posts'));
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        $user = $this->user->find($id);
        if($user) {
            return view('user/show', compact('post'));
        }
        else {
            return redirect()->to('/user');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
        return view('user/create');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('user/create', [
                'validation' => $this->validator
            ]);
        }

        $this->user->save([
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description')
        ]);
        session()->setFlashdata('success', 'Success! post created.');
        return redirect()->to(site_url('/user'));
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
        $user = $this->user->find($id);
        if($user) {
            return view('user/edit', compact('post'));
        }
        else {
            session()->setFlashdata('failed', 'Alert! no post found.');
            return redirect()->to('/user');
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
        $inputs = $this->validate([
            'title' => 'required|min_length[5]',
            'description' => 'required|min_length[5]',
        ]);

        if (!$inputs) {
            return view('user/create', [
                'validation' => $this->validator
            ]);
        }

        $this->user->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description')
        ]);
        session()->setFlashdata('success', 'Success! post updated.');
        return redirect()->to(base_url('/user'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        $this->user->delete($id);
        session()->setFlashdata('success', 'Success! post deleted.');
        return redirect()->to(base_url('/user'));
    }
}

<?php

namespace App\Controllers;

use \Myth\Auth\Models\UserModel;
use \Myth\Auth\Password;

class Users extends BaseController
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $dataUser = $this->userModel->findAll();
        $data = [
            'title' => 'Data User',
            'result' => $dataUser
        ];
        return view('users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
        ];
        return view('users/create', $data);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        session()->setFlashdata("msg", "Data berhasil dihapus!");

        return redirect()->to('/users');
    }


    public function detail($id)
    {
        $dataUser = $this->userModel->getUsers($id);
        $data = [
            'title' => 'Data User',
            'result' => $dataUser
        ];
        return view('users/detail', $data);
    }

    public function edit($id = null)
    {
        if ($id==null) 
        {
            return redirect()->to(base_url('/users/index'));
        } else
        {
            $data = [            
                'id' => $id,
                'title' => 'Update Password',
            ];
            return view('users/edit', $data);            
        }
    }
 
    public function set_password()
    {
        $id = $this->request->getVar('id');
        $rules = [
            'password'     => 'required',
            'pass_confirm' => 'required',
        ];
 
        if (! $this->validate($rules))
        {
            $data = [            
                'id' => $id,
                'title' => 'Update Password',
                'validation' => $this->validator,
            ];
 
            return view('/users/edit', $data);
        }
        else
        {
            $userModel = new UserModel();
            $data = [            
                'password_hash' => Password::hash($this->request->getVar('password')),
                'reset_hash' => null,
                'reset_at' => null,
                'reset_expires' => null,
            ];
            $userModel->update($this->request->getVar('id'), $data);  

            session()->setFlashdata("msg", "Data berhasil diubah!");
 
            return redirect()->to(base_url('/users/index'));
        }
    }
}


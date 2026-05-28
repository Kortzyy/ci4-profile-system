<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $search = $this->request->getGet('search');

        if ($search) {

            $users = $model
                ->like('name', $search)
                ->orLike('email', $search)
                ->paginate(5);

        } else {

            $users = $model->paginate(5);
        }

        $data = [

            'users' => $users,

            'pager' => $model->pager,

            'search' => $search
        ];

        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        helper(['form']);

        $rules = [

            'name' => 'required',

            'email' => 'required|valid_email',

            'avatar' =>
                'uploaded[avatar]'
                . '|max_size[avatar,2048]'
                . '|ext_in[avatar,png,jpg,jpeg]'
                . '|mime_in[avatar,image/png,image/jpg,image/jpeg]'
                . '|is_image[avatar]'
            ];

        if (! $this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        try {

            $file = $this->request->getFile('avatar');

            if ($file->isValid() && ! $file->hasMoved()) {

                $newName = $file->getRandomName();

                $file->move(
                    FCPATH . 'uploads/',
                    $newName
                );

                $model = new UserModel();

                $model->save([

                    'name' =>
                        $this->request->getPost('name'),

                    'email' =>
                        $this->request->getPost('email'),

                    'avatar' =>
                        'uploads/' . $newName
                ]);

                return redirect()
                    ->to('/users')
                    ->with(
                        'success',
                        'User added successfully!'
                    );
            }

        } catch (\Exception $e) {

            log_message(
                'error',
                $e->getMessage()
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Upload failed.'
                );
        }
    }
}
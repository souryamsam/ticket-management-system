<?php

namespace App\Controllers;
use App\Models\UserModel;
class User extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index(): string
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'userid' => 'required|number|min_length[10]|max_length[10]',
                'password' => 'required'
            ];
            if (!$this->validate($rules)) {
                return view('user/login_template', [
                    'validation' => $this->validator
                ]);
            } else {
                $userModel = model('UserModel');
            }
        }
        return view('user/login_template');
    }
    public function is_login()
    {
        $rules = [
            'userid' => [
                'label' => 'Phone Number',
                'rules' => 'trim|required|numeric|exact_length[10]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'trim|required'
            ],
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('sign-in'))->withInput();
        } else {
            $postdata = $this->request->getPost();
            $result = $this->userModel->verifyuser($postdata['userid'], $postdata['password']);
            if ($result['STATUS'] == 'YES') {
                session()->set('user_id', $postdata['userid']);
                session()->set('user_info', $result);
                session()->setFlashdata('msg', ['status' => '1', 'message' => 'Successfully Logged In']);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('msg', ['status' => '0', 'message' => 'Invalid Credentials!']);
                return redirect()->to(base_url('sign-in'));
            }
        }

    }
    public function sign_out()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('sign-in')); // Redirect to login page
    }

    public function role_master()
    {
        $role_master_pageload_data = $this->userModel->role_master_pageload_data();
        $data = [
            'title' => 'Role Master',
            'app_content' => 'user/role_master_template.php',
            'page_menu' => $role_master_pageload_data[0],
            'page_name' => $role_master_pageload_data[1],
            'permission' => $role_master_pageload_data[2],
        ];
        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }

    public function role_master_save()
    {
        $rules = [
            'role_name' => [
                'label' => 'Role Name',
                'rules' => 'trim|required|alpha_space'
            ],
            'page_name' => [
                'label' => 'Page Name',
                'rules' => 'required'
            ],
            'privilege' => [
                'label' => 'Privilege',
                'rules' => 'required'
            ],
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('role-master'))->withInput();
        }
        $postdata = $this->request->getPost();
        $result = $this->userModel->save_role_master($postdata);
        session()->setFlashdata("msg", $result);
        return redirect()->to(base_url('role-master'));
    }

    public function role_master_view()
    {
        $role_master_view_pageload_data = $this->userModel->role_master_pageload_view();
        $data = [
            'title' => 'Role Master View',
            'app_content' => 'user/role_master_view.php',
            'role_master_view_data' => $role_master_view_pageload_data[0]
        ];
        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }
}

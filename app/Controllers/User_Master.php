<?php

namespace App\Controllers;
use CodeIgniter\Config\BaseConfig;
use App\Models\UserMasterModel;
class User_Master extends BaseController
{
    public function __construct()
    {
        $this->UserMasterModel = new UserMasterModel();

    }
    public function index()
    {
        $mode = $this->request->getPost('mode');
        $user_id = $this->request->getPost('custom_id');
        $customer_master_pageload_data = $this->UserMasterModel->user_master_pageload();
        $data = [
            'title' => 'User Master',
            'app_content' => 'user_master/user_master_template',
            'user_data' => $customer_master_pageload_data,
            'project_data' => $customer_master_pageload_data[0],
            'designation' => $customer_master_pageload_data[1],
            'role' => $customer_master_pageload_data[2]
        ];
        if (isset($user_id) && $mode == 'edit_user_data') {
            $single_user_data = $this->UserMasterModel->get_user_master_single_data($user_id);
            $data['user_single_data'] = $single_user_data[0][0];
        }
        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);


    }


    public function save_user_master()
    {

        $rules = [
            'user_name' => [
                'label' => 'User Name',
                'rules' => 'required'
            ],
            'designation_val' => [
                'label' => 'Designation',
                'rules' => 'required',
            ],
            'choose_role' => [
                'label' => 'Choose Role',
                'rules' => 'required'
            ],
            'email_address' => [
                'label' => 'Email Address',
                'rules' => 'required|valid_email'
            ],
            'contact_number' => [
                'label' => 'Contact Number',
                'rules' => 'required|numeric|exact_length[10]'
            ],
            'choose_gender' => [
                'label' => 'Choose Gender',
                'rules' => 'required'
            ],
            'project' => [
                'label' => 'Choose Project',
                'rules' => 'required'
            ]

        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('user-master'))->withInput();
        } else {
            $postdata = esc($_POST);
            $result = $this->UserMasterModel->save_user_master_info($postdata);
            session()->setFlashdata("status_msg", $result);
            return redirect()->to(base_url('user-master'));

        }
    }

    public function user_master_view()
    {
        $user_master_view_data = $this->UserMasterModel->pageload_user_master_view();
        $data = [
            'title' => 'User Master View',
            'app_content' => 'user_master/user_master_view_template.php',
            'user_data' => $user_master_view_data[0],
        ];

        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }

    public function update_status_user_master()
    {
        $postdata = $this->request->getPost();
        $result = $this->UserMasterModel->update_status_user_master($postdata);
        session()->setFlashdata('msg', $result);
        return redirect()->to(base_url('user-master-view'));
    }

}
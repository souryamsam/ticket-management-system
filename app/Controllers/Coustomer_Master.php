<?php

namespace App\Controllers;
use CodeIgniter\Config\BaseConfig;
use App\Models\CustomerMasterModel;
class Coustomer_Master extends BaseController
{
    public function __construct()
    {
        $this->CustomerMasterModel = new CustomerMasterModel();
    }
    public function index(): string
    {
        $customer_master_pageload_data = $this->CustomerMasterModel->customer_master_pageload();
        $data = [
            'title' => 'Customer Master',
            'app_content' => 'customer_master/customer_master_template',
            'project_detail_data' => $customer_master_pageload_data[0],
            'state_data' => $customer_master_pageload_data[1]
        ];
        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }

    public function save_customer_master_info()
    {
        $rules = [
            'c_name' => [
                'label' => 'Customer Name',
                'rules' => 'trim|required|alpha_space'
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'trim|required'
            ],
            'state' => [
                'label' => 'State',
                'rules' => 'trim|required'
            ],
            'project_mapping' => [
                'label' => 'Project Mapping',
                'rules' => 'required'
            ]
        ];
        if (!$this->validate($rules)) {
            $user_info = [];
            if (isset($_POST["customer_master"]) && $_POST["customer_master"] == 'customer_master_data') {
                foreach ($_POST['contact_person'] as $key => $contact_person) {
                    $user_info[] = [
                        'contact_person_info' => $contact_person,
                        'contact_number_info' => $_POST['contact_number'][$key]
                    ];
                }
            } else {
                $user_info = [];
            }
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('customer_master_info', $user_info);
            return redirect()->to(base_url('customer-master'))->withInput();
        }
        $postdata = $this->request->getPost();
        $result = $this->CustomerMasterModel->save_customer_master_info($postdata);
        session()->setFlashdata('msg', $result);
        return redirect()->to(base_url('customer-master'));
    }
    public function customer_master_view(): string
    {
        $customer_master_view_data = $this->CustomerMasterModel->pageload_customer_master_view();
        $data = [
            'title' => 'Customer Master View',
            'app_content' => 'customer_master/customer_master_view',
            'customer_data' => $customer_master_view_data[0],
            'contact_details' => $customer_master_view_data[1]
        ];
        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }


}
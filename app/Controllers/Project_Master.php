<?php

namespace App\Controllers;
use CodeIgniter\Config\BaseConfig;
use App\Models\ProjectMasterModel;

class Project_Master extends BaseController
{
    public function __construct()
    {
        $this->ProjectMasterModel = new ProjectMasterModel();
    }

    public function project_master_view(): string
    {
        $project_master_view_data = $this->ProjectMasterModel->pageload_project_master_view();
        //print_r($project_master_view_data); die;
        $data = [
            'title' => 'Project Master View',
            'app_content' => 'project_master/project_master_view_template.php',
            'project_data' => $project_master_view_data[0],
        ];
        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }

    public function project_master(): string
    {

        $data = [
            'title' => 'Project Master',
            'app_content' => 'project_master/project_master_template.php',
        ];

        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }

    public function save_project_master_data()
    {

        $rules = [
            'project_name' => [
                'label' => 'Project Name',
                'rules' => 'trim|required'
            ],
            'upload_photo' => [
                'label' => 'Project Icon',
                'rules' => 'uploaded[upload_photo]|ext_in[upload_photo,jpg,png]|max_size[upload_photo,2048]'
            ],
            'description' => [
                'label' => 'Project Description',
                'rules' => 'trim|required'
            ]
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('project-master'))->withInput();
        }
        $file = $this->request->getFile('upload_photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newFileName = time() . '.' . $file->getExtension();
            $file->move('public/project_icons/', $newFileName);
            $filePath = $newFileName;
            $postdata = $this->request->getPost();
            $result = $this->ProjectMasterModel->save_project_master_info($postdata, $filePath);
            session()->setFlashdata('msg', $result);
            return redirect()->to(base_url('project-master'));
        } else {
            session()->setFlashdata('msg', 'There was an error uploading the file.');
            return redirect()->to(base_url('project-master'))->withInput();
        }
    }

    public function project_master_name_duplicate_check()
    {
        $postdata = $this->request->getPost();
        $result = $this->ProjectMasterModel->project_master_name_duplicate_check($postdata);
        echo json_encode($result);
    }


}
<?php

namespace App\Controllers;

use CodeIgniter\Config\BaseConfig;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session(); // Initialize session service
    }

    public function index()
    {

        $pageload_dashboard_data = $this->userModel->dashboard_manu_data();
        session()->set('dashboard_manu_data', $pageload_dashboard_data);
        $data = [
            'title' => 'Dashboard',
            'app_content' => 'dashboard_template'
        ];

        return view('common/header', $data) .
            view('common/app_main', $data) .
            view('common/footer', $data);
    }
}

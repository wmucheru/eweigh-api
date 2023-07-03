<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    
    public function __construct(){
		parent::__construct();

        $this->auth_model->set_login_redirect();
	}
    
    function index(){
        $data['stats'] = $this->reports_model->getDashboardStats();
        $data['submissions'] = $this->lw_model->getSubmissions();
        $data['breeds'] = $this->reports_model->getCattleByBreed();
        $data['countyData'] = $this->reports_model->getDataByCounties();

        render_admin('admin/reports/reports', 'Reports', 'reports-bd', $data);
    }
}
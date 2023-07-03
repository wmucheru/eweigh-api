<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct(){
		parent::__construct();

        $this->auth_model->set_login_redirect();
    }

    function index(){
        $data['stats'] = $this->reports_model->getDashboardStats();
        $data['submissions'] = $this->lw_model->getSubmissions(['withCoords'=>TRUE]);

        render_admin('admin/dashboard', 'Dashboard', 'dashboard-bd', $data);
    }
    
    function farmers($id=''){
        $f = $this->lw_model->getFarmers($id);

        if($id != ''){
            $data['farmer'] = $f;
            $data['cattle'] = $this->lw_model->getFarmerCattle($f->id);
            $data['submissions'] = $this->lw_model->getFarmerSubmissions($f->id);

            $pageTitle = 'Farmer: '. $f->name;
            $pageContent = 'admin/farmers/view-farmer';
        }
        else{
            $data['farmers'] = $f;

            $pageTitle = 'Farmers';
            $pageContent = 'admin/farmers/farmers';
        }
        
        render_admin($pageContent, $pageTitle, 'farmers-bd', $data);
    }
    
    function cattle($id=''){
        $data['cattle'] = $this->lw_model->getCattle($id);

        if($id != ''){
            $pageContent = 'admin/cattle/view-cattle';
            $pageTitle = 'View Cattle';

            $data['submissions'] = $this->lw_model->getCattleSubmissions($id);
            $data['stats'] = $this->lw_model->getCattleSubmissionStats($id);
        }
        else{
            $pageContent = 'admin/cattle/cattle';
            $pageTitle = 'Cattle';
        }

        render_admin($pageContent, $pageTitle, 'cattle-bd', $data);
    }

    function submissions(){
        $data['submissions'] = $this->lw_model->getSubmissions();
        render_admin('admin/submissions/submissions', 'Submissions', 'dashboard-bd', $data);
    }

    function reports(){
        $data['reports'] = (object) array(
            'county_registrations'=>$this->reports_model->getRegistrationByCounties(),
            'cattle_by_breed'=>$this->reports_model->getCattleByBreed()
        );
    }
}

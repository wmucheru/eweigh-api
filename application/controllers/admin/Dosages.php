<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosages extends CI_Controller {
    var $userId;

    function __construct(){
		parent::__construct();

        $this->auth_model->set_login_redirect();

        $this->userId = $this->auth_model->get_user_id();
	}
    
    /**
     * 
     * Dosages
     * 
     * 
    */
    function index(){
        $data['dosages'] = $this->feeds_model->getFeeds();

        render_admin('admin/dosages/dosages', 'Dosages & Chemical Agents', 'dosages-bd', $data);
    }

    function dosageForm($id=''){
        $data = array();

        if($id != ''){
            $data['dosageObj'] = $this->dosages_model->getDosages($id);
        }

        $title = $id != '' ? 'Edit' : 'New';

        render_admin('admin/dosages/dosage-form', "$title dosage", 'dosages-bd', $data);
    }

    function saveDosage(){
        $id = $this->input->post('id');

        $this->form_validation->set_rules('disease', 'Disease', 'required');
        $this->form_validation->set_rules('agent', 'Chemical Agent', 'required');
        $this->form_validation->set_rules('dosage', 'Dosage', 'required');
        # $this->form_validation->set_rules('county', 'County', 'required');

        if($this->form_validation->run() == FALSE){
            $this->dosageForm($id);
        }
        else{
            
            $post = $this->input->post();

            $post['createdby'] = $this->userId;
            $post['lasteditedby'] = $this->userId;


            if(empty($id)){
                $post['createdby'] = $this->userId;
                $save = $this->db->insert('il_dosages', $post);
            }
            else{
                $post['lasteditedby'] = $this->userId;
                $save = $this->db->update('il_dosages', $post, array('id'=>$id));
            }

            if($save){
                $this->session->set_flashdata('dosage_success', 'Dosage updated');
            }
            else{
                $this->session->set_flashdata('dosage_fail', 'Dosage could not be updated');
            }

            redirect('admin/dosages');
        }
    }

    /**
     * 
     * Chemical agents
     * 
    */
    function agentForm($id=''){
        $data = array();

        if($id != ''){
            $data['agentObj'] = $this->dosages_model->getChemicalAgents($id);
        }

        $title = $id != '' ? 'Edit' : 'New';

        render_admin('admin/dosages/agent-form', "$title chemical agent", 'dosages-bd', $data);
    }

    function saveAgent(){
        $id = $this->input->post('id');

        $this->form_validation->set_rules('agent', 'Chemical Agent', 'required');
        $this->form_validation->set_rules('applicationmode', 'Application Mode', 'required');
        $this->form_validation->set_rules('proprietaryname', 'Proprietary Name', 'required');
        $this->form_validation->set_rules('dosagebasis', 'Dosage Basis', 'required');

        if($this->form_validation->run() == FALSE){
            $this->agentForm($id);
        }
        else{
            
            $post = $this->input->post();

            $post['createdby'] = $this->userId;
            $post['lasteditedby'] = $this->userId;

            if(empty($id)){
                $post['createdby'] = $this->userId;
                $save = $this->db->insert('il_chemicalagents', $post);
            }
            else{
                $post['lasteditedby'] = $this->userId;
                $save = $this->db->update('il_chemicalagents', $post, array('id'=>$id));
            }
            

            if($save){
                $this->session->set_flashdata('dosage_success', 'Chemical agent updated');
            }
            else{
                $this->session->set_flashdata('dosage_fail', 'Chemical agent could not be updated');
            }

            redirect('admin/dosages');
        }
    }

    /**
     * 
     * Diseases
     * 
    */
    function diseaseForm($id=''){
        $data = array();

        if($id != ''){
            $data['diseaseObj'] = $this->dosages_model->getDiseases($id);
        }

        $title = $id != '' ? 'Edit' : 'New';

        render_admin('admin/dosages/disease-form', "$title disease", 'dosages-bd', $data);
    }

    function saveDisease(){
        $id = $this->input->post('id');

        $this->form_validation->set_rules('name', 'Disease', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if($this->form_validation->run() == FALSE){
            $this->diseaseForm($id);
        }
        else{
            
            $post = $this->input->post();

            $post['createdby'] = $this->userId;
            $post['lasteditedby'] = $this->userId;

            if(empty($id)){
                $post['createdby'] = $this->userId;
                $save = $this->db->insert('il_diseases', $post);
            }
            else{
                $post['lasteditedby'] = $this->userId;
                $save = $this->db->update('il_diseases', $post, array('id'=>$id));
            }
            

            if($save){
                $this->session->set_flashdata('dosage_success', 'Disease updated');
            }
            else{
                $this->session->set_flashdata('dosage_fail', 'Disease could not be updated');
            }

            redirect('admin/dosages');
        }
    }
}
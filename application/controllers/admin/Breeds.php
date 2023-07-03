<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breeds extends CI_Controller {
    var $userId;

    function __construct(){
		parent::__construct();

        $this->auth_model->set_login_redirect();

        $this->userId = $this->auth_model->get_user_id();
	}
    
    function index(){
        $data['breeds'] = $this->breeds_model->getBreeds();

        render_admin('admin/breeds/breeds', 'Breeds', 'breeds-bd', $data);
    }

    function form($id=''){
        $data = array();

        if($id != ''){
            $data['breedObj'] = $this->breeds_model->getBreeds($id);
        }

        $title = $id != '' ? 'Edit' : 'New';

        render_admin('admin/breeds/breed-form', "$title breed", 'breeds-bd', $data);
    }

    function saveBreed(){
        # var_dump($this->input->post());
        $id = $this->input->post('id');

        $this->form_validation->set_rules('breed', 'Breed', 'required');
        $this->form_validation->set_rules('matureweight', 'Mature Weight', 'required');

        if($this->form_validation->run() == FALSE){
            $this->form($id);
        }
        else{
            
            $post = $this->input->post();

            $post['createdby'] = $this->userId;
            $post['lasteditedby'] = $this->userId;

            if(empty($id)){
                $post['createdby'] = $this->userId;
                $save = $this->db->insert('il_breeds', $post);
            }
            else{
                $post['lasteditedby'] = $this->userId;
                $save = $this->db->update('il_breeds', $post, array('id'=>$id));
            }

            if($save){
                $this->session->set_flashdata('breed_success', 'Breed updated');
            }
            else{
                $this->session->set_flashdata('breed_fail', 'Breed could not be updated');
            }

            redirect('admin/breeds');
        }
    }
}
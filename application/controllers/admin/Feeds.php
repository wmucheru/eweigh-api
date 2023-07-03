<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feeds extends CI_Controller {
    var $userId;

    function __construct(){
		parent::__construct();

        $this->auth_model->set_login_redirect();

        $this->userId = $this->auth_model->get_user_id();
	}
    
    function index(){
        $data['feeds'] = $this->feeds_model->getFeeds();
        $data['feed_records'] = $this->feeds_model->getFeedRecords();
        $data['feed_stats'] = $this->feeds_model->getFeedRecords();

        render_admin('admin/feeds/feeds', 'Feeds', 'feeds-bd', $data);
    }

    function form($id=''){
        $data = array();

        if($id != ''){
            $data['feedObj'] = $this->feeds_model->getFeeds($id);
        }

        $title = $id != '' ? 'Edit feed' : 'New feed';

        render_admin('admin/feeds/feed-form', $title, 'feeds-bd', $data);
    }

    function saveFeed(){
        # var_dump($this->input->post());
        $id = $this->input->post('id');

        $this->form_validation->set_rules('feed', 'Feed Name', 'required');
        $this->form_validation->set_rules('feedtype', 'Feed Type', 'required');
        $this->form_validation->set_rules('drymatter', 'Dry Matter', 'required');
        $this->form_validation->set_rules('energy', 'Energy', 'required');
        $this->form_validation->set_rules('protein', 'Protein', 'required');
        $this->form_validation->set_rules('ndf', 'NDF', 'required');

        if($this->form_validation->run() == FALSE){
            $this->form($id);
        }
        else{
            
            $post = $this->input->post();

            if(empty($id)){
                $post['createdby'] = $this->userId;
                $save = $this->db->insert('il_feeds', $post);
            }
            else{
                $post['lasteditedby'] = $this->userId;
                $save = $this->db->update('il_feeds', $post, array('id'=>$id));
            }
            

            if($save){
                $this->session->set_flashdata('feed_success', 'Feed details updated');
            }
            else{
                $this->session->set_flashdata('feed_fail', 'Feed details could not be updated');
            }

            redirect('admin/feeds');
        }
    }
}
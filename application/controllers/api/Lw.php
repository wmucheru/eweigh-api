<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lw extends CI_Controller {
    
    /**
     * 
     * Get LiveWeight (LW) from provided heart girth (HG) measurement
     * 
     *
     */
    function getLW(){
        $post = $this->input->post();
        # var_dump($post); exit();

        $userId = $this->input->post('userid');
        $cattleId = $this->input->post('cattle');
        $hg = $this->input->post('hg');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $timestamp = date('Y-m-d H:i:s');
    
        if(empty($userId)){
            $response = array(
                'error'=>true,
                'message'=>'Could not identify user'
            );
        }
        else if(empty($hg) || empty($lat) || empty($lng)){
            $response = array(
                'error'=>true,
                'message'=>'Incomplete data received'
            );
        }
        else{

            $lw = pow((0.02451 + 0.04894 * $hg), (1/0.3595));
            $agent = $this->site_model->getUserAgent();

            $record = array(
                'userid'=>$userId,
                'cattleid'=>$cattleId,
                'hg'=>$hg,
                'lw'=>round($lw, 1),
                'lat'=>round($lat, 7),
                'lng'=>round($lng, 7),
                
                # User agent details
                'useragent'=>$agent->ua,
                'useragenttype'=>$agent->uaType,
                'ipaddress'=>$agent->ip,

                'createdon'=>$timestamp,
                'createdby'=>$userId
            );

            $this->db->insert('il_hglw_records', $record);

            $record['id'] = $this->db->insert_id();

            $response = $record;
        }

        $this->site_model->returnJSON($response);
    }

    function getSubmissions(){
        $response = array();

        $submissionId = $this->input->post('submissionid');
        $userId = $this->input->post('userid');

        if(!empty($userId)){
            $response = $this->lw_model->getSubmissions([
                'submissionId'=>$submissionId,
                'userId'=>$userId
            ]);
        }

        $this->site_model->returnJSON($response);
    }
}
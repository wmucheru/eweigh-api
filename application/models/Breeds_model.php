<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Breeds_model extends CI_Model{

    function getBreeds($id=''){
        $this->db->select('id, breed, matureweight, createdon');
        $this->db->from('il_breeds');

        if($id != ''){
            $this->db->where(array('id'=>$id));
        }

        $this->db->order_by('lasteditedon', 'desc');

        $q = $this->db->get();

        return $id != '' ? $q->row() : $q->result();
    }
    
}
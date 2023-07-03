<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Members_model extends CI_Model{

    function getMemberForm($id=''){
        $formUrl = $id != '' ? "admin/member/edit/$id" : 'admin/member/add';

        return array(
            'url' => $formUrl,
            'formType'=> 'multipart',
            'fields' => array(),
            'submitLabel' => 'Save',
            'table'=>'members',
            'sessionKey'=>'member'
        );
    }

    function getMembers($memberId='', $userId=''){
        $this->db->select('
            m.id, m.mtypeid, m.idno, m.address, m.photo, m.company, m.createdon,
            
            au.names AS member, au.email, au.mobile,
            aug.name AS mtype,
            ct.county'
        );
        $this->db->from('members m');
        $this->db->join('aauth_users au', 'au.id = m.userid', 'left');
        $this->db->join('aauth_groups aug', 'aug.id = m.mtypeid', 'left');
        $this->db->join('sys_counties ct', 'ct.id = m.county', 'left');

        if($memberId != ''){
            $this->db->where(array('m.id'=>$memberId));
        }

        if($userId != ''){
            $this->db->where(array('au.id'=>$userId));
        }

        $q = $this->db->get();

        return $memberId != '' || $userId != '' ? $q->row() : $q->result();
    }

    function getUserInfo($userId){
        return $this->getMembers($userId);
    }

    function getMemberPhotoUrl($image){
        return base_url('content/uploads/members/'.$image);
    }
}
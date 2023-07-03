<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{

    /**
     * 
     * Get users
     * 
     * @param userId: Unique user ID
     * @param email: User's email address
     * 
     * 
    */
     function getUsers($userId='', $email=''){
        $this->db->select('
            u.id, u.name, u.email, u.mobile, u.idno, u.country, u.county, u.createdon,
            f.ref, f.tag, f.address, f.lat, f.lng'
        );
        $this->db->from('il_users u');
        $this->db->join('il_farmers f', 'f.userid = u.id', 'left');

        if($userId != ''){
            $this->db->where('u.id', $userId);
        }

        if($email != ''){
            $this->db->where('u.email', $email);
        }

        $q = $this->db->get();

        return $userId != '' || $email != '' ? $q->row() : $q->result();
    }

    /**
     * 
     * Get user details using email
     * 
     * @param email: User's email address
     * 
    */
    function getUserByEmail($email){
        return $this->getUsers('', $email);
    }
    
    function hashPassword($userId, $password){
        return sha1($userId . $password);
    }

    function emailExists($email){
        $e = $this->db->get_where('il_users', array('email'=>$email));
        return $e->num_rows() > 0;
    }

    function phoneExists($phone){
        $e = $this->db->get_where('il_users', array('mobile'=>$phone));
        return $e->num_rows() > 0;
    }

    function verifyAccount($email){

    }

    function checkPassword($password){
        $p = $this->db->get_where('il_users', array('password'=>$password));
        return $p->num_rows() > 0;
    }

    function loginUser($email, $password){
        $user = $this->getUsers('', $email);

        if(isset($user->id)){
            $userId = $user->id;
            $passCompare = $this->hashPassword($userId, $password);

            if($this->checkPassword($passCompare)){
                return $user;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    function resetPassword($email){
        # TODO: Send email to user to reset their password
    }
}
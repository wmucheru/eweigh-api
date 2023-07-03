<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * 
     * Register farmer account
     * 
     */
    function register(){
        $response = array();

        $fullName = $this->input->post('fullname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        // $idNumber = $this->input->post('idnumber');
        $country = $this->input->post('country');
        $county = $this->input->post('county');
        $password = $this->input->post('password');

        $userName = explode('@', $email)[0];

        if(empty($fullName) || empty($email) || empty($mobile) || empty($county) || empty($password)){
            
            $response = array(
                'error'=>true,
                'message'=>'Enter the required details'
            );
        }
        else if($this->users_model->emailExists($email)){
            $response = array(
                'error'=>true,
                'message'=>'This email address has already been used'
            );
        }
        else if($this->users_model->phoneExists($mobile)){
            $response = array(
                'error'=>true,
                'message'=>'This mobile no. has already been used'
            );
        }
        else{

            $user = array(
                'name'=>$fullName,
                'email'=>$email,
                'mobile'=>$mobile,
                // 'idno'=>$idNumber,
                // 'country'=>$country,
                'county'=>$county
            );

            if($this->db->insert('il_users', $user)){
                $userId = $this->db->insert_id();

                $agent = $this->site_model->getUserAgent();

                $verificationCode = rand(1000, 9999);

                $this->db->update('il_users', 
                    array(
                        'password'=>$this->users_model->hashPassword($userId, $password),
                        'verification_code'=>$verificationCode,

                        # User agent details
                        'useragent'=>$agent->ua,
                        'useragenttype'=>$agent->uaType,
                        'ipaddress'=>$agent->ip
                    ), 
                    array('id'=>$userId)
                );

                # Add user to il_farmers
                $farmerRef = sprintf("%06d", $userId);

                $farmer = array(
                    'userid'=>$userId,
                    'ref'=>$this->site_model->generateRef(),
                    'tag'=>$farmerRef,
                );

                if($this->site_model->addToTable('il_farmers', $farmer)){
                    $siteName = $this->config->item('site_name');
                    $message = "You have successfully registered for $siteName. Your verification code is $verificationCode";

                    # $this->messages_model->sendSMS($mobile, $message, TRUE);

                    $response = array(
                        'success'=>true,
                        'message'=>'Account successfully created',
                        'user' => $this->users_model->getUserByEmail($email)
                    );
                }
                else{
                    $response = array(
                        'error'=>true,
                        'message' => 'Could not create user account. Please contact admin'
                    );
                }
            }
            else{
                $response = array(
                    'error'=>true,
                    'message'=>'Could not create user account'
                );
            }
        }

        $this->site_model->returnJSON($response);
    }

    function verify(){
        $verificationCode = get_api_vars('verification_code');
        $userId = get_api_vars('id');

        if(empty($verificationCode) || empty($userId)){
            $response = array(
                'error'=>true,
                'message'=>'Enter correct verification details'
            );
        }
        else{
            $v = $this->db->get_where(
                'il_users',
                array(
                    'id'=>$userId,
                    'verification_code'=>$verificationCode
                )
            );

            if($v->num_rows() > 0){
                $response = array(
                    'success'=>true,
                    'message'=>'Phone verified'
                );
            }
            else{
                $response = array(
                    'error'=>true,
                    'message'=>'Could not verify account'
                );
            }
        }

        $this->site_model->returnJSON($response);
    }

    function login(){
        $response = array();

        $email = get_api_vars('email');
        $password = get_api_vars('password');

        $user = $this->users_model->loginUser($email, $password);

        if(empty($email) || empty($password)){
            $response = array(
                'error'=>true,
                'message'=>'Enter the required login details'
            );
        }

        /*
        else if(!$this->users_model->is_account_verified($email)){
            $response = array(
                'error'=>true,
                'message'=>'Your account is inactive or has been suspended'
            );
        }
        */

        else if($user){
            $response = array(
                'success'=>true,
                'user' => $user
            );
        }
        else{
            $response = array(
                'error'=>true,
                'message'=>'Invalid email/password'
            );
        }

        $this->site_model->returnJSON($response);
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

    function index(){
        render_page('auth/login', 'Login');
    }

    function login_proc(){
        # redirect('dashboard');

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $persist_login = 'true';

        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === FALSE){
            $this->index();
        }
        else{
            $remember = $persist_login == 'true';

            if($this->auth_model->is_account_verified($email)){

                if ($this->aauth->login($email, $password, $remember)){
                    redirect('admin/dashboard');
                }
                else{
                    $this->session->set_flashdata('login_fail', 'Please enter the correct login details');
                    $this->index();
                }
            }
            else{
                $this->session->set_flashdata('login_fail', 'Could not log you in. Please try again later');
                $this->index();
            }
        }
    }

    function register_proc(){
        # var_dump($this->input->post());
    }

    function logout(){
        $this->aauth->logout();
        redirect('admin');
    }
}

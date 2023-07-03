<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(!$this->auth_model->is_logged_in()){
            redirect('auth/index');
        }
    }

    /*
     * Users' view
     *
     * @type: admin, corporate, supervisor, accountant, pending, banned
     */
    function index($type='') {
        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        # $this->auth_model->control(2, true);

        $data['body_id'] = 'users-bd';
        $data['page_title'] = 'Users';
        $data['page_content'] = 'users/all-users';

        $data['users'] = $this->auth_model->list_users('', '', '', TRUE);
        $data['groups'] = $this->auth_model->list_groups();

        $this->load->view('inc/template-admin', $data);
    }

    /*
     * Profile view
     *
     */
    function profile(){
        $data['body_id'] = 'users-bd';
        
        $data['page_title'] = 'My Profile';
        $data['page_content'] = 'users/profile';
        $data['userdata'] = $this->auth_model->get_user_data();

        if($this->auth_model->is_member('Corporate')){
            $data['corp_userdata'] = $this->users_model->get_corporate_users($data['userdata']->id)[0];
        }

        $this->load->view('inc/template-admin', $data);
    }

    function edit($user_id){
        $data['body_id'] = 'users-bd';

        $data['page_title'] = 'Edit User';
        $data['page_content'] = 'users/edit-user';
        $data['edit_mode'] = true;

        $data['user_info'] = $this->auth_model->get_user_info($user_id);
        $data['groups'] = $this->auth_model->list_groups();

        $this->load->view('inc/template-admin', $data);
    }

    /*
     *  User functions
     *
     *  add or edit user, upload profile pictures
     */
    function upload_profileimg(){

        $filename = substr(microtime(), -9, -1) . '_' . rand(1, 2000);

        $gallery_path = realpath(APPPATH . '../content/uploads/avatars');
        $gallery_path_url = base_url('content/uploads/avatars');

        # Get user data
        $user_id = $this->auth_model->get_user_data()->id;

        $upload_config = array(
            'allowed_types' => 'gif|jpg|png',
            'upload_path' => $gallery_path,
            'max_size' => 5000, # 5MB
            'file_name' => $filename
        );

        $this->load->library('upload', $upload_config);
        
        if($this->upload->do_upload('ppic')){

            $filename = $this->upload->data()['file_name'];

            # Update users table with new filename
            if($this->db->update('aauth_users', array('photo' => $filename), array('id' => $user_id))){
                $this->session->set_flashdata('users_success', 'Profile photo was successfully updated');
            }
            else{
                $this->session->set_flashdata('users_fail', 'Profile photo could not be uploaded');
            }
            
        }
        else{
            $this->session->set_flashdata('users_fail', $this->upload->display_errors());
        }
        
        redirect('admin/users/profile');
    }

    function user_proc($mode='', $owner=''){

        # Get form type
        $form_type = $this->input->post('form_type');
        
        $name = $this->input->post('fname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $group = $this->input->post('user_group');
        $password = $this->input->post('password');
        $con_password = $this->input->post('cpassword');

        $user_id = $this->input->post('user_id');

        $this->form_validation->set_rules('fname', 'Full name', 'required');
        $this->form_validation->set_rules('email', 'Email address', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('user_group', 'User Group', 'required');

        #var_dump($this->input->post());
        //exit();

        if($this->form_validation->run() == FALSE){
            $data = array(
                'fname' => form_error('fname'),
                'email' => form_error('email'),
                'mobile' => form_error('mobile'),
                'return' => 1
            );
            echo json_encode($data);
        }
        else{
            
            if($mode == 'edit'){
                $update_password = ($password == '') ? FALSE : $password;

                $this->auth_model->update_user($user_id, $email, $update_password, $name);
                $this->db->update('aauth_users', array('mobile' => $mobile), array('id' => $user_id));

                if($owner == 'self'){
                    $this->session->set_flashdata('users_success', 'Profile updated successfully');
                    redirect('admin/users/profile');
                }
                else{

                    # Update member group
                    $this->auth_model->update_member_group($user_id, $group);
                    
                    $this->session->set_flashdata('users_success', 'User updated successfully');
                    redirect('admin/users');
                }
            }

            if($mode == 'add'){
                $userName = $this->site_model->generateRef();
                $userId = $this->auth_model->create_user($email, $password, strtolower($userName));

                if($userId){

                    $this->db->update('aauth_users', 
                        array(
                            'name'=>$name,
                            'mobile'=>$mobile, 
                            'banned'=>'0' # Automatically activate users added by ADMIN
                        ),
                        array('id' => $userId)
                    );

                    $user_array = array(
                        'member_id' => $userId
                    );

                    # Update member group
                    $this->auth_model->update_member_group($userId, $group);
                    
                    $this->session->set_flashdata('users_success', 'User successfully created');
                    redirect('admin/users');
                }
                else{
                    $this->session->set_flashdata('users_fail', 'User not created');
                    $this->index();
                }
            }
        }
    }

    /*
     *  Permission functions
     *
     *  @method: create or delete. Default show all roles
     */
    function permissions($method='', $group_id=''){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        $data['body_id'] = 'users-bd';

        $data['page_title'] = 'User Permissions';
        $data['page_content'] = 'users/permissions';
        

        # Include corporates in the groups list
        $data['groups'] = $this->auth_model->list_groups(TRUE);
        $data['perms'] = $this->auth_model->list_perms();

        if($method == 'add'){

            $name = $this->input->post('permname');
            $desc = $this->input->post('permdescription');

            $add_role = $this->auth_model->create_perm($name, $desc);
            //var_dump($this->db->last_query());exit();

            if($add_role == false){
                $this->session->set_flashdata('perm_fail', 'Permission could not be added');
            }
            else{
                $this->session->set_flashdata('perm_success', 'Permission added successfully');
            }

            redirect('admin/users/permissions');
        }

        if($method == 'group' && $group_id != ''){
            $group_name = $this->auth_model->get_group_name($group_id);

            $data['page_title'] = 'Group Permissions: ' . $group_name;
            $data['page_content'] = 'users/group-permissions';
            $data['gid'] = $group_id;
            $data['group_perms'] = $this->auth_model->get_group_perms($group_id);
        }

        if($method == 'delete'){
            $this->auth_model->delete_perm();
            redirect('admin/users/permissions');
        }

        $this->load->view('inc/template-admin', $data);
    }

    /* 
     * Add permissions to a specific group 
     */
    function set_perms(){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        $perms = $this->input->post('perm');
        $group_id = $this->input->post('gid');

        #new manenos
        #get from post 
        #$perms   = $_POST['perm'];
        #$group_id   = $_POST['group_id'];

        $group_perms = $this->auth_model->get_group_perms($group_id);

        foreach($group_perms as $perm){
            $this->aauth->deny_group($group_id, $perm);
        }

        foreach($perms as $perm){
    
            $this->aauth->allow_group($group_id, $perm);
        }

        $this->session->set_flashdata('perm_success', 'Permissions successfully updated');

        //return true;
        redirect('admin/users/permissions/group/' . $group_id);
    }

    function delete_perm($perm_id){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);
        
        $this->auth_model->delete_perm($perm_id);
        redirect('amin/users/permissions');
    }

    # @method: create, delete, allow
    function groups($method='', $group_id=''){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        # var_dump($this->input->post());
        $group_name = $this->input->post('group_name');
        $group_definition = $this->input->post('group_definition');

        $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $this->permissions();
        }
        else{
            if($method == 'create'){
                $this->auth_model->create_group($group_name, $group_definition);
            }

            if($method == 'update'){
                
            }

            if($method == 'allow'){
                
            }

            redirect('admin/users/groups');
        }
    }

    function delete_group($group_id){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);
        
        $this->auth_model->delete_group($group_id);
        redirect('users');
    }

    function suspended(){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        $data['body_id'] = 'users-bd';
        
        $data['page_title'] = 'Suspended Accounts';
        $data['page_content'] = 'users/suspended-users';
        $data['suspended_users'] = $this->auth_model->get_banned_users();

        $this->load->view('inc/template-admin', $data);
    }

    function suspend_user($user_id){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        if($this->aauth->ban_user($user_id)){
            $this->session->set_flashdata('users_success', 'User has been suspended');
        }
        else{
            $this->session->set_flashdata('users_fail', 'Suspension could not be processed');
        }

        redirect('admin/users');
    }

    function revoke_suspension($user_id){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        if($this->aauth->unban_user($user_id)){
            $this->session->set_flashdata('users_fail', 'Suspension was successfully revoked');
        }
        else{
            $this->session->set_flashdata('users_fail', 'Suspension could not be revoked');
        }

        redirect('admin/users/suspended/' . $group_id);
    }

    function activity(){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        $data['body_id'] = 'users-bd';

        $data['page_title'] = 'User Activity';
        $data['page_content'] = 'users/activity';
        # $data['user_activity'] = $this->auth_model->get_user_activity();

        $this->load->view('inc/template-admin', $data);
    }
    
    
    /*
     * Users' view
     *
     * @type: admin
     */
      
    function agents($view_type=FALSE, $agent_user_id=''){

        /* Control user access: 2 is control parameter for User access in aauth_perms table */
        $this->auth_model->control(2, true);

        $data['body_id'] = 'users-bd';
        $data['corporates'] = $this->users_model->get_corporate_users();

        if($corp_user_id !=''){

            $data['corporates'] = $this->users_model->get_corporate_users($corp_user_id);
            $data['corporate_members'] = $this->users_model->get_corporate_members($corp_user_id);
        }
        
        if($view_type == 'pending'){

            $data['corporates'] = $this->users_model->get_pending_corporates();
        }

        $data['page_title'] = 'Corporate Accounts';
        $data['page_content'] = 'users/all-corporates';

        if($corp_user_id != ''){
            $data['view_mode'] = true;
        }

        $this->load->view('inc/template-admin', $data);
    }
}

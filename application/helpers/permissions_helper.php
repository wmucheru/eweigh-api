<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * PERMISSIONS HELPER
 * 
 * Functions and variables used to restrict functionality to allowed users
 * 
*/

function is_allowed($perm_id){
    $ci =& get_instance();
    
    $ci->load->database();
    $ci->load->library('aauth');
    $ci->load->model('auth_model');

    return $ci->auth_model->is_group_allowed($perm_id);
}

# Admin
define('PERM_SHOW_ADMIN_SECTION', is_allowed(1));
define('PERM_IS_ADMIN', is_allowed(44));

define('PERM_USER_MANAGEMENT', is_allowed(3));

define('PERM_MANAGE_PERMISSIONS', is_allowed(5));

define('PERM_VIEW_PAYMENTS', is_allowed(6));
define('PERM_VIEW_LOGS', is_allowed(9));

?>
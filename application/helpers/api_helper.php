<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_api_vars')){

    /* Check if value isset, add null value if not */
    function get_api_vars($field=''){
        
        if($field != ''){
            return isset($_REQUEST[$field]) ? $_REQUEST[$field] : '';
        }
        else{
            return $_REQUEST;
        }
        /*
        parse_str($_SERVER['QUERY_STRING'], $query);
        
        return !empty($query[$field]) ? $query[$field] : '';
        */
    }
    

    if (!function_exists('get_json_api_vars')){

        /* Check if value isset, add null value if not */
        function get_json_api_vars($field, $defaultValue=''){
            $postVars = (object) json_decode(file_get_contents('php://input'));
            return isset($postVars->$field) ? $postVars->$field : $defaultValue;
        }
    }
}
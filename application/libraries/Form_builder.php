<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * FormBuilder is a library that helps build and validate forms
 * 
 * 
*/
class Form_builder {
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
    
        $this->CI->load->database();
        $this->CI->load->library('form_validation');
        $this->CI->load->library('uri');
        $this->CI->load->library('session');

        $this->CI->load->helper('form');
        $this->CI->load->helper('html');
        $this->CI->load->helper('url');
        
        $this->CI->load->model('site_model');
    }

    /**
     * 
     * Build form based on form object: Form object consists of:
     * 
     * array(
     *  'action' => '',
     *  'attributes' => array('class'=>'form form-horizontal'),
     *  'fields' => array(
     *      array(
     *          'type' => 'text',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'validation' => 'required'
     *      ),
     *      array(
     *          'type' => 'email',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'validation' => 'valid_email'
     *      ),
     *      array(
     *          'type' => 'textarea',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'validation' => ''
     *      ),
     *      array(
     *          'type' => 'checkbox',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'validation' => ''
     *      ),
     *      array(
     *          'type' => 'radio',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'validation' => ''
     *      ),
     *      array(
     *          'type' => 'select',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'listValues' => $myValuesArray,
     *          'listKey' => 'value_id',
     *          'listValue' => 'value_name',
     *          'validation' => 'required'
     *      ),
     *      array(
     *          'type' => 'file',
     *          'attributes' => array(
     *              'class'=>'form-control',
     *              'name' => '',
     *              'label' => '',
     *              'value' => $myValue
     *          ),
     *          'validation' => ''
     *      )
     *  ),
     * )
     * 
    */
    function build_form($formObj){

    }

    function build_field($fieldObj){

    }
}
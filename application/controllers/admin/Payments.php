<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {
    
    function index(){
        $data['payments'] = $this->payments_model->getPayments();

        render_admin('admin/payments/payments', 'Payments', 'payments-bd', $data);
    }
}
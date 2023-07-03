<?php defined('BASEPATH') OR exit('No direct script access allowed');

use AfricasTalking\SDK\AfricasTalking;

class Messages_model extends CI_Model{
    var $username;
    var $apikey;
    var $shortCode;

	public function __construct(){
        parent::__construct();
        # $this->load->library('sms');

        $this->username = "";
        $this->apikey = "";
        $this->shortCode = $this->config->item('sms_shortcode');
    }

    function sendEmail($to, $subject, $message){
        $this->load->library('email');

        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        $this->email->from('info@eweighapp.com', 'eWeigh App');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
    
    /**
     * https://www.africastalking.com/services/bulksms/pricing/kenya
     * http://docs.africastalking.com/sms/sending/url
     * 
     * @var recipients: An array of recipients
     * @var message: Message to be sent
     *
     */
    public function sendSMS($recipients, $message, $sendFromLocal=FALSE){
        $response = array();
        $recipients = is_array($recipients) ? join(',', $recipients) : $recipients;

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "http://api.africastalking.com/version1/messaging",
            CURLOPT_HTTPHEADER => array("apikey:$this->apikey"),
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                "from" => $this->shortCode,
                "username" => $this->username,
                "apikey" => $this->apikey,
                "to" => $recipients,
                "message" => $message
                //"enqueue"=> 1
            )
        ));

        if($this->site_model->isLocalhost() && !$sendFromLocal){
            $response = array('message'=>'No sending from local');
        }
        else if ($this->site_model->isIpHost() && !$sendFromLocal) {
            $response = array('message'=>'No sending from IP host');
        }
        else{
            $result = curl_exec($curl);
            curl_close($curl);
            $response = array('message'=>$result);
        }

        return $response;
    }

    /**
     * 
     * http://docs.africastalking.com/userdata/balance
     * 
     * Check no. of SMS tokens remaining. Get balance and divide by unit cost
     * 
    */
    function checkRemainingSMSes(){
        $unitCost = 1;

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://api.africastalking.com/version1/user?username=". $this->username,
            CURLOPT_HTTPHEADER => array(
                "Apikey:$this->apikey",
                "Accept:application/json"
            )
        ));

        $result = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($result);
        $result = isset($response->UserData) ? $response->UserData->balance : 0;

        $balance = str_replace('KES ', '', $result);
        
        # return $result;
        # return $balance;
        return $balance / $unitCost;
    }
}
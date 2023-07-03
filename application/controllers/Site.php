<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
    
    function index(){
        $siteName = $this->config->item('site_name');
        render_page('home', $siteName, 'home-bd');
    }

    function about(){
        render_page('about', 'About Us', 'about-bd');
    }

    function contacts(){
        render_page('contact-us', 'Contact Us', 'contacts-bd');
    }
}

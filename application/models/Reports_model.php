<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model{
    var $today;
    var $last30Days;

    function __construct(){
        parent::__construct();

        $this->last30Days = date('Y-m-d', strtotime('-30days', strtotime(date('Y-m-d'))));
        $this->today = date('Y-m-d');
    }

    function getCounties(){
        $this->db->order_by('county', 'asc');
        return $this->db->get('sys_counties')->result();
    }

    function getDashboardStats(){
        $this->db->select("
            (SELECT COUNT(id) from il_hglw_records) AS submissions,
            (SELECT COUNT(id) from il_farmers) AS farmers,
            (SELECT COUNT(id) from il_cattle) AS cattle,
            (SELECT COUNT(id) from il_farms) AS farms,
            (SELECT COUNT(id) from il_feeds) AS feeds,
            (SELECT COUNT(id) from il_dosages) AS dosages"
        );

        return $this->db->get()->row();
    }

    function getRegistrationByCounties(){

    }

    /**
     * 
     * Get counties data:
     * 
     * 1. Farmers
     * 2. Cattle
     * 3. Submissions
     * 
    */
    function getDataByCounties($county=''){
        $this->db
            ->select('
                ct.id, ct.county,

                (SELECT COUNT(r.id) 
                    FROM il_hglw_records r
                    LEFT JOIN il_users u ON u.id = r.userid
                    WHERE u.county = ct.id) AS submissions,

                (SELECT COUNT(f.id) 
                    FROM il_farmers f
                    LEFT JOIN il_users u ON u.id = f.userid
                    WHERE u.county = ct.id) AS farmers,

                (SELECT COUNT(c.id) 
                    FROM il_cattle c
                    LEFT JOIN il_users u ON u.id = c.userid
                    WHERE u.county = ct.id) AS cattle'
            )
            ->from('sys_counties ct')
            ->order_by('farmers', 'DESC');

        return $this->db->get()->result();
    }

    function getCattleByBreed($breedId=''){
        $this->db
            ->select("
                b.breed,
                (SELECT COUNT(id) FROM il_cattle WHERE breedid = b.id) AS count"
            )
            ->from('il_breeds b')
            ->order_by('b.breed', 'asc');

        if($breedId != ''){
            $this->db->where('b.id', $breedId);
        }

        return $this->db->get()->result();
    }
}
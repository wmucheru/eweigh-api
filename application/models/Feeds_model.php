<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('FEED_TYPE_FORAGE', 'forage');
define('FEED_TYPE_CONCENTRATE', 'concentrate');

define('FEED_STYLE_STALL', 'stall');
define('FEED_STYLE_GRAZE_LOCAL', 'graze_local');
define('FEED_STYLE_GRAZE_EXT', 'graze_ext');

define('FEED_FOR_MILK', 'milk');
define('FEED_FOR_WEIGHT', 'weight');

class Feeds_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    /**
     * 
     * Get feeds
     * 
     * 
    */
    function getFeeds($feedId='', $feedType=''){
        $this->db
            ->select('*')
            ->from('il_feeds');

        if($feedId != ''){
            $this->db->where('id', $feedId);
        }

        if($feedType != ''){
            $this->db->where('feedtype', $feedType);
        }

        $this->db->order_by('lasteditedon', 'desc');

        $q = $this->db->get();

        return $feedId != '' ? $q->row() : $q->result();
    }

    /**
     * 
     * Get trimmed version of feeds list; for API
     * 
    */
    function getFeedsList(){
        return $this->db
            ->select('id, feed, description, feedtype, drymatter, energy, protein, ndf')
            ->order_by('feed', 'asc')
            ->get('il_feeds')
            ->result();
    }

    function getFeedByType($feedType){
        return $this->getFeeds('', $feedType);
    }

    function getFeedTypes(){
        return array(
            'forage'=>'Forage',
            'concentrate'=>'Concentrate'
        );
    }

    /**
     * 
     * When calculating the cattle diet, get the concentrate(s) that's more
     * than the Minimum Energy Density of the diet
     * 
    */
    function getViableConcentrates($MED){
        return $this->db
            ->select('feed, energy')
            ->from('il_feeds')
            ->where('feedtype', FEED_TYPE_CONCENTRATE)
            ->where('energy >=', $MED)
            ->order_by('energy', 'asc')
            ->order_by('feed', 'asc')
            ->get()
            ->result();
    }

    /**
     * 
     * Get records submitted by farmers
     * 
    */
    function getFeedRecords($recordId='', $cattleId='', $feedId=''){
        $this->db
            ->select('*')
            ->from('il_feed_records');

        if($recordId != ''){
            $this->db->where('id', $recordId);
        }

        if($cattleId != ''){
            $this->db->where('cattleid', $cattleId);
        }

        $q = $this->db->get();

        return $recordId != '' ? $q->row() : $q->result();
    }

    function getFeedTypeRecords($feedId){
        return $this->getFeedRecords('', '', $feedId);
    }

    /**
     * 
     * Generate an overview report of feed & feed records
     * 
     * 1. Percentage usage comparison of forages
     * 2. Percentage usage comparison of concentrates
     * 3. Preferred forage/concentrate
     * 
    */
    function getFeedTypeStats(){
        
    }
}
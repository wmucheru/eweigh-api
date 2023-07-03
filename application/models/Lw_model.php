<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lw_model extends CI_Model{

    /** 
     * 
     * Cattle
     * 
     * - Get the latest live-weight for each cattle listing
     * 
    */
    function getCattle($cattleId='', $userId='', $activeOnly=FALSE){
        $this->db
            ->select("
                c.id, c.userid, c.tag, c.gender, c.breedid, c.deleted, c.createdon,

                (SELECT IFNULL(lw, 0) 
                    FROM il_hglw_records
                    WHERE cattleid=c.id
                    ORDER BY id DESC
                    LIMIT 1) AS lw,

                (SELECT COUNT(id)
                    FROM il_hglw_records
                    WHERE cattleid=c.id) AS submissions,

                b.breed,
                u.name AS user,
                f.id AS farmerid"
            )
            ->from('il_cattle c')
            ->join('il_breeds b', 'b.id = c.breedid', 'left')
            ->join('il_users u', 'u.id = c.userid', 'left')
            ->join('il_farmers f', 'f.userid = c.userid', 'left');

        if($cattleId != ''){
            $this->db->where('c.id', $cattleId);
        }

        if($userId != ''){
            $this->db->where('c.userid', $userId);
        }

        # Only return the cattle that aren't deleted
        if($activeOnly){
            $this->db->where('c.deleted', '0');
        }

        $this->db->order_by('c.id', 'desc');

        $q = $this->db->get();

        return $cattleId != '' ? $q->row() : $q->result();
    }

    /**
     * 
     * Get the cattl a farmer has registered
     * 
     * 
    */
    function getFarmerCattle($userId){
        return $this->getCattle('', $userId);
    }

    /**
     * 
     * Submissions
     * 
     * @params filter: Submissions filter
     * 
     */
    function getSubmissions($filter=array()){
        $filter = (object) $filter;

        $submissionId = !empty($filter->submissionId) ? $filter->submissionId : '';
        $userId = !empty($filter->userId) ? $filter->userId : '';
        $cattleId = !empty($filter->cattleId) ? $filter->cattleId : '';

        # List only those with coordinates
        $withCoords = !empty($filter->withCoords) ? $filter->withCoords : FALSE;

        $this->db
            ->select('
                r.id, r.userid, r.cattleid, r.lat, r.lng, r.hg, r.lw, r.createdon,
                u.name AS user,
                f.id AS farmerid,
                ct.county'
            )
            ->from('il_hglw_records r')
            ->join('il_users u', 'u.id = r.userid', 'left')
            ->join('il_farmers f', 'f.userid = r.userid', 'left')
            ->join('sys_counties ct', 'ct.id = u.county', 'left')
            ->order_by('r.id', 'desc');

        if($submissionId != ''){
            $this->db->where('r.id', $submissionId);
        }

        if($userId != ''){
            $this->db->where('u.id', $userId);
        }

        if($cattleId != ''){
            $this->db->where('r.cattleid', $cattleId);
        }

        if($withCoords === TRUE){
            $this->db
                ->where('r.lat !=', '0')
                ->where('r.lng !=', '0');
        }

        $q = $this->db->get();

        return $submissionId != '' ? $q->row() : $q->result();
    }

    /**
     * 
     * Get farmer submissions
     * 
     * @param userId: Farmer's user ID
     * 
    */
    function getFarmerSubmissions($userId){
        return $this->getSubmissions(['userId'=>$userId]);
    }

    function getCattleSubmissions($cattleId){
        return $this->getSubmissions(['cattleId'=>$cattleId]);
    }

    function getCattleSubmissionStats($id){
        return $this->db
            ->distinct('createdon')
            ->select('
                r.hg, r.lw, DATE_FORMAT(r.createdon, "%Y-%m-%d") AS createdon'
            )
            ->from('il_hglw_records r')
            ->where('cattleid', $id)
            ->get()
            ->result();
    }

    /**
     * 
     * Farmers
     * 
    */
    function getFarmers($farmerId=''){
        $this->db
            ->select('
                u.id, u.name, u.email, u.mobile, u.idno, 
                f.tag, f.ref, f.createdon,
                ct.county'
            )
            ->from('il_farmers f')
            ->join('il_users u', 'u.id = f.userid', 'left')
            ->join('sys_counties ct', 'ct.id = u.county', 'left');
        
        if($farmerId != ''){
            $this->db->where('f.id', $farmerId);
        }

        $this->db->order_by('f.id', 'desc');

        $q = $this->db->get();

        return $farmerId != '' ? $q->row() : $q->result();
    }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('DOSAGE_BASIS_WEIGHT', 'weight');
define('DOSAGE_BASIS_RATIO', 'ratio');

class Dosages_model extends CI_Model{

    /** 
     * 
     * Chemical Agents
     * 
    */
    function getChemicalAgents($id=''){
        $this->db
            ->select('
                id, agent, applicationmode AS mode, proprietaryname, 
                dosagebasis AS basis, createdon'
            )
            ->from('il_chemicalagents');

        if($id != ''){
            $this->db->where('id', $id);
        }

        $this->db->order_by('agent', 'asc');

        $q = $this->db->get();

        return $id != '' ? $q->row() : $q->result();
    }

    /** 
     * 
     * Diseases
     * 
    */
    function getDiseases($id=''){
        $this->db
            ->select('id, name AS disease, description, createdon')
            ->from('il_diseases');

        if($id != ''){
            $this->db->where('id', $id);
        }

        $this->db->order_by('name', 'asc');

        $q = $this->db->get();

        return $id != '' ? $q->row() : $q->result();
    }

    /** 
     * 
     * Dosages
     * 
    */
    function getDosages($id='', $diseaseId='', $agentId=''){
        $this->db
            ->select('
                d.id, d.dosage, d.county,
                di.id AS did, di.name AS disease,

                a.id AS aid, a.proprietaryname AS agent, a.applicationmode AS mode,
                a.dosagebasis AS basis'
            )
            ->from('il_dosages d')
            ->join('il_diseases di', 'di.id = d.disease', 'left')
            ->join('il_chemicalagents a', 'a.id = d.agent', 'left');

        if($id != ''){
            $this->db->where('d.id', $id);
        }

        if($diseaseId != ''){
            $this->db->where('di.id', $diseaseId);
        }

        if($agentId != ''){
            $this->db->where('a.id', $agentId);
        }

        $this->db->order_by('d.lasteditedon', 'desc');

        $q = $this->db->get();

        return $id != '' || ($diseaseId != '' && $agentId != '') ? 
            $q->row() : $q->result();
    }

    /**
     * 
     * For a particular disease, get the dosage of the selected chemical agents
     * 
    */
    function getTreatmentDosage($diseaseId, $agent){
        return $this->getDosages('', $diseaseId, $agent);
    }
}
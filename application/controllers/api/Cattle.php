<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cattle extends CI_Controller {

    function getBundle(){
        $userId = $this->input->post('userid');

        $response = array(

            # Dosages
            'dosages'=>$this->dosages_model->getDosages(),

            # Breeds
            'breeds'=>$this->breeds_model->getBreeds(),

            # Rations
            'feeds'=>$this->feeds_model->getFeedsList(),

            # Submissions
            'submissions'=>[],
        );

        if(!empty($userId)){
            $response['submissions'] = $this->lw_model->getSubmissions(['userId'=>$userId]);
        }

        $this->site_model->returnJSON($response);
    }

    function getCattle(){
        $cattleId = $this->input->post('cattleid');
        $userId = $this->input->post('userid');

        $c = $this->lw_model->getCattle($cattleId, $userId, TRUE);
        $this->site_model->returnJSON($c);
    }

    /**
     * 
     * Register cattle into farmers account
     * 
    */
    function registerCattle(){
        $response = array();

        $userId = $this->input->post('userid');
        $tag = $this->input->post('tag');
        $gender = $this->input->post('gender');
        $breedId = $this->input->post('breed');

        if(empty($userId) || empty($tag) || empty($gender)){

            $response = array(
                'message'=>'Enter all required details'
            );
        }
        else{
            $insert = array(
                'userid'=>$userId,
                'tag'=>$tag,
                'gender'=>$gender,
                'breedid'=>$breedId,
                'createdon'=>date('Y-m-d H:i:s'),
                'createdby'=>$userId
            );

            if($this->db->insert('il_cattle', $insert)){
                $cattleId = $this->db->insert_id();

                $response = array(
                    'success'=>true,
                    'message'=>'Cattle added',
                    'cattle'=>$this->lw_model->getCattle($cattleId)
                );
            }
            else{
                $response = array(
                    'message'=>'Could not add cattle'
                );
            }
        }

        $this->site_model->returnJSON($response);
    }

    function deleteCattle(){
        $response = array();

        $cattleId = $this->input->post('id');

        if(empty($cattleId)){

            $response = array(
                'message'=>'Could not fetch cattle details'
            );
        }
        else{
            
            if($this->db->update('il_cattle', array('deleted'=>'1'), array('id'=>$cattleId))){

                $response = array(
                    'success'=>true,
                    'message'=>'Cattle deleted'
                );
            }
            else{
                $response = array(
                    'message'=>'Could not add cattle'
                );
            }
        }

        $this->site_model->returnJSON($response);
    }

    function getFeeds(){
        $response = $this->feeds_model->getFeedsList();
        $this->site_model->returnJSON($response);
    }

    /**
     * 
     * Calculate & store feeds required for the following purposes:
     * 
     * 1. Weight gain
     * 2. Milk porduction
     * 
     * 
    */
    function calculateFeedRation(){
        $response = array('error'=>true);

        # Params
        $cattleId = $this->input->post('cattle');
        $LW = $this->input->post('lw');
        $feedStyle = $this->input->post('feedstyle');
        $feedFor = $this->input->post('feedfor');
        $milkProd = $this->input->post('milkprod');
        
        $targetWeight = $this->input->post('weight');
        $dueDate = $this->input->post('date');

        $forageId = $this->input->post('forage');
        $concentrateId = $this->input->post('concentrate');

        if(empty($LW)){
            $response['message'] = 'Enter the live weight';
        }
        elseif(empty($feedStyle)){
            $response['message'] = 'Specify the feeding style';
        }
        elseif(empty($feedFor)){
            $response['message'] = 'Specify the feed purpose';
        }

        # If feed is for Milk Production, then specify `milkprod`
        elseif($feedFor == FEED_FOR_MILK && empty($milkProd)){
            $response['message'] = 'Specify the milk production';
        }

        # If feed is for Weight Gain, then specify `weight` and `date`
        elseif($feedFor == FEED_FOR_WEIGHT && (empty($targetWeight) || empty($dueDate))){
            $response['message'] = 'Specify the weight and due date';
        }

        elseif(empty($forageId)){
            $response['message'] = 'Enter the forage type';
        }
        elseif(empty($concentrateId)){
            $response['message'] = 'Enter the concentrate';
        }
        else{

            $forage = $this->feeds_model->getFeeds($forageId);
            $concentrate = $this->feeds_model->getFeeds($concentrateId);

            # Calculate intake based on NDF content of forage
            $maximumIntake = (150 / $forage->ndf) * ($LW / 100 * 1.1);

            # Get MER (Mininimum Energy Requirement) for basic metabolic functions, with 
            # margin of error based on the style of feeding
            $MER = ($LW * 0.092) + 8.14;

            $feedingFactor = 1;

            switch($feedStyle){

                case FEED_STYLE_STALL:
                    $feedingFactor = 1;
                    break;

                case FEED_STYLE_GRAZE_LOCAL:
                    $feedingFactor = 1.1;
                    break;

                case FEED_STYLE_GRAZE_EXT:
                    $feedingFactor = 1.3;
                    break;

                default:
                    break;
            }

            $MER = $MER * $feedingFactor;

            $totalEnergyRequirement = 0;

            /**
             * 
             * Calculate feed for milk production (litres/day)
             * 
             * MPE = Milk production energy
             * 
             * Using 5.3MJ as a constant; energy for milk production per litre
             * 
            */
            if($feedFor == FEED_FOR_MILK){
                $MPE = 5.3 * $milkProd;
                $totalEnergyRequirement = $MER + $MPE;

                # var_dump(array('milkEnergy'=>$MPE));
            }

            /**
             * 
             * Calculate feed for weight gain
             * 
             * WGE = Weight gain energy; energy required to lay down the tissue
             * 
             * Using 55MJ as a constant; energy content in a kilo of body tissue
             * 
            */
            if($feedFor == FEED_FOR_WEIGHT){
                $weightDiff = $targetWeight - $LW;

                $today = date('Y-m-d H:i:s');

                $daysDiff = (strtotime($dueDate) - strtotime($today)) / 1440; # Seconds diff to days

                $WGE = ($weightDiff / $daysDiff) * 55;

                $totalEnergyRequirement = $MER + $WGE;

                # var_dump(array('weightEnergy'=>$WGE));
            }

            /**
             * 
             * Ration DM Basis
             * 
             * Minimum Energy Density (MED) of diet = Total Energy required / Maximum Intake
             * 
            */
            $MED = round($totalEnergyRequirement / $maximumIntake, 3);

            $EDForage = $forage->energy;
            $EDConcentrate = $concentrate->energy;

            /*
            var_dump(
                array(
                    'maxIntake'=>$maximumIntake,
                    'minimumEnergyRequirement'=>$MER,
                    'feedStyle'=>$feedStyle,
                    'feedFactor'=>$feedingFactor,
                    'feedFor'=>$feedFor,
                    'minimumEnergyDensity'=>$MED,
                    'forageED'=>$EDForage,
                    'concentrateED'=>$EDConcentrate,
                    'forage'=>$forage->feed,
                    'concentrate'=>$concentrate->feed,
                    'totalEnergyRequirement'=>$totalEnergyRequirement
                )
            );
            */

            # if(false){ # TODO: Check for MED > EDConcentrate caps the amounts of forage to be considered
            if($MED > $EDConcentrate){

                # Suggest a viable concentrate if the selected one is deficient
                $viableConcentrates = $this->feeds_model->getViableConcentrates($MED);

                if(empty($viableConcentrates)){
                    $response = array(
                        'error'=>true,
                        'message'=>'Could not find a viable concentrate'
                    );
                }
                else{
                    $cArray = array();

                    foreach($viableConcentrates as $c){
                        array_push($cArray, $c->feed);
                    }

                    $proposedConcentrates = implode(', ', $cArray);

                    $response = array(
                        'error'=>true,
                        'message'=>"Please choose one of the following: $proposedConcentrates"
                    );
                }
            }
            else{

                $concentrateInRation = abs($EDForage - $MED) / (abs($EDConcentrate - $MED) + abs($EDForage - $MED)) * $maximumIntake;
                $forageInRation = abs($EDConcentrate - $MED) / (abs($EDForage - $MED) + abs($EDConcentrate - $MED)) * $maximumIntake;

                # 1.1 is a fudge factor
                $forageKG = ($forageInRation * 1.1) / $forage->drymatter;
                $concentrateKG = $concentrateInRation / $concentrate->drymatter;

                /*
                var_dump(
                    array(
                        'concentrateInRation'=>round($concentrateInRation, 2),
                        'forageInRation'=>round($forageInRation, 2),
                        'forageKG'=>round($forageKG, 1),
                        'concentrateKG'=>round($concentrateKG, 1),
                    )
                ); exit();
                */

                $response = array(
                    'intake'=>$maximumIntake,
                    'mer'=>$MER,
                    'ter'=>$totalEnergyRequirement,
                    'med'=>$MED,

                    # Feed names
                    'forageName'=>$forage->feed,
                    'concentrateName'=>$concentrate->feed,

                    # Feed values, TODO: Update forage values to show KGs . "kg"
                    'forage'=>round($forageKG, 1),
                    'concentrate'=>round($concentrateKG, 1)
                );
            }

            /**
             * 
             * TODO: In future, save results from feed ration
             * 
             * Set status of result: 
             * - SUCCESS: Found rations 
             * - FAIL: Could not find suitable ration ()
             * 
            */
        }

        $this->site_model->returnJSON($response);
    }

    /**
     * 
     * DOSAGE
     * 
     * 
    */
    function getDosages(){
        $dosageId = $this->input->post('dosage') ?: '';
        $diseaseId = $this->input->post('disease') ?: '';
        $agentId = $this->input->post('agent') ?: '';

        $response = $this->dosages_model->getDosages($dosageId, $diseaseId, $agentId);

        $this->site_model->returnJSON($response);
    }

    function calculateDosage(){
        $response = array();

        $disease = $this->input->post('disease') ?: '';
        $agent = $this->input->post('agent') ?: '';
        $lw = $this->input->post('lw') ?: '';

        if(empty($disease)){
            $response = array(
                'message'=>'Specify the disease to treat'
            );
        }
        elseif(empty($agent)){
            $response = array(
                'message'=>'Specify the chemical agent'
            );
        }
        elseif(empty($lw)){
            $response = array(
                'message'=>'Enter the live weight'
            );
        }
        else{

            $dosage = $this->dosages_model->getTreatmentDosage($disease, $agent);
            # var_dump($dosage); exit();

            /**
             * 
             * Depending on the chemical agent dosage basis type, ie: 
             * 
             * - Ratio-based e.g. Mostraz is 20ml/10L water
             * - Weight-based e.g. Albendazole 10%
             * 
             * Check the dosage basis and present the correct info
             * 
            */

            if(!isset($dosage->dosage)){
                $response = array(
                    'message'=>'Could not find suitable dosage'
                );
            }
            else{

                # var_dump($dosage->dosage * $lw); exit();

                # Round up dosage to the nearest multiple of 5
                $weightDosage = ceil(($dosage->dosage * $lw) / 5) * 5;

                $dose = $dosage->basis == DOSAGE_BASIS_WEIGHT ?
                    "$weightDosage" :
                    "$dosage->dosage ml/10L water";

                $response = array(
                    'disease'=>$dosage->disease,
                    'agent'=>$dosage->agent,
                    'dosage'=>$dose,
                    'mode'=>$dosage->mode
                );
            } 
        }

        $this->site_model->returnJSON($response);
    }
}
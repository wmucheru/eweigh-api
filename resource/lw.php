<?php

    # $form = json_decode(file_get_contents('php://input'));
    
    if(!empty($_POST)){
        $form = (object) $_POST;

        $hg = $form->hg;
        $lat = $form->lat;
        $lng = $form->lng;
        $timestamp = date('Y-m-d H:i:s');

        $lw = pow((0.02451 + 0.04894 * $hg), (1/0.3595));

        $response = array(
            'lw'=>round($lw, 3),
            'lat'=>$lat,
            'lng'=>$lng,
            'timestamp'=>$timestamp
        );
    }
    else{
        $response = array(
            'error'=>true,
            'message'=>'Incomplete data received'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);

?>
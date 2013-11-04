<?php
/**
 * Created by PhpStorm.
 * User: nos4a2
 * Date: 10/28/13
 * Time: 4:55 PM
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];

    // include db handler
    require_once 'include/db_functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);
// check for tag type
    if ($tag == 'send') {
        // Request type is check Login
        $uID = $_POST['uid'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $timestamp = $_POST['timestamp'];

        $report = $db->storeReport($uID, $lat, $lng, $timestamp);
        if ($report) {
             //user stored successfully
            $rindex = $report[$i]["rID"];
            $response[$rindex ]["rid"] = $report[$i]["Report_id"];
            $response[$rindex ]["uid"] = $report[$i]["R_user_id"];
            $response[$rindex ]["lat"] = $report[$i]["R_lat"];
            $response[$rindex ]["lng"] = $report[$i]["R_lng"];
            $response[$rindex ]["time"] = $report[$i]["R_datetime_sent"];
            echo json_encode($report);
        } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in Registartion";
            echo json_encode($response);
        }
    }
    else if($tag == 'view'){
     $uID = $_POST['uid'];

        $report = $db->viewReport($uID);
        if($report){
            // user stored successfully
            $response["success"] = 1;
            for($i = 0; $i < count($report); $i++){
                $rindex = $report[$i]["rID"];
                $response[$rindex ]["rid"] = $report[$i]["rID"];
                $response[$rindex ]["uid"] = $report[$i]["uID"];
                $response[$rindex ]["lat"] = $report[$i]["lat"];
                $response[$rindex ]["lng"] = $report[$i]["lng"];
                $response[$rindex ]["time"] = $report[$i]["time"];
            }
            unset($report);
            echo json_encode($response);
        }
    }
    else{
        echo 'Invalid request!';
    }
}

?>				
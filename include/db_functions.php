<?php
/**
 * Created by PhpStorm.
 * User: nos4a2
 * Date: 10/28/13
 * Time: 4:56 PM
 */
class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
    }

    public function storeReport($uID, $lat, $lng, $timestamp){

        $result = mysql_query("INSERT INTO report_test2 VALUES('','$timestamp','','','','$lat','$lng','','$uID')");
        // check for successful store
        if ($result) {
            // get user details
            $rid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM report_test2 WHERE Report_id = $rid");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

    public function viewReport($uID){
        $result = mysql_query("SELECT * FROM report_test WHERE uID = '$uID'") or die(mysql_error());
        // check for result
        $no_of_rows = mysql_num_rows($result);
        if($no_of_rows > 0){
        $data = array();
        while ($row = mysql_fetch_assoc($result)) {
            array_push($data,$row); // Shifts first element
            }
                return $data;
            }
         else {
            // user not found
            return false;
        }
    }
}

?>
<?php
// echo "<pre>";
// print_r($_GET);
// print_r($_POST); exit;

session_start();
require("config.php");

$type = $_GET['type'];

switch($type){

	case 'accept':{

		$request_id = $_GET['id'];

		$userdetail = "UPDATE tbl_relationship_details SET rs_relation_status = '1' WHERE rs_relation_id =".$request_id ;

		if(mysql_query($userdetail)){
			$json 		= '{ "serviceresponse" : { "servicename" : "Accept Request Patient", "success" : "Yes","message" : "1" } }';
		}
		else{
			echo '{ "serviceresponse" : { "servicename" : "Accept Request Patient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;
		$_SESSION['success'] = "Accept Request Provider successfully";

		header("Location:requestpatient.php");

		break;
	}

	case 'ignore':{

		$request_id = $_GET['id'];

		$userdetail = "DELETE FROM tbl_relationship_details WHERE rs_relation_id = ".$request_id;

		if(mysql_query($userdetail)){
			$json 		= '{ "serviceresponse" : { "servicename" : "Ignore Request Patient", "success" : "Yes","message" : "1" } }';
		}
		else{
			echo '{ "serviceresponse" : { "servicename" : " Ignore Request Patient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;

		$_SESSION['success'] = "Ignore Request Patient successfully";

		header("Location:requestpatient.php");

		break;

	}
exit;
}

?>
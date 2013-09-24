<?php
// echo "<pre>";
// print_r($_GET);
// print_r($_POST); exit;

session_start();
require("config.php");

$type = $_GET['type'];

switch($type){

	case 'patient':{

		$patient_id = $_GET['id'];
		$return_id = $_GET['getid'];

		$userdetail = "DELETE FROM tbl_relationship_details WHERE rs_relation_id = ".$patient_id;

		if(mysql_query($userdetail)){
		//	$json 		= '{ "serviceresponse" : { "servicename" : "Delete Assign Provider", "success" : "Yes","message" : "1" } }';
		}
		else{
		//	echo '{ "serviceresponse" : { "servicename" : "Delete Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		//echo $json;
		$_SESSION['success'] = "Delete Assign patient successfully";
        $_SESSION["tab_active"]="assoc";
		header("Location:providerdetails.php?id=".$return_id);

		break;
	}

	case 'provider':{

		$provider_id = $_GET['id'];
		$return_id = $_GET['getid'];

		$userdetail = "DELETE FROM tbl_relationship_details WHERE rs_relation_id = ".$provider_id;

		if(mysql_query($userdetail)){
		//	$json 		= '{ "serviceresponse" : { "servicename" : "Delete Assign Patient", "success" : "Yes","message" : "1" } }';
		}
		else{
		//	echo '{ "serviceresponse" : { "servicename" : " Delete Assign Patient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
	//	echo $json;

		$_SESSION['success'] = "Delete Assign provider successfully";
        $_SESSION["tab_active"]="assoc";
		header("Location:patientdetails.php?id=".$return_id);

		break;

	}
exit;
}

?>
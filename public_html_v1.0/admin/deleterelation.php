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
			$json 		= '{ "serviceresponse" : { "servicename" : "Delete Assign Provider", "success" : "Yes","message" : "1" } }';
		}
		else{
			echo '{ "serviceresponse" : { "servicename" : "Delete Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;
		$_SESSION['success'] = "Delete Assign Provider successfully";

		header("Location:providerdetails.php?id=".$return_id);

		break;
	}

	case 'provider':{

		$provider_id = $_GET['id'];
		$return_id = $_GET['getid'];

		$userdetail = "DELETE FROM tbl_relationship_details WHERE rs_relation_id = ".$provider_id;

		if(mysql_query($userdetail)){
			$json 		= '{ "serviceresponse" : { "servicename" : "Delete Assign Patient", "success" : "Yes","message" : "1" } }';
		}
		else{
			echo '{ "serviceresponse" : { "servicename" : " Delete Assign Patient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;

		$_SESSION['success'] = "Delete Assign Patient successfully";

		header("Location:patientdetails.php?id=".$return_id);

		break;

	}
exit;
}

?>
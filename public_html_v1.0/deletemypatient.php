<?php
// echo "<pre>";
// print_r($_POST);
//   print_r($_GET);  exit;
session_start();

$patient_id = $_GET['id'];



require("config.php");




	$update ="DELETE FROM tbl_patient_details WHERE pid_patient_id = ".$patient_id;

	$updaterel ="DELETE FROM tbl_relationship_details WHERE rs_relation_patientid = ".$patient_id;
	mysql_query($updaterel);

	if(mysql_query($update))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Delete MyPatient", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Delete MyPatient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
 	//exit;

	$_SESSION['success'] = "Your Patient was Deleted successfully";

 header("Location:mypatientlist.php");

?>
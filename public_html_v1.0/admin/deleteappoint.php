<?php

session_start();
require("config.php");
$appointment_id = $_GET['id'];


$appdate = $_POST['appdate'];
// $patientname = $_POST['patientname'];
$appnotes = $_POST['notes'];


	$sqldel = "DELETE FROM tbl_appointment_details WHERE app_appointment_id =".$appointment_id;

	if(mysql_query($sqldel))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Appointment Deleted", "success" : "Yes","message" : "1" } }';
	    $_SESSION['success'] = "Your Appointment was Deleted successfully";
	}
	else
	{
		$json =  '{ "serviceresponse" : { "servicename" : "Appointment Deleted", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;
// 	exit;



header("Location:viewappionment.php");

?>
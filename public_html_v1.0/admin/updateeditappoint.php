<?php
// echo "<pre>";
//   print_r($_POST);
// print_r($_GET);  exit;

session_start();
require("config.php");
$app_id = $_GET['id'];


foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['appdate']) || trim($_POST['appdate'])=='')
	$_SESSION['error']['appdate'] = "Appointment Date - Required Field Can't be blank";

if(!isset($_POST['notes']) || trim($_POST['notes'])=='')
	$_SESSION['error']['notes'] = "Notes - Required Field Can't be blank";

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}



$appdate = $_POST['appdate'];
// $patientname = $_POST['patientname'];
$appnotes = $_POST['notes'];


	$editdetail ="UPDATE tbl_appointment_details SET app_appointment_date = '".$appdate."', app_appointment_note = '".$appnotes."' WHERE app_appointment_id =".$app_id; 

	if(mysql_query($editdetail))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Appointment Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Appointment Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

	$_SESSION['success'] = "Your Appointment was Updated successfully";
 }

header("Location:editappoint.php?id=".$app_id."&type=edit");

?>
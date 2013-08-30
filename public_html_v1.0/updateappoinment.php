<?php
// echo "<pre>";
//   print_r($_POST);  exit;



session_start();
require("config.php");


$remcheck = "SELECT * FROM tbl_patient_details WHERE pid_patient_username='".$_POST['patient']."';";

$sqlremcheck = mysql_query($remcheck);

$sqlpatient = mysql_fetch_array($sqlremcheck);



foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['appdate']) || trim($_POST['appdate'])=='')
	$_SESSION['require ']['appdate'] = "Appointment Date - Required Field Can't be blank";

if(!isset($_POST['appnotes']) || trim($_POST['appnotes'])=='')
	$_SESSION['require']['appnotes'] = "Notes - Required Field Can't be blank";

if(!isset($_POST['patient']) || trim($_POST['patient'])=='Select')
	$_SESSION['error']['patient'] = "Patient Name - Required option Can't be blank";



// exit;

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}



$appdate = $_POST['appdate'];
$patientname = $_POST['patient'];
$appnotes = $_POST['appnotes'];

$patient_id = $sqlpatient['pid_patient_id'];

	 $reminderdetail ="INSERT INTO tbl_appointment_details (app_appointment_date, app_appointment_note, app_appointment_patientname, app_appointment_patientid, app_appointment_status) VALUES ('".$appdate."', '".$appnotes."', '".$patientname."', '".$patient_id."', '1')";

	if(mysql_query($reminderdetail))
	{
		$json 		= '{ "serviceresponse" : { "servicename" : "Appointment Details", "success" : "Yes","message" : "1" } }';
		$_SESSION['success'] = "Your Appointment was submitted successfully";
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Appointment Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;


 }

header("Location:appoinment.php");

?>
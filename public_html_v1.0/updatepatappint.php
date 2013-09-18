<?php
// echo "<pre>";
// print_r($_GET);
// 
// print_r($_POST);  exit;

session_start();
require("config.php");

$dd = date('Y-m-d H:i:s');

$patient_id = $_GET['patid'];

$sql11 = "SELECT * FROM tbl_patient_details WHERE pid_patient_id = ".$patient_id;
$query11 = mysql_query($sql11);
$records11 = mysql_fetch_array($query11);

$patientname = $records11['pid_patient_username'];

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['appdatetime']) || trim($_POST['appdatetime'])=='')
	$_SESSION['error']['appdatetime'] = "Appointment Date - Required Field Can't be blank";

if(!isset($_POST['appdatetime']) || trim($_POST['appdatetime'])<$dd)
{
	$_SESSION['error']['appdatetime'] = "Appointment Date - Please select Correct time";
}

if(!isset($_POST['notes']) || trim($_POST['notes'])=='')
	$_SESSION['error']['notes'] = "Notes - Required Field Can't be blank";


if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}

// echo $patient_id; exit;

$appdate = $_POST['appdatetime'];


$appnotes = $_POST['notes'];



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
	//echo $json;
// 	exit;


 }

header("Location:patientdetails.php?id=".$patient_id);

?>
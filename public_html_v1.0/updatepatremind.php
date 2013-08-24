<?php
// echo "<pre>";
// print_r($_GET);
//   print_r($_POST);  exit;

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

if(!isset($_POST['remindername']) || trim($_POST['remindername'])=='')
	$_SESSION['error']['remindername'] = "Reminder Name - Required Field Can't be blank";

if($_POST['radio'] == 'Once')
{
	if(!isset($_POST['oncedate']) || trim($_POST['oncedate'])=='')
		$_SESSION['error']['oncedate'] = "Reminder Once - Required Field Can't be blank";
	
	if(!isset($_POST['oncedate']) || trim($_POST['oncedate'])<$dd)
		$_SESSION['error']['oncedate'] = "Reminder Once - Please Select Correct time";
}

if($_POST['radio'] == 'Daily')
{
	if( trim($_POST['dailytime'])=='Select Time' || trim($_POST['timeformat'])=='Select')
		$_SESSION['error']['dailytime'] = "Reminder Daily - Required Field Can't be blank";
}

if(!isset($_POST['radio']) || trim($_POST['radio'])=='')
	$_SESSION['error']['radio'] = "Reminder Type - Required Option Can't be blank";


if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}



$remindername = $_POST['remindername'];
$remindertype = $_POST['radio'];

$dailytime = $_POST['dailytime'];
$timeformat = $_POST['timeformat'];


if($remindertype == 'Once')
{
$datetime = $_POST['oncedate'];
}
else
{
$datetime = $dailytime.' '.$timeformat;

}

	$reminderdetail ="INSERT INTO tbl_reminder_details (rd_reminder_id, rd_reminder_name, rd_reminder_dateandtime, rd_reminder_type, rd_patient_id, rd_patient_name, rd_medicine_id, rd_assessment_id, rd_createdby, rd_reminder, rd_status) VALUES ('', '".$remindername."', '".$datetime."', '".$remindertype."', '".$patient_id."', '".$patientname."', '".$medicin_id."', '".$assessment_id."', 'Provider', 'Reminder', '1');";
	if(mysql_query($reminderdetail))
	{
		$json 		= '{ "serviceresponse" : { "servicename" : "Appointment Details", "success" : "Yes","message" : "1" } }';
		$_SESSION['success'] = "Your Reminder was Added successfully";
	}
	else
	{
		$json 		= '{ "serviceresponse" : { "servicename" : "Appointment Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;


 }

header("Location:patientdetails.php?id=".$patient_id);

?>
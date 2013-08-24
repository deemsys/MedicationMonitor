<?php
echo "<pre>";
  print_r($_POST);  exit;

session_start();
require("config.php");



foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['remindername']) || trim($_POST['remindername'])=='')
	$_SESSION['error']['remindername'] = "Reminder Name - Required Field Can't be blank";

elseif($avai == 1)
	$_SESSION['error']['remindername'] = "Reminder Name - Reminder Name Already Exist";

if(!isset($_POST['patient']) || trim($_POST['patient'])=='Select')
	$_SESSION['error']['patient'] = "Patient Name - Required option Can't be blank";

if(!isset($_POST['radio']) || trim($_POST['radio'])=='')
	$_SESSION['error']['radio'] = "Reminder Type - Required option Can't be blank";

if(trim($_POST['oncedate'])!='' && trim($_POST['dailydate'])!='')
	$_SESSION['error']['oncedate'] = "Date & Time - Required option any one";



if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}

	$assessmentsdetail ="INSERT INTO tbl_reminder_details (rd_reminder_id, rd_reminder_name, rd_reminder_dateandtime, rd_reminder_type, rd_patient_id, rd_medicine_id, rd_reminder) VALUES ('', '".$remindername."', '".$datetime."', '".$remindertype."', '".$sqlpatient['pid_patient_id']."', '".$medicin_id."', 'Reminder');"; 

	if(mysql_query($assessmentsdetail))
	{
// 		$row		= mysql_fetch_object($query);
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->ud_user_id.'","username" : "'.$row->ud_username.'","firstname" : "'.$row->ud_firstname.'","lastname" : "'.$row->ud_lastname.'","password" : "'.$row->ud_password.'","sex" : "'.$row->ud_sex.'","age" : "'.$row->ud_age.'","emailid" : "'.$row->ud_email_id.'","skypeid" : "'.$row->ud_skype_id.'","facetimeid" : "'.$row->ud_facetime_id.'","mobile" : "'.$row->ud_mobile.'","address" : "'.$row->ud_address.'","date" : "'.$row->ud_date.'","status" : "'.$row->ud_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "Assessment Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Assessment Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

// 	$_SESSION['success'] = "Your Reminder was submitted successfully";
 }

header("Location:assessment.php");

?>
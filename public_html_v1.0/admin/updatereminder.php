<?php
// echo "<pre>";
//   print_r($_POST);  exit;

session_start();
require("config.php");


$remcheck = "SELECT * FROM tbl_patient_details WHERE pid_patient_username='".$_POST['patient']."';";

$sqlremcheck = mysql_query($remcheck);

$sqlpatient = mysql_fetch_array($sqlremcheck);


$remname = "SELECT * FROM tbl_reminder_details WHERE rd_reminder_name='".$_POST['remindername']."';";

$sqlremname = mysql_query($remname);

$nameexist = mysql_fetch_array($sqlremname);

$avai = mysql_num_rows($sqlremname);

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['remindername']) || trim($_POST['remindername'])=='')
	$_SESSION['require']['remindername'] = "Reminder Name - Required Field Can't be blank";

elseif($avai == 1)
	$_SESSION['error']['remindername'] = "Reminder Name - Reminder Name Already Exist";

if(!isset($_POST['patient']) || trim($_POST['patient'])=='Select')
	$_SESSION['error']['patient'] = "Patient Name - Required option Can't be blank";

if(!isset($_POST['radio']) || trim($_POST['radio'])=='')
	$_SESSION['error']['radio'] = "Reminder Type - Required option Can't be blank";
if($_POST['radio'] == "Once")
{
	if(!isset($_POST['oncedate']) || trim($_POST['oncedate'])=='')
		$_SESSION['error']['oncedate'] = "Once Date - Required Field Can't be blank";
}
if($_POST['radio'] == "Daily"){
	if(!isset($_POST['dailytime']) || trim($_POST['dailytime'])=='Select Time')
		$_SESSION['error']['dailytime'] = "Daily Date - Required Option Can't be blank";
	if(!isset($_POST['timeformat']) || trim($_POST['timeformat'])=='Select')
		$_SESSION['error']['timeformat'] = "Daily Date - Select AM or PM";
}




if(trim($_POST['oncedate'])!='' && trim($_POST['dailydate'])!='')
	$_SESSION['error']['oncedate'] = "Date & Time - Required option any one";

// exit;

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}




$remindername = $_POST['remindername'];
$patientname = $_POST['patient'];
$remindertype = $_POST['radio'];
$medicineid = $_POST['Medicine'];
$dailytime = $_POST['dailytime'];
$timeformat = $_POST['timeformat'];
$patient_id = $sqlpatient['pid_patient_id'];


// echo $patientname; 

if($remindertype == 'Once')
{
$datetime = $_POST['oncedate'];
}
else
{
$datetime = $dailytime.' '.$timeformat;
// echo $datetime; exit;
// $datetime = $_POST['dailydate'];
}

	foreach( $_POST['Medicine'] as $medicine => $medicinevalue )
	{

		$medicin_id.=$medicinevalue.',';
	}

// $abc=trim($medicin_id, '/');
	foreach( $_POST['assessment'] as $assessment => $assessmentvalue )
	{

		$assessment_id.=$assessmentvalue.',';
	}


	$reminderdetail ="INSERT INTO tbl_reminder_details (rd_reminder_id, rd_reminder_name, rd_reminder_dateandtime, rd_reminder_type, rd_patient_id, rd_patient_name, rd_medicine_id, rd_assessment_id, rd_createdby, rd_reminder, rd_status) VALUES ('', '".$remindername."', '".$datetime."', '".$remindertype."', '".$patient_id."', '".$patientname."', '".$medicin_id."', '".$assessment_id."', 'Admin', 'Reminder', '1');";

	if(mysql_query($reminderdetail))
	{
// 		$row		= mysql_fetch_object($query);
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->ud_user_id.'","username" : "'.$row->ud_username.'","firstname" : "'.$row->ud_firstname.'","lastname" : "'.$row->ud_lastname.'","password" : "'.$row->ud_password.'","sex" : "'.$row->ud_sex.'","age" : "'.$row->ud_age.'","emailid" : "'.$row->ud_email_id.'","skypeid" : "'.$row->ud_skype_id.'","facetimeid" : "'.$row->ud_facetime_id.'","mobile" : "'.$row->ud_mobile.'","address" : "'.$row->ud_address.'","date" : "'.$row->ud_date.'","status" : "'.$row->ud_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "Reminder Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Reminder Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

	$_SESSION['success'] = "Your Reminder was submitted successfully";
 }

header("Location:reminders.php");

?>

<?php
// echo "<pre>";
//   print_r($_POST);
// print_r($_GET); exit;

session_start();
require("config.php");
$viewass_id = $_GET['id'];
$patient_id = $_GET['pat'];
$ass_id = $_GET['ass'];


foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['notes']) || trim($_POST['notes'])=='')
	$_SESSION['error']['notes'] = "Notes - Required Field Can't be blank";


if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}



$assnotes = $_POST['notes'];


	$editdetail ="UPDATE tbl_viewassessment_details SET vd_viewass_providernotes = '".$assnotes."' WHERE vd_viewass_id ='".$viewass_id."'";

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

	$_SESSION['success'] = "Your Notes was Updated successfully";
 }

header("Location:viewpatassessment.php?id=".$patient_id."&type=".$ass_id);

?>
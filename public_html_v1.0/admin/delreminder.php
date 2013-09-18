<?php
// echo "<pre>";
// print_r($_POST);
//   print_r($_GET);  exit;
session_start();

$reminder_id = $_REQUEST['id'];
// echo $reminder_id; exit;


require("config.php");




	$update ="DELETE FROM tbl_reminder_details WHERE rd_reminder_id = ".$reminder_id;


	if(mysql_query($update))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Delete Reminder", "success" : "Yes","message" : "1" } }';
	    $_SESSION['success'] = "Your Reminder was Deleted successfully";
	}
	else
	{
		$json =  '{ "serviceresponse" : { "servicename" : "Delete Reminder", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;
 	//exit;



 header("Location:viewreminder.php");

?>
<?php
// echo "<pre>";
// print_r($_POST);
//   print_r($_GET);  exit;
session_start();

$provider_id = $_GET['id'];



require("config.php");




	$update ="DELETE FROM tbl_user_details WHERE ud_user_id = ".$provider_id;
 
	if(mysql_query($update))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Delete MyPatient", "success" : "Yes","message" : "1" } }';
     	$_SESSION['success'] = "Provider was Deleted successfully";
	}
	else
	{
		$json =  '{ "serviceresponse" : { "servicename" : "Delete MyPatient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;
 	//exit;

	

 header("Location:providerlist.php");

?>
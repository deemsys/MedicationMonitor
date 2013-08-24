<?php

session_start();
require("config.php");


foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['currpswd']) || trim($_POST['currpswd'])=='')
	$_SESSION['error']['currpswd'] = "Current Password - Required Field Can't be blank";


if(!isset($_POST['pswd']) || trim($_POST['pswd'])=='')
	$_SESSION['error']['pswd'] = "Password - Required Field Can't be blank";

if(!isset($_POST['cpswd']) || trim($_POST['cpswd'])=='')
	$_SESSION['error']['cpswd'] = "Confirm Password - Required Field Can't be blank";

if(trim($_POST['pswd'])!= trim($_POST['cpswd']))
	$_SESSION['error']['pswd'] = "Password - Password and Confirm Password are not match";


$currpswd = md5($_POST['currpswd']);
$password = md5($_POST['pswd']);


$usercheck = "SELECT * FROM tbl_admin_details WHERE md_admin_id=".$_SESSION['adminid'];

$sqlcheck = mysql_query($usercheck);

$reccheck = mysql_fetch_array($sqlcheck);

$pswd = $reccheck['md_password'];

	if($pswd != $currpswd)
	{
		$_SESSION['error']['currpswd'] = "Current Password - Current Password is wrong";
	}




if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}


// echo $currpswd; exit;


	$changepswd ="UPDATE tbl_admin_details SET md_password = '".$password."' WHERE md_admin_id = ".$_SESSION['adminid'];

	if(mysql_query($changepswd))
	{
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->ud_user_id.'","username" : "'.$row->ud_username.'","firstname" : "'.$row->ud_firstname.'","lastname" : "'.$row->ud_lastname.'","password" : "'.$row->ud_password.'","sex" : "'.$row->ud_sex.'","age" : "'.$row->ud_age.'","emailid" : "'.$row->ud_email_id.'","skypeid" : "'.$row->ud_skype_id.'","facetimeid" : "'.$row->ud_facetime_id.'","mobile" : "'.$row->ud_mobile.'","address" : "'.$row->ud_address.'","date" : "'.$row->ud_date.'","status" : "'.$row->ud_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "Change Password", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Change Password", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

	$_SESSION['success'] = "Your Password was Changed successfully";
}

header("Location:changepswd.php");

?>
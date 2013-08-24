<?php
// echo "<pre>";
//   print_r($_POST); 
// print_r($_GET); exit;
session_start();
require("config.php");

$admin_id = $_GET['id'];

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}



if(!isset($_POST['fname']) || trim($_POST['fname'])=='')
	$_SESSION['error']['fname'] = "First Name - Required Field Can't be blank";

// if(!isset($_POST['lname']) || trim($_POST['lname'])=='')
// 	$_SESSION['error']['lname'] = "Last Name - Required Field Can't be blank";



// if(!isset($_POST['age']) || trim($_POST['age'])=='')
// 	$_SESSION['error']['age'] = "Age - Required Field Can't be blank";

if(!isset($_POST['email']) || trim($_POST['email'])=='')
	$_SESSION['error']['email'] = "Email Id - Required Field Can't be blank";

elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$_POST['email']))
	$_SESSION['error']['email'] = "E-Mail - Enter the Valid E-mail format";

/*
if(!isset($_POST['skype']) || trim($_POST['skype'])=='')
	$_SESSION['error']['skype'] = "Skype Id - Required Field Can't be blank";

if(!isset($_POST['facetime']) || trim($_POST['facetime'])=='')
	$_SESSION['error']['facetime'] = "Facetime Id - Required Field Can't be blank";*/

if(!isset($_POST['mobile']) || trim($_POST['mobile'])=='')
	$_SESSION['error']['mobile'] = "Mobile - Required Field Can't be blank";

elseif(!eregi("^([0-9])+$",$_POST['mobile']))
	$_SESSION['error']['mobile'] = "Mobile - Only Allowed Numbers";

// elseif(strlen($_POST['mobile'])!=10)
// 	$_SESSION['error']['mobile'] = "Mobile - Enter Valid Mobile Number";

if(!isset($_POST['add1']) || trim($_POST['add1'])=='')
	$_SESSION['error']['add1'] = "Address 1 - Required Field Can't be blank";

if(!isset($_POST['add2']) || trim($_POST['add2'])=='')
	$_SESSION['error']['add2'] = "Address 2 - Required Field Can't be blank";

if(!isset($_POST['state']) || trim($_POST['state'])=='')
	$_SESSION['error']['state'] = "State - Required Field Can't be blank";

if(!isset($_POST['city']) || trim($_POST['city'])=='')
	$_SESSION['error']['city'] = "City - Required Field Can't be blank";


if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}





$firstname = $_POST['fname'];
$lastname = $_POST['lname'];

$age = $_POST['age'];
$email = $_POST['email'];
$skype = $_POST['skype'];

$facetime = $_POST['facetime'];
$mobile = $_POST['mobile'];
$address1 = $_POST['add1'];
$address2 = $_POST['add2'];
$state = $_POST['state'];
$city = $_POST['city'];

//  echo $password; exit;
	$userdetail = "UPDATE tbl_admin_details SET  md_firstname = '".$firstname."', md_lastname = '".$lastname."', md_email_id = '".$email."', md_skype_id = '".$skype."', md_facetime_id = '".$facetime."', md_mobile = '".$mobile."', md_address1 = '".$address1."', md_address2 = '".$address2."', md_state = '".$state."', md_city = '".$city."' WHERE md_admin_id =".$admin_id; 




// echo $count; exit;
	if(mysql_query($userdetail))
	{
		$row		= mysql_fetch_object($query);
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->md_user_id.'","username" : "'.$row->md_username.'","firstname" : "'.$row->md_firstname.'","lastname" : "'.$row->md_lastname.'","password" : "'.$row->md_password.'","sex" : "'.$row->md_sex.'","age" : "'.$row->md_age.'","emailid" : "'.$row->md_email_id.'","skypeid" : "'.$row->md_skype_id.'","facetimeid" : "'.$row->md_facetime_id.'","mobile" : "'.$row->md_mobile.'","address" : "'.$row->md_address.'","date" : "'.$row->md_date.'","status" : "'.$row->md_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "Update Provider Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Update Provider Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

	$_SESSION['success'] = "Your Account Details was Updated successfully";
}

header("Location:myaccount.php");

?>
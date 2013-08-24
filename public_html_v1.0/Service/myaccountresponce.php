<?php

session_start();

require("../config.php");

$username = $_POST['username'];
$password = md5( $_POST['pswd']);
	
$case = $_REQUEST['service'];

switch($case){

	case 'myaccout':{

		$provider_id = $_GET['id'];
		
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

		$userdetail = "UPDATE tbl_user_details SET  ud_firstname = '".$firstname."', ud_lastname = '".$lastname."', ud_email_id = '".$email."', ud_skype_id = '".$skype."', ud_facetime_id = '".$facetime."', ud_mobile = '".$mobile."', ud_address1 = '".$address1."', ud_address2 = '".$address2."', ud_state = '".$state."', ud_city = '".$city."' WHERE ud_user_id =".$provider_id; 
	
		if(mysql_query($userdetail))
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Provider Myaccount Details", "success" : "Yes","message" : "1" } }';
		}
		else
		{
			echo '{ "serviceresponse" : { "servicename" : "Provider Myaccount Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;

		break;
	}

	case 'changepswd':{

		$currpswd = md5($_POST['currpswd']);
		$password = md5($_POST['pswd']);

		$changepswd ="UPDATE tbl_user_details SET ud_password = '".$password."' WHERE ud_user_id = ".$_SESSION['userid'];
	
		if(mysql_query($changepswd))
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Change Password", "success" : "Yes","message" : "1" } }';
		}else{
			echo '{ "serviceresponse" : { "servicename" : "Change Password", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;

		break;
	}

}

exit;


?>

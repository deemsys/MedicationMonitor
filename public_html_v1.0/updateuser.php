<?php
// echo "<pre>";
//   print_r($_POST);  exit;

session_start();
require("config.php");

$uname = $_POST['username'];

$usercheck = "SELECT * FROM tbl_user_details WHERE ud_username='$uname'";

$sqlcheck = mysql_query($usercheck);

$avai = mysql_num_rows($sqlcheck);

// echo $avai; exit;

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['username']) || trim($_POST['username'])=='')
	$_SESSION['require']['username'] = "User Name - Required Field Can't be blank";

elseif($avai == 1)
	$_SESSION['error']['username'] = "User Name - User Name Already Exist";

if(!isset($_POST['fname']) || trim($_POST['fname'])=='')
	$_SESSION['require']['fname'] = "First Name - Required Field Can't be blank";

// if(!isset($_POST['lname']) || trim($_POST['lname'])=='')
// 	$_SESSION['error']['lname'] = "Last Name - Required Field Can't be blank";

if(!isset($_POST['pswd']) || trim($_POST['pswd'])=='')
	$_SESSION['require']['pswd'] = "Password - Required Field Can't be blank";

if(!isset($_POST['cpswd']) || trim($_POST['cpswd'])=='')
	$_SESSION['require']['cpswd'] = "Confirm Password - Required Field Can't be blank";

if(trim($_POST['pswd'])!= trim($_POST['cpswd']))
	$_SESSION['error']['pswd'] = "Password - Password and Confirm Password are not match";

if(!isset($_POST['sex']) || trim($_POST['sex'])=='')
	$_SESSION['error']['sex'] = "Sex - Required Field Can't be blank";

if(!isset($_POST['age']) || trim($_POST['age'])=='Select Age')
	$_SESSION['error']['age'] = "Age - Required Field Can't be blank";

if(!isset($_POST['email']) || trim($_POST['email'])=='')
	$_SESSION['require']['email'] = "Email Id - Required Field Can't be blank";

elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$_POST['email']))
	$_SESSION['error']['email'] = "E-Mail - Enter the Valid E-mail format";


if(!isset($_POST['skype']) || trim($_POST['skype'])=='')
	$_SESSION['error']['skype'] = "Skype Id - Required Field Can't be blank";

if(!isset($_POST['facetime']) || trim($_POST['facetime'])=='')
	$_SESSION['error']['facetime'] = "Facetime Id - Required Field Can't be blank";

if(!isset($_POST['mobile']) || trim($_POST['mobile'])=='')
	$_SESSION['require']['mobile'] = "Mobile - Required Field Can't be blank";

elseif(!eregi("^([0-9])+$",$_POST['mobile']))
	$_SESSION['error']['mobile'] = "Mobile - Only Allowed Numbers";

elseif(strlen($_POST['mobile'])!=10)
	$_SESSION['error']['mobile'] = "Mobile - Enter Valid Mobile Number";

if(!isset($_POST['address']) || trim($_POST['address'])=='')
	$_SESSION['require']['address'] = "Address - Required Field Can't be blank";



if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}




$username = $_POST['username'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$password = md5($_POST['pswd']);

$sex = $_POST['sex'];
$age = $_POST['age'];
$email = $_POST['email'];
$skype = $_POST['skype'];

$facetime = $_POST['facetime'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];

//  echo $password; exit;

	$userdetail ="INSERT INTO tbl_user_details (ud_user_id, ud_firstname, ud_lastname, ud_username, ud_password, ud_sex, ud_age, ud_email_id, ud_skype_id, ud_facetime_id, ud_mobile, ud_address, ud_date, ud_status, ud_provider) VALUES ('', '".$firstname."', '".$lastname."', '".$username."', '".$password."', '".$sex."', '".$age."', '".$email."', '".$skype."', '".$facetime."', '".$mobile."', '".$address."', NOW(), '1', 'Provider');"; 

	$query = mysql_query("select * from tbl_user_details where ud_user_id ='".$_REQUEST['ud_user_id']."' limit 1");

	$count = mysql_num_rows($query);

// echo $count; exit;
	if(mysql_query($userdetail))
	{
		$row		= mysql_fetch_object($query);
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->ud_user_id.'","username" : "'.$row->ud_username.'","firstname" : "'.$row->ud_firstname.'","lastname" : "'.$row->ud_lastname.'","password" : "'.$row->ud_password.'","sex" : "'.$row->ud_sex.'","age" : "'.$row->ud_age.'","emailid" : "'.$row->ud_email_id.'","skypeid" : "'.$row->ud_skype_id.'","facetimeid" : "'.$row->ud_facetime_id.'","mobile" : "'.$row->ud_mobile.'","address" : "'.$row->ud_address.'","date" : "'.$row->ud_date.'","status" : "'.$row->ud_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "User Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

	$_SESSION['success'] = "Your Application was submitted successfully";
}

header("Location:register.php");

?>
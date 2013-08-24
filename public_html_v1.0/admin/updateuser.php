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
	$_SESSION['error']['username'] = "User Name - Required Field Can't be blank";

elseif($avai == 1)
	$_SESSION['error']['username'] = "User Name - User Name Already Exist";

if(!isset($_POST['fname']) || trim($_POST['fname'])=='')
	$_SESSION['error']['fname'] = "First Name - Required Field Can't be blank";

// if(!isset($_POST['lname']) || trim($_POST['lname'])=='')
// 	$_SESSION['error']['lname'] = "Last Name - Required Field Can't be blank";

if(!isset($_POST['pswd']) || trim($_POST['pswd'])=='')
	$_SESSION['error']['pswd'] = "Password - Required Field Can't be blank";

if(!isset($_POST['cpswd']) || trim($_POST['cpswd'])=='')
	$_SESSION['error']['cpswd'] = "Confirm Password - Required Field Can't be blank";

if(trim($_POST['pswd'])!= trim($_POST['cpswd']))
	$_SESSION['error']['pswd'] = "Password - Password and Confirm Password are not match";

if(!isset($_POST['sex']) || trim($_POST['sex'])=='')
	$_SESSION['error']['sex'] = "Sex - Required Option Can't be blank";

if(!isset($_POST['age']) || trim($_POST['age'])=='Select Age')
	$_SESSION['error']['age'] = "Age - Required Field Can't be blank";

if(!isset($_POST['email']) || trim($_POST['email'])=='')
	$_SESSION['error']['email'] = "Email Id - Required Field Can't be blank";

elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$_POST['email']))
	$_SESSION['error']['email'] = "E-Mail - Enter the Valid E-mail format";


// if(!isset($_POST['skype']) || trim($_POST['skype'])=='')
// 	$_SESSION['error']['skype'] = "Skype Id - Required Field Can't be blank";
// 
// if(!isset($_POST['facetime']) || trim($_POST['facetime'])=='')
// 	$_SESSION['error']['facetime'] = "Facetime Id - Required Field Can't be blank";

if(!isset($_POST['mobile']) || trim($_POST['mobile'])=='')
	$_SESSION['error']['mobile'] = "Mobile - Required Field Can't be blank";

elseif(!eregi("^([0-9])+$",$_POST['mobile']))
	$_SESSION['error']['mobile'] = "Mobile - Only Allowed Numbers";

elseif(strlen($_POST['mobile'])!=10)
 	$_SESSION['error']['mobile'] = "Mobile - Enter Valid Mobile Number";

if(!isset($_POST['address1']) || trim($_POST['address1'])=='')
	$_SESSION['error']['address1'] = "Address 1 - Required Field Can't be blank";

if(!isset($_POST['country']) || trim($_POST['country'])=='Select Country')
	$_SESSION['error']['country'] = "Country - Required Option Can't be blank";

if(!isset($_POST['state']) || trim($_POST['state'])=='')
	$_SESSION['error']['state'] = "State - Required Field Can't be blank";

elseif(!preg_match("/^[[a-z]+[\s\_\-\.]*[a-z]*[\.]*[a-z]*]*$/i",$_POST['state']))
	$_SESSION['error']['state'] = "State - Only Allowed Alphabets";
	
if(!isset($_POST['city']) || trim($_POST['city'])=='')
	$_SESSION['error']['city'] = "City - Required Field Can't be blank";

elseif(!preg_match("/^[[a-z]+[\s\_\-\.]*[a-z]*[\.]*[a-z]*]*$/i",$_POST['city']))
	$_SESSION['error']['city'] = "City - Only Allowed Alphabets";
	
if(!isset($_POST['zipcode']) || trim($_POST['zipcode'])=='')
	$_SESSION['error']['zipcode'] = "Zipcode - Required Field Can't be blank";
	
elseif(!preg_match("/^(\d{5})(?:[-\s]*(\d{4}))?$/",$_POST['zipcode']))
	$_SESSION['error']['zipcode'] = "Zipcode - Enter Valid Zip Code";

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
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$zipcode = $_POST['zipcode'];

//  echo $password; exit;

	$userdetail ="INSERT INTO tbl_user_details (ud_user_id, ud_firstname, ud_lastname, ud_username, ud_password, ud_sex, ud_age, ud_email_id, ud_skype_id, ud_facetime_id, ud_mobile, ud_address1, ud_address2, ud_country, ud_state, ud_city, ud_zipcode, ud_date, ud_status, ud_provider) VALUES ('', '".$firstname."', '".$lastname."', '".$username."', '".$password."', '".$sex."', '".$age."', '".$email."', '".$skype."', '".$facetime."', '".$mobile."', '".$address1."', '".$address2."', '".$country."', '".$state."', '".$city."', '".$zipcode."', NOW(), '1', 'Provider');"; 
// 	mysql_query($userdetail);
// 	$insert_id = mysql_insert_id();

// 	$userdetail = "INSERT INTO tbl_relationship_details (rs_relation_patientid, rs_relation_providerid, rs_relation_status) VALUES ('0', '".$insert_id."', '0')";

	if(mysql_query($userdetail))
	{
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
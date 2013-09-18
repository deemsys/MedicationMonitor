<?php
// echo "<pre>";
//   print_r($_POST); 
// print_r($_GET); exit;
session_start();
require("config.php");


//Added by suresh
$mobile = $_POST['mobile'];

$mobcheck = "SELECT * FROM tbl_patient_details WHERE pid_patient_mobile='$mobile'";

$sqlcheck_mob = mysql_query($mobcheck);

$sqlpatient_mob = mysql_fetch_array($sqlcheck_mob);

$avai_mob = mysql_num_rows($sqlcheck_mob);
//End









$patient_id = $_GET['id'];

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}



if(!isset($_POST['fname']) || trim($_POST['fname'])=='')
	$_SESSION['error']['fname'] = "First Name - Required Field Can't be blank";

// if(!isset($_POST['lname']) || trim($_POST['lname'])=='')
// 	$_SESSION['error']['lname'] = "Last Name - Required Field Can't be blank";


/*
if(!isset($_POST['age']) || trim($_POST['age'])=='')
	$_SESSION['error']['age'] = "Age - Required Field Can't be blank";*/

if(!isset($_POST['email']) || trim($_POST['email'])=='')
	$_SESSION['error']['email'] = "Email Id - Required Field Can't be blank";

elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",$_POST['email']))
	$_SESSION['error']['email'] = "E-Mail - Enter the Valid E-mail format";

/*
if(!isset($_POST['skype']) || trim($_POST['skype'])=='')
	$_SESSION['error']['skype'] = "Skype Id - Required Field Can't be blank";

if(!isset($_POST['facetime']) || trim($_POST['facetime'])=='')
	$_SESSION['error']['facetime'] = "Facetime Id - Required Field Can't be blank";*/

if(!isset($_POST['mobile']) || trim($_POST['mobile'])=='')
    $_SESSION['error']['mobile'] = "Mobile - Required Field Can't be blank";
elseif(!preg_match("/^([7-9]{1})([0-9]{9})$/i",$_POST['mobile']))
    $_SESSION['error']['mobile'] = "Mobile - Invalid Mobile Number";

// elseif(strlen($_POST['mobile'])!=10)
// 	$_SESSION['error']['mobile'] = "Mobile - Enter Valid Mobile Number";

if(!isset($_POST['add1']) || trim($_POST['add1'])=='')
	$_SESSION['error']['add1'] = "Address 1 - Required Field Can't be blank";


if(!isset($_POST['sex']) || trim($_POST['sex'])=='')
    $_SESSION['error']['sex'] = "Sex - Required Field Can't be blank";

if(!isset($_POST['country']) || trim($_POST['country'])=='Select Country')
    $_SESSION['error']['country'] = "Country - Required Option Can't be blank";



if(!isset($_POST['age']) || trim($_POST['age'])=='Select Age')
    $_SESSION['error']['age'] = "Age - Required Option Can't be blank";
// if(!isset($_POST['add2']) || trim($_POST['add2'])=='')
// 	$_SESSION['error']['add2'] = "Address 2 - Required Field Can't be blank";

if(!isset($_POST['state']) || trim($_POST['state'])=='')
	$_SESSION['error']['state'] = "State - Required Field Can't be blank";

elseif(!preg_match("/^[[a-z]+[\s\_\-\.]*[a-z]*[\.]*[a-z]*]*$/i",$_POST['state']))
	$_SESSION['error']['state'] = "State - Only Allowed Alphabets";


if(!isset($_POST['city']) || trim($_POST['city'])=='')
	$_SESSION['error']['city'] = "City - Required Field Can't be blank";

elseif(!preg_match("/^[[a-z]+[\s\_\-\.]*[a-z]*[\.]*[a-z]*]*$/i",$_POST['city']))
	$_SESSION['error']['city'] = "City - Only Allowed Alphabets ";

if(!isset($_POST['zipcode']) || trim($_POST['zipcode'])=='')
    $_SESSION['error']['zipcode'] = "Postal Code- Required Field Can't be blank";
elseif(!preg_match("/^[0-9]/i",$_POST['zipcode']))
    $_SESSION['error']['zipcode'] = "Postal Code- Only accept Numbers";

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
    $country=$_POST['country'];
$city = $_POST['city'];

//  echo $password; exit;
	$userdetail = "UPDATE tbl_patient_details SET  pid_patient_firstname = '".$firstname."', pid_patient_lastname = '".$lastname."', pid_patient_age = '".$age."', pid_patient_emailid = '".$email."', pid_patient_skypeid = '".$skype."', pid_patient_facetimeid = '".$facetime."', pid_patient_mobile = '".$mobile."', pid_patient_address1 = '".$address1."', pid_patient_address2 = '".$address2."', pid_patient_state = '".$state."', pid_patient_city = '".$city."',pid_patient_country='".$country."' WHERE pid_patient_id =".$patient_id;




// echo $count; exit;
	if(mysql_query($userdetail))
	{
	//	$row		= mysql_fetch_object($query);
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->ud_user_id.'","username" : "'.$row->ud_username.'","firstname" : "'.$row->ud_firstname.'","lastname" : "'.$row->ud_lastname.'","password" : "'.$row->ud_password.'","sex" : "'.$row->ud_sex.'","age" : "'.$row->ud_age.'","emailid" : "'.$row->ud_email_id.'","skypeid" : "'.$row->ud_skype_id.'","facetimeid" : "'.$row->ud_facetime_id.'","mobile" : "'.$row->ud_mobile.'","address" : "'.$row->ud_address.'","date" : "'.$row->ud_date.'","status" : "'.$row->ud_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "Update Patient Details", "success" : "Yes","message" : "1" } }';
        $_SESSION['success'] = "Your Patient Details was Updated successfully";
	
	}
	else
	{
		//echo '{ "serviceresponse" : { "servicename" : "Update Patient Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;
// 	exit;

	
}

header("Location:patientdetails.php?id=".$patient_id);

?>
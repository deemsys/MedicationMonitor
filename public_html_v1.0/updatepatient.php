<?php
// echo "<pre>";
//   print_r($_POST); exit;

session_start();
require("config.php");

$uname = $_POST['username'];

$usercheck = "SELECT * FROM tbl_patient_details WHERE pid_patient_username='$uname'";

$sqlcheck = mysql_query($usercheck);

$sqlpatient = mysql_fetch_array($sqlcheck);

$avai = mysql_num_rows($sqlcheck);

// echo $avai; exit;
//Added by suresh
$mobile = $_POST['mobile'];

$mobcheck = "SELECT * FROM tbl_patient_details WHERE pid_patient_mobile='$mobile'";

$sqlcheck_mob = mysql_query($mobcheck);

$sqlpatient_mob = mysql_fetch_array($sqlcheck_mob);

$avai_mob = mysql_num_rows($sqlcheck_mob);
//End


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
	$_SESSION['error']['sex'] = "Sex - Required Field Can't be blank";

if(!isset($_POST['age']) || trim($_POST['age'])=='Select Age')
	$_SESSION['error']['age'] = "Age - Required Option Can't be blank";

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
elseif(!eregi("^([7-9]{1})([0-9]{9})$",$_POST['mobile']))
	$_SESSION['error']['mobile'] = "Mobile - Invalid Mobile Number";
elseif($avai_mob>=1)
    $_SESSION['error']['mobile']="Mobile - Mobile number already exists";

// elseif(strlen($_POST['mobile'])!=10)
// 	$_SESSION['error']['mobile'] = "Mobile - Enter Valid Mobile Number";

if(!isset($_POST['address1']) || trim($_POST['address1'])=='')
	$_SESSION['error']['address1'] = "Address 1 - Required Field Can't be blank";

if(!isset($_POST['country']) || trim($_POST['country'])=='Select Country')
	$_SESSION['error']['country'] = "Country - Required Option Can't be blank";

if(!isset($_POST['state']) || trim($_POST['state'])=='')
	$_SESSION['error']['state'] = "State - Required Field Can't be blank";
elseif(!eregi("[A-Za-z]", $_POST['state']))
    $_SESSION['error']['state']='State - Only accept alphabets';


if(!isset($_POST['city']) || trim($_POST['city'])=='')
	$_SESSION['error']['city'] = "City - Required Field Can't be blank";
elseif(!ereg("[A-Za-z]", $_POST['city']))
    $_SESSION['error']['city']='City - Only accept alphabets';

if(!isset($_POST['zipcode']) || trim($_POST['zipcode'])=='')
	$_SESSION['error']['zipcode'] = "Zipcode - Required Field Can't be blank";
elseif(!eregi("^[0-9]",$_POST['zipcode']))
    $_SESSION['error']['zipcode'] = "Zipcode - Only accept Numbers";

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}



$refuserid = $_POST['userid'];
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

	$userdetail ="INSERT INTO tbl_patient_details (pid_patient_id, pid_patient_firstname, pid_patient_lastname, pid_patient_username, pid_patient_password, pid_patient_sex, pid_patient_age, pid_patient_emailid, pid_patient_skypeid, pid_patient_facetimeid, pid_patient_mobile, pid_patient_address1, pid_patient_address2, pid_patient_country, pid_patient_state, pid_patient_city, pid_patient_zipcode, pid_patient_date, pid_patient_status, pid_provider_userid, pid_patient) VALUES ('', '".$firstname."', '".$lastname."', '".$username."', '".$password."', '".$sex."', '".$age."', '".$email."', '".$skype."', '".$facetime."', '".$mobile."', '".$address1."', '".$address2."', '".$country."', '".$state."', '".$city."', '".$zipcode."', NOW(), 'suspend', '".$refuserid."', 'Patient');"; 
	mysql_query($userdetail);
	$indipat_id = mysql_insert_id();

	$patmed = "INSERT INTO tbl_patientmedication_details (pm_patient_patientname, pm_patient_patientid, pm_patient_providerid, pm_patient_medicineid, pm_patient_assessmentid, pm_patient_reminderid, pm_patient_appointmentid, pm_patientmedication_status) VALUES ('".$username."', '".$indipat_id."', '".$refuserid."', '', '', '', '', '1');";
	mysql_query($patmed);

//	$assignassessment ="INSERT INTO tbl_patientassessment_details (pa_patientassessment_patname, pa_patientassessment_patid, pa_patientassessment_providerid, pa_patientassessment_assid, pa_patientassessment_status) VALUES ('".$username."', '".$indipat_id."', '0', '1', '1'),('".$username."', '".$indipat_id."', '0', '3', '1');";
//	mysql_query($assignassessment);


	$relation = "INSERT INTO tbl_relationship_details (rs_relation_patientid, rs_relation_providerid, rs_relation_status) VALUES ('".$indipat_id."', '".$refuserid."', '1')";

	if(mysql_query($relation))
	{

		echo '{ "serviceresponse" : { "servicename" : "Patient Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Patient Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
//  	exit;

	$_SESSION['success'] = "Your patient was registered successfully";
        header("Location:Patientregister.php");
        exit;
}

header("Location:Patientregister.php");

?>
<?php

session_start();

require("../config.php");


	
$case = $_REQUEST['service'];

switch($case){

	case 'patinsert':{

//		$refuserid = $_POST['userid'];
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

		$sql = "SELECT * FROM tbl_patient_details WHERE pid_patient_username ='".$username."'";
		$count = mysql_num_rows(mysql_query($sql));

		if($count > 0)
		{
				$json	= '{ "serviceresponse" : { "servicename" : "Signup", "success" : "No", "username" : "NULL",  "message" : "Already Exist" } }';
		}
		else
		{
			$userdetail ="INSERT INTO tbl_patient_details (pid_patient_id, pid_patient_firstname, pid_patient_lastname, pid_patient_username, pid_patient_password, pid_patient_sex, pid_patient_age, pid_patient_emailid, pid_patient_skypeid, pid_patient_facetimeid, pid_patient_mobile, pid_patient_address1, pid_patient_address2, pid_patient_country, pid_patient_state, pid_patient_city, pid_patient_zipcode, pid_patient_date, pid_patient_status, pid_provider_userid, pid_patient) VALUES ('', '".$username."', '".$lastname."', '".$username."', '".$password."', '".$sex."', '".$age."', '".$email."', '".$skype."', '".$facetime."', '".$mobile."', '".$address1."', '".$address2."', '".$country."', '".$state."', '".$city."', '".$zipcode."', NOW(), 'suspend', '0', 'Patient');";
	
			mysql_query($userdetail);
			$indipat_id = mysql_insert_id();
	
			$patmed = "INSERT INTO tbl_patientmedication_details (pm_patient_patientname, pm_patient_patientid, pm_patient_providerid, pm_patient_medicineid, pm_patient_assessmentid, pm_patient_reminderid, pm_patient_appointmentid, pm_patientmedication_status) VALUES ('".$username."', '".$indipat_id."', '0', '', '', '', '', '1')";
// 			mysql_query($patmed);

//			$assignassessment ="INSERT INTO tbl_patientassessment_details (pa_patientassessment_patname, pa_patientassessment_patid, pa_patientassessment_providerid, pa_patientassessment_assid, pa_patientassessment_status) VALUES ('".$username."', '".$indipat_id."', '0', '1', '1'),('".$username."', '".$indipat_id."', '0', '3', '1');";
//			mysql_query($assignassessment);

			if(mysql_query($patmed))
			{
				$json	= '{ "serviceresponse" : { "servicename" : "Signup", "success" : "Yes", "message" : "1" } }';
			}
			else
			{
				$json	= '{ "serviceresponse" : { "servicename" : "Signup", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
		}
		echo $json;

		break;

	}

	case 'patedit':{

		$patient_id = $_GET['id'];
		
		
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

		$userdetail = "UPDATE tbl_patient_details SET  pid_patient_firstname = '".$firstname."', pid_patient_lastname = '".$lastname."', pid_patient_age = '".$age."', pid_patient_emailid = '".$email."', pid_patient_skypeid = '".$skype."', pid_patient_facetimeid = '".$facetime."', pid_patient_mobile = '".$mobile."', pid_patient_address1 = '".$address1."', pid_patient_address2 = '".$address2."', pid_patient_state = '".$state."', pid_patient_city = '".$city."' WHERE pid_patient_id =".$patient_id;
		
		if(mysql_query($userdetail))
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Update MyPatient Details", "success" : "Yes","message" : "1" } }';
		}
		else
		{
			$json 		=  '{ "serviceresponse" : { "servicename" : "Update MyPatient Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;

		break;
	}

	case 'patdelete':{

		$patient_id = $_GET['id'];

		$update ="DELETE FROM tbl_patient_details WHERE pid_patient_id = ".$patient_id;
	
		if(mysql_query($update))
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Delete MyPatient", "success" : "Yes","message" : "1" } }';
		}
		else
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Delete MyPatient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;

		break;
	}
}

exit;


?>

<?php
// echo "<pre>";
// print_r($_GET);
// print_r($_POST); exit;

session_start();
require("config.php");

$type = $_GET['type'];

switch($type){

	case 'medicine':{


		$patient_id1 = $_GET['patid'];	
		$medicine_id1 = $_GET['id'];

		$deletedetail = "DELETE FROM tbl_patientmedtaketime_details WHERE pmt_taketime_id = ".$medicine_id1;

			if(mysql_query($deletedetail)){
				$json 		= '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "Yes","message" : "1" } }';
			$_SESSION['success'] = "Assign Medicine was Deleted successfully";
            }
			else{
				$json  = '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
			//echo $json;

		
        $_SESSION["tab_active"]="medicine";
		header("Location:patientdetails.php?id=".$patient_id1);
	
		break;
	}

	case 'assessment':{

		$patient_id2 = $_GET['patid'];	
		$assessment_id2 = $_GET['id'];

		$deletedetail = "DELETE FROM tbl_patientassessment_details WHERE pa_patientassessment_patid = '".$patient_id2."' AND pa_patientassessment_id = ".$assessment_id2;

		if(mysql_query($deletedetail)){
				$json 		= '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "Yes","message" : "1" } }';
			    $_SESSION['success'] = "Assign Assessment was Deleted successfully";
            }
			else{
				$json =  '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
	//		echo $json;

		

        $_SESSION["tab_active"]="assessment";
		header("Location:patientdetails.php?id=".$patient_id2);
	
		break;
	}



	case 'reminder':{

		$patient_id3 = $_GET['patid'];	
		$reminder_id3 = $_GET['id'];

		$deletedetail = "DELETE FROM tbl_reminder_details WHERE rd_reminder_id = ".$reminder_id3;

		if(mysql_query($deletedetail)){
				$json 		= '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "Yes","message" : "1" } }';
			    $_SESSION['success'] = "Assign Reminder was Deleted successfully";
            }
			else{
				$json =  '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
			//echo $json;

		

        $_SESSION["tab_active"]="remainder";
		header("Location:patientdetails.php?id=".$patient_id3);
	
		break;
	}

	case 'appointment':{

		$patient_id4 = $_GET['patid'];	
		$appointment_id4 = $_GET['id'];

		$deletedetail = "DELETE FROM tbl_appointment_details WHERE app_appointment_id = ".$appointment_id4;

		if(mysql_query($deletedetail)){
				$json 		= '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "Yes","message" : "1" } }';
			$_SESSION['success'] = "Assign Appointment was Deleted successfully";
            }
			else{
				$json =  '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
			//echo $json;

			

        $_SESSION["tab_active"]="appointment";
		header("Location:patientdetails.php?id=".$patient_id4);
	
		break;
	}


exit;
}

?>
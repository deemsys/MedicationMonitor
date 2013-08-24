<?php
// echo "<pre>";
//   print_r($_POST);
//   print_r($_GET); exit;

session_start();
require("config.php");


$assessment = $_POST['assessment'];

$patient_id = $_GET['patid'];

$provider_id = $_POST['provider'];


	$sql11 = "SELECT * FROM tbl_patient_details WHERE pid_patient_id =".$patient_id;
	$records11 = mysql_fetch_array(mysql_query($sql11));
	 $patname = $records11['pid_patient_username'];


	foreach( $assessment as $assess => $assessmentvalue )
	{
 
		$assdetail ="INSERT INTO tbl_patientassessment_details (pa_patientassessment_patname, pa_patientassessment_patid, pa_patientassessment_providerid, pa_patientassessment_assid, pa_patientassessment_status) VALUES ('".$patname."', '".$patient_id."', '".$provider_id."', '".$assessmentvalue."', '1');";

		mysql_query($assdetail);

	}

	$_SESSION['success'] = "Your Assign Assessment was Added successfully";


header("Location:patientdetails.php?id=".$patient_id);

?>
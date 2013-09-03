<?php
// echo "<pre>";
//   print_r($_POST);
//   print_r($_GET); exit;

session_start();
require("config.php");


$assessment = $_POST['assessment'];

$patient_id = $_GET['patid'];

$provider_id = $_POST['provider'];

$noofcheckbox=$_POST['noofcheckbox'];

$avai=0;
	$sql11 = "SELECT * FROM tbl_patient_details WHERE pid_patient_id =".$patient_id;
	$records11 = mysql_fetch_array(mysql_query($sql11));
	 $patname = $records11['pid_patient_username'];

$SQL12="select * from tbl_patientassessment_details where pa_patientassessment_patid=".$patient_id;

$sqlcheck12 = mysql_query($SQL12);

$avai = mysql_num_rows($sqlcheck12);


$noofchecks=0;
	foreach( $assessment as $assess => $assessmentvalue )
	{
 
		$assdetail ="INSERT INTO tbl_patientassessment_details (pa_patientassessment_patname, pa_patientassessment_patid, pa_patientassessment_providerid, pa_patientassessment_assid, pa_patientassessment_status) VALUES ('".$patname."', '".$patient_id."', '".$provider_id."', '".$assessmentvalue."', '1');";

		mysql_query($assdetail);
        $noofchecks++;

	}

if($noofcheckbox>0&&$noofchecks>0)
{
	$_SESSION['success'] = "Your Assign Assessment was Added successfully";
}
elseif($avai==0)
{
    $_SESSION['error']['noass']="No Assessments assigned to this patient";
    unset($_SESSION['success']);
}



header("Location:patientdetails.php?id=".$patient_id);

?>
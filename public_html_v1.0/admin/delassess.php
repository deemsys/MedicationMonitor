<?php
// echo "<pre>";
// print_r($_POST);
//   print_r($_GET);  exit;
session_start();

$assess_id = $_GET['id'];

$assess_com = $assess_id.",";


require("config.php");




	$update ="DELETE FROM tbl_assessment_details WHERE ad_assessment_id = ".$assess_id;
	mysql_query($update);



	$updateass= "select replace(pm_patient_assessmentid,'".$assess_com."','') AS assessment,pm_patientmedication_id  FROM tbl_patientmedication_details WHERE FIND_IN_SET('".$assess_id."',pm_patient_assessmentid)>0";
 	$quer =mysql_query($updateass);

 	while($rec =mysql_fetch_array($quer))
	{

		$sql2 = "UPDATE tbl_patientmedication_details SET pm_patient_assessmentid = '".$rec['assessment']."' WHERE pm_patientmedication_id = ".$rec['pm_patientmedication_id'];
		$query2 = mysql_query($sql2);
	}


	if(mysql_query($update))
	{

		//$json 		= '{ "serviceresponse" : { "servicename" : "Delete Assessment", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
	//	echo '{ "serviceresponse" : { "servicename" : "Delete Assessment", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;
 	//exit;

	$_SESSION['success'] = "Your Assessment was Deleted successfully";

 header("Location:viewassessment.php");

?>
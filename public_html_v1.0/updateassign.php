<?php
echo "<pre>";
// print_r($_POST);
//   print_r($_GET);  exit;
session_start();

$asses_id = $_SESSION['assess_id'];

$ass_id = $_GET['id'];
$ass_type = $_GET['type'];
// echo $asses_id; exit;

$question_id = $_GET['id'];

require("config.php");



	$assname = $_POST['assignbypat'];

	$med=str_replace('/',',',$assname);

	$medexp = explode(",", $assname);
	$ss=count($medexp)-1;


	foreach( $_POST['assignbypat'] as $medicine => $medicinevalue )
	{

		$medicin_id.=$medicinevalue.',';
	}


if($ass_type != 'Patient')
{
	$update ="UPDATE tbl_assessment_details SET ad_assessment_reminderid = '".$medicin_id."' WHERE ad_assessment_id =".$ass_id;
}
else
{

	$update ="UPDATE tbl_assessment_details SET ad_assessment_patientid = '".$medicin_id."' WHERE ad_assessment_id =".$ass_id;
}
	if(mysql_query($update))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Delete Question", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Delete Question", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
 	//exit;

	$_SESSION['success'] = "Your Questions & Answers was Deleted successfully";

 header("Location:updatequestion.php?id=".$asses_id);

?>
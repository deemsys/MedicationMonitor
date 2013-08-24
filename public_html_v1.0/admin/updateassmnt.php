<?php
// echo "<pre>";
//   print_r($_POST);
// print_r($_SESSION);  exit;

session_start();
require("config.php");



$checkassnam = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_name = '".$_POST['assessment']."';"; 

$queryassnam = mysql_query($checkassnam);

$avai = mysql_num_rows($queryassnam);


foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['assessment']) || trim($_POST['assessment'])=='')
	$_SESSION['error']['assessment'] = "Assessment Name - Required Field Can't be blank";

if($avai == 1)
	$_SESSION['error']['asstype'] = "Assessment Name - Assessment Name Already Exist";

// if(!isset($_POST['asstype']) || trim($_POST['asstype'])=='')
// 	$_SESSION['error']['asstype'] = "Assessment Type - Required Option Can't be blank";
// 
// if(!isset($_POST['assignby']) || trim($_POST['assignby'])=='')
// 	$_SESSION['error']['assignby'] = "Assign By - Required Option Can't be blank";

if(!isset($_POST['question']) || trim($_POST['question'])=='')
	$_SESSION['error']['question'] = "Question - Required Field Can't be blank";

if(!isset($_POST['ansoption']) || trim($_POST['ansoption'])=='')
	$_SESSION['error']['ansoption'] = "Answer Option - Required Option Can't be blank";

if(!isset($_POST['Answer']['0']) || trim($_POST['Answer']['0'])=='')
	$_SESSION['error']['Answer1'] = "Answer1 - Required Field Can't be blank";

if(!isset($_POST['Answer']['1']) || trim($_POST['Answer']['1'])=='')
	$_SESSION['error']['Answer2'] = "Answer2 - Required Field Can't be blank";




if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{

		$_SESSION['values'][$key] = '';

	}
//  echo "yfty"; exit;

$assessment_name = $_POST['assessment'];
$assessment_type = $_POST['asstype'];
$question = $_POST['question'];
$answer_type = $_POST['ansoption'];
// $answer1 = $_POST['Answer1'];
// $answer2 = $_POST['Answer2'];

$assign_type = $_POST['assignby'];

if($assign_type == 'Patient')
{
	foreach( $_POST['assignbypat'] as $assignby => $assignbyvalue )
	{

		$assignbypat_id.=$assignbyvalue.',';
	}
}
else
{
	foreach( $_POST['assignbyrem'] as $assignby => $assignbyvalue )
	{

		$assignbyrem_id.=$assignbyvalue.',';
	}
}


		$assessmentdetail ="INSERT INTO tbl_assessment_details (ad_assessment_id, ad_assessment_name, ad_assessment_type, ad_assessment_assignby, ad_assessment_patientid, ad_assessment_reminderid, ad_assessment_created, ad_assessment_modified, ad_assessment_status) VALUES ('', '".$assessment_name."', '".$assessment_type."', '".$assign_type."', '".$assignbypat_id."', '".$assignbyrem_id."', NOW(), NOW(), '1');"; 

$query = mysql_query($assessmentdetail);
// $assmnt_id = $query->insertid;
$assmnt_id = mysql_insert_id();

		$questiondetail ="INSERT INTO tbl_question_details (qd_question_id, qd_question_name, qd_question_type, qd_assessment_id, qd_parentquestion_id, qd_parentanswer_id, qd_question_created, qd_question_modified, qd_question_status) VALUES ('', '".$question."', '".$answer_type."', '".$assmnt_id."', '0', '0', NOW(), Now(), '1');";

$questquery = mysql_query($questiondetail);
$question_id = mysql_insert_id();




	for($i=0;$i<count($_POST['Answer']);$i++)
	{

		$answerdetail ="INSERT INTO tbl_answers_details (ans_answer_id, ans_answer_name, ans_question_id, ans_answer_created, ans_answer_modified, ans_answer_status) VALUES ('', '".$_POST['Answer'][$i]."', '".$question_id."', NOW(), NOW(), '1');";

$answerquery = mysql_query($answerdetail);
	
	}





	if(mysql_query($assessmentdetail))
	{
		$row		= mysql_fetch_object($query);
	
// 		$json 		= '{ "serviceresponse" : { "servicename" : "User Details", "success" : "Yes","message" : "1","userid " : "'.$row->ud_user_id.'","username" : "'.$row->ud_username.'","firstname" : "'.$row->ud_firstname.'","lastname" : "'.$row->ud_lastname.'","password" : "'.$row->ud_password.'","sex" : "'.$row->ud_sex.'","age" : "'.$row->ud_age.'","emailid" : "'.$row->ud_email_id.'","skypeid" : "'.$row->ud_skype_id.'","facetimeid" : "'.$row->ud_facetime_id.'","mobile" : "'.$row->ud_mobile.'","address" : "'.$row->ud_address.'","date" : "'.$row->ud_date.'","status" : "'.$row->ud_status.'" } }';
		$json 		= '{ "serviceresponse" : { "servicename" : "Assessment Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Assessment Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
// 	exit;

	$_SESSION['success'] = "Your Assessment was submitted successfully";
}

header("Location:addassessment.php");

?>
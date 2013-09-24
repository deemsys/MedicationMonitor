<?php

// 	echo "<pre>";
// 	print_r($_POST); exit;

session_start();

$asses_id = $_SESSION['assess_id'];


require("config.php");

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

$parentquest_id = $_POST['parentquest_id'];


$sqlparentq1 = "SELECT ans_answer_id FROM tbl_answers_details WHERE ans_question_id = ".$parentquest_id;

$queryparentq1 = mysql_query($sqlparentq1);

while($recordsparentq1 = mysql_fetch_array($queryparentq1))
{
	$flag		= 1;
	$parentans1 	= $recordsparentq1['ans_answer_id'];
	$question1	= $_POST["question_$parentans1"];
	$ansoption1 	= $_POST["ansoption_$parentans1"]; 
	$Ansid1 	= $_POST["Ansid$parentans1"];
	$newAnswers1 	=  $_POST["Answer$parentans1"]; 



	if($_POST["question_$parentans1"]=='' && $_POST["ansoption_$parentans1"]=='' && $_POST["Answer$parentans1"]=='')
	{

		$_SESSION['error']["question_$parentans1"] = "Sub Question & Answers - Required Field Can't be blank";
	}
}
if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

//echo "succ"; //exit;

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}


$sqlparentq = "SELECT ans_answer_id FROM tbl_answers_details WHERE ans_question_id = ".$parentquest_id;

$queryparentq = mysql_query($sqlparentq);
$flag =0;
while($recordsparentq = mysql_fetch_array($queryparentq))
{
	$flag		= 1;
	$parentans 	= $recordsparentq['ans_answer_id'];
	$question	= $_POST["question_$parentans"];
	$ansoption 	= $_POST["ansoption_$parentans"]; 
	$Ansid 		= $_POST["Ansid$parentans"];
	$newAnswers =  $_POST["Answer$parentans"]; 
		
	//insert Question
	$questionupdate ="INSERT INTO tbl_question_details (qd_question_name, qd_question_type, qd_assessment_id, qd_parentquestion_id, qd_parentanswer_id, qd_question_created, qd_question_modified, qd_question_status) VALUES ('".$question."', '".$ansoption."', '".$asses_id."', '".$parentquest_id."', '".$Ansid."', NOW(), Now(), '1');";

	$questquery = mysql_query($questionupdate);

	//Get Question ID
	$question_id = mysql_insert_id();

	//Update Parent answer Id, parent Quest id
	
	foreach($newAnswers as $ans){
		
		$answerdetail ="INSERT INTO tbl_answers_details (ans_answer_name, ans_question_id, ans_answer_created, ans_answer_modified, ans_answer_status) VALUES ('".$ans."', '".$question_id."', NOW(), NOW(), '1');";
		mysql_query($answerdetail);
	
	}
}



	if($flag == '1')
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Update Assessment Details", "success" : "Yes","message" : "1" } }';
	
	}
	else
	{
		echo '{ "serviceresponse" : { "servicename" : "Update Assessment Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	echo $json;
 	//exit;

	$_SESSION['success'] = "Your Questions & Answers was Updated successfully";
}

header("Location:updatequestion.php?id=".$asses_id);

?>
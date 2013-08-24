<?php

echo "<pre>";
print_r($_POST);

session_start();

 $asses_id = $_SESSION['assess_id'];

require("config.php");

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}


	if(!isset($_POST['Answer']) || trim($_POST['Answer'])=='' && !isset($_POST['question_']) || trim($_POST['question_'])=='' && !isset($_POST['ansoption_']) || trim($_POST['ansoption_'])=='')
	$_SESSION['error']["question_$parentans1"] = "Indipendent Question & Answers - Required Field Can't be blank";

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}


$inqust = $_POST['question_'];
$inansoptn = $_POST['ansoption_'];
$indiAnswers = $_POST['Answer'];


			$indiquestion ="INSERT INTO tbl_question_details (qd_question_name, qd_question_type, qd_assessment_id, qd_parentquestion_id, qd_parentanswer_id, qd_question_created, qd_question_modified, qd_question_status) VALUES ('".$inqust."', '".$inansoptn."', '".$asses_id."', '".$parentquest_id."', '".$Ansid."', NOW(), Now(), '1');"; 

			$indiquest = mysql_query($indiquestion);

			$indiquest_id = mysql_insert_id();


			foreach($indiAnswers as $indians)
			{

		 	$inanswer ="INSERT INTO tbl_answers_details (ans_answer_name, ans_question_id, ans_answer_created, ans_answer_modified, ans_answer_status) VALUES ('".$indians."', '".$indiquest_id."', NOW(), NOW(), '1');"; 
			mysql_query($inanswer);

			} 
	$_SESSION['success'] = "Your Questions & Answers was Updated successfully";
}
header("Location:updatequestion.php?id=".$asses_id);
exit;

?>
<?php

session_start();

 $asses_id = $_SESSION['assess_id'];

require("config.php");

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}


	if(!isset($_POST['Answer'])=='' && !isset($_POST['question']) || trim($_POST['question'])=='' && !isset($_POST['ansoption']) || trim($_POST['ansoption'])=='')
	     $_SESSION['error']["question_$parentans1"] = "Independent Question & Answers - Required Field Can't be blank";

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}


$inqust = $_POST['question'];
$inansoptn = $_POST['ansoption'];
$indiAnswers = $_POST['Answer'];


//			$indiquestion ="INSERT INTO tbl_question_details (qd_question_name, qd_question_type, qd_assessment_id, qd_parentquestion_id, qd_parentanswer_id, qd_question_created, qd_question_modified, qd_question_status) VALUES ('".$inqust."', '".$inansoptn."', '".$asses_id."', '".$parentquest_id."', '".$Ansid."', NOW(), Now(), '1');"; 

                        $indeQuestion = "UPDATE tbl_question_details set qd_question_name = '". $_POST['question'] ."', qd_question_type = '". $_POST['ansoption'] ."' where qd_assessment_id = ". $_POST['assesid'] ." AND qd_question_id = ".$_POST['questionid'];

			$indiquest = mysql_query($indeQuestion);

			mysql_query("DELETE from tbl_answers_details WHERE ans_question_id=".$_POST['questionid']);

			foreach($indiAnswers as $indians)
			{
		 	     $inanswer ="INSERT INTO tbl_answers_details (ans_answer_name, ans_question_id, ans_answer_created, ans_answer_modified, ans_answer_status) VALUES ('".$indians."', '". $_POST['questionid'] ."', NOW(), NOW(), '1');"; 
			mysql_query($inanswer);

			} 
	$_SESSION['success'] = "Your Questions & Answers were Updated successfully";
}
header("Location:updatequestion.php?id=".$asses_id);
exit;

?>
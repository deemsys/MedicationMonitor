<?php
// echo "<pre>";
//   print_r($_GET);  exit;
session_start();

$asses_id = $_SESSION['assess_id'];

// echo $asses_id; exit;

$question_id = $_GET['id'];

require("config.php");


	$questiondelete ="DELETE FROM tbl_question_details WHERE qd_question_id =".$question_id;

	if(mysql_query($questiondelete))
	{

	$answerdelete ="DELETE FROM tbl_answers_details WHERE ans_question_id =".$question_id; 





	if(mysql_query($answerdelete))
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
}

header("Location:updatequestion.php?id=".$asses_id);

?>
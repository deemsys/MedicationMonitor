<?php

session_start();


require("../config.php");


	
$case = $_REQUEST['service'];

switch($case){

	case 'question':{

 		$patient_id = $_POST['patid'];	
 //		$patient_id = 8;
		$flag=0;
		$sql11 ="SELECT * FROM tbl_patientassessment_details WHERE pa_patientassessment_patid = ".$patient_id;

		if($query11 = mysql_query($sql11))
		{
			$flag =1;

			if($flag == '1')
			{


				$myjson = array();
				$i=0;
		
				
				$myjson['servicename'] = "Select Question";
				$myjson['success'] = "Yes";


				while($row = mysql_fetch_array($query11))
				{

					
					$sql12 = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$row['pa_patientassessment_assid'];
					$query12 = mysql_query($sql12);
					$row1 = mysql_fetch_object($query12);
					
					$myjson['Patient Question'][$i]['assname'] 	= $row1->ad_assessment_name;
					$myjson['Patient Question'][$i]['assid']	= $row1->ad_assessment_id;


					$sqlquest = "SELECT * FROM tbl_question_details WHERE qd_assessment_id = ".$row['pa_patientassessment_assid'];
					$queryquest = mysql_query($sqlquest);

					$j=0;
					while($rows = mysql_fetch_array($queryquest))
					{

						$myjson['Patient Question'][$i]['assessment'][$j]['assquestion'] = $rows['qd_question_name'];
						$myjson['Patient Question'][$i]['assessment'][$j]['assquestionid'] = $rows['qd_question_id'];
						$myjson['Patient Question'][$i]['assessment'][$j]['assparentquestionid'] = $rows['qd_parentquestion_id'];
						$myjson['Patient Question'][$i]['assessment'][$j]['assparentanswerid'] = $rows['qd_parentanswer_id'];

						$sqlans = "SELECT * FROM tbl_answers_details WHERE ans_question_id = ".$rows['qd_question_id'];
						$queryans = mysql_query($sqlans);

// 						$json .='{ "serviceresponse" : { "servicename" : "Patient Answers",';

						$k=0;
						while($key = mysql_fetch_array($queryans))
						{

							$myjson['Patient Question'][$i]['assessment'][$j]['answer'][$k]['assanswer'] = $key['ans_answer_name'];
							$myjson['Patient Question'][$i]['assessment'][$j]['answer'][$k]['assanswerid'] = $key['ans_answer_id'];
							
							$k++;
						}

						$j++;
					}
					$i++;

				}

				$myarray 	= array("serviceresponse"=>$myjson);
				$json		= json_encode($myarray);
		
			}
		}

			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Select Question", "success" : "No", "message" : "error" } }';
			}

			echo $json;
		break;
	}
}

exit;

?>

<?php

session_start();

error_reporting(0);

require("../config.php");

$case = $_REQUEST['service'];

//$file = print_r($_FILES['patientaudio']);

switch($case){

	case 'assessinsert':{

$flag = 0;
 $date = date('Y-m-d H:i:s'); 

$file = print_r($_FILES);

		$patient_id = $_POST['patid'];
		$assessment_id = $_POST['assessid'];

// 		$assessxml = '<Result><Question>Tove,Tove,Tove,Tove,Tove</Question><Answer>Jani,Jani,Jani,Jani,Jani</Answer></Result>';


		$assessxml = $_POST['assessxml'];


		$xml = simplexml_load_string($assessxml);
		
		 $xml->getName() . "<br />";		

		foreach($xml->children() as $child)
		{
			if($child->getName()=="Question")
			{
			$qn = explode(',,',$child);
			}
			elseif($child->getName()=="Answer")
			{
			$ans = explode(',,',$child);
			}

		}
		


		for($i=0;$i<count($qn);$i++)
		{
			$flag=1;

		echo	$patassess = "INSERT INTO tbl_viewassessment_details (vd_viewass_patientid, vd_viewass_assessmentid, vd_viewass_question, vd_viewass_answer, vd_viewass_patientnotes, vd_viewass_providernotes, vd_viewass_date, vd_viewass_status) VALUES ('".$patient_id."', '".$assessment_id."', '".$qn[$i]."', '".$ans[$i]."', 'pat notes', 'provider notes', '".$date."', '1');";
			
			mysql_query($patassess);
		}


			if ($_FILES['patientaudio']['size'] > 0)
			{
				$rand=rand(0,100000);
				$headerimage ='../uploadaudio/'.$rand. $_FILES['patientaudio']['name'];
				move_uploaded_file($_FILES['patientaudio']['tmp_name'],$headerimage);
			}
	
			$audio_url = $headerimage;
	
		echo	$pataudio = "INSERT INTO tbl_patientaudio_details (pa_patient_id,pa_patientassess_id, pa_patient_audio,pa_patientaudio_date,pa_patientaudio_status) VALUES ('".$patient_id."','".$assessment_id."', '".$audio_url."','".$date."','1')";
	
			mysql_query($pataudio);



		if($flag==1)
		{
			$json		= '{ "serviceresponse" : { "servicename" : "Question Details", "success" : "Yes", "message" : "1", } }';
		}
		else
		{
			$json		= '{ "serviceresponse" : { "servicename" : "Question Details", "success" : "No",  "message" : "'.$error.'" } }';
		}
		
		echo $json;

		break;
	}

}

exit;

?>

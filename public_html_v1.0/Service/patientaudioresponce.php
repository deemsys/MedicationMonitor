<?php

session_start();

require("../config.php");

$case = $_REQUEST['service'];


switch($case){

	case 'audioinsert':{
print_r($_FILES);

		if ($_FILES['patientaudio']['size'] > 0)
		{
			$rand=rand(0,100000);
			$headerimage ='../uploadaudio/'.$rand. $_FILES['patientaudio']['name'];
			move_uploaded_file($_FILES['patientaudio']['tmp_name'],$headerimage);
		}

		$patient_id = $_POST['patid'];
		$audio_url = $headerimage;

		$assess_id = $_POST['assessid'];

		$pataudio = "INSERT INTO tbl_patientaudio_details (pa_patient_id,pa_patientassess_id, pa_patient_audio,pa_patientaudio_date,pa_patientaudio_status) VALUES ('".$patient_id."','".$assess_id."', '".$audio_url."',NOW(),'1')";

			if(mysql_query($pataudio))
			{
				$json		= '{ "serviceresponse" : { "servicename" : "Audio Details", "success" : "Yes", "Audio" : "'.$file.'", "message" : "1" } }';
			}
			else
			{
				$json		= '{ "serviceresponse" : { "servicename" : "Audio Details", "success" : "No", "Audio" : "'.$file.'",  "message" : "'.$error.'" } }';
			}
		
		echo $json;

		break;
	}

}

exit;

?>

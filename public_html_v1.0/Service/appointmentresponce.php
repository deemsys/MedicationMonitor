<?php

session_start();

require("../config.php");


	
$case = $_REQUEST['service'];

switch($case){

	case 'appdetail':{

		$patient_id = $_POST['patid'];	
		$flag=0;
		$sql11 ="SELECT * FROM tbl_appointment_details WHERE app_appointment_date >= NOW() AND app_appointment_patientid = ".$patient_id;


		if($query11 = mysql_query($sql11))
		{
			$flag =1;

			if($flag == '1')
			{

				$json = '{ "serviceresponse" : { "servicename" : "Select Appointment", "success" : "Yes", "Patient Appointment" : [ ';
				for($i=0;$i<mysql_num_rows($query11);$i++)
				{
					$record11 =mysql_fetch_array($query11);
					$sql12 = "SELECT * FROM tbl_appointment_details WHERE app_appointment_id = ".$record11['app_appointment_id'];

					$query12 = mysql_query($sql12);
					$row		= mysql_fetch_object($query12);

					$appointment_date = date('M d, Y, H:i A',strtotime($row->app_appointment_date));


					$json 		.= '{ "serviceresponse" : { "servicename" : "Select Appointment", "success" : "Yes", "appdate" : "'.$appointment_date.'", "appnotes" : "'.$row->app_appointment_note.'", "message" : "1" } }';
				
				}
				$json = rtrim($json,',');
				$json .= '], "message" : "1" } }';
			}
		}
			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Select Appointment", "success" : "No", "message" : "'.$error.'" } }';
			}

			echo $json;
		break;
	}
}

exit;

?>

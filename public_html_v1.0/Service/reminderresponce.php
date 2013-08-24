<?php
error_reporting(0);
session_start();

require("../config.php");

$case = $_REQUEST['service'];

$today = date('Y-m-d');

switch($case){

	case 'reminder':{

 		$patient_id = $_POST['patid'];	
 //		$patient_id = 8;
		$flag=0;

	$sql11 = "SELECT * FROM tbl_reminder_details WHERE rd_patient_id = '".$patient_id."' ORDER BY rd_reminder_dateandtime ASC";
		if($query11 = mysql_query($sql11))
		{

			$flag =1;

			if($flag == '1')
			{
				$myjson = array();
				$i=0;

				$myjson['servicename'] = "Select Reminder";
				$myjson['success'] = "Yes";

				$i=0;

				while($row = mysql_fetch_array($query11))
				{
					if($row['rd_reminder_type']=='Once')
					{
			
						if($row['rd_reminder_dateandtime'] >= $today)
						{
							$myjson['Patient Reminder'][$i]['remindername']	= $row['rd_reminder_name'];
							$myjson['Patient Reminder'][$i]['remindertype']	= $row['rd_reminder_type'];
							$myjson['Patient Reminder'][$i]['reminderdate']	= $row['rd_reminder_dateandtime'];
							$myjson['Patient Reminder'][$i]['createdby']	= $row['rd_createdby'];
				
							$i++;
				
						}
					}else{
							$myjson['Patient Reminder'][$i]['remindername']	= $row['rd_reminder_name'];
							$myjson['Patient Reminder'][$i]['remindertype']	= $row['rd_reminder_type'];
							$myjson['Patient Reminder'][$i]['reminderdate']	= $row['rd_reminder_dateandtime'];
							$myjson['Patient Reminder'][$i]['createdby']	= $row['rd_createdby'];
			
							$i++;
					}
				}

				$myarray 	= array("serviceresponse"=>$myjson);
				$json		= json_encode($myarray);
			}
		}

			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Select Reminder", "success" : "No", "message" : "error" } }';
			}

			echo $json;
		break;
	}
}

exit;

?>
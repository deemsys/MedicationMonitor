<?php

session_start();

require("../config.php");


	
$case = $_REQUEST['service'];

switch($case){

	case 'medinsert':{

		if ($_FILES['medicineimage']['size'] > 0)
		{
			$rand=rand(0,100000);
			$headerimage ='uploadimages/'.$rand. $_FILES['medicineimage']['name'];
			move_uploaded_file($_FILES['medicineimage']['tmp_name'],$headerimage);
		}

// 		$user_id = $_SESSION['userid'];
		   $user_id = $_POST['userid'];
		$randmed_id=rand(10,100000);
		$medicine_id = $_POST['medicineid'];
		$medicine_name = $_POST['medicinename'];
		$medicine_direction = $_POST['medicinedirection'];
		$image_url = $headerimage;
		$medicine_notes = $_POST['notes'];
		$medicine_sideeffect = $_POST['sideeffects'];

		$sqlcheck = "SELECT * FROM tbl_medication_details WHERE md_medicine_name ='".$medicine_name."'";
		$countcheck = mysql_num_rows(mysql_query($sqlcheck));

	if($countcheck > 0)
	{
			$json	= '{ "serviceresponse" : { "servicename" : "Medicine Details", "success" : "No", "username" : "NULL",  "message" : "Already Exist" } }';
	}else{

		$medication = "INSERT INTO tbl_medication_details (md_medication_id, md_medicine_id, md_user_id, md_medicine_name, md_medicine_imageurl, md_medicine_notes, md_medicine_sideeffects, md_medicine_direction, md_medicine_addfor, md_medicine_status) VALUES ('', '".$randmed_id."', '".$user_id."', '".$medicine_name."', '".$image_url."', '".$medicine_notes."', '".$medicine_sideeffect."', '".$medicine_direction."', 'Patient', 'active')"; 


		$sql = "INSERT INTO tbl_patientmedtaketime_details (pmt_taketime_fromdate, pmt_taketime_todate, pmt_taketime_medtype, pmt_taketime_time1, pmt_taketime_time2, pmt_taketime_time3, pmt_taketime_time4, pmt_taketime_time5, pmt_taketime_time6, pmt_taketime_medicineid, pmt_taketime_patientid, pmt_taketime_status) VALUES (NOW(), NOW()+INTERVAL 2 DAY, 'Daily', '', '', '', '', '', '', '".$randmed_id."', '".$user_id."', '1')";
		mysql_query($sql);

		if(mysql_query($medication))
		{
// 			$row		= mysql_fetch_object($medication);
			$json 		= '{ "serviceresponse" : { "servicename" : "Medicine Details", "success" : "Yes","message" : "1","medicine_id" : "'.$randmed_id.'" } }';
		}
		else
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Medicine Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
              }
		echo $json;

		break;
	}

	case 'mededit':{

		$medicine_id = $_GET['id'];
		
		$medicinename = $_POST['medicinename'];
		$notes = $_POST['notes'];
		
		$sideeffect = $_POST['sideeffect'];
		$direction = $_POST['direction'];


		$medicinedetail = "UPDATE tbl_medication_details SET  md_medicine_name = '".$medicinename."', md_medicine_notes = '".$notes."', md_medicine_sideeffects = '".$sideeffect."', md_medicine_direction = '".$direction."' WHERE md_medicine_id =".$medicine_id;
	
		if(mysql_query($medicinedetail))
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Update Medicine Details", "success" : "Yes","message" : "1" } }';
		}else{
			echo '{ "serviceresponse" : { "servicename" : "Update Medicine Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}
		echo $json;
		break;
	}

	case 'meddelete':{

		$delmedicine_id = $_GET['id'];	
	
		$update ="DELETE FROM tbl_medication_details WHERE md_medicine_id = ".$medicine_id;
	

		$updatemed= "select replace(pm_patient_medicineid,'".$medicine_id."','') AS medicine,pm_patientmedication_id  FROM tbl_patientmedication_details WHERE FIND_IN_SET('".$getmedicine_id."',pm_patient_medicineid)>0";
 		$quer =mysql_query($updatemed);

		while($rec =mysql_fetch_array($quer))
		{
			$sql2 = "UPDATE tbl_patientmedication_details SET pm_patient_medicineid = '".$rec['medicine']."' WHERE pm_patientmedication_id = ".$rec['pm_patientmedication_id'];
			$query2 = mysql_query($sql2);
		}


		if(mysql_query($update))
		{
	
			$json 		= '{ "serviceresponse" : { "servicename" : "Delete Medicine", "success" : "Yes","message" : "1" } }';
		
		}
		else
		{
			$json 		= '{ "serviceresponse" : { "servicename" : "Delete Medicine", "success" : "No", "message" : "'.$error.'" } }';
		}
		echo $json;
		break;
	}

	case 'patmeddetail':{
// print_r($_POST);
//  print_r($_GET); exit;
		$patient_id = $_POST['patid'];	
		$flag=0;
		$sql11 ="SELECT * FROM tbl_patientmedtaketime_details WHERE pmt_taketime_patientid = ".$patient_id;
// 		$query11 = mysql_query($sql11);

		if($query11 = mysql_query($sql11))
		{
			$flag =1;
// 			$cou = mysql_num_rows($query11);
			if($flag == '1')
			{
// 				$json = '{ "serviceresponse" : { "servicename" : "Select Medicine", "success" : "Yes", "Patient Medicine" : [ ';

// 				for($i=0;$i<mysql_num_rows($query11);$i++)
// 				{
				$json = '{ "serviceresponse" : { "servicename" : "Select Medicine", "success" : "Yes", "Patient Medicines" : [ ';
				for($i=0;$i<mysql_num_rows($query11);$i++)
				{
					$record11 =mysql_fetch_array($query11);
					$sql12 = "SELECT * FROM tbl_medication_details WHERE md_medicine_id = ".$record11['pmt_taketime_medicineid'];

					$query12 = mysql_query($sql12);
					$row		= mysql_fetch_object($query12);

					$json 		.= '{ "serviceresponse" : { "servicename" : "Select Medicine", "success" : "Yes", "medicinename" : "'.$row->md_medicine_name.'", "medicinenotes" : "'.$row->md_medicine_notes.'", "direction" : "'.$row->md_medicine_direction.'", "message" : "1" } }';
				
				}
				$json = rtrim($json,',');
				$json .= '], "message" : "1" } }';
						
// 				}
			}
// 				$json .= ' ], "message" : "1" } }';
		}
			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Select Medicine", "success" : "No", "message" : "'.$error.'" } }';
			}

			echo $json;
		break;
	}
}

exit;

?>

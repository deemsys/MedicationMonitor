<?php
// echo "<pre>";
// print_r($_GET);
// print_r($_POST); exit;

session_start();
require("config.php");

$type = $_GET['type'];

switch($type){

	case 'patient':{

		foreach($_POST as $key=>$value)
		{
			$_SESSION['values'][$key] = $value;
		}

		$patient_id1 = $_GET['patid'];	
		$provider_id1 = $_POST['provider'];

		if(!isset($_POST['provider']) || trim($_POST['provider'])=='Select')
			$_SESSION['error']['provider'] = "Provider - Required Option Can't be blank";


		if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
		{
			foreach( $_POST as $key => $value )
			{

				$_SESSION['values'][$key] = '';

			}

			$userdetail = "INSERT INTO tbl_relationship_details (rs_relation_patientid, rs_relation_providerid, rs_relation_status) VALUES ('".$patient_id1."', '".$provider_id1."', '1')";

			if(mysql_query($userdetail)){
			//	$json 		= '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "Yes","message" : "1" } }';
			}
			else{
			//	echo '{ "serviceresponse" : { "servicename" : "Assign Provider", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
		//	echo $json;
            $_SESSION["tab_active"]="assoc";
			$_SESSION['success'] = "Provider Assign successfully";
		}
		
		header("Location:patientdetails.php?id=".$patient_id1);
	
		break;
	}

	case 'Provider':{

		foreach($_POST as $key=>$value)
		{
			$_SESSION['values'][$key] = $value;
		}

		$provider_id = $_GET['patid'];	
		$patient_id = $_POST['patient'];

		if(!isset($_POST['patient']) || trim($_POST['patient'])=='Select')
			$_SESSION['error']['patient'] = "Patient - Required Option Can't be blank";

		if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
		{
			foreach( $_POST as $key => $value )
			{
				$_SESSION['values'][$key] = '';
			}

			$userdetail = "INSERT INTO tbl_relationship_details (rs_relation_patientid, rs_relation_providerid, rs_relation_status) VALUES ('".$patient_id."', '".$provider_id."', '1')";

			if(mysql_query($userdetail)){
			//	$json 		= '{ "serviceresponse" : { "servicename" : "Assign Patient", "success" : "Yes","message" : "1" } }';
			}
			else{
			//	echo '{ "serviceresponse" : { "servicename" : "Assign Patient", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
			}
			//echo $json;

			$_SESSION['success'] = "Patient Assign successfully";
		}

		header("Location:providerdetails.php?id=".$provider_id);

		break;

	}
exit;
}

?>
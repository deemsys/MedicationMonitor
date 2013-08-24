<?php

session_start();

require("../config.php");



$case = $_REQUEST['service'];

switch($case){

	case 'login':{

// print_r($_POST); exit;
 $username = $_POST['username'];
 $password = md5($_POST['pswd']);
// $username = mm001;
// $password = md5(001);

		$sql = "select * from tbl_patient_details where pid_patient_username ='".$username."' AND pid_patient_password = '".$password."'";
		$query = mysql_query($sql);

		if(mysql_num_rows($query) > 0)
		{
			$row		= mysql_fetch_object($query);
			$json 		= '{ "serviceresponse" : { "servicename" : "Login Details", "success" : "Yes", "message" : "1", "userid" : "'.$row->pid_patient_id.'" } }';
		}else{
			$json		= '{ "serviceresponse" : { "servicename" : "Login Details", "success" : "No", "userid" : "NULL",  "message" : "'.$error.'" } }';
		}

		echo $json;	
		break;
	}


}

exit;


?>

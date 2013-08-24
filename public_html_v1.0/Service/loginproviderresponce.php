<?php

session_start();

require("../config.php");

$username = $_POST['username'];
$password = md5( $_POST['pswd']);

$case = $_REQUEST['service'];

switch($case){

	case 'login':{

		$query = mysql_query("select * from tbl_user_details where ud_username ='".$username."' AND ud_password = '".$password."';");

		if(mysql_num_rows($query) >0)
		{
			$row		= mysql_fetch_object($query);
			$json 		= '{ "serviceresponse" : { "servicename" : "Signin Details", "success" : "Yes", "message" : "1", "userid" : "'.$row->ud_user_id.'" } }';
		}else{
			$json		= '{ "serviceresponse" : { "servicename" : "Signin Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
		}

		echo $json;	
		break;
	}


}

exit;


?>

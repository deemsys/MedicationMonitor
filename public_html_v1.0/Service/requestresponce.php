<?php

session_start();

require("../config.php");


    
$case = $_REQUEST['service'];

switch($case){

	case 'providerlist':{

		$patient_id = $_POST['patid'];
 //		$patient_id = 8;

		$flag=0;

		$getpat = "SELECT * FROM tbl_relationship_details WHERE rs_relation_patientid = ".$patient_id;
		$querygetpat = mysql_query($getpat);
		$count = mysql_num_rows($querygetpat);

		$users_id = array();
		$where  ='';

		while($row = mysql_fetch_assoc($querygetpat))
		{
			$users_id[] = " `ud_user_id` != '".$row['rs_relation_providerid']."' ";	
		}
			$where = implode(" AND ",$users_id);
			if($count == 0)
			{
				$flag =1;
				$sqlasspat = "SELECT * FROM tbl_user_details";
			}else{
				$flag =1;
				$sqlasspat = "SELECT * FROM tbl_user_details WHERE $where ";
			}
			
			$queryasspat = mysql_query($sqlasspat);

			$myjson = array();
			$myjson['servicename'] = "Provider List";
			$myjson['success'] = "Yes";

			$i=0;

			while($row = mysql_fetch_assoc($queryasspat))
			{
// 				print_r($row);
				$myjson['Select Provider'][$i]['providername']	= $row['ud_username'];
				$myjson['Select Provider'][$i]['provideid']	= $row['ud_user_id'];
				$i++;
			}

				$myarray 	= array("serviceresponse"=>$myjson);
				$json		= json_encode($myarray);

			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Provider List", "success" : "No", "message" : "'.$error.'" } }';
			}

			echo $json;
		break;
	}

	case 'addrequest':{

		$patient_id = $_POST['patid'];
		$provider_id = $_POST['proid'];
// 		$patient_id = 8;
// 		$provider_id = 1;

		$flag=0;
		
		if($patient_id != '' && $provider_id != '')
		{

			$flag =1;
			$getpat = "INSERT INTO tbl_relationship_details (rs_relation_patientid, rs_relation_providerid, rs_relation_status) VALUES ('".$patient_id."', '".$provider_id."', '0');";
			$querygetpat = mysql_query($getpat);

			if($flag == '1')
			{
				$myjson = array();
				$myjson['servicename'] = "Send Request";
				$myjson['success'] = "Yes";
	
				$myarray 	= array("serviceresponse"=>$myjson);
				$json		= json_encode($myarray);
			}
		}
			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Send Request", "success" : "No", "message" : "'.$error.'" } }';
			}

			echo $json;
		break;
	}

	case 'removerequest':{

		$patient_id = $_POST['patid'];
		$provider_id = $_POST['proid'];
// 		$patient_id = 6;
// 		$provider_id = 15;

		$flag=0;
		
		if($patient_id != '' && $provider_id != '')
		{
			$flag =1;

			$rmepat = "DELETE FROM tbl_relationship_details WHERE rs_relation_patientid = '".$patient_id."' AND rs_relation_providerid = '".$provider_id."'";


 			$querygetpat = mysql_query($rmepat);

			if($flag == '1')
			{
				$myjson = array();
				$myjson['servicename'] = "Remove Provider";
				$myjson['success'] = "Yes";
				$myjson['message'] = "1";

				$myarray 	= array("serviceresponse"=>$myjson);
				$json		= json_encode($myarray);
			}
		}
			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Remove Provider", "success" : "No", "message" : "'.$error.'" } }';
			}

			echo $json;
		break;
	}

	case 'providers':{

		$patient_id = $_POST['patid'];
//		$patient_id = 8;

		$flag=0;

		$getpat = "SELECT * FROM tbl_relationship_details WHERE rs_relation_status=1 and rs_relation_patientid = ".$patient_id;
		$querygetpat = mysql_query($getpat);
		$count = mysql_num_rows($querygetpat);

			$myjson = array();
			$myjson['servicename'] = "Providers";
			$myjson['success'] = "Yes";
                $i=0;


		while($row = mysql_fetch_array($querygetpat))
		{
			$flag =1;
			$sqlasspat = "SELECT * FROM tbl_user_details WHERE ud_user_id = ".$row['rs_relation_providerid'];
			$queryasspat = mysql_query($sqlasspat);
			$recprovider = mysql_fetch_array($queryasspat);

// 			print_r($row);
			$myjson['Select Providers'][$i]['providername']	= $recprovider['ud_username'];
			$myjson['Select Providers'][$i]['provideid']	= $recprovider['ud_user_id'];
			$i++;
		}

				$myarray 	= array("serviceresponse"=>$myjson);
				$json		= json_encode($myarray);

			if($flag == '0')
			{
				$json 		= '{ "serviceresponse" : { "servicename" : "Providers", "success" : "No", "message" : "'.$error.'" } }';
			}

			echo $json;
		break;
	}




}

exit;

?>

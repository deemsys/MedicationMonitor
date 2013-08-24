<?php
// echo "<pre>";
// print_r($_POST);
//   print_r($_GET);  exit;
session_start();

$getmedicine_id = $_GET['id'];

$medicine_id = $getmedicine_id.",";


require("config.php");




	$update ="DELETE FROM tbl_medication_details WHERE md_medication_id = ".$getmedicine_id;
	mysql_query($update);

	$updatemed= "select replace(pm_patient_medicineid,'".$medicine_id."','') AS medicine,pm_patientmedication_id  FROM tbl_patientmedication_details WHERE FIND_IN_SET('".$getmedicine_id."',pm_patient_medicineid)>0";
 	$quer =mysql_query($updatemed);

 	while($rec =mysql_fetch_array($quer))
	{
// 	print_r($rec['medicine']."<br>");
		$sql2 = "UPDATE tbl_patientmedication_details SET pm_patient_medicineid = '".$rec['medicine']."' WHERE pm_patientmedication_id = ".$rec['pm_patientmedication_id'];
		$query2 = mysql_query($sql2);
	}
	$sql11 = "DELETE FROM tbl_patientmedtaketime_details WHERE pmt_taketime_medicineid =".$getmedicine_id;
	$query11 = mysql_query($sql11);

	$_SESSION['success'] = "Your Medicine was Deleted successfully";


 header("Location:Medicinelist.php");

?>
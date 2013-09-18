<?php
// echo "<pre>";
//   print_r($_POST); 
// print_r($_GET); exit;
session_start();
require("config.php");

$medicine_id = $_GET['id'];

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}



if(!isset($_POST['medicinename']) || trim($_POST['medicinename'])=='')
	$_SESSION['error']['medicinename'] = "Medicine Name - Required Field Can't be blank";



if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}





$medicinename = $_POST['medicinename'];
$notes = $_POST['notes'];

$sideeffect = $_POST['sideeffect'];
$direction = $_POST['direction'];


	$medicinedetail = "UPDATE tbl_medication_details SET  md_medicine_name = '".$medicinename."', md_medicine_notes = '".$notes."', md_medicine_sideeffects = '".$sideeffect."', md_medicine_direction = '".$direction."' WHERE md_medication_id =".$medicine_id;





	if(mysql_query($medicinedetail))
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Update Medicine Details", "success" : "Yes","message" : "1" } }';
	$_SESSION['success'] = "Your Medicine was Updated successfully";
	}
	else
	{
		$json = '{ "serviceresponse" : { "servicename" : "Update Medicine Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;


	
header("Location:Medicinelist.php");
exit;
}
	header("Location:editmedicine.php?id=".$medicine_id);
	exit;

?>
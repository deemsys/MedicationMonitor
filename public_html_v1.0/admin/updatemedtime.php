<?php
// echo "<pre>";
// print_r($_POST);
// print_r($_GET); exit;
error_reporting(0);
session_start();

require("config.php");

$patient_id = $_GET['patid'];
$medicine_id = $_POST['medicine'];

$nowdate = date('Y-m-d');

$flag = 0;

foreach($medicine_id as $med1)
{

	$fromdate1 = $_POST["fromdate_$med1"];
	$todate1 = $_POST["todate_$med1"];


    //Added by deem

    $medtype = $_POST["medtype_$med1"];
    $sql="Select md_medicine_name from tbl_medication_details where md_medication_id='".$med1."'";

    $query = mysql_query($sql);

    $records = mysql_fetch_array($query);
    $med_name = $records[0];

    //end

	if($fromdate1 < $nowdate)
		$_SESSION['error']["fromdate_$med1"] = $med_name." - From date Should be today or greater than today";
    if($fromdate1 > $todate1)
		$_SESSION['error']["fromdate_$med1"] = $med_name." - To date Should be greater than From date";
    if($fromdate1==$todate1)
    {
       // $_SESSION['error']["fromdate_$med1"]="From date and to date must be different";
          if($medtype=="Daily"||$medtype=='Every Couple of days')
          {
                $_SESSION['error']["fromdate_$med1"]=$med_name." - From Date and To Date must be different";

          }
    }


}

// if(!isset($_POST['medicine[]']) || trim($_POST['medicine[]'])=='')
// 	$_SESSION['error']['medicine[]'] = "Medicine - Required Option Can't be blank";



if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}


foreach($medicine_id as $med)
{
$flag = 1;

	$fromdate = $_POST["fromdate_$med"];
	$todate = $_POST["todate_$med"];
	$medtype = $_POST["medtype_$med"];
	$hourtime = $_POST["hour$med"];
	$mintime = $_POST["min$med"];

for($i=0;$i<count($hourtime);$i++)
{
	if($hourtime[$i] == 'Select Time')
	{
		$hourtime[$i] = '00';
	}

	    $time[$i] = $hourtime[$i].":".$mintime[$i];

}
$sql = "INSERT INTO tbl_patientmedtaketime_details (pmt_taketime_fromdate, pmt_taketime_todate, pmt_taketime_medtype, pmt_taketime_time1, pmt_taketime_time2, pmt_taketime_time3, pmt_taketime_time4, pmt_taketime_time5, pmt_taketime_time6, pmt_taketime_medicineid, pmt_taketime_patientid, pmt_taketime_status) VALUES ('".$fromdate."', '".$todate."', '".$medtype."', '".$time[0]."', '".$time[1]."', '".$time[2]."', '".$time[3]."', '".$time[4]."', '".$time[5]."', '".$med."', '".$patient_id."', '1')";
mysql_query($sql);
}

	if($flag == '1')
	{

		$json 		= '{ "serviceresponse" : { "servicename" : "Medicine Reminder Details", "success" : "Yes","message" : "1" } }';
	    $_SESSION['success'] = "Your Medicine Reminder was Updated successfully";
	}
	else
	{
        $json =  '{ "serviceresponse" : { "servicename" : "Medicine Reminder Details", "success" : "No", "username" : "NULL",  "message" : "'.$error.'" } }';
	}
	//echo $json;
 	//exit;



	header('location:patientdetails.php?id='.$patient_id);
	exit;
}

header('location:addmedtime.php?patid='.$patient_id);



?>
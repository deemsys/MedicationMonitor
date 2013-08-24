<?php



session_start();

// echo $_SESSION['userid'];
//  print_r($_POST); exit;


require("config.php");
$medid = $_POST['medicineid'];

$usercheck = "SELECT * FROM tbl_medication_details WHERE md_medicine_id=".$medid;

$sqlcheck = mysql_query($usercheck);

$avai = mysql_num_rows($sqlcheck);


$sql11 = "SELECT * FROM tbl_user_details WHERE ud_user_id=".$_SESSION['userid'];

$query11 = mysql_query($sql11);

$rec11 = mysql_fetch_array($query11);
$providername = $rec11['ud_username'];


foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['medicinename']) || trim($_POST['medicinename'])=='')
	$_SESSION['error']['medicinename'] = "Medicine Name - Required Field Can't be blank";

if(!isset($_POST['medicineid']) || trim($_POST['medicineid'])=='')
	$_SESSION['error']['medicineid'] = "Medicine Id - Required Field Can't be blank";

elseif(!eregi("^([0-9])+$",$_POST['medicineid']))
	$_SESSION['error']['medicineid'] = "Medicine Id - Only Allowed Numbers";

elseif($avai == 1)
	$_SESSION['error']['medicineid'] = "Medicine Id - User Medicine Id Already Exist";


if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}

	if($_FILES['medicineimage']['size'] > 0)
	{
		$filecheck = basename($_FILES['medicineimage']['name']);
	
		$ext = substr($filecheck, strrpos($filecheck, '.') + 1);
	
		if(($ext == "jpg" || $ext == "gif" || $ext == "png") && ($_FILES["medicineimage"]["type"] == "image/jpeg" || $_FILES["medicineimage"]["type"] == "image/gif" || $_FILES["medicineimage"]["type"] == "image/png") && ($_FILES["medicineimage"]["size"] < 2120000))
		{
			$rand=rand(0,1000);
			$headerimage ='uploadimages/'.$rand. $_FILES['medicineimage']['name'];
			//  echo  $headerimage; exit;
			move_uploaded_file($_FILES['medicineimage']['tmp_name'],$headerimage);
		}else{
			$_SESSION['error']['medicineid'] = "Image - Please Upload Image file";
			header("Location:addmedicine.php");
			exit;
		}
	
	}




$user_id = $_SESSION['userid'];
//   $user_id = $_POST['user_id'];
 $medicine_id = $_POST['medicineid'];
 $medicine_name = $_POST['medicinename'];
 $medicine_direction = $_POST['medicinedirection'];
 $image_url = $headerimage;
 $medicine_notes = $_POST['notes'];
 $medicine_sideeffect = $_POST['sideeffects'];


		$medication = "INSERT INTO tbl_medication_details (md_medication_id, md_medicine_id, md_user_id, md_medicine_name, md_medicine_imageurl, md_medicine_notes, md_medicine_sideeffects, md_medicine_direction, md_medicine_addfor, md_medicine_status) VALUES ('', '".$medicine_id."', '".$user_id."', '".$medicine_name."', '".$image_url."', '".$medicine_notes."', '".$medicine_sideeffect."', '".$medicine_direction."', 'Provider : ".$providername."', 'active');"; 
		

	if(mysql_query($medication))
	{
		$_SESSION['success'] = "Your Medicine was Added successfully";
	
		header("Location:Medicinelist.php");
		exit;
	}

}
else
{

header("Location:addmedicine.php");
exit;
}
?>

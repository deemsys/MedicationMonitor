<?php

// print_r($_POST); exit;

include('config.php');


	$sql11 = "SELECT * FROM tbl_reminder_details WHERE rd_reminder_id =".$_GET['id'];
	$query11 = mysql_query($sql11);
	$record11 = mysql_fetch_array($query11);

	if($record11['rd_status'] != 0)
	{
		$sql12 = "UPDATE tbl_reminder_details SET rd_status = '0' WHERE rd_reminder_id =".$_GET['id'];

	}
	else
	{
		$sql12 = "UPDATE tbl_reminder_details SET rd_status = '1' WHERE rd_reminder_id =".$_GET['id'];

	}
		if($query12 = mysql_query($sql12))
		{
		 	header("Location:viewreminder.php");
			exit;
		}
?>
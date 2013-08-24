<?php

session_start();
require("config.php");

$searchword = $_GET['remindersearch'];

// echo $searchword; exit;

foreach($_GET as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_GET['remindersearch']) || trim($_GET['remindersearch'])=='')
{

header("Location:viewreminder.php");
exit();
}
else
{
header("Location:viewreminder.php");
exit();
}


?>
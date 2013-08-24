<?php
require("config.php");
$medid = $_POST['medid'];

$usercheck = "SELECT * FROM tbl_medication_details WHERE md_medicine_id = '$medid'";

$sqlcheck = mysql_query($usercheck);

$avai = mysql_num_rows($sqlcheck);



//echo $avai; exit;

if($avai==1)
{
	echo "<i class = 'icon-remove'></i>";
// echo "User Name Not Available";
}
else
{
	echo "<i class = 'icon-ok'></i>";
// echo "User Name Available";
}
?>
<?php
require("config.php");
$uname = $_POST['rrr'];

$usercheck = "SELECT * FROM tbl_user_details WHERE ud_username='$uname'";

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
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SURESH
 * Date: 8/23/13
 * Time: 5:52 PM
 * To change this template use File | Settings | File Templates.
 */
require("config.php");
$uname = $_POST['rrr'];

$usercheck = "SELECT * FROM tbl_patient_details WHERE pid_patient_username='$uname'";

$sqlcheck = mysql_query($usercheck);

$avai = mysql_num_rows($sqlcheck);



//echo $avai; exit;

if($avai>0)
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
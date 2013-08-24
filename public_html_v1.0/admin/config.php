<?php


$host = "localhost";
$DB_usr_name = "medsmoni_monitor";
$DB_usr_pswd = "monitor";
$DB_name = "medsmoni_medicationmonitor"; 


// $host = "localhost";
// $DB_usr_name = "root";
// $DB_usr_pswd = "";
// $DB_name = "medication_monitor";

$con = mysql_connect($host,$DB_usr_name,$DB_usr_pswd);
mysql_select_db($DB_name,$con);

$result = mysql_query("SELECT country_id, country_desc from tbl_countries_list");
$GLOBALS['countries'] = array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
     $GLOBALS['countries'][$row['country_id']] = $row['country_desc']; 
}
mysql_free_result($result);

$result = mysql_query("SELECT age_id, age_range from tbl_age_group");
$GLOBALS['age_group'] = array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
     $GLOBALS['age_group'][$row['age_id']] = $row['age_range']; 
}
mysql_free_result($result);

?>
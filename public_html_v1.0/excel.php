<?php
error_reporting(0);
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 9/25/13
 * Time: 3:50 PM
 * To change this template use File | Settings | File Templates.
 */


//create query to select as data from your table
require("config.php");
$assesQuestId = $_GET['id'];
$patientId = $_GET['patid'];

$select="SELECT vd_viewass_date, vd_viewass_question, vd_viewass_answer, vd_viewass_patientnotes FROM tbl_viewassessment_details WHERE vd_viewass_assessmentid = '".$assesQuestId."' AND vd_viewass_patientid = '".$patientId."'";

//run mysql query and then count number of fields
$export = mysql_query ( $select )or die ( "sqlerror :" . mysql_error( ) );
$fields = mysql_num_fields ( $export );

//create csv header row, to contain table headers
//with database field names
for ( $i = 0; $i < $fields; $i++ ) {
    $header .= mysql_field_name( $export , $i ) . ",";
}

//this is where most of the work is done.
//Loop through the query results, and create
//a row for each
while( $row = mysql_fetch_row( $export ) ) {
    $line = '';
    //for each field in the row
    foreach( $row as $value ) {
        //if null, create blank field
        if ( ( !isset( $value ) ) || ( $value == "" ) ){
            $value = ",";
        }
        //else, assign field value to our data
        else {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . ",";
        }
        //add this field value to our row
        $line .= $value;
    }
    //trim whitespace from each row
    $data .= trim( $line ) . "\n";
}
//remove all carriage returns from the data
$data = str_replace( "\r" , "" , $data );


//create a file and send to browser for user to download

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".xls");
header( "Content-disposition: filename='abc.xls'");
print "$header\n$data";
exit;
?>
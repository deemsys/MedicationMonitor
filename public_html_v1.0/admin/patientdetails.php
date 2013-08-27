<?php
error_reporting(0);
session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');

include('config.php');

$id = $_GET['id'];
// echo $id; exit;
$today = date('Y-m-d');

	$sqlpatient = "SELECT * FROM tbl_patient_details WHERE pid_patient_id = '".$id."';";

	$querypatient = mysql_query($sqlpatient);
	$patientrecords = mysql_fetch_array($querypatient);
	
?>

<script src="assets/js/jquery.js"></script>
<link type="text/css" href="assets/css/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="assets/js/jquery-ui-1.7.2.custom.min.js"></script>
 <script type="text/javascript" src="assets/js/timepicker.js"></script> 

<script type="text/javascript">

$(document).ready(function(){

    $(".clsmedtime .addbtn").live('click',function () {

	var textcounter = $(this).parents('.clsmedtime').find('.clscounter').length;
	
	if(textcounter >2){
            alert("Only 3 textboxes allow");
            return false;
	}   

	var id = $(this).attr('name');

var dec = $("#TextBoxesGroup_"+id+" .clscounter").length + 1;

        var divAfter = "#TextBoxDiv"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxDiv' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><label class="control-label" for="input01">Time '+ dec + '</label>' + '<div class="controls"><label class="control-label"><input class="input-medium" type="text" name="Time'+id+'[]" id="Time'+id+"_"+dec + '" value="" ></label><input type="hidden" name="Ansid'+id+'" value="'+id+'"></div></div>');


	newTextBoxDiv.appendTo("#TextBoxesGroup_"+id);

	var picker = '#Time'+id+"_"+dec;
	$(picker).datepicker({

		duration: '',
	
		showTime: true,
	
		constrainInput: false
	
	});


     });
 

    $(".clsmedtime .removebtn").on('click',function () {


	var elem = $(this).parents('.clsmedtime').find('.clscounter');

	var divCounter = (elem.length);

	if(divCounter==0){
          alert("No more textbox to remove");
          return false;
        }else{

		$(this).parents('.clsmedtime').find('div.clscounter').last().remove();

	}
	
	return false;
 
     });
 

  });

</script>


<style type="text/css">
    #ui-datepicker-div
    {
        z-index: 9999999;
    }
    #ui-timepicker-div
    {
        z-index: 9999999;

    }

</style>

<script type="text/javascript">

 $(document).ready(function() {
  $('.oncedate').hide();
  $('.dailydate').hide();
$('.once').click(function(){
//     alert("vcxv");
  $('.oncedate').show();
  $('.dailydate').hide();
});

$('#daily').click(function(){
//    alert("vcxv");
  $('.oncedate').hide();
  $('.dailydate').show();
});

  $('.clsmedtime').hide();

$('.clsmedipack .abc').on('click',function(){

	//if($(this).(
  	$(this).parent('.clsmedipack').find('.clsmedtime').toggle();
});


});

</script>


 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li><a href="patientlist.php">Patient Details</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $patientrecords['pid_patient_username']; ?></li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
          
          <div class="slate">
<?php
if(isset($_SESSION['error']) && count($_SESSION['error'])>0)
{
	echo '<div class="alert alert-error">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <p><strong>Oh snap! Change a few things up and try submitting again.</strong></p>';
	foreach($_SESSION['error'] as $key=>$value)
	echo '<p>'.$value.'.</p>';
	echo '</div>';
}
?>
<?php
if(isset($_SESSION['success']) && $_SESSION['success']!='')
{
	echo '<div class="alert alert-success">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>'.$_SESSION['success'].'.</strong>
      </div>';
}
?>
		<div class="page-header">
		<div class="pull-right">
 		<a href="addmedtime.php?patid=<?php echo $id; ?>" class="btn">Add Medicine</a> 
<!-- 		<a href="#addmedicine" class="btn" data-toggle="modal">Add Medicine</a> -->
		<a href="#addreminder" class="btn" data-toggle="modal">Add Reminder</a>
		<a href="#addassessment" class="btn" data-toggle="modal">Add Assessment</a>

		<a href="#addappointment" class="btn" data-toggle="modal">Add Appointment</a>

           	 </div><br><br>
		<div class="btn-group pull-right" style="margin-bottom : 10px;">
			<a title="Edit Patient" href="editpatient.php?id=<?php echo $_GET['id']; ?>" class="btn"><i class="icon-pencil"></i></a>
			<a title="Delete Patient" href="javascript:validate(<?php echo $_GET['id']; ?>);" class="btn"><i class="icon-trash"></i></a> </div>

			<h2>Patient Name : <?php echo $patientrecords['pid_patient_username']; ?></h2>
			<h2>Age : <?php echo $GLOBALS['age_group'][$patientrecords['pid_patient_age']].",  ".$patientrecords['pid_patient_sex']; ?></h2>


					</div>
<!-- 					<form name="patient" method="POST" action=""> -->




<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#profile">Profile</a></li>
<li><a href="#medicine">Medicine</a></li>
<li><a href="#reminder">Reminder</a></li>
<li><a href="#assessment">Assessment</a></li>
<li><a href="#appointment">Appointment</a></li>
<li><a href="#assoc">Associated Providers</a></li>
</ul>


		<div class="tab-content">
		<div class="tab-pane active" id="profile">

			<table class="orders-table table">
				<tbody>
					<tr>
						<td width="200px">Name </td>
						<td width="150px"><?php echo $patientrecords['pid_patient_firstname']." "; echo $patientrecords['pid_patient_lastname']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Email Id </td>
						<td><?php echo $patientrecords['pid_patient_emailid']; ?></td>
						<td align="left"><a href="mailto:<?php echo $patientrecords['pid_patient_emailid']; ?>" style="margin-left : 10px;" title="Mail"><i class="icon-envelope"></i></a></td>
					</tr>
<?php
if($patientrecords['pid_patient_skypeid'] != '')
{
?>
					<tr>
						<td>Skype Id </td>
						<td><?php echo $patientrecords['pid_patient_skypeid']; ?></td>
						<td><a href="skype:<?php echo $patientrecords['pid_patient_skypeid']; ?>" style="margin-left : 10px;"><img src="assets/img/skype.png" title="Skype"></a></td>
					</tr>
<?php
}
if($patientrecords['pid_patient_facetimeid'] !='')
{
?>
					<tr>
						<td>Facetime Id </td>
						<td><?php echo $patientrecords['pid_patient_facetimeid']; ?></td>
						<td><a href="facetime:<?php echo $patientrecords['pid_patient_facetimeid']; ?>" style="margin-left : 10px;"><img src="assets/img/Facetime.png" title="Facetime"></a></td>
					</tr>
<?php
}
?>
					<tr>
						<td>Mobile </td>
						<td><?php echo $patientrecords['pid_patient_mobile']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Address 1 </td>
						<td><?php echo $patientrecords['pid_patient_address1']; ?></td>
						<td></td>
					</tr>
					

					<tr>
						<td>Address 2 </td>
						<td><?php echo $patientrecords['pid_patient_address2']; ?></td>
						<td></td>
					</tr>
					

					<tr>
						<td>Country </td>
						<td><?php echo $GLOBALS['countries'][$patientrecords['pid_patient_country']]; ?></td>
						<td></td>
					</tr>
					

					<tr>
						<td>State </td>
						<td><?php echo $patientrecords['pid_patient_state']; ?></td>
						<td></td>
					</tr>
					

					<tr>
						<td>City </td>
						<td><?php echo $patientrecords['pid_patient_city']; ?></td>
						<td></td>
					</tr>
	
				</tbody>
			</table>

</div>


<div class="tab-pane" id="medicine">

			<table class="orders-table table">
				<tbody>

				<tr>
					<th> S.No </th>
					<th> Medicine Name </th>
					<th> From Date </th>
					<th> To Date </th>
					<th> Type </th>
					<th> Time </th>
					<th> Action </th>
				</tr>


<?php


	$sqlmed = "SELECT * FROM tbl_patientmedtaketime_details WHERE pmt_taketime_patientid ='".$id."' AND pmt_taketime_todate >= '".$today."'";
	$querymed = mysql_query($sqlmed);

	for($j=0;$j<mysql_num_rows($querymed);$j++)
	{
		$medrecords = mysql_fetch_array($querymed);
		$sqlmedicin = "SELECT * FROM tbl_medication_details WHERE md_medication_id =".$medrecords['pmt_taketime_medicineid'];
	
		$querymedicin = mysql_query($sqlmedicin);
		$recordsmedicin = mysql_fetch_array($querymedicin);

?>
				<tr>
					<td> <?php echo $j+1; ?> </td>
					<td> <a href="#medicinedetail_<?php echo $recordsmedicin['md_medicine_name']; ?>" data-toggle="modal"><?php echo $recordsmedicin['md_medicine_name']; ?></a> </td>
					<td> <?php echo $medrecords['pmt_taketime_fromdate']; ?> </td>
					<td> <?php echo $medrecords['pmt_taketime_todate']; ?> </td>
					<td> <?php echo $medrecords['pmt_taketime_medtype']; ?> </td>
					<td> <?php echo $medrecords['pmt_taketime_time1']." <strong> ".$medrecords['pmt_taketime_time2']." </strong> ".$medrecords['pmt_taketime_time3']." <strong> ".$medrecords['pmt_taketime_time4']." </strong> ".$medrecords['pmt_taketime_time5']." <strong> ".$medrecords['pmt_taketime_time6']."</strong>"; ?> </td>
					<td><a href="deletepatientdetail.php?type=medicine&patid=<?php echo $_GET['id']; ?>&id=<?php echo $medrecords['pmt_taketime_id'];?>" class="btn"><i class="icon-trash"></i></a></td>
				</tr>
<div id="medicinedetail_<?php echo $recordsmedicin['md_medicine_name']; ?>" class="modal hide fade" style="display : none;">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Medicine</h2>
		</div>

		<div class="modal-body">
		<div class="control-group">
                <div class="controls">
		
			<label for="input117" class="control-label"><strong style="margin-right : 50px;">Medicine Name : </strong><?php echo $recordsmedicin['md_medicine_name']; ?></label><br />
			<label for="input117" class="control-label"><strong style="margin-right : 50px;">Medicine Notes : </strong><?php echo $recordsmedicin['md_medicine_notes']; ?></label><br />
			<label for="input117" class="control-label"><strong style="margin-right : 17px;">Medicine Side Effect : </strong><?php echo $recordsmedicin['md_medicine_sideeffects']; ?></label><br />
			<label for="input117" class="control-label"><strong style="margin-right : 27px;">Medicine Direction : </strong><?php echo $recordsmedicin['md_medicine_direction']; ?></label><br />

                </div>
                </div>
	</div>
	</div>

<?php 
	}
?>
				</tbody>
			</table>

</div>

<div class="tab-pane" id="reminder">

			<table class="orders-table table">
				<tbody>

				<tr>
					<th> S.No </th>
					<th> Reminder Name </th>
					<th> Reminder Type </th>
					<th> Reminder Date/Time </th>
					<th> Action </th>
				</tr>


<?php
	$sqlreminder11 = "SELECT * FROM tbl_reminder_details WHERE rd_patient_id = '".$id."' ORDER BY rd_reminder_dateandtime ASC";
	$queryreminder11 = mysql_query($sqlreminder11);

// echo	$aa = mysql_num_rows($queryreminder11);

// 	for($i=1;$i<=mysql_num_rows($queryreminder11);$i++)
$i=0;
	while($reminderrecords = mysql_fetch_array($queryreminder11))
	{
// 		$reminderrecords = mysql_fetch_array($queryreminder11);

?>
				<tr>

<?php
	if($reminderrecords['rd_reminder_type']=='Once')
	{

		if($reminderrecords['rd_reminder_dateandtime'] >= $today)
		{
?>

					<td> <?php echo $i+=1; ?> </td>
					<td> <?php echo $reminderrecords['rd_reminder_name']; ?> </td>
					<td> <?php echo $reminderrecords['rd_reminder_type']; ?> </td>
					<td> <?php echo $reminderrecords['rd_reminder_dateandtime']; ?> </td>
					<td> <a href="deletepatientdetail.php?type=reminder&patid=<?php echo $_GET['id'];?>&id=<?php echo $reminderrecords['rd_reminder_id']; ?>" class="btn" ><i class="icon-trash"></i></a> </td>

<?php
		}
	}else{
?>

					<td> <?php echo $i+=1; ?> </td>
					<td> <?php echo $reminderrecords['rd_reminder_name']; ?> </td>
					<td> <?php echo $reminderrecords['rd_reminder_type']; ?> </td>
					<td> <?php echo $reminderrecords['rd_reminder_dateandtime']; ?> </td>
					<td> <a href="deletepatientdetail.php?type=reminder&patid=<?php echo $_GET['id'];?>&id=<?php echo $reminderrecords['rd_reminder_id']; ?>" class="btn" ><i class="icon-trash"></i></a> </td>

<?php
	}
?>
				</tr>
<?php 

	}

?>
				</tbody>
			</table>

</div>
<div class="tab-pane" id="assessment">

			<table class="orders-table table">
				<tbody>

				<tr>
					<th width="5%"> S.No </th>
					<th width="40%"> Assessment Name </th>
 					<th width="45%"> Action </th> 
					<th>  </th>
				</tr>
					
<?php
	$sqlmed = "SELECT * FROM tbl_patientassessment_details WHERE pa_patientassessment_patid =".$id;
	$querymed = mysql_query($sqlmed);

	while($medrecords = mysql_fetch_array($querymed))
	{
		$sql1 = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$medrecords['pa_patientassessment_assid'];

		$query1 = mysql_query($sql1);

		$assrecords = mysql_fetch_array($query1);
		
?>
		<tr>
			<td> <?php echo $k+=1; ?> </td>
			<td> <a href="viewpatassessment.php?id=<?php echo $_GET['id'];?>&type=<?php echo $medrecords['pa_patientassessment_id']; ?>" value="<?php echo $medrecords['pa_patientassessment_id']; ?>"><?php echo $assrecords['ad_assessment_name']; ?> </a></td>
			<td><a href="deletepatientdetail.php?type=assessment&patid=<?php echo $_GET['id'];?>&id=<?php echo $medrecords['pa_patientassessment_id']; ?>" class="btn" ><i class="icon-trash"></i></a> </td>
		</tr>

<?php

}

?>		
	
				</tbody>
			</table>


</div>


<div class="tab-pane" id="assoc">

<div class="pull-left">
<a href="#assign" class="btn" data-toggle="modal">Assign Providers</a>
</div><br><br>

			<table class="orders-table table">

				<tbody>

				<tr>
					<th> S.No </th>
					<th> Provider Name </th>
					<th> Email id </th>
					<th> Action </th>
				</tr>
					
<?php

	$sqlrelation = "SELECT r.*, p.* FROM tbl_relationship_details as r , tbl_user_details as p WHERE r.rs_relation_patientid = '".$id."' AND p.ud_user_id  = r.rs_relation_providerid ORDER BY p.ud_username ASC";

	$queryrelation = mysql_query($sqlrelation);

	while($recordrelation = mysql_fetch_array($queryrelation))
	{

?>
		<tr>
			<td> <?php echo $p+=1; ?> </td>
			<td> <a href="providerdetails.php?id=<?php echo $recordrelation['ud_user_id']; ?>" ><?php echo $recordrelation['ud_username']; ?> </a></td>
			<td> <?php echo $recordrelation['ud_email_id']; ?> </td>
			<td> <a href="javascript:valdelete(<?php echo $recordrelation['rs_relation_id']; ?>);" style="margin-right : 200px;" class="btn"><i class="icon-trash"></i></a> </td>

		</tr>

<?php

	}

?>		
	
				</tbody>
			</table>
		</div>


<div class="tab-pane" id="appointment">

			<table class="orders-table table">
				<tbody>

				<tr>
					<th width="5%"> S.No </th>
					<th width="20%"> Appointment Date/Time </th>
					<th width="55%"> Notes </th>
					<th width="20%"> Action </th>
				</tr>


<?php
	$sqlapp = "SELECT * FROM tbl_appointment_details WHERE app_appointment_patientid = '".$id."' AND app_appointment_date >= '".$today."' ";

	$queryapp = mysql_query($sqlapp);

	for($j=1;$j<=mysql_num_rows($queryapp);$j++)
	{
		$apprecords = mysql_fetch_array($queryapp);
?>
				<tr>
					<td> <?php echo $j; ?> </td>
					<td> <?php echo $apprecords['app_appointment_date']; ?> </td>
					<td> <?php echo $apprecords['app_appointment_note']; ?> </td>
					<td> <a href="deletepatientdetail.php?type=appointment&patid=<?php echo $_GET['id'];?>&id=<?php echo $apprecords['app_appointment_id']; ?>" class="btn"><i class="icon-trash"></i></a> </td>
				</tr>
<?php 

	}

?>
				</tbody>
			</table>

</div>


</div>

<!-- </form> -->
<div id="assign" class="modal hide fade" style="display: none; ">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Assign Provider</h2>
		</div>
		<div class="modal-body" id="appiont">
		 
	<form method="POST" action="assignpatientprovider.php?patid=<?php echo $id; ?>&type=patient">
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Provider </label>
                  	<div class="controls">
			<select id="select01" name="provider">
			<option>Select</option>
<?php


	$getpat = "SELECT * FROM tbl_relationship_details WHERE rs_relation_patientid = ".$_GET['id'];
	$querygetpat = mysql_query($getpat);
	$count = mysql_num_rows($querygetpat);

	$users_id = array();
	$where  ='';
	while($row = mysql_fetch_assoc($querygetpat)){
		$users_id[] = " `ud_user_id` != '".$row['rs_relation_providerid']."' ";	
	}

	$where = implode(" AND ",$users_id);
	if($count == 0)
	{
		$sqlasspat = "SELECT * FROM tbl_user_details";
	}else{
		$sqlasspat = "SELECT * FROM tbl_user_details WHERE $where ";
	}
	
	$queryasspat = mysql_query($sqlasspat);
	
	while($row = mysql_fetch_assoc($queryasspat)){
		print_r($row);

?>
		<option value="<?php echo $row['ud_user_id']; ?>"><?php echo $row['ud_username']; ?></option>
<?php

	}

?>
              </select>

                    	</div>
                	</div>
                                      <div class="control-group">
                                      <div class="controls">
                                     </div>
                                      </div>
					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>

		                </div>
					</form>
	</div>
	</div>


	<div id="addassessment" class="modal hide fade" style="display: none; ">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Assessment</h2>
		</div>
		<div class="modal-body">
		 
	<form method="POST" action="updatepatmed.php?patid=<?php echo $id; ?>&type=assess">
		<div class="control-group">
		<div class="controls">
<!-- 		<label for="input117" class="control-label">Assessment :</label> -->
			<table class="orders-table table">
				<tbody>
<tr>
<?php

$sqlchk = "SELECT * FROM tbl_patientassessment_details WHERE pa_patientassessment_patid = ".$_GET['id'];
$querchk = mysql_query($sqlchk);

	for($i=0; $i <mysql_num_rows($querchk); $i++) { 
		$recchk = mysql_fetch_object($querchk);
		$chkarray['chkasss'][$i] = $recchk->pa_patientassessment_assid;
	}
 // print_r($chkarray['chkasss']);
if ($chkarray['chkasss'] != '') {
	foreach($chkarray['chkasss'] as $key){

				$inv_id[] = "ad_assessment_id !='".$key."' ";
			}
			
			$where .= "WHERE ".implode(" && ",$inv_id);
}
else{
	$where .= "";
}

 		$sql11 = "SELECT * FROM tbl_assessment_details ".$where." ORDER BY ad_assessment_name ASC";
	$query11 = mysql_query($sql11);
	

$assCount=0;
		while($assess = mysql_fetch_array($query11))
		{
$assCount++;
?>
<td>

	<input type="checkbox" name="assessment[]" id="<?php echo $assess['ad_assessment_name']; ?>" value="<?php echo $assess['ad_assessment_id']; ?>">  <?php echo $assess['ad_assessment_name']."<br />"; ?>
	<input type="hidden" name="provider" value="<?php echo $_SESSION['userid']; ?>">

		
<?php

$b++;
	
if($b == 3)
{
 echo "</td><tr>";
$b = 0;

}
else{ 

echo "</td>";
}

}
if (!$assCount) { 
echo "<td>No assessments found.</td>";
}

?>
	</tr>
</tbody>
</table>
</div>
		</div>
	<div class="form-actions">
	<?php if (!$assCount) { ?>
		<button class="btn btn-primary" data-dismiss="modal" type="button">Close</button>
	<?php } else { ?>
		<button type="submit" class="btn btn-primary">Submit</button>
	<?php } ?>
		
	</div>
	</form>
	</div>
	</div>

<div id="addmedicine" class="modal hide fade" style="display: none; ">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Medicine</h2>
		</div>
		<div class="modal-body">
		<a href="addmedicine.php"><button class="btn pull-right">Define New Medicine</button></a> 
	<form method="POST" action="updatepatmed.php?patid=<?php echo $id; ?>&type=medicine">
		<div class="control-group">

		<div class="controls">

<?php

	$sql12 = "SELECT * FROM tbl_medication_details";
	$query12 = mysql_query($sql12);
	
		while($med12 = mysql_fetch_array($query12))
		{

?>
		<div class="clsmedipack">
			<input type="checkbox" class="abc" name="medicine[]" id="<?php echo $med12['md_medicine_name']; ?>" value="<?php echo $med12['md_medication_id']; ?>">  <?php echo $med12['md_medicine_name']."<br />"; ?>
		<div id="medtime" class="clsmedtime" style="border:#ccc 1px solid; padding:10px; width : 250px;">
		<div class="control-group" id='TextBoxesGroup_<?php echo $med12['md_medication_id']; ?>'>

                </div>
		<div class="control-group">
                	<label class="control-label" for="input01"></label>
				<div class="controls">
				<input type='button' class="btn addbtn" value='Add Time' id='addButton' name="<?php echo $med12['md_medication_id']; ?>">
				<input type='button' class="btn removebtn" value='Remove Time' id='removeButton' name="<?php echo $med12['md_medication_id']; ?>">
				</div>
		</div>
		</div>
		</div>
<?php

}

?>
		</div>
		</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Submit</button>

		
	</div>
	</form>
	</div>
	</div>

<div id="addreminder" class="modal hide fade" style="display: none; ">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Reminder</h2>
		</div>
<p></p>	 
	<form class="form-horizontal" method="POST" action="updatepatremind.php?patid=<?php echo $id; ?>">
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Reminder Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="remindername" id="remindername">
			</div>
                	</div>
                                      <div class="control-group">
                <label class="control-label" for="input501"><span style=" color : red;">*</span>Reminder Type</label>
                <div class="controls">
                <label class="radio"><input type="radio" name="radio" id="once" class="once" value="Once"> Once</label>
                <label class="oncedate"><input type="text" placeholder="Select your Date" name="oncedate" id="oncedate"> 
      </label>
                <label class="radio"><input type="radio" name="radio" id="daily" value="Daily"> Daily</label>
                <i class="dailydate" ><select id="select01" class="input-small" name="dailytime">
		<option>Select Time</option>
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
		<option>10</option>
		<option>11</option>
		<option>12</option>
              </select></i>
		<i class="dailydate" >
		<select id="select01" class="input-small" name="timeformat">
		<option>Select</option>
		<option>AM</option>
		<option>PM</option>
		</select></i>
                </div>
                </div>
				<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>

		                </div>
					</form>
	</div>
	</div>


<div id="addappointment" class="modal hide fade" style="display: none; ">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Appointment</h2>
		</div>
		<div class="modal-body" id="appiont">
		 
	<form method="POST" action="updatepatappint.php?patid=<?php echo $id; ?>&type=appointment">
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Appointment Date</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" style="color : #999999;" placeholder="Select your Date" name="appdatetime" id="appdatetime">
                    	</div>
                	</div>
                                      <div class="control-group">
                                      <div class="controls">

                                      <textarea placeholder=" please Enter your notes" name="notes" rows="3" id="notes" class="input-xlarge"></textarea>
                                      </div>
                                      </div>
				<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>

		                </div>
					</form>
	</div>
	</div>
			</div>

          </div><!--/row-->
          <!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Medication Monitor 2012</p>
      </footer>

    </div>
    </div>
    <!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="assets/js/transition.js"></script>
    <script src="assets/js/alert.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/scrollspy.js"></script>
    <script src="assets/js/tab.js"></script>
    <script src="assets/js/tooltip.js"></script>
    <script src="assets/js/popover.js"></script>
    <script src="assets/js/button.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="assets/js/carousel.js"></script>
    <script src="assets/js/typeahead.js"></script>
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu > li > ul'),
	           menu_a  = $('.menu > li > a');
	    
	    menu_ul.hide();
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>

<script>


    $('#myTab a').click(function (e) {

    e.preventDefault();
    $(this).tab('show');

    })


</script>
<script type="text/javascript">

$(function() {
	  $('#appdatetime').datepicker({

    	duration: '',

        showTime: true,

        constrainInput: false

     });

	  $('#oncedate').datepicker({

    	duration: '',

        showTime: true,

        constrainInput: false

     });

    

//  alert("gds");
});



function validate(val)
{


	if(val!='')
	{

		var res = confirm('Are you sure you want to delete this Patient?');
		if(res)
		{
			window.location="deletemypatient.php?id="+val;		
		}

	}


}

function valdelete(valu)
{


	if(valu!='')
	{

		var res = confirm('Are you sure you want to delete this Provider from this list?');
		if(res)
		{
			window.location="deleterelation.php?type=provider&getid=<?php echo $_GET['id']; ?>&id="+valu;		
		}

	}


}

</script>
  </body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['success']);

}
else
{
header('Location:login.php');
}
?>
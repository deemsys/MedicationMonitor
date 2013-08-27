<?php
session_start();

if(isset($_SESSION['adminid']))
{


include('header.php');

include('config.php');

$id = $_GET['id'];
// echo $id; exit;


	$sqlprovider = "SELECT * FROM tbl_user_details WHERE ud_user_id = '".$id."';";

	$queryprovider = mysql_query($sqlprovider);
	$providerrecords = mysql_fetch_array($queryprovider);
	
?>
    <script src="assets/js/jquery.js"></script>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li><a href="/admin/providerlist.php">Provider Details</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $providerrecords['ud_firstname']." ".$providerrecords['ud_lastname']; ?></li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
		<div class="btn-group pull-right">
			<a title="Edit Provider" href="editprovider.php?id=<?php echo $_GET['id']; ?>" class="btn"><i class="icon-pencil"></i></a>
			<a title="Delete Provider" href="javascript:validate(<?php echo $_GET['id']; ?>);" class="btn"><i class="icon-trash"></i></a> </div>

			<h2>Provider Name : <?php echo $providerrecords['ud_username']; ?></h2>
		</div>

<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#profile">Profile</a></li>
<li><a href="#assoc">Associated Patients</a></li>
</ul>

		<div class="tab-content">
		<div class="tab-pane active" id="profile">

			<table class="orders-table table">
				<tbody>
					<tr>
						<td width="200px">Name </td>
						<td width="150px"><?php echo $providerrecords['ud_firstname']." "; echo $providerrecords['ud_lastname']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Email Id </td>
						<td><?php echo $providerrecords['ud_email_id']; ?></td>
						<td align="left"><a href="mailto:<?php echo $providerrecords['ud_email_id']; ?>" style="margin-left : 10px;" title="Mail"><i class="icon-envelope"></i></a></td>
					</tr>

					<tr>
						<td>Skype Id </td>
						<td><?php echo $providerrecords['ud_skype_id']; ?></td>
						<td><a href="skype:<?php echo $providerrecords['ud_skype_id']; ?>" style="margin-left : 10px;"><img src="assets/img/skype.png" title="Skype"></a></td>
					</tr>

					<tr>
						<td>Facetime Id </td>
						<td><?php echo $providerrecords['ud_facetime_id']; ?></td>
						<td><a href="facetime:<?php echo $providerrecords['ud_facetime_id']; ?>" style="margin-left : 10px;"><img src="assets/img/Facetime.png" title="Face Time"></a></td>
					</tr>

					<tr>
						<td>Mobile </td>
						<td><?php echo $providerrecords['ud_mobile']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Address 1 </td>
						<td><?php echo $providerrecords['ud_address1']; ?></td>
						<td></td>
					</tr>
					

					<tr>
						<td>Address 2 </td>
						<td><?php echo $providerrecords['ud_address2']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>State </td>
						<td><?php echo $providerrecords['ud_state']; ?></td>
						<td></td>
					</tr>
					

					<tr>
						<td>City </td>
						<td><?php echo $providerrecords['ud_city']; ?></td>
						<td></td>
					</tr>
	
				</tbody>
			</table>

</div>

<div id="assign" class="modal hide fade" style="display: none; ">

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h2>Assign Patient</h2>
		</div>
		<div class="modal-body" id="appiont">
		 
		<form method="POST" action="assignpatientprovider.php?patid=<?php echo $id; ?>&type=Provider">
			<div class="control-group">
			<label class="control-label" for="input01"><span style=" color : red;">*</span>Patient </label>
			<div class="controls">
			<select id="select01" name="patient">
			<option>Select</option>
<?php


	$getpat = "SELECT * FROM tbl_relationship_details WHERE rs_relation_providerid = ".$_GET['id'];
	$querygetpat = mysql_query($getpat);
	$count = mysql_num_rows($querygetpat);

	$users_id = array();
	$where  ='';
	while($row = mysql_fetch_assoc($querygetpat))
	{
		$users_id[] = " pid_patient_id != '".$row['rs_relation_patientid']."' ";	
	}
	$where = implode(" AND ",$users_id);
	if($count == 0)
	{
		$sqlasspat = "SELECT * FROM tbl_patient_details";
	}else{
		$sqlasspat = "SELECT * FROM tbl_patient_details WHERE $where ";
	}
	$queryasspat = mysql_query($sqlasspat);
	
	while($row = mysql_fetch_assoc($queryasspat))
	{
?>
		<option value="<?php echo $row['pid_patient_id']; ?>"><?php echo $row['pid_patient_username']; ?></option>
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

<div class="tab-pane" id="assoc">
<div class="pull-left">
<a href="#assign" class="btn" data-toggle="modal">Assign Patients</a>
</div><br><br>
			<table class="orders-table table">
				<tbody>

				<tr>
					<th> S.No </th>
					<th> Patient Name </th>
					<th> Email id </th>
					<th> Action </th>
				</tr>
					
<?php

	$sqlmed = "SELECT r.*, p.* FROM tbl_relationship_details as r , tbl_patient_details as p WHERE r.rs_relation_providerid = '".$id."' AND p.pid_patient_id  = r.rs_relation_patientid ORDER BY p.pid_patient_username ASC";

        $k=0;
	$querymed = mysql_query($sqlmed);

	while($medrecords = mysql_fetch_array($querymed))
	{

?>
		<tr>
			<td> <?php echo $k+=1; ?> </td>
			<td> <a href="patientdetails.php?id=<?php echo $medrecords['rs_relation_patientid'] ?>" ><?php echo $medrecords['pid_patient_username']; ?> </a></td>
			<td> <?php echo $medrecords['pid_patient_emailid']; ?> </td>
			<td> <a href="javascript:valdelete(<?php echo $medrecords['rs_relation_id']; ?>);" style="margin-right : 200px;" class="btn"><i class="icon-trash"></i></a> </td>
		</tr>

<?php

	}

?>
				</tbody>
			</table>
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
    <script src="assets/js/jquery.js"></script>
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


function validate(val)
{


	if(val!='')
	{

		var res = confirm('Are you sure you want to delete this Provider?');
		if(res)
		{
			window.location="deleteprovider.php?id="+val;		
		}

	}


}
function valdelete(valu)
{


	if(valu!='')
	{

		var res = confirm('Are you sure you want to delete this Patient from this list?');
		if(res)
		{
			window.location="deleterelation.php?type=patient&getid=<?php echo $_GET['id']; ?>&id="+valu;		
		}

	}


}

</script>

<script>


    $('#myTab a').click(function (e) {

    e.preventDefault();
    $(this).tab('show');

    })


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
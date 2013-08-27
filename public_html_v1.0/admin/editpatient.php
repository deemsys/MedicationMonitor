<?php
session_start();



if(isset($_SESSION['adminid']))

{


include('header.php');

include('config.php');

$patient_id = $_GET['id'];
// echo $id; exit;


	$sqlpatient = "SELECT * FROM tbl_patient_details WHERE pid_patient_id = '".$patient_id."';";

	$querypatient = mysql_query($sqlpatient);
	$patientrecords = mysql_fetch_array($querypatient);

        $ageQry = mysql_query("SELECT AGE_ID, AGE_RANGE FROM tbl_age_group");
        $ageRange=array();
        while ($row = mysql_fetch_array($ageQry, MYSQL_ASSOC))
        {
              $ageRange[$row['AGE_ID']] = $row['AGE_RANGE'];
        }

        $countryQry = mysql_query("SELECT COUNTRY_ID, COUNTRY_DESC FROM tbl_countries_list order by DISPLAY_ORDER");
        $countries=array();
        while ($row = mysql_fetch_array($countryQry, MYSQL_ASSOC))
        {
              $countries[$row['COUNTRY_ID']] = $row['COUNTRY_DESC'];
        }

?>

 <div class="container">
 <ul class="breadcrumb">
     <li><a href="index.php">Home</a> <span class="divider">/</span></li>
     <li><a href="javascript:history.go(-1);">Patient Details</a><span class="divider">/</span></li>
     <li><a href="javascript:history.go(-1);"><?php echo $patientrecords['pid_patient_username'];?></li><span class="divider">/</span>
     <li class="active">Edit<a></a></li>
     <i class="icon-chevron-left pull-right"></i>

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
						<h2> Edit Patient</h2>
					</div>
					<form class="form-horizontal" name="editpatient" method="POST" action="updateeditpatient.php?id=<?php echo $patient_id; ?>">
					<div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>First Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_firstname']; ?>" name="fname" id="fname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Last Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_lastname']; ?>" name="lname" id="lname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">User Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_username']; ?>" disabled="true" name="lname" id="lname">
                    	</div>
                	</div>

                        <div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Sex</label>
                  	<div class="controls">
<?php 
$maleSelected = ($patientrecords['pid_patient_sex'] && strtolower($patientrecords['pid_patient_sex']) == 'male') ? "checked" : "";
$femaleSelected = ($patientrecords['pid_patient_sex'] && strtolower($patientrecords['pid_patient_sex']) == 'female') ? "checked" : "";
?>
			<label class="radio"><input type="radio" name="sex" value="male" <?=$maleSelected?>> Male</label>
			<label class="radio"><input type="radio" name="sex" value="female" <?=$femaleSelected?>> Female</label>
                    	</div>
                	</div>

			<div class="control-group">
			<label for="select01" class="control-label"><span style=" color : red;">*</span>Select Age</label>
			<div class="controls">
			<select id="select01" name="age" class="input-semi-medium">
			<option value="0">Select Age</option>
<?php foreach ($ageRange as $key => $val) { ?>
    <?php if ($patientrecords['pid_patient_age'] == $key) { ?>
			<option value="<?=$key?>" selected><?=$val?></option>
    <?php } else { ?>
			<option value="<?=$key?>"><?=$val?></option>
    <?php } ?>
<?php } ?>
			</select>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Email Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_emailid']; ?>" name="email" id="email">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Skype Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_skypeid']; ?>" name="skype" id="skype">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Facetime Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_facetimeid']; ?>" name="facetime" id="facetime">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Mobile</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_mobile']; ?>" name="mobile" id="mobile">
                    	</div>
                	</div>

              		
              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Address1</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_address1']; ?>" name="add1" id="add1">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01">Address2</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_address2']; ?>" name="add2" id="add2">
                    	</div>
                	</div>

			<div class="control-group">
			<label for="select01" class="control-label"><span style=" color : red;">*</span>Country</label>
			<div class="controls">
			<select id="select01" name="country" class="input-large">
			<option>Select Country</option>
<?php foreach ($countries as $key => $val) { ?>
    <?php if ($key == $patientrecords['pid_patient_country']) { ?>
			<option value="<?=$key?>" selected><?=$val?></option>
    <?php } else { ?>
			<option value="<?=$key?>"><?=$val?></option>
    <?php } ?>
<?php } ?>
			</select>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>State</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_state']; ?>" name="state" id="state">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>City</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_city']; ?>" name="city" id="city">
                    	</div>
                	</div>

                        <div class="control-group">
                            <label class="control-label" for="input01"><span style=" color : red;">*</span>Postal Code</label>
                            <div class="controls">
                                <input type="text" class="input-medium" value="<?php echo $patientrecords['pid_patient_zipcode']; ?>" name="zipcode" id="zipcode">
                            </div>
                        </div>

				<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                </div>



		              	</div>

		            	</form>

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
<?php
session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');
include('config.php');
?>
    <script src="assets/js/jquery.js"></script>
<link type="text/css" href="assets/css/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="assets/js/jquery-ui-1.7.2.custom.min.js"></script>
 <script type="text/javascript" src="assets/js/timepicker.js"></script> 
<script type="text/javascript">

$(function() {

	  $('#appdate').datepicker({

    	duration: '',

        showTime: true,

        constrainInput: false

     });

});

</script>



 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Appointment</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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




			<div id="global" class="tab-pane fade active in">
         		<form class="form-horizontal" action="updateappoinment.php" method="POST" name="dd1" id="dd1">
              		<fieldset>
              		<legend>Appointment</legend>

              			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Appointment Date</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" style="color : #999999;" placeholder="Select your Date" name="appdate" id="appdate">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Notes</label>
                  	<div class="controls">
                    	<textarea placeholder=" please Enter your Notes" name="appnotes" rows="3" id="appnotes" class="input-xlarge"></textarea>
                    	</div>
                	</div>

              		<div class="control-group">
            		<label for="select01" class="control-label"><span style=" color : red;">*</span>Select Patient</label>
            		<div class="controls">
             		 <select id="select01" name="patient">
			<option>Select</option>
<?php


	$sqlrempatient = "SELECT * FROM tbl_patient_details;";

	$queryrempatient = mysql_query($sqlrempatient);

		while($reminderpatient = mysql_fetch_array($queryrempatient))
		{

?>

                	<option><?php echo $reminderpatient['pid_patient_username']; ?></option>

<?php

}

?>
             		 </select>
           		 </div>
        		  </div>

      					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                  
		                </div>
		              	</fieldset>
		            	</form>
						</div>                    <!-- End of Payment Tabs -->	

					
			</div>          </div><!--/row-->
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

  </body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['success']);
?>
<?php
}
else
{
header('Location:login.php');
}
?>
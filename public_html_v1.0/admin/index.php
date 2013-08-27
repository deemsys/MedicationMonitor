<?php
session_start();

if(isset($_SESSION['adminid']))
{


include('header.php');
?>

 <div class="container">
 <!--ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider"></span></li>
        <li class="active"></li>
      </ul-->
    <div class="container-fluid">
    


				
					<!--<div class="page-header">
						<h2>Dash Board</h2>
					</div>-->
<?php

$sql11 = "SELECT * FROM tbl_patient_details";
$query11 = mysql_query($sql11);
$count11 = mysql_num_rows($query11);

$sql12 = "SELECT * FROM tbl_user_details";
$query12 = mysql_query($sql12);
$count12 = mysql_num_rows($query12);

$sql13 = "SELECT * FROM tbl_medication_details";
$query13 = mysql_query($sql13);
$count13 = mysql_num_rows($query13);

$sql14 = "SELECT * FROM tbl_reminder_details";
$query14 = mysql_query($sql14);
$count14 = mysql_num_rows($query14);

$sql15 = "SELECT * FROM tbl_assessment_details";
$query15 = mysql_query($sql15);
$count15 = mysql_num_rows($query15);

$sql16 = "SELECT * FROM tbl_appointment_details";
$query16 = mysql_query($sql16);
$count16 = mysql_num_rows($query16);

?>
      <div class="row-fluid">
    	<div class="span3">
        <div class="slate clearfix">
        <h2>Quick links</h2>
<ul class="nav nav-tabs nav-stacked">
        <li><a href="Patientregister.php"><i class="icon-user icon-white"></i> Define New Patient</a></li>
	<li><a href="register.php"><i class="icon-user icon-white"></i> Define New Provider</a></li>
	<li><a href="addmedicine.php"><i class="icon-plus-sign icon-white"></i> Define New Medicine</a></li>
	<li><a href="reminders.php"><i class="icon-list-alt icon-white"></i> Define New Reminder</a></li>
	<li><a href="addassessment.php"><i class="icon-ok-circle icon-white"></i> Define New Assessment</a></li>
	<li><a href="appoinment.php"><i class="icon-time icon-white"></i> Define New Appointment</a></li>

         </ul>
            </div>  
        </div>
					

<div class="span9">
	<div class="slate clearfix">
				
					<a href="patientlist.php" class="stat-column">
						<span class="number"><?php echo $count11; ?></span>
						<span>No. of Patients</span></a>

					<a href="providerlist.php" class="stat-column">
						<span class="number"><?php echo $count12; ?></span>
						<span>No. of Providers</span></a>

					<a href="Medicinelist.php" class="stat-column">
						<span class="number"><?php echo $count13; ?></span>
						<span>No. of Medicines</span></a>

					<a href="viewreminder.php" class="stat-column">
						<span class="number"><?php echo $count14; ?></span>
						<span>No. of Reminders</span></a>

					<a href="viewassessment.php" class="stat-column">
						<span class="number"><?php echo $count15; ?></span>
						<span>No. of Assessments</span></a>

					<a href="viewappionment.php" class="stat-column">
						<span class="number"><?php echo $count16; ?></span>
						<span>No. of Appointments</span></a>

	</div>
</div>
					

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
}
else
{
header('Location:login.php');
}
?>
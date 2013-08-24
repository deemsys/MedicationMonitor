<?php
session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider"></span></li>
        <li class="active"></li>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
          	<div class="slate">
				
					<div class="page-header">
						<h2>Dashboard</h2>
					</div>
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
					<div class="pull-right" style="margin-right : 200px;"><h2>Quick Links</h2>
				<a href="Patientregister.php">Define New Patient</a> <br>
				<a href="register.php">Define New Provider</a> <br>
				<a href="addmedicine.php">Define New Medicine</a><br>
				<a href="reminders.php">Define New Reminder</a><br>
				<a href="addassessment.php">Define New Assessment</a><br>
				<a href="appoinment.php">Define New Appointment</a><br>
				</div>
					<table>
					<tbody>
						<tr>

						<td><a href="patientlist.php" class="stat-column">
						<span class="number"><?php echo $count11; ?></span>
						<span>No.of Patients</span></a></td>

						<td><a href="providerlist.php" class="stat-column">
						<span class="number"><?php echo $count12; ?></span>
						<span>No.of Providers</span></a></td>

						<td><a href="Medicinelist.php" class="stat-column">
						<span class="number"><?php echo $count13; ?></span>
						<span>No.of Medicine</span></a></td>

						<td><a href="viewreminder.php" class="stat-column">
						<span class="number"><?php echo $count14; ?></span>
						<span>No.of Reminder</span></a></td>

						</tr>

						<tr>

						<td><a href="viewassessment.php" class="stat-column">
						<span class="number"><?php echo $count15; ?></span>
						<span>No.of Assessment</span></a></td>

						<td><a href="viewappionment.php" class="stat-column">
						<span class="number"><?php echo $count16; ?></span>
						<span>No.of Appointment</span></a></td>

						</tr>

					</tbody>

					</table>

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
}
else
{
header('Location:login.php');
}
?>
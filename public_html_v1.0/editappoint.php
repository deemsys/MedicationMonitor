<?php
session_start();

if($_SESSION['userid'] != '')
{

include('header.php');

include('config.php');

$appointment_id = $_GET['id'];



	$sqledit = "SELECT * FROM tbl_appointment_details WHERE app_appointment_id =".$appointment_id;
	$queryedit = mysql_query($sqledit);
	$recordsedit = mysql_fetch_array($queryedit);
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
        <li><a href="index.php">Home</a> <span class="divider">/</span>
        <!--li class="active"-->Edit Appointment</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
       
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
						<h2> Edit Appointment</h2>
					</div>
					<form name="editpatient" method="POST" action="updateeditappoint.php?id=<?php echo $appointment_id; ?>">
					<table class="orders-table table">
					<tbody>
						<tr>
							<td>Appointment Date </td>
							<td><input type="text" name="appdate" id="appdate" class="input-medium" value="<?php echo $recordsedit['app_appointment_date']; ?>"></td>
						</tr>
						
						<tr>
							<td>Patient Name </td>
							<td><input type="text" disabled="true" name="patientname" class="input-medium" value="<?php echo $recordsedit['app_appointment_patientname']; ?>"></td>
						</tr>
						
						<tr>
							<td> Notes </td>
							<td><textarea placeholder=" please Enter your notes" name="notes" rows="3" id="notes" class="input-xlarge"><?php echo $recordsedit['app_appointment_note']; ?></textarea></td>
						</tr>
						
						<tr class="form-actions">
							
							<td><button type="submit" class="btn btn-primary">Submit</button></td>
							
						</tr>

						
					</tbody>
					</table>
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
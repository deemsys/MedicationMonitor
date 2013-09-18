<?php
session_start();

if($_SESSION['adminid'] != '')
{


$asses_id = $_GET['id'];
$asses_type = $_GET['type'];

include('header.php');
?>
<!-- <script language="javascript" type="text/javascript" src="assets/js/addfield.js"></script> -->
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Assessment<span class="divider">/</span></li>
	<li class="active">Add Assessment</li>
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
         		<form class="form-horizontal" action="updateassign.php?id=<?php echo $asses_id; ?>&type=<?php echo $asses_type; ?>" method="POST">
              		<fieldset>
              		<legend>Add or Remove Assign</legend>
              		<!--<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>-->


<?php


	$sqlassesment = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$_GET['id'];
	$queryasses = mysql_query($sqlassesment);

	$recordsasses = mysql_fetch_array($queryasses);
?>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Assessment Name :</label>
                  	<div class="controls">
                    	<label for="input01"><b><?php echo $recordsasses['ad_assessment_name']; ?></b></label>
                    	</div>
                	</div>

<?php

	$type = $_GET['type'];

	$assignbyperson = $_SESSION['assignbyperson_id'];

?>
			<div class="control-group">

                  	<div class="controls">

	
<?php
if($type != 'Reminder')
{
	 	$sqlselassign = "SELECT * FROM tbl_patient_details WHERE pid_patient = '".$type."';";
		$queryselassign = mysql_query($sqlselassign);

		while($recordselassign = mysql_fetch_array($queryselassign))
		{

			echo "<label class='checkbox'><input type='checkbox' id=".$recordselassign['pid_patient_id']." name='assignbypat[]' value=".$recordselassign['pid_patient_id']."> ".$recordselassign['pid_patient_username']."</label>";

		}
}
else
{
	 	$sqlselassign1 = "SELECT * FROM tbl_reminder_details WHERE rd_reminder = '".$type."';";
		$queryselassign1 = mysql_query($sqlselassign1);

		while($recordselassign1 = mysql_fetch_array($queryselassign1))
		{

			echo "<label class='checkbox'><input type='checkbox' id=".$recordselassign1['rd_reminder_id']." name='assignbyrem[]' value=".$recordselassign1['rd_reminder_id']."> ".$recordselassign1['rd_reminder_name']."</label>";

		}

}
?>	
                    	</div>
                	</div>

			<div class="form-actions">
			<button type="submit" class="btn btn-primary">Submit</button>

			</div>
		        </fieldset>
		        </form>



			</div>                    <!-- End of Payment Tabs -->	

					
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
unset($_SESSION['values']['Answer1']);
unset($_SESSION['values']['Answer2']);
unset($_SESSION['values']['assessment']);




}
else
{
header('Location:login.php');
}
?>
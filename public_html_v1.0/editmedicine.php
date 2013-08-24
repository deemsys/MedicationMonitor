<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');

include('config.php');

$medicine_id = $_GET['id'];
// echo $id; exit;


	$sqlmedicine = "SELECT * FROM tbl_medication_details WHERE md_medication_id = ".$medicine_id;

	$querymedicine = mysql_query($sqlmedicine);
	$medicinerecords = mysql_fetch_array($querymedicine);
	
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Medicine Details</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
						<h2> Edit Medicine</h2>
					</div>
					<form name="editpatient" method="POST" action="updateeditmedicine.php?id=<?php echo $medicine_id; ?>">
					<table class="orders-table table">
					<tbody>
						<tr>
							<td>Medicine ID </td>
							<td><input type="text" name="medicineid" disabled="disabled" class="input-medium" value="<?php echo $medicinerecords['md_medication_id']; ?>"></td>
						</tr>
						
						<tr>
							<td>Medicine Name </td>
							<td><input type="text" name="medicinename" class="input-medium" value="<?php echo $medicinerecords['md_medicine_name']; ?>"></td>
						</tr>
						
						<tr>
							<td>Medicine Notes </td>
							<td><textarea placeholder=" please Enter your notes" name="notes" rows="3" id="notes" class="input-xlarge"><?php echo $medicinerecords['md_medicine_notes']; ?></textarea></td>
						</tr>
						
						<tr>
							<td>Medicine Side Effects </td>
							<td><textarea placeholder=" please Enter your notes" name="sideeffect" rows="3" id="sideeffect" class="input-xlarge"><?php echo $medicinerecords['md_medicine_sideeffects']; ?></textarea></td>
						</tr>
						
						<tr>
							<td>Medicine Direction </td>
							<td><textarea placeholder=" please Enter your notes" name="direction" rows="3" id="direction" class="input-xlarge"><?php echo $medicinerecords['md_medicine_direction']; ?></textarea></td>
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
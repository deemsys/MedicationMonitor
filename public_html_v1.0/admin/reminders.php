<?php
session_start();

function valid_check($key)
{
    if(isset($_SESSION['require'][$key]))
    {
        echo 'style="border:1px solid red;"';
    }

}



if(isset($_SESSION['adminid']))

{


include('header.php');

?>
    <script src="assets/js/jquery.js"></script>
<link type="text/css" href="assets/css/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<!-- <script type="text/javascript" src="assets/js/jquery-1.3.2.min.js"></script> -->
<script type="text/javascript" src="assets/js/jquery-ui-1.7.2.custom.min.js"></script>
 <script type="text/javascript" src="assets/js/timepicker.js"></script> 
<script type="text/javascript">

$(function() {

    $('#dailydate').datepicker({

    	duration: '',

        showTime: true,

        constrainInput: false

     });
	 
	  $('#oncedate').datepicker({

    	duration: '',

        showTime: true,

        constrainInput: false

     });

});

</script>


<!-- <script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script> -->


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

});

</script>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="viewreminder.php">Reminders</a> <span class="divider">/</span>
        <!--li class="active"-->Add Reminders</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
if(isset($_SESSION['require']))
{
    echo '<div class="alert alert-error">
    <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>Required Field(s) should not be blank!! </strong>
      </div>';
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
         		<form class="form-horizontal" action="updatereminder.php" method="POST" name="dd1" id="dd1">
              		<fieldset>
              		<legend>Add Reminder</legend>
              			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Reminder Name</label>
                  	<div class="controls">
                    <?php if(isset($_SESSION['values']['remindername']))
{
    ?>
    <input type="text" class="input-medium" value="<?php echo $_SESSION['values']['remindername']; ?>" <?php valid_check("remindername")?> name="remindername" id="remindername">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
    <?php
}
else
{
    ?>
   <input type="text" class="input-medium" <?php valid_check("remindername")?> name="remindername" id="remindername">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
    <?php
}
    ?>

    </div>

                	</div>

              		<div class="control-group">
            <label for="select01" class="control-label"><span style=" color : red;">*</span>Select Patient</label>
            <div class="controls">
              <select id="select01" name="patient">
		<option>Select</option>
<?php

include('config.php');

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


		<div class="control-group">
                <label class="control-label" for="input501"><span style=" color : red;">*</span>Reminder Date</label>
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
              </select>
		<select id="select01" class="input-small" name="timeformat">
		<option>Select</option>
		<option>AM</option>
		<option>PM</option>
		</select></i>
                </div>
                </div>
		
<div class="controls">
<div id="accordion2" class="accordion">
            <div class="accordion-group" style="width: 200px;">
              <div class="accordion-heading">
		 <a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle"> Add Medicine</a>
              </div>
              <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                <div class="accordion-inner">
		<ul style="height: auto;" id="store-dropdown" class="in collapse">
<?php

	$sqlremmedicine = "SELECT * FROM tbl_medication_details;";

	$queryremmedicine = mysql_query($sqlremmedicine);

		while($remindermedicine = mysql_fetch_array($queryremmedicine))
		{

?>

		<li>
		 <input type="checkbox" name="Medicine[]" id="<?php echo $remindermedicine['md_medicine_name']; ?>" value="<?php echo $remindermedicine['md_medication_id']; ?>">  <?php echo $remindermedicine['md_medicine_name']; ?></li>

<?php

}

?>

		</ul>
                </div>
              </div>
              </div>





           <div class="accordion-group" style="width: 200px;">
              <div class="accordion-heading">
		 <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle"> Add Assessment </a>
              </div>
              <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
                <div class="accordion-inner">
		<ul style="height: auto;" id="store-dropdown" class="collapse">
<?php

	$sqlassess = "SELECT * FROM tbl_assessment_details;";

	$queryassess = mysql_query($sqlassess);

		while($assess = mysql_fetch_array($queryassess))
		{

?>

		<li>
		 <input type="checkbox" name="assessment[]" id="<?php echo $assess['ad_assessment_name']; ?>" value="<?php echo $assess['ad_assessment_id']; ?>">  <?php echo $assess['ad_assessment_name']; ?></li>

<?php

}

?>

		</ul>
                </div>
              </div>
            </div>
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
unset($_SESSION['require']);

unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['values']['remindername']);
unset($_SESSION['values']['patient']);
unset($_SESSION['values']['radio']);

?>

<?php
}
else
{
header('Location:login.php');
}
?>
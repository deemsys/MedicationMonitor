<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');

include('config.php');

$id = $_GET['patid'];
// echo $id; exit;


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

    $(".mngdisp .mngaddbtn").live('click',function () {

	var textcounter = $(this).parents('.mngdisp').find('.clscounter').length;
	
	if(textcounter >2){
            alert("Only 3 textboxes allow");
            return false;
	}

	var id = $(this).attr('name');

var dec = $("#TextBoxesMorng_"+id+" .clscounter").length + 1;

        var divAfter = "#TextBoxMor"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxMor' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><div class="controls"><select id="select01" class="input-medium" name="hour'+id+'[]" id="hour'+id+"_"+dec + '"><option>Select Time</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option></select><select class="input-small" name="min'+id+'[]" id="min'+id+"_"+dec + '"><option>00</option><option>15</option><option>30</option><option>45</option></select><input type="hidden" name="medid'+id+'" value="'+id+'"></div></div>');

	newTextBoxDiv.appendTo("#TextBoxesMorng_"+id);

	var picker = '#Time'+id+"_"+dec;
	$(picker).datepicker({

		duration: '',
	
		showTime: false,

		constrainInput: false
	
	});


     });



    $(".mngdisp .mngremovebtn").on('click',function () {


	var elem = $(this).parents('.mngdisp').find('.clscounter');

	var divCounter = (elem.length);

	if(divCounter==0){
          alert("No more textbox to remove");
          return false;
        }else{

		$(this).parents('.mngdisp').find('div.clscounter').last().remove();

	}
	
	return false;
 
     });
 

    $(".aftdisp .aftaddbtn").live('click',function () {

	var textcounter = $(this).parents('.aftdisp').find('.clscounter').length;
	
	if(textcounter >2){
            alert("Only 3 textboxes allow");
            return false;
	}

	var id = $(this).attr('name');

var dec = $("#TextBoxesAft_"+id+" .clscounter").length + 1;

        var divAfter = "#TextBoxAft"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxAft' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><div class="controls"><select id="select01" class="input-small" name="hour'+id+'[]" id="hour'+id+"_"+dec + '"><option>Select Time</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option></select><select class="input-small" name="min'+id+'[]" id="min'+id+"_"+dec + '"><option>00</option><option>15</option><option>30</option><option>45</option></select><input type="hidden" name="medid'+id+'" value="'+id+'"></div></div>');

	newTextBoxDiv.appendTo("#TextBoxesAft_"+id);

	var picker = '#Time'+id+"_"+dec;
	$(picker).datepicker({

		duration: '',
	
		showTime: false,

		constrainInput: false
	
	});


     });



    $(".aftdisp .aftremovebtn").on('click',function () {


	var elem = $(this).parents('.aftdisp').find('.clscounter');

	var divCounter = (elem.length);

	if(divCounter==0){
          alert("No more textbox to remove");
          return false;
        }else{

		$(this).parents('.aftdisp').find('div.clscounter').last().remove();

	}
	
	return false;
 
     });

 

    $(".evedisp .eveaddbtn").live('click',function () {

	var textcounter = $(this).parents('.evedisp').find('.clscounter').length;
	
	if(textcounter >2){
            alert("Only 3 textboxes allow");
            return false;
	}

	var id = $(this).attr('name');

var dec = $("#TextBoxesEve_"+id+" .clscounter").length + 1;

        var divAfter = "#TextBoxEve"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxEve' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><div class="controls"><select id="select01" class="input-small" name="hour'+id+'[]" id="hour'+id+"_"+dec + '"><option>Select Time</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option></select><select class="input-small" name="min'+id+'[]" id="min'+id+"_"+dec + '"><option>00</option><option>15</option><option>30</option><option>45</option></select><input type="hidden" name="medid'+id+'" value="'+id+'"></div></div>');

	newTextBoxDiv.appendTo("#TextBoxesEve_"+id);

	var picker = '#Time'+id+"_"+dec;
	$(picker).datepicker({

		duration: '',
	
		showTime: false,

		constrainInput: false
	
	});


     });



    $(".evedisp .everemovebtn").on('click',function () {


	var elem = $(this).parents('.evedisp').find('.clscounter');

	var divCounter = (elem.length);

	if(divCounter==0){
          alert("No more textbox to remove");
          return false;
        }else{

		$(this).parents('.evedisp').find('div.clscounter').last().remove();

	}
	
	return false;
 
     });

  });

</script>

<script type="text/javascript">

 $(document).ready(function() {
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
        <li class="active">Add Medicine</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
		<h2>Patient Name : <?php echo $patientrecords['pid_patient_username']; ?></h2>
		<h2>Age : <?php echo $patientrecords['pid_patient_age']." ".$patientrecords['pid_patient_sex']; ?>
		<a href="addmedicine.php"><button class="btn pull-right">Define New Medicine</button></a></h2>
		</div>

		 
	<form method="POST" action="updatemedtime.php?patid=<?php echo $id; ?>">
		<div class="control-group">

		<div class="controls">

			<table class="orders-table table">
				<tbody>
<tr>

<?php

	$sql12 = "SELECT * FROM tbl_medication_details ORDER BY md_medicine_name ASC";
	$query12 = mysql_query($sql12);
	
		while($med12 = mysql_fetch_array($query12))
		{

?>
	<td style="width : 500px;">
		<div class="clsmedipack">
		<input type="checkbox" class="abc" name="medicine[]" id="<?php echo $med12['md_medicine_name']; ?>" value="<?php echo $med12['md_medication_id']; ?>"> <?php echo $med12['md_medicine_name']."<br />"; ?>
<div id="medtime" class="clsmedtime" style="border:#ccc 1px solid; padding:10px; width : 500px;">

			<div class="control-group">
			
                	</div>

<!--			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn addbtn" value='Add Time' id='addButton' name="<?php echo $med12['md_medication_id']; ?>">
			<input type='button' class="btn removebtn" value='Remove Time' id='removeButton' name="<?php echo $med12['md_medication_id']; ?>">
                    	</div>
                	</div>-->



			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			From Date <input type='text' class="input-medium" placeholder="Select From Date" name="fromdate_<?php echo $med12['md_medication_id']; ?>" id="fromdate_<?php echo $med12['md_medication_id']; ?>">
			To Date <input type='text' class="input-medium" placeholder="Select To Date" name="todate_<?php echo $med12['md_medication_id']; ?>" id="todate_<?php echo $med12['md_medication_id']; ?>">
			<p><input type="radio" id="medtype_<?php echo $med12['md_medication_id']; ?>" name="medtype_<?php echo $med12['md_medication_id']; ?>" value="Once"> Once
			<input type="radio" id="medtype_<?php echo $med12['md_medication_id']; ?>" name="medtype_<?php echo $med12['md_medication_id']; ?>" value="Daily"> Daily
			<input type="radio" id="medtype_<?php echo $med12['md_medication_id']; ?>" name="medtype_<?php echo $med12['md_medication_id']; ?>" value="Every Couple of days"> Every Couple of days</p>
                    	</div>
                	</div>


			
			
			<div class="control-group mngdisp">
                  	<div class="controls" id='TextBoxesMorng_<?php echo $med12['md_medication_id']; ?>'>
                    	<label class="control-label" style="margin : 15px;" for="input01">Morning
			<input type='button' style="margin-left : 25px;" class="btn mngaddbtn" value='Add Morning Time' id='addButton' name="<?php echo $med12['md_medication_id']; ?>">
			<input type='button' class="btn mngremovebtn" value='Remove Morning Time' id='removeButton' name="<?php echo $med12['md_medication_id']; ?>"></label>
			</div></div>

			<div class="control-group aftdisp">
                  	<div class="controls" id='TextBoxesAft_<?php echo $med12['md_medication_id']; ?>'>
                  	<label class="control-label" style="margin : 15px;" for="input01">Afternoon
			<input type='button' style="margin-left : 15px;" class="btn aftaddbtn" value='Add Afternoon Time' id='addButton' name="<?php echo $med12['md_medication_id']; ?>">
			<input type='button' class="btn aftremovebtn" value='Remove Afternoon Time' id='removeButton' name="<?php echo $med12['md_medication_id']; ?>"></label>
			</div></div>

			<div class="control-group evedisp">
                	<div class="controls" id='TextBoxesEve_<?php echo $med12['md_medication_id']; ?>'>
                	<label class="control-label" style="margin : 15px;" for="input01">Evening
			<input type='button' style="margin-left : 25px;" class="btn eveaddbtn" value='Add Evening Time' id='addButton' name="<?php echo $med12['md_medication_id']; ?>">
			<input type='button' class="btn everemovebtn" value='Remove Evening Time' id='removeButton' name="<?php echo $med12['md_medication_id']; ?>"></label>
			</div></div>

		</div>
		</div>

<?php
$b=1;
$b++;
	
if($b == 2)
{
 echo "</td><tr>";
$b = 0;

}
else{ 

echo "</td>";
}

}

?>
</tr>
</tbody>
</table>


</div>

	</div>
	<div class="form-actions">
	<button type="submit" class="btn btn-primary">Submit</button>

	</div>
	</form>

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

//   $(".clsmedtime .input-medium").live('click',function () {
// 	var pickdate = $(this).attr('id');
// 
// alert(picdate);


	  $(".clsmedtime .input-medium").datepicker({

    	duration: '',

//         showTime: true,

        constrainInput: false

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

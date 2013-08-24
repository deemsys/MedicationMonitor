<?php
session_start();

if($_SESSION['adminid'] != '')
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

    $(".clsmedtime .addbtn").live('click',function () {

	var textcounter = $(this).parents('.clsmedtime').find('.clscounter').length;
	
	if(textcounter >2){
            alert("Only 3 textboxes allow");
            return false;
	}

	var id = $(this).attr('name');

var dec = $("#TextBoxesGroup_"+id+" .clscounter").length + 1;

        var divAfter = "#TextBoxDiv"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxDiv' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><label class="control-label" for="input01">Time '+ dec + '</label>' + '<div class="controls"><label class="control-label"><input class="input-medium" type="text" name="Time'+id+'[]" id="Time'+id+"_"+dec + '" value="" ></label><input type="hidden" name="Ansid'+id+'" value="'+id+'"></div></div>');


	newTextBoxDiv.appendTo("#TextBoxesGroup_"+id);

	var picker = '#Time'+id+"_"+dec;
	$(picker).datepicker({

		duration: '',
	
		showTime: false,

		constrainInput: false
	
	});


     });
 

    $(".clsmedtime .removebtn").on('click',function () {


	var elem = $(this).parents('.clsmedtime').find('.clscounter');

	var divCounter = (elem.length);

	if(divCounter==0){
          alert("No more textbox to remove");
          return false;
        }else{

		$(this).parents('.clsmedtime').find('div.clscounter').last().remove();

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
function getid(medval)
{
     alert(medval);
}
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
		<h2>Age : <?php echo $patientrecords['pid_patient_age']." ".$patientrecords['pid_patient_sex']; ?></h2>
		</div>
<!-- 		<form name="patient" method="POST" action=""> -->


<!-- </form> -->


		<a href="addmedicine.php"><button class="btn pull-right">Define New Medicine</button></a> 
	<form method="POST" action="updatemedtime.php?patid=<?php echo $id; ?>&type=medicine">
		<div class="control-group">

		<div class="controls">
<!--		<label for="input117" class="control-label">Medicine :</label>-->


<?php

	$sql12 = "SELECT * FROM tbl_medication_details";
	$query12 = mysql_query($sql12);
	
		while($med12 = mysql_fetch_array($query12))
		{

?>
		<div class="clsmedipack">
		<input type="checkbox" class="abc" name="medicine[]" id="<?php echo $med12['md_medicine_name']; ?>" value="<?php echo $med12['md_medicine_id']; ?>"> <?php echo $med12['md_medicine_name']."<br />"; ?>
<div id="medtime" class="clsmedtime" style="border:#ccc 1px solid; padding:10px; width : 250px;">

			<div class="control-group" id='TextBoxesGroup_<?php echo $med12['md_medicine_id']; ?>'>
			
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn addbtn" value='Add Time' id='addButton' name="<?php echo $med12['md_medicine_id']; ?>">
			<input type='button' class="btn removebtn" value='Remove Time' id='removeButton' name="<?php echo $med12['md_medicine_id']; ?>">
                    	</div>
                	</div>



		</div>
		</div>

<?php

}

?>


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

//  alert("gds");
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

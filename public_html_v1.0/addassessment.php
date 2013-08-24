<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');
?>
<!-- <script language="javascript" type="text/javascript" src="assets/js/addfield.js"></script> -->
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
 
$(document).ready(function(){
 $('#addquest').hide();
  $('#addquestion').click(function(){
 $('#addquest').show();

});


 $('#assign').hide();
  $('#asspati').click(function(){
 $('#assign').show();

});

  $('#assremind').click(function(){
 $('#assign').show();

});

});
</script>
<script type="text/javascript">
 
$(document).ready(function(){
 
    var counter = 1;
 
    $("#addButton").click(function () {
 
	if(counter>4){
            alert("Only 4 textboxes allow");
            return false;
	}   
 
	var dec	= counter - 1;
        var divAfter = "#TextBoxDiv"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxDiv' + counter);
 //alert(divAfter);
	newTextBoxDiv.after(divAfter).html('<div class="control-group"><label class="control-label" for="input01">Answer '+ counter + '</label>' + '<div class="controls"><label class="control-label"><input class="input-medium" type="text" name="Answer[]" id="Answer'+ counter + '" value="" ></label></div></div>');


	newTextBoxDiv.appendTo("#TextBoxesGroup");
 
 
	counter++;
     });
 
     $("#removeButton").click(function () {
	if(counter==2){
          alert("No more textbox to remove");
          return false;
       }   
 
	counter--;
 
        $("#TextBoxDiv" + counter).remove();
 
     });
 
     $("#getButtonValue").click(function () {
 
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Answer " + i + " : " + $('#Answer' + i).val();
	}
    	  alert(msg);
     });
  });
</script>


<script type="text/javascript">
function showpatient(str)
{

	if(str=="")
	{
		document.getElementById("assign").innerHTML="";
		return;
	}
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("assign").innerHTML=xmlhttp.responseText;
		}
	}

	var url="assigntype.php?type="+str;

	xmlhttp.open("GET",url,true);

	xmlhttp.send();
}

function showreminder(str)
{

	if(str=="")
	{
		document.getElementById("assign").innerHTML="";
		return;
	}
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("assign").innerHTML=xmlhttp.responseText;
		}
	}

	var url="assigntype.php?type="+str;

	xmlhttp.open("GET",url,true);

	xmlhttp.send();
}


</script>





 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Assessment<span class="divider">/</span></li>
	<li class="active">Add Assessment</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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

			<h3>Medication Monitor</h3>
			</div>
			<div id="global" class="tab-pane fade active in">
         		<form class="form-horizontal" action="updateassmnt.php" method="POST">
              		<fieldset>
              		<legend>Add Assessment</legend>
              		<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Assessment Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['assessment']; ?>" name="assessment" id="assessment">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
                    	</div>
                	</div>

			<!--<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Assessment Type</label>
                  	<div class="controls">
			<label class="radio"><input type="radio" name="asstype" value="daily"> Daily</label>
			<label class="radio"><input type="radio" name="asstype" value="weekly"> Weekly</label>
			<label class="radio"><input type="radio" name="asstype" value="monthly"> Monthly</label>
                    	</div>
                	</div>-->


			<!--<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Assign By</label>
                  	<div class="controls">
			<label class="radio" id="asspati"><input onclick="showpatient(this.value);" type="radio" name="assignby" value="Patient"> Patients</label>
			<label class="radio" id="assremind"><input onclick="showreminder(this.value);" type="radio" name="assignby" value="Reminder"> Reminders</label>
                    	</div>
                	</div>-->


			<div class="control-group">
			<label class="checkbox">
                  	<div class="controls">
		<div id="assign" style="border:#ccc 1px solid; padding:10px; width : 500px;">
			<input type="checkbox">
			</label>
                    	</div>
                	</div>

		</div>


			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn" value='Add Question' id='addquestion'>
                    	</div>
                	</div>


		<div id="addquest" style="border:#ccc 1px solid; padding:10px;">
              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Question</label>
                  	<div class="controls">
                    	<textarea placeholder=" please Enter your Question" name="question" rows="3" id="question" class="input-xlarge"></textarea>
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Answer Option</label>
                  	<div class="controls">
			<label class="radio"><input type="radio" name="ansoption" value="single"> Single Choice</label>
			<label class="radio"><input type="radio" name="ansoption" value="multi"> Multi Choice</label>
                    	</div>
                	</div>


			<div class="control-group" id='TextBoxesGroup'>
			<div id="TextBoxDiv1">
			</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn" value='Add Answer' id='addButton'>
			<input type='button' class="btn" value='Remove Answer' id='removeButton'>
<!-- 			<input type='button' class="btn" value='Get TextBox Value' id='getButtonValue'> -->
                    	</div>
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
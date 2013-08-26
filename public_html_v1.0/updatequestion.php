<?php
session_start();


if(isset($_SESSION['userid']))
{


include('header.php');

require("config.php");
?>
<!-- <script language="javascript" type="text/javascript" src="assets/js/addfield.js"></script> -->
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>


<script type="text/javascript">
 
$(document).ready(function(){
 
    var counter = 1;
 
    $("#addButton").click(function () {

	if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
	}   
	var id = $(this).attr('name');
//  		var ince += 1;
	//var dec	= counter - 1;
var dec = $("#TextBoxesGroup_"+id+".clscounter").length + 1;
//   alert(counter);
        var divAfter = "#TextBoxDiv"+dec;
	var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'TextBoxDiv' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><label class="control-label" for="input01">Answer '+ dec + '</label>' + '<div class="controls"><label class="control-label"><input class="input-medium" type="text" name="Answer'+id+'[]" id="Answer'+id+"_"+dec + '" value="" ></label><input type="hidden" name="Ansid'+id+'" value="'+id+'"></div></div>');


	newTextBoxDiv.appendTo("#TextBoxesGroup_"+id);
 
 
	counter++;

     });
 
     $("#removeButton").live('click',function () {
	if(counter==1){
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
 
$(document).ready(function(){
 	$('#addquestion').hide();
 	$('#addquest').click(function(){
		$('#addquestion').show();
	});
	$('.clsControl').live('click',function(){
		var id = $(this).attr('name');
// alert(id);
		$.ajax({
			type: "POST",
			url: 'subquestion.php',
			data: { str: id }
			}).done(function( msg ) {
			var dt = '#sel_'+id;
			$(msg).appendTo($(dt));
		});
		$(this).closest('.clsControl').attr('disabled','disabled');
	});

});
</script>



<script type="text/javascript">
function getid(quest)
{
//  alert(quest);
	if(quest=="")
	{
		document.getElementById("showans").innerHTML="";
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
			document.getElementById("showans").innerHTML=xmlhttp.responseText;
		}
	}

	var url="answer.php?ans="+quest;

	xmlhttp.open("GET",url,true);

	xmlhttp.send();
}
</script>



 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Assessment<span class="divider">/</span></li>
	<li class="active">Add Questionnaire</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
         		<form class="form-horizontal" action="updatedaily.php" method="POST">
              		<fieldset>
              		<legend>Add Question</legend>
              		<!--<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>-->


<?php


	$sqlassesment = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$_GET['id'];
	$queryasses = mysql_query($sqlassesment);

	$recordsasses = mysql_fetch_array($queryasses);
	$_SESSION['assess_id'] = $_GET['id'];
?>


<dl>
<dt style="float:left; margin-right:20px; margin-left:10px">Assessment Name :</dt>
<dd><?php echo $recordsasses['ad_assessment_name']; ?></dd>
</dl>

<?php

	$sqlassign1 = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$_GET['id'];
	$queryassign1 = mysql_query($sqlassign1);
		$recassign = mysql_fetch_array($queryassign1);
?>



	<table class="table table-bordered">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Question</th>
            <th width="100">Question Type</th>
            <th>No.of Answers</th>
            <th width="100">Action</th>
          </tr>
        </thead>
        <tbody>
<?php

	$sqlquestion = "SELECT * FROM tbl_question_details WHERE qd_assessment_id = ".$_GET['id'];
	$queryquestion = mysql_query($sqlquestion);

	

	for($i=1;$i<=mysql_num_rows($queryquestion);$i++)
	{
		$recordsquest = mysql_fetch_array($queryquestion);

	$sqlselans = "SELECT * FROM tbl_answers_details WHERE ans_question_id = ".$recordsquest['qd_question_id'];
	$queryselans = mysql_query($sqlselans);
	$countselans = mysql_num_rows($queryselans);


	$sqlans = "SELECT * FROM tbl_question_details WHERE qd_parentquestion_id = ".$recordsquest['qd_question_id'];
	$queryans = mysql_query($sqlans);
	$recans = mysql_fetch_array($queryans);
 	$countparentanswer = mysql_num_rows($queryans);

?>


          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $recordsquest['qd_question_name']; ?></td>
            <td><?php echo $recordsquest['qd_question_type']; ?></td>
            <td><?php echo $countselans; ?></td>
<?php

	if($countselans == 2 && $recordsquest['qd_question_type'] == 'single' && $countparentanswer == '')
	{

?>
            <td ><div title="Add Question" class="btn" onclick="getid(<?php echo $recordsquest['qd_question_id']; ?>);" ><i class="icon-plus" value="<?php echo $recordsquest['qd_question_id']; ?>"></i></div>
		<a title="Delete Question" href="javascript:validate(<?php echo $recordsquest['qd_question_id']; ?>);" class="btn" ><i class="icon-trash"></i></a></td>

<?php

}
else
{
?>
            <td ><div title="Add Question" disabled="disabled" class="btn" ><i class="icon-plus" value="<?php echo $recordsquest['qd_question_id']; ?>"></i></div>
		<a title="Delete Question" href="javascript:validate(<?php echo $recordsquest['qd_question_id']; ?>);" class="btn" ><i class="icon-trash"></i></a></td>

<?php

}

?>

          </tr>


<?php


	}
?>
        </tbody>
      </table>


			

			<!--<div class="control-group">
                  	<label class="control-label">References</label>
                  	<div class="controls">
                  	  <p><a href="#uploadquest" class="btn btn-inverse" data-toggle="modal">Upload Dcouments</a></p>
                  	  </div>
                	</div>-->






		<div id="showans">

			
		</div>

			<!--<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn" value='Add Question' id="addquest">
                    	</div>
                	</div>-->
		        </form>

		<legend>Add Independent Questionnaire</legend>
         		<form action="updatedailyind.php" method="POST">
              		<div class="control-group"><input type="hidden" name="assesid" value="<?php echo $_GET['id']; ?>">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Question</label>
                  	<div class="controls">

                        <!--?php echo $_REQUEST['str']; ?>-->
                    	<textarea placeholder=" please Enter your Question" name="question_" rows="3" id="question" class="input-xlarge"></textarea>
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Answer Type</label>
                  	<div class="controls">
                        <?php
                        if(isset($_REQUEST['str']))
                        {
                        ?>
                        <label class="radio"><input type="radio" name="ansoption_<?php echo $_REQUEST['str']; ?>" value="single"> Single Choice</label>
			<label class="radio"><input type="radio" name="ansoption_<?php echo $_REQUEST['str']; ?>" value="multi"> Multi Choice</label>'
                        <?php
                        }
                        else
                        {
                        ?>
                            <label class="radio"><input type="radio" name="ansoption" value="single"> Single Choice</label>
                            <label class="radio"><input type="radio" name="ansoption"  value="multi"> Multi Choice</label>'

                            <?php
                        }

                            ?>
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


function validate(val)
{


	if(val!='')
	{

		var res = confirm('Are you sure you want to delete this Question?');
		if(res)
		{
			window.location="deletequestion.php?id="+val;		
		}

	}


}



</script>
  </body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['values']['Answer1']);
unset($_SESSION['values']['Answer2']);


}
else
{
header('Location:login.php');
}
?>
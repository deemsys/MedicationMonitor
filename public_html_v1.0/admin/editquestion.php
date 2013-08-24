<?php
session_start();


if($_SESSION['adminid'] != '')
{


include('header.php');

require("config.php");

	$sqlassesment = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$_GET['id'];
	$queryasses = mysql_query($sqlassesment);

	$recordsasses = mysql_fetch_array($queryasses);
	$_SESSION['assess_id'] = $_GET['id'];

	$sqlquestion = "SELECT * FROM tbl_question_details WHERE qd_assessment_id = ".$_GET['id']." AND qd_question_id = ".$_GET['qid'];
	$queryquestion = mysql_query($sqlquestion);
	$recordsquest = mysql_fetch_array($queryquestion);

	$sqlselans = "SELECT * FROM tbl_answers_details WHERE ans_question_id = ".$recordsquest['qd_question_id'];
	$recordsans = array();
	$result = mysql_query($sqlselans);
	$html="";
	$i=1;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$recordsans[$row['ans_answer_id']]['ans_answer_name'] = $row['ans_answer_name'];
		$recordsans[$row['ans_answer_id']]['ans_question_id'] = $row['ans_question_id'];
		$recordsans[$row['ans_answer_id']]['ans_answer_created'] = $row['ans_answer_created'];
		$recordsans[$row['ans_answer_id']]['ans_answer_modified'] = $row['ans_answer_modified'];
		$recordsans[$row['ans_answer_id']]['ans_answer_status'] = $row['ans_answer_status'];
		
		$html .= '<div id="TextBoxDiv'.$i.'" class="clscounter">
				<div class="control-group">
					<label for="input01" class="control-label">Answer '.$i.'</label>
					<div class="controls">
						<label class="control-label">
							<input type="text" value="'.$row['ans_answer_name'].'" id="Answer_'.$i.'" name="Answer[]" class="input-medium">
						</label>
						<input type="hidden" value="" name="Ansid">
					</div>
				</div>
			</div>';
		$i++;
	}
	
	         
	$counter = count($recordsans);

?>
<!-- <script language="javascript" type="text/javascript" src="assets/js/addfield.js"></script> -->
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
 
$(document).ready(function(){

	var counter = "<?php echo $counter+1; ?>";
	$("#addButton").live('click',function () {

	if(counter>10){
        	alert("Only 10 textboxes allowed");
            	return false;
	}   
	var id = $(this).attr('name');
	//alert(id);
//	var ince += 1;
//	var dec	= counter - 1;

	var dec = $("#TextBoxesGroup"+id+" .clscounter").length + 1;
//   	alert(counter);

        var divAfter = "#TextBoxDiv"+dec;
	var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + dec).attr("class", 'clscounter');

	newTextBoxDiv.after(divAfter).html('<div class="control-group"><label class="control-label" for="input01">Answer '+ dec + '</label>' + '<div class="controls"><label class="control-label"><input class="input-medium" type="text" name="Answer'+id+'[]" id="Answer'+id+"_"+dec + '" value="" ></label><input type="hidden" name="Ansid'+id+'" value="'+id+'"></div></div>');

	newTextBoxDiv.appendTo("#TextBoxesGroup"+id);
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
              		<legend>Edit Question</legend>
<dl>
<dt style="float:left; margin-right:20px; margin-left:10px">Assessment Name :</dt>
<dd><?php echo $recordsasses['ad_assessment_name']; ?></dd>
</dl>


		<div id="showans">

			
		</div>
		        </form>

		<legend>Edit Indipendent Questionnaire</legend>	
         		<form action="updateeditquestion.php" method="POST">
              		<div class="control-group">
                        <input type="hidden" name="assesid" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="questionid" value="<?php echo $_GET['qid']; ?>">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Question</label>
                  	<div class="controls">
                    	<textarea placeholder=" please enter your Question" name="question" rows="3" id="question" class="input-xlarge"><?=$recordsquest['qd_question_name']?></textarea>
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Answer Type</label>
                  	<div class="controls">
			<label class="radio"><input type="radio" name="ansoption" value="single" <?php if ($recordsquest['qd_question_type']=='single') { echo "checked"; } ?>> Single Choice</label>
			<label class="radio"><input type="radio" name="ansoption" value="multi" <?php if ($recordsquest['qd_question_type']=='multi') { echo "checked"; } ?>> Multi Choice</label>
                    	</div>
                	</div>


			<div class="control-group" id='TextBoxesGroup'>
			<?php echo $html; ?>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn" value='Add Answer' id='addButton' name="">
			<input type='button' class="btn" value='Remove Answer' id='removeButton' name="">
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
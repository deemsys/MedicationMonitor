<?php
// print_r($_GET); exit;
require("config.php");

	$id = intval($_GET['ans']);

?>

<legend>Add Sub Questionnaire</legend>
		<div class="control-group">
		<label for="select01" class="control-label"><span style=" color : red;">*</span> Answer</label>
		<div class="controls">
		
	
<?php
	 	$sqlselans = "SELECT * FROM tbl_answers_details WHERE ans_question_id = '".$id."';";
		$queryselans = mysql_query($sqlselans);

		while($recordselans = mysql_fetch_array($queryselans))
		{

                echo "<i value=".$recordselans['ans_answer_id'].">" .$recordselans['ans_answer_name']. "</i><br />";
		echo "<div class='control-group' id='sel_".$recordselans['ans_answer_id']."'>
                  	<label class='control-label' for='input01'></label>
                  	<div class='controls'>
			<input type='button' class='clsControl btn' value='Add Question' id='addquest' name='".$recordselans['ans_answer_id']."'><input type='hidden' name='parentquest_id' value='".$id."'>
                    	</div>
                	</div>";

		}

?>	
			</div>
			</div>
<?php
echo '<div class="form-actions"><button type="submit" class="btn btn-primary">Submit</button></div>';
?>
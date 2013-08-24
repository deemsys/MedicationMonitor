<?php

require("config.php");

	$type = $_GET['type'];

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

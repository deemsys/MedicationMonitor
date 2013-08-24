<?php
session_start();

if($_SESSION['adminid'] != '')
{

include('config.php');
include('header.php');

$asses_id = $_REQUEST['type'];
$patient_id = $_REQUEST['id'];

	$sqlpatient = "SELECT * FROM tbl_patient_details WHERE pid_patient_id = '".$patient_id."';";

	$querypatient = mysql_query($sqlpatient);
	$patientrecords = mysql_fetch_array($querypatient);

	$sql1 = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = '".$asses_id."';";

	$query1 = mysql_query($sql1);
	$assrecords = mysql_fetch_array($query1);

?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Patient Assessment</li><span class="divider">/</span></li>
        <li class="active">View Assessment</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
          

                <div class="slate">
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
		          <h2>Assessment Name : <?php echo $assrecords['ad_assessment_name']; ?></h2>
            </div>
            <table class="table">
            <thead>
              <tr>
                <th><table class="table">
                  <thead>
                    <tr style="color : #0088CC;">
                      <th> S.No </th>
                      <th> Date </th>
                      <th> </th>
                      <th> Audio </th>
                      <th> Notes </th>

                    </tr>
                  </thead>
                  <tbody>
<?php



 	$sqlass = "SELECT DISTINCT vd_viewass_date FROM tbl_viewassessment_details WHERE vd_viewass_assessmentid = '".$asses_id."' AND vd_viewass_patientid = '".$patient_id."'";
	$queryass = mysql_query($sqlass);
	$countass = mysql_num_rows($queryass);

	for($i=1;$i<=$countass;$i++)
	{
		$recordass = mysql_fetch_array($queryass);

?>
			<tr>
                      <td><?php echo $i; ?></td>
                      <td><a href="viewpatientnotes.php?id=<?php echo $asses_id; ?>&pat=<?php echo $patient_id; ?>&dat=<?php echo $recordass['vd_viewass_date']; ?>"><?php echo $recordass['vd_viewass_date']; ?></a></td>
                      <td> </td>
<!--                       <td><a href="" class="btn"><i class="icon-play"></i></a></td> -->
<?php 
 $sqlaudio = "SELECT * FROM tbl_patientaudio_details WHERE pa_patient_id = '".$patient_id."' AND pa_patientassess_id = '".$asses_id."' AND pa_patientaudio_date = '".$recordass['vd_viewass_date']."'";
$queryaudio = mysql_query($sqlaudio);
$recordaudio = mysql_fetch_array($queryaudio);
if ($recordaudio['pa_patient_audio'] != '') {
  
 ?>
 <td><object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" width="320" height="306" standby="Data is loading..." codebase="http://www.apple.com/qtactivex/qtplugin.cab"> 
<param name="src" value="<?php echo $recordaudio['pa_patient_audio']; ?>"> 
<param name="autoplay" value="false"> 
<param name="controller" value="true"> 
<embed src="<?php echo $recordaudio['pa_patient_audio']; ?>" width="200" height="50" scale="1" autoplay="false" controller="true" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"> 
</embed> 
</object></td>  
<?php
  
}else{
?>
  <td>NO AUDIO</td>  
<?php
}
?>


			<td><a href="#uploadRef_<?php echo $recordass['vd_viewass_id']; ?>" class="btn" data-toggle="modal"> Notes</a>
			<div id="uploadRef_<?php echo $recordass['vd_viewass_id']; ?>" class="modal hide fade" style="display: none; ">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">×</button>
                                      <h2>Notes</h2>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST" action="updatenotes.php?id=<?php echo $recordass['vd_viewass_id']; ?>&pat=<?php echo $patient_id; ?>&ass=<?php echo $asses_id; ?>">
                                      <div class="control-group">
                                      <div class="controls">
                                      <label for="input117" class="control-label">Notes :</label>
                                      <textarea placeholder=" please Enter your notes" name="notes" rows="3" id="notes" class="input-xlarge"><?php echo $recordass['vd_viewass_providernotes']; ?></textarea>
                                      </div>
                                      </div>
				<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                  
		                </div>
					</form>
                                      </div>
                                      </div></td>
                    </tr>

<?php

	}

?>

                  </tbody>
                </table></th>
              </tr>
            </thead>
            </table>
            <div class="row-fluid">
              <div class="span5">
        
              </div>
            <div class="span5">
           
            </div>
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
unset($_SESSION['success']);


}
else
{
header('Location:login.php');
}
?>
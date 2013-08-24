<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');

include('config.php');

$assess_id = $_GET['id'];


	$sqlassessment = "SELECT * FROM tbl_assessment_details WHERE ad_assessment_id = ".$assess_id;
	$queryassessment = mysql_query($sqlassessment);
	$recordsassessment = mysql_fetch_array($queryassessment);
?>

 <div class="container">
 <ul class="breadcrumb">

        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">View Questions</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">


      <div class="row-fluid">
        <!--/span-->


        <div class="span12">
       <div class="row-fluid">
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
		<div class="slate clearfix">

		<div class="page-header">
			<h2>Assessment Name : <?php echo $recordsassessment['ad_assessment_name']; ?></h2>
		</div>

<table class="table table-bordered">
        <thead>
	<TR>
		<th>S.No</th>
		<th>Assessment Question</th>
		<th width="200">Assessment Answers</th>
		<th width="100">Question Type</th>
	</TR>
	</thead>
<?php





	$sql11 = "SELECT * FROM tbl_question_details WHERE qd_assessment_id = ".$assess_id;

	$query11 = mysql_query($sql11);
	

	while($records11 = mysql_fetch_array($query11))
	{



?>
		<tr>
                        <TD> <?php echo $i+=1; ?> </TD>
			<TD><?php echo $records11['qd_question_name']; ?></TD>
			<TD>
<?php

	$sql12 = "SELECT * FROM tbl_answers_details WHERE ans_question_id = ".$records11['qd_question_id'];
	$query12 = mysql_query($sql12);

	while($records12 = mysql_fetch_array($query12))
	{



			echo $records12['ans_answer_name']."<br />";



	}

?>
			</TD>
			<TD><?php echo $records11['qd_question_type']; ?></TD>
		</tr>
<?php
	}

?>			
					</table>
                          <ul>
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
unset($_SESSION['error']);
unset($_SESSION['success']);

}
else
{
header('Location:login.php');
}
?>
<?php
session_start();

if($_SESSION['userid'] != '')
{

// print_r($_GET); exit;

include('header.php');
include('config.php');

$patient_id = $_GET['pat'];
$assesquest_id = $_GET['id'];

	$sql1 = "SELECT * FROM tbl_patient_details WHERE pid_patient_id =".$patient_id;
	$query1 = mysql_query($sql1);
	$records1 = mysql_fetch_array($query1);


?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Patient Assessment</li><span class="divider">/</span></li>
        <li class="active">View Patient Assessment</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->


        <div class="span12">
          <div class="row-fluid">

           <div class="slate">


            <div class="page-header">
             <h2>Patient Name : <?php echo $records1['pid_patient_username']; ?> </h2>
            </div>
           <table class="table">
                  <thead>
                    <tr style="color : #0088CC;">
                      <th> S.No</th>
                      <th> Assessment question</th>
                      <th> Answer</th>
                      <th> Patient Notes</th>
                      <!--<th> Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
<?php


	$datechk = $_GET['dat'];
	$sql2 = "SELECT * FROM tbl_viewassessment_details WHERE vd_viewass_assessmentid =".$assesquest_id." AND vd_viewass_patientid = ".$patient_id." AND vd_viewass_date LIKE '".$datechk."'" ;

	$query2 = mysql_query($sql2);


		for($i=1;$i<=mysql_num_rows($query2);$i++)
		{
			$records2 = mysql_fetch_array($query2)

?>
			<tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $records2['vd_viewass_question']; ?></td>
                      <td><?php echo $records2['vd_viewass_answer']; ?></td>
                      <td><?php echo $records2['vd_viewass_patientnotes']; ?></td>

                    </tr>
<?php
		}
	
?>



                  </tbody>
                </table>
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

		var res = confirm('Are you sure you want to delete this Appointment?');
		if(res)
		{
			window.location="deleteappoint.php?id="+val;		
		}

	}


}

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
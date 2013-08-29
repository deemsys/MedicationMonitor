<?php
session_start();

if($_SESSION['userid'] != '')
{

include('header.php');
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">My Patients</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>

 <div class="container-fluid">

      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">

                <div class="slate">
            <div class="btn-group pull-right"><a href="Patientregister.php"  class="btn btn-inverse">Add New Patients</a> <!--<a href="#inviteCustomer" data-toggle="modal" class="btn btn-inverse">Invite New Patients</a>-->

            </div>
            <div class="page-header">
              <h2>List of my Patients </h2>
            </div>
            <?php

            if(isset($_SESSION['success']) && $_SESSION['success']!='')

            {

                echo '<div class="alert alert-success">

        <button data-dismiss="alert" class="close" type="button">×</button>

        <strong>'.$_SESSION['success'].'.</strong>

      </div>';
            }

            ?>

            <table class="table">
                  <thead>
                    <tr>
                        <th>S.No</th>
                      <th> Patients Name</th>
                      <th> Patient User Name</th>
                      <th> Email</th>
                      <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
include('config.php');


	$sqlreminder = "SELECT COUNT(*) as num FROM tbl_relationship_details WHERE rs_relation_providerid = '".$_SESSION['userid']."' AND rs_relation_status = '1'";

$num=0;

	$total_pages = mysql_fetch_array(mysql_query($sqlreminder),$num);

	$recordsreminder123 = $total_pages[$num];

	$targetpage = "mypatientlist.php"; 	
	$limit = 6;
	$stages = 3;
if(isset($_GET['page']))
    $page =mysql_escape_string($_GET['page']);
else
    $page=0;
		if($page)
	{
		$start = ($page - 1) * $limit; 
	}
	else
	{
		$start = 0;	
	}

		$sqlreminder = "SELECT r.*, p.* FROM tbl_relationship_details as r , tbl_patient_details as p WHERE r.rs_relation_providerid = '".$_SESSION['userid']."' && p.pid_patient_id  = r.rs_relation_patientid AND rs_relation_status = '1' ORDER BY p.pid_patient_date DESC LIMIT $start, $limit";
// 	$sqlreminder = "SELECT * FROM tbl_relationship_details WHERE rs_relation_providerid = '".$_SESSION['userid']."' LIMIT $start, $limit";

	$querypatient = mysql_query($sqlreminder);
	
	// Initial page num setup
	if ($page == 0)
	{
		$page = 1;
	}
	$prev = $page - 1;	
	$next = $page + 1;
	$lastpage = ceil($recordsreminder123/$limit);
	$LastPagem1 = $lastpage - 1;	
	$paginate = "";
$i=0;
		while($recordspatient = mysql_fetch_array($querypatient))
		{

?>
		<tr>
                      <td><?php echo $start+($i+=1); ?></td>
                      <td><?php echo $recordspatient['pid_patient_firstname']; echo " ".$recordspatient['pid_patient_lastname']; ?></td>
                      <td><a href="patientdetails.php?id=<?php echo $recordspatient['pid_patient_id']; ?>"><?php echo $recordspatient['pid_patient_username']; ?></a></td>
                      <td><?php echo $recordspatient['pid_patient_emailid']; ?></td>
                      <td><div class="btn-group">   <a title="Edit Patient" href="editpatient.php?id=<?php echo $recordspatient['pid_patient_id']; ?>" class="btn"><i class="icon-pencil"></i></a><a title="Delete Patient" href="javascript:validate(<?php echo $recordspatient['pid_patient_id']; ?>);" class="btn"><i class="icon-trash"></i></a> </div></td>

		</tr>
<?php
		}
	
?>


                  </tbody>
                </table>

<div class="pagination">
	<ul>
<?php


	if($lastpage > 1)
	{	
		// Previous
		if ($page > 1)
		{
			$paginate.= "<li><a href='$targetpage?page=$prev'>Prev</a></li>";
		}
		else
		{
			$paginate.= "";
		}

		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	

			for ($counter = 1; $counter <= $lastpage; $counter++)
			{

				if ($counter == $page)
				{
					
					$paginate.= "<li class='active'><a href='$targetpage?page=$counter'>$counter</a></li>";
				}
				else
				{
					$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";
				}
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page)
					{
						$paginate.= "<li class='active'>$counter</li>";
					}
					else
					{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";
					}
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";

				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{

					if ($counter == $page)
					{
						$paginate.= "<li class='active'>$counter</li>";
					}
					else
					{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";
					}
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{ 
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					{
						$paginate.= "<li class='active'>$counter</li>";
					}
					else
					{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";
					}
				}
			}
		}
					
				// Next
		if ($page < $counter - 1)
		{ 
			$paginate.= "<li><a href='$targetpage?page=$next'>next</a></li>";
		}
		else
		{
			$paginate.= "";
		}
			

}
 echo $paginate;

?>
    </ul>
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


function validate(val)
{


	if(val!='')
	{

		var res = confirm('Are you sure you want to delete this Patient?');
		if(res)
		{
			window.location="deletemypatient.php?id="+val;		
		}

	}


}


</script>
  </body>
</html>
<?php
    unset($_SESSION['success']);
unset($_SESSION['error']);
}
else
{
header('Location:login.php');
}
?>
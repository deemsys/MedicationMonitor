<?php
session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');
include('config.php');
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
       <!-- <li class="active">Appointment</li><span class="divider">/</span></li>-->
        <li class="active">Appointments</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
           <div class="btn-group pull-right">
		<a href="appoinment.php" class="btn btn-inverse">Define New Appointment</a>
            </div>

            <div class="page-header">
              <h2>List of Appointments </h2>
            </div>
 
<?php

$num=0;

	$sqlreminder = "SELECT COUNT(*) as num FROM tbl_appointment_details";

	$total_pages = mysql_fetch_array(mysql_query($sqlreminder),$num);

	$recordsreminder123 = $total_pages[$num];

	$targetpage = "viewappionment.php";
	$limit = 10; 
	$stages = 3;
//Removed by suresh
	//$page = mysql_escape_string($_GET['page']);
//added by suresh
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

	
	$sqlreminder = "SELECT * FROM tbl_appointment_details ORDER BY app_appointment_date DESC LIMIT $start, $limit";

	$queryapp = mysql_query($sqlreminder);
	
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

/*
	$sqlapp = "SELECT * FROM tbl_appointment_details";

	$queryapp = mysql_query($sqlapp);*/
	
?>

          <table class="table">
                  <thead>
<!-- 			<tr><u colspan="5"><u style="color : #0088CC;"><h4>Records <?php echo $start+1; ?> of <?php echo $recordsreminder123; ?></h4></u></TD></tr> -->
                    <tr style="color : #0088CC;">
                      <th> S.No</th>
                      <th> Appointment Date </th>
                      <th> Notes </th>
                      <th width="100"> Patient Name </th>
                      <th width="100"> Action </th>
                    </tr>
                  </thead>
                  <tbody>

<?php
		for($i=0;$i<mysql_num_rows($queryapp);$i++)
		{
			$recordsapp = mysql_fetch_array($queryapp)
?>
		<tr>
			<td><?php echo $start+($i+1); ?></td>
			<td><?php echo $recordsapp['app_appointment_date']; ?></td>
			<td><?php echo $recordsapp['app_appointment_note']; ?></td>
			
			<td><?php echo $recordsapp['app_appointment_patientname']; ?></td>

			 <td><div class="btn-group">   <a title="Edit Appointment" href="editappoint.php?id=<?php echo $recordsapp['app_appointment_id']; ?>" class="btn"><i class="icon-pencil"></i></a><a title="Delete Appointment" href="javascript:validate(<?php echo $recordsapp['app_appointment_id']; ?>);" class="btn"><i class="icon-trash"></i></a> </div></td>
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
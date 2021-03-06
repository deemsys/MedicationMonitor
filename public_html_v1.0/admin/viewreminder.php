<?php

error_reporting(0);

session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');
?>

 <div class="container">
 <ul class="breadcrumb">

        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">View Reminders</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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

<div class="control-group">
		<div class="controls">
<div class="btn-group pull-right">
<a href="reminders.php"  class="btn btn-inverse">Define New Reminders</a>

            </div>

<form name="remsearch" id="remsearch" method="GET" action="viewreminder.php">
		<i class="icon-search"></i>
		<input type="text" style="border-radius : 15px;" placeholder="Search Reminder/Patient" name="remindersearch" id="remindersearch">
		<input type="submit" class="btn"  style="margin-left : 10px; margin-top: -10px;" value="Search Reminder/Patient">
		</form>


		</div>
		</div>

<table class="table table-bordered">
        <thead>

			<TR>
			<th>Reminder Name</th><th>Reminder Type</th><th>Reminder Date/Time</th><th>Patient Name</th><th>Medicine Name</th><th>Created By</th><th>Sync Status</th><th>Action</th>
			</TR>        </thead>
<?php

$today = date('Y-m-d');
	include('config.php');

	if($_GET['remindersearch'] != '')
	{
		$searchword.=' WHERE rd_reminder_name LIKE "%'.$_GET['remindersearch'].'%" OR rd_patient_name LIKE "%'.$_GET['remindersearch'].'%" AND rd_reminder_dateandtime >="'.$today.'"';
	}
	else
	{
		$searchword = ' WHERE rd_reminder_dateandtime >="'.$today.'"';
	}
	$sqlreminder = "SELECT COUNT(*) as num FROM tbl_reminder_details".$searchword."";

	$total_pages = mysql_fetch_array(mysql_query($sqlreminder));

	$recordsreminder123 = $total_pages[num];

	$targetpage = "viewreminder.php"; 	
	$limit = 5; 
	$stages = 3;

	$page = mysql_escape_string($_GET['page']);
	if($page)
	{
		$start = ($page - 1) * $limit; 
	}
	else
	{
		$start = 0;	
	}

	
	$sqlreminder = "SELECT * FROM tbl_reminder_details".$searchword." ORDER BY rd_reminder_dateandtime DESC LIMIT $start, $limit";

	$queryreminder = mysql_query($sqlreminder);
	
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

	while($recordsreminder = mysql_fetch_array($queryreminder))
		{


	$mediname = $recordsreminder['rd_medicine_id'];

	$med=str_replace('/',',',$mediname);

	$medexp = explode(",", $mediname);
	$ss=count($medexp)-1;


	if($recordsreminder123 != 0)
	{

?>
			<tr>
			<TD><?php echo $recordsreminder['rd_reminder_name']; ?></TD>
			<TD><?php echo $recordsreminder['rd_reminder_type']; ?></TD>
			<TD><?php echo $recordsreminder['rd_reminder_dateandtime']; ?></TD>
			<TD><?php echo $recordsreminder['rd_patient_name']; ?></TD>
			<TD>
<?php
		for($i=0;$i<$ss;$i++)
{
	$sqlmedicin = "SELECT * FROM tbl_medication_details WHERE md_medication_id = '".$medexp[$i]."';";

	$querymedicin = mysql_query($sqlmedicin);
	$recordsmedicin = mysql_fetch_array($querymedicin);
	$name= $recordsmedicin['md_medicine_name'];
	
	 echo $name."<br />"; 
}
?>


</TD>
<TD><?php echo $recordsreminder['rd_createdby']; ?></TD>
<TD>
<?php
if($recordsreminder['rd_status'] != 0)
{
?>
<span title="Not Sync" class="badge badge-warning"><i class="icon-refresh icon-white"></i></span>
<?php
}
else
{
?>
<span title="Sync" class="badge badge-success"><i class="icon-refresh icon-white"></i></span>
<!--<span class="btn btn-mini btn-warning"  onclick="status(<?php echo $recordsreminder['rd_reminder_id']; ?>);"><i class="icon-resize-full"></i></span>-->

<?php
}
?>
</TD>
<TD><a href="javascript:validate(<?php echo $recordsreminder['rd_reminder_id']; ?>);" class="btn"><i class="icon-trash"></i></a></TD></tr>
<?php
	}
}
	if($recordsreminder123 == 0)
	{
?>
			<tr>
			<td colspan="6" style="text-align : center"><h3> No Records Found!!! </h3></td>
			
			</tr>
<?php
	}

?>
					
					</table>
				
                      <div class="pagination pull-left">
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

		var res = confirm('Are you sure you want to delete this Reminder?');
		if(res)
		{
			window.location="delreminder.php?id="+val;		
		}

	}


}

function status(valu)
{


	if(valu!='')
	{
//  alert("viewreminder.php?id="+valu);
		
		window.location="reminderstatus.php?id="+valu;		
		

	}


}

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
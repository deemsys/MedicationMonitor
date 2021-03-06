<?php
session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Medicine Details</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
		<a href="addmedicine.php" class="btn btn-inverse">Define New Medicine</a>
            </div>

            <div class="page-header">
              <h2>List of Medicines </h2>
            </div>
           <table class="table">
                  <thead>
                   <tr style="color : #0088CC;">
                      <th width="100"> Medicine Id</th>
                      <th width="150"> Medicine Name</th>
                      <th width="300"> Medicine Notes</th>
                      <th width="300"> Medicine Side Effects</th>
                      <th width="300"> Medicine Direction</th>
                      <th width="200"> Added By</th>
                      <th width="200"> Action</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
include('config.php');

	$sqlreminder = "SELECT COUNT(*) as num FROM tbl_medication_details";

	$total_pages = mysql_fetch_array(mysql_query($sqlreminder));

	$recordsreminder123 = $total_pages[num];

	$targetpage = "Medicinelist.php"; 	
	$limit = 10; 
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

	
	$sqlreminder = "SELECT * FROM tbl_medication_details ORDER BY md_medicine_name ASC LIMIT $start, $limit";

	$querymedicine = mysql_query($sqlreminder);
	
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

		while($recordsmedicine = mysql_fetch_array($querymedicine))
		{
			
?>
		<tr>
                      <td><?php echo $recordsmedicine['md_medicine_id']; ?></td>
                      <td><?php echo $recordsmedicine['md_medicine_name']; ?></td>

                      <td><?php echo $recordsmedicine['md_medicine_notes']; ?></td>
                      <td><?php echo $recordsmedicine['md_medicine_sideeffects']; ?></td>
                      <td><?php echo $recordsmedicine['md_medicine_direction']; ?></td>
                      <td><?php echo $recordsmedicine['md_medicine_addfor']; ?></td>
		      <td><div class="btn-group">
			<a title="Edit Medicine" href="editmedicine.php?id=<?php echo $recordsmedicine['md_medicine_id']; ?>" class="btn"><i class="icon-pencil"></i></a>
			<a title="Delete Medicine" href="javascript:validate(<?php echo $recordsmedicine['md_medicine_id']; ?>);" class="btn"><i class="icon-trash"></i></a> </div></td>
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

		var res = confirm('Are you sure you want to delete this Medicine?');
		if(res)
		{
			window.location="deletemedicine.php?id="+val;		
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
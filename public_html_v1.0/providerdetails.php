<?php
session_start();

if(isset($_SESSION['userid']))
{


include('header.php');

include('config.php');

$id = $_GET['id'];
// echo $id; exit;


	$sqlprovider = "SELECT * FROM tbl_user_details WHERE ud_user_id = '".$id."';";

	$queryprovider = mysql_query($sqlprovider);
	$providerrecords = mysql_fetch_array($queryprovider);
	
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span>
        <a href="javascript:history.go(-1);">Provider Details</a><span class="divider">/</span>
         <!--li class="active"--><?php echo $providerrecords['ud_username'];?></li>
         <i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        
          <div class="row-fluid">
          
          <div class="slate">
				
					<div class="page-header">
						<h2>Provider Name : <?php echo $providerrecords['ud_username']; ?></h2>
					</div>
					
				<table class="orders-table table">
				<tbody>
					<tr>
						<td width="200px">Name </td>
						<td width="150px"><?php echo $providerrecords['ud_firstname']." "; echo $providerrecords['ud_lastname']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Email Id </td>
						<td><?php echo $providerrecords['ud_email_id']; ?></td>
						<td align="left"><a href="" style="margin-left : 10px;" title="Mail"><i class="icon-envelope"></i></a></td>
					</tr>

					<tr>
						<td>Skype Id </td>
						<td><?php echo $providerrecords['ud_skype_id']; ?></td>
						<td><a href="" style="margin-left : 10px;"><img src="assets/img/skype.png" title="Skype"></a></td>
					</tr>

					<tr>
						<td>Facetime Id </td>
						<td><?php echo $providerrecords['ud_facetime_id']; ?></td>
						<td><a href="facetime:<?php echo $providerrecords['ud_facetime_id']; ?>" style="margin-left : 10px;"><img src="assets/img/Facetime.png" title="Face Time"></a></td>
					</tr>

					<tr>
						<td>Mobile </td>
						<td><?php echo $providerrecords['ud_mobile']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>Address 1 </td>
						<td><?php echo $providerrecords['ud_address1']; ?></td>
						<td></td>
					</tr>


					<tr>
						<td>Address 2 </td>
						<td><?php echo $providerrecords['ud_address2']; ?></td>
						<td></td>
					</tr>

					<tr>
						<td>State </td>
						<td><?php echo $providerrecords['ud_state']; ?></td>
						<td></td>
					</tr>


					<tr>
						<td>City </td>
						<td><?php echo $providerrecords['ud_city']; ?></td>
						<td></td>
					</tr>
	
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
</script>
  </body>
</html>
<?php
}
else
{
header('Location:login.php');
}
?>
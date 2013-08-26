<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');
?>
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>


<script type="text/javascript">

 $(document).ready(function() {
$('#medicineid').keyup(function(){

var medicineid = $('#medicineid').val();
var n = medicineid.length;
   //alert(usernam);

$.post("medicationempty.php",{ medid: medicineid },function(data){
//alert("fdgd123");

//  alert(n);
	if(n>0)
	{
		$('#notavai').show(data);
		$('#notavai').html(data);
		
	}
	else
	{
		$('#notavai').hide(data);
	
	}

});


});

});

</script>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="Medicinelist.php">Medication</a> <span class="divider">/</span></li>
        <li class="active">Add Medicine</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
<div class="slate">
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

			<div id="global" class="tab-pane fade active in">
         		<form class="form-horizontal" action="medicationdetails.php" method="POST" name="dd1" id="dd1" enctype="multipart/form-data">
<!-- 			<form class="form-horizontal" action="Service/medicineresponce.php?service=medinsert" method="POST"> -->
              		<div>
              		<legend>Add Medicine</legend>
              			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>


			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Medicine Name</label>
                  	<div class="controls">
                        <?php
                        if(isset($_SESSION['values']['medicinename']))
                        {
                         ?>
                             <input type="text" class="input-medium" value="<?php echo $_SESSION['values']['medicinename'];?>" name="medicinename" id="medicinename">
                            <?php
                        }

                        else
                        {
                          ?>
                            <input type="text" class="input-medium" name="medicinename" id="medicinename">
                            <?php
                        }
                            ?>


                    	</div>
                	</div>

		<!--	<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Medicine Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<!--?php echo $_SESSION['values']['medicineid']; ?>" name="medicineid" id="medicineid">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
                    	</div>
                	</div>  -->

			<div class="control-group">
                  	<label class="control-label" for="input01">Image</label>
                  	<div class="controls">
                    	<input type="file" style="width: 90px;" onchange="this.style.width = '100%';" class="input-xlarge"  name="medicineimage" id="medicineimage">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Notes</label>
                  	<div class="controls">
                    	<textarea placeholder=" please enter your notes" name="notes" rows="3" id="notes" class="input-xlarge"></textarea>
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Side Effects</label>
                  	<div class="controls">
                    	<textarea placeholder=" please enter your comments" name="sideeffects" rows="3" id="sideeffects" class="input-xlarge"></textarea>
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Medicine Direction</label>
                  	<div class="controls">
                    	<textarea placeholder=" please enter your comments" name="medicinedirection" rows="3" id="medicinedirection" class="input-xlarge"></textarea>
                    	</div>
                	</div>


      					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                  
		                </div>
		              	</div>
		            	</form>
						</div>                    <!-- End of Payment Tabs -->

					
			</div>          </div><!--/row-->
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
unset($_SESSION['values']['medicinename']);
unset($_SESSION['values']['medicineid']);


?>
<?php
}
else
{
header('Location:login.php');
}
?>
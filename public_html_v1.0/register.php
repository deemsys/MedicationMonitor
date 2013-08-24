<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');
?>
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>


<script type="text/javascript">

 $(document).ready(function() {
$('#username').keyup(function(){

var usernam = $('#username').val();
var n = usernam.length;
   //alert(usernam);

$.post("empty.php",{ rrr: usernam },function(data){
//alert("fdgd123");

//  alert(n);
if(n>0)
{
  $('#notavai').show(data);
  $('#notavai').html(data);

}
else
{
//  alert(n);
  $('#notavai').hide(data);

}

});


});

});

</script>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Providers</a> <span class="divider">/</span></li>
        <li class="active">Register</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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




		<div class="page-header">

			<h3>Medication Monitor</h3>
			</div>
			<div id="global" class="tab-pane fade active in">
         		<form class="form-horizontal" action="updateuser.php" method="POST" name="dd1" id="dd1">
              		<fieldset>
              		<legend>Provider Registration</legend>
              			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>User Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['username']; ?>" name="username" id="username">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>First Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['fname']; ?>" name="fname" id="fname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Last Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['lname']; ?>" name="lname" id="lname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Password</label>
                  	<div class="controls">
                    	<input type="password" class="input-medium" name="pswd" id="pswd">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Confirm Password</label>
                  	<div class="controls">
                    	<input type="password" class="input-medium" name="cpswd" id="cpswd">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Sex</label>
                  	<div class="controls">
			<label class="radio"><input type="radio" name="sex" value="Male"> Male</label>
			<label class="radio"><input type="radio" name="sex" value="Female"> Female</label>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Age</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['age']; ?>" name="age" id="age">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Email Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['email']; ?>" name="email" id="email">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Skype Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['skype']; ?>" name="skype" id="skype">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Facetime Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['facetime']; ?>" name="facetime" id="facetime">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Mobile</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['mobile']; ?>" name="mobile" id="mobile">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Address</label>
                  	<div class="controls">
                    	<textarea placeholder=" please Enter your Address" name="address" rows="3" id="address" class="input-xlarge"></textarea>
                    	</div>
                	</div>

      					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                  
		                </div>
		              	</fieldset>
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
unset($_SESSION['values']['username']);
unset($_SESSION['values']['fname']);
unset($_SESSION['values']['lname']);
unset($_SESSION['values']['age']);
unset($_SESSION['values']['email']);
unset($_SESSION['values']['skype']);
unset($_SESSION['values']['facetime']);
unset($_SESSION['values']['mobile']);
unset($_SESSION['values']['address']);
?>
<?php
}
else
{
header('Location:login.php');
}
?>
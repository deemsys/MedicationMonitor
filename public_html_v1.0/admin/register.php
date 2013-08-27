<?php
session_start();

if($_SESSION['adminid'] != '')
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
        <li><a href="/admin/providerlist.php">Providers</a> <span class="divider">/</span></li>
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
    <?php
    if(!isset($_SESSION['error'])&&!isset($_SESSION['success']))
    {
        ?>
              		<div>
              		<legend>Provider Registration</legend>
              			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>User Name</label>
                  	<div class="controls">

                    	<input type="text" class="input-medium" name="username" id="username">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>First Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="fname" id="fname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Last Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="lname" id="lname">
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

                    	<input type="text" class="input-medium" name="age" id="age">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Email Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="email" id="email">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Skype Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="skype" id="skype">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Facetime Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="facetime" id="facetime">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Mobile</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" name="mobile" id="mobile">
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
		              	</div>
        <?php
    }
    else
    {
       ?>
        <div>
            <legend>Provider Registration</legend>
            <p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
            <div class="control-group">

                <label class="control-label" for="input01"><span style=" color : red;">*</span>User Name</label>
                <div class="controls">

                    <input type="text" class="input-medium" value="<?php echo $_SESSION['values']['username'];?>" name="username" id="username">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
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
			<label for="select01" class="control-label"><span style=" color : red;">*</span>Select Age</label>
			<div class="controls">
			<select id="select01" name="age" class="input-small">
			<option>Select Age</option>
			<option>05 to 10</option>
			<option>11 to 15</option>
			<option>16 to 20</option>
			<option>21 to 25</option>
			<option>26 to 30</option>
			<option>31 to 35</option>
			<option>36 to 40</option>
			<option>41 to 45</option>
			<option>46 to 50</option>
			<option>51 to 55</option>
			<option>56 to 60</option>
			<option>61 to 65</option>
			<option>66 to 70</option>
			<option>71 to 75</option>
			<option>76 to 80</option>
			<option>81 to 85</option>
			<option>86 to 90</option>
			<option>91 to 95</option>
			<option>96 to 100</option>
			</select>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Email Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['email']; ?>" name="email" id="email">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Skype Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['skype']; ?>" name="skype" id="skype">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Facetime Id</label>
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
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Address1</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['address1']; ?>" name="address1" id="address1">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01">Address2</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['address2']; ?>" name="address2" id="address2">
                    	</div>
                	</div>

			<div class="control-group">
			<label for="select01" class="control-label"><span style=" color : red;">*</span>Select Country</label>
			<div class="controls">
			<select id="select01" name="country" class="input-large">
			<option>Select Country</option>
			<option>USA</option>
			<option>Others</option>
			</select>
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>State</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['state']; ?>" name="state" id="state">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>City</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['city']; ?>" name="city" id="city">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Zipcode</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['zipcode']; ?>" name="zipcode" id="zipcode">
                    	</div>
                	</div>

      					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                  
		                </div>
        </div>
        <?php
    }
        ?>
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
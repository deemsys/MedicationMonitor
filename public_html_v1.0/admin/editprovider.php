<?php
session_start();

if($_SESSION['adminid'] != '')
{


include('header.php');

include('config.php');
include_once('loadAC.php');

$id=$_GET['id'];

	$sqlmyacc = "SELECT * FROM tbl_user_details WHERE ud_user_id =".$_GET['id'];

	$querymyacc = mysql_query($sqlmyacc);
	$myaccrecords = mysql_fetch_array($querymyacc);
   // $providerrecords=mysql_fetch_array($querymyacc);
	
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span>
     <a href="providerlist.php">Provider Details</a><span class="divider">/</span>
     <a href="providerdetails.php?id=<?php echo $id ?>"><?php echo $myaccrecords['ud_username'];?></li><span class="divider">/</span>


        <!--li class="active"-->Edit</li><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        
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
						<h2> My Account</h2>
					</div>
					<form class="form-horizontal" name="editmyaccount" method="POST" action="updateeditprovider.php?id=<?php echo $_GET['id']; ?>">
					<div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>First Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_firstname']; ?>" name="fname" id="fname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">Last Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_lastname']; ?>" name="lname" id="lname">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01">User Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_username']; ?>"  name="lname" id="lname">
                    	</div>
                	</div>

           <!-- <div class="control-group">
                    <label class="control-label" for="input01">Password</label>
                    <div class="controls">
                        <input type="password" class="input-medium" value="<?php /*echo $myaccrecords['ud_password']; */?>" disabled="true" name="pswd" id="pswd">
                            </div>
                    </div>


            <div class="control-group">
                    <label class="control-label" for="input01">Confirm Password</label>
                    <div class="controls">
                        <input type="password" class="input-medium" value="<?php /*echo $myaccrecords['ud_password']; */?>" disabled="true" name="cpswd" id="cpswd">
                            </div>
                    </div>-->

                        <div class="control-group">
                            <label class="control-label" for="input01"><span style=" color : red;">*</span>Sex</label>
                            <div class="controls">
                                <label class="radio"><input type="radio" <?php if(!isset($_SESSION['values']['sex'])) $_SESSION['values']['sex']=$myaccrecords['ud_sex']; if($_SESSION['values']['sex']=='Male')
                                    {
                                        echo 'Checked="true"';
                                    }
                                    ?> name="sex" value="Male"> Male</label>
                                <label class="radio"><input type="radio" name="sex"
                                                            <?php if(!isset($_SESSION['values']['sex']))
                                                                $_SESSION['values']['sex']=$myaccrecords['ud_sex'];
                                                            if($_SESSION['values']['sex']=='Female')
                                                            {
                                                                echo 'Checked="true"';
                                                            }
                                                            ?>name="sex" value="Female"> Female</label>
                            </div>
                        </div>

                    <div class="control-group">
                        <label for="select01" class="control-label"><span style=" color : red;">*</span>Age</label>
                        <div class="controls">
                            <select id="select01" name="age" class="input-medium">
                              <?php if(!isset($_SESSION['values']['age'])) $_SESSION['values']['age']=$myaccrecords['ud_age'];load_age($_SESSION['values']['age']);?>

                                                          </select>
                        </div>
                    </div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Email</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_email_id']; ?>" name="email" id="email">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Skype Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_skype_id']; ?>" name="skype" id="skype">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">Facetime Id</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_facetime_id']; ?>" name="facetime" id="facetime">
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Mobile</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_mobile']; ?>" name="mobile" id="mobile">
                    	</div>
                	</div>

              		
              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Address1</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_address1']; ?>" name="add1" id="add1">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01">Address2</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_address2']; ?>" name="add2" id="add2">
                    	</div>
                	</div>

			<div class="control-group">
			<label for="select01" class="control-label"><span style=" color : red;">*</span>Country</label>
			<div class="controls">
			<select id="select01" name="country" class="input-large">
			<?php if(!isset($_SESSION['values']['country'])) $_SESSION['values']['country']=$myaccrecords['ud_country'];load_country($_SESSION['values']['country']);?>
			</select>
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>State</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_state']; ?>" name="state" id="state">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>City</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $myaccrecords['ud_city']; ?>" name="city" id="city">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Postal code</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?=$myaccrecords['ud_zipcode']?>" name="zipcode" id="zipcode">
                    	</div>
                	</div>

				<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                </div>



		              	</div>

		            	</form>

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
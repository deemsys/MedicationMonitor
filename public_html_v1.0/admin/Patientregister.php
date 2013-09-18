<?php
session_start();

function valid_check($key)
{
    if(isset($_SESSION['require'][$key]))
    {
        echo 'style="border:1px solid red;"';
    }

}


if(isset($_SESSION['adminid']))
{
include('header.php');
include('loadAC.php');
?>

 <div class="container">
 <ul class="breadcrumb">
        <li><a href="patientlist.php">Patient</a> <span class="divider">/</span>
        <!--li class="active"-->Register</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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

    if(isset($_SESSION['require']))
    {
        echo '<div class="alert alert-error">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>Required Field(s) should not be blank!! </strong>
      </div>';
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
    <?php
    if(!isset($_SESSION['error'])&&!isset($_SESSION['success'])&&!isset($_SESSION['require']))
    {
    ?>


        <div id="global" class="tab-pane fade active in">
            <form class="form-horizontal" action="updatepatient.php" method="POST" name="dd1" id="dd1">
                <!-- 			<form class="form-horizontal" action="Service/patientresponce.php?service=patinsert" method="POST" name="dd1" id="dd1"> -->
                <div>
                    <legend>Patient Registration</legend>
                    <p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
                    <div class="control-group">
                        <label class="control-label" for="input01"><span style=" color : red;">*</span>User Name</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="username" id="username">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
                        </div>
                    </div>
                    <input type="hidden" class="input-medium"  name="userid">

                    <div class="control-group">
                        <label class="control-label" for="input01"><span style=" color : red;">*</span>First Name</label>
                        <div class="controls">
                            <input type="text" class="input-medium" name="fname" id="fname">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="input01">Last Name</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="lname" id="lname">
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
                        <label for="select01" class="control-label"><span style=" color : red;">*</span>Age</label>
                        <div class="controls">
                            <select id="select01" name="age" class="input-medium">
                                <?php load_age('null');?>
                             </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="input01"><span style=" color : red;">*</span>Email</label>
                        <div class="controls">
                            <input type="text" class="input-medium" name="email" id="email">
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="input01">Skype Id</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="skype" id="skype">
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="input01">Facetime Id</label>
                        <div class="controls">
                            <input type="text" class="input-medium" name="facetime" id="facetime">
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="input01">Mobile</label>
                        <div class="controls">
                            <input type="text" class="input-medium" name="mobile" id="mobile"><strong id="notavai"></strong><i id="notempty"></i>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="input01">Address1</label>
                        <div class="controls">
                            <input type="text" class="input-medium" name="address1" id="address1">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="input01">Address2</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="address2" id="address2">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="select01" class="control-label">Country</label>
                        <div class="controls">
                            <select id="select01" name="country" class="input-large">
                              <?php load_country('null');?>
                                </select>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="input01">State</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="state" id="state">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="input01">City</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="city" id="city">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="input01">Postal Code</label>
                        <div class="controls">
                            <input type="text" class="input-medium"  name="zipcode" id="zipcode">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-primary">Reset</button>

                    </div>
                </div>
            </form>
        </div>

        <?php
    }

        else
        {
        ?>
    		<div id="global" class="tab-pane fade active in">
         		<form class="form-horizontal" action="updatepatient.php" method="POST" name="dd1" id="dd1">
<!-- 			<form class="form-horizontal" action="Service/patientresponce.php?service=patinsert" method="POST" name="dd1" id="dd1"> -->
              		<div>
              		<legend>Patient Registration</legend>
              			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p>
			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>User Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['username']; ?>" <?php valid_check("username")?>
                               name="username" id="username">&nbsp;&nbsp;&nbsp;<strong id="notavai"></strong><i id="notempty"></i>
                    	</div>
                	</div>
			<input type="hidden" class="input-medium" value="<?php echo $_SESSION['adminid']; ?>" name="userid">

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>First Name</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['fname']; ?>" <?php valid_check("fname")?>
                               name="fname" id="fname">
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
                    	<input type="password" class="input-medium"<?php valid_check("pswd")?>
                               name="pswd" id="pswd">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Confirm Password</label>
                  	<div class="controls">
                    	<input type="password" class="input-medium"<?php valid_check("cpswd")?>
                               name="cpswd" id="cpswd">
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Sex</label>
                  	<div class="controls">
			<label class="radio"><input type="radio" <?php if($_SESSION['values']['sex']=='Male')
                {
                echo 'Checked="true"';
                }
                ?>
                name="sex" value="Male"> Male</label>

			<label class="radio"><input type="radio" name="sex" <?php if($_SESSION['values']['sex']=='Female')
                {
                    echo 'Checked="true"';
                }
                ?> name="sex" value="Female"> Female</label>
                    	</div>
                	</div>

              		
			<div class="control-group">
			<label for="select01" class="control-label"><span style=" color : red;">*</span>Age</label>
			<div class="controls">

                <select id="select01" name="age" class="input-medium">
                    <?php load_age($_SESSION['values']['age']);?>
                </select>

                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Email</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['email']; ?>" <?php valid_check("email")?>
                               name="email" id="email">
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
                  	<label class="control-label" for="input01">Mobile</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['mobile']; ?>" <?php valid_check("mobile")?>
                               name="mobile" id="mobile">
                    	</div>
                	</div>

              		
              		<div class="control-group">
                  	<label class="control-label" for="input01">Address1</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['address1']; ?>" <?php valid_check("address1")?>
                               name="address1" id="address1">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01">Address2</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['address2']; ?>" name="address2" id="address2">
                    	</div>
                	</div>

			<div class="control-group">
			<label for="select01" class="control-label">Country</label>
			<div class="controls">
			<select id="select01" name="country" class="input-large">
			<?php load_country($_SESSION['values']['country'])?>
			</select>
                    	</div>
                	</div>


              		<div class="control-group">
                  	<label class="control-label" for="input01">State</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['state']; ?>"<?php valid_check("state")?>
                               name="state" id="state">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01">City</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['city']; ?>"<?php valid_check("city")?>
                               name="city" id="city">
                    	</div>
                	</div>

              		<div class="control-group">
                  	<label class="control-label" for="input01">Postal Code</label>
                  	<div class="controls">
                    	<input type="text" class="input-medium" value="<?php echo $_SESSION['values']['zipcode']; ?>" <?php valid_check("zipcode")?>
                               name="zipcode" id="zipcode">
                    	</div>
                	</div>

      					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>&nbsp;
                          <button type="reset" class="btn btn-primary">Reset</button>
		                  
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
            <?php
            }
            ?>
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
    <script type="text/javascript">

        $(document).ready(function() {
            $('#username').keyup(function(){

                var usernam = $('#username').val();
                var n = usernam.length;
                //alert(usernam);

                $.post("patient_check.php",{ rrr: usernam },function(data){
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

            $(document).ready(function() {
                $('#mobile').keyup(function(){

                    var mobile = $('#mobile').val();

                    var n=mobile.length;

                    $.post("patient_mob_check.php",{ rrr: mobile },function(data){
//alert("fdgd123");

//  alert(n);
                        if(n==10)
                        {
                            $('#notavai_mob').show(data);
                            $('#notavai_mob').html(data);

                        }
                        else
                        {
//  alert(n);
                            $('#notavai_mob').hide(data);

                        }

                    });


                });

            });

       /*
        // To check mobile number
        $(document).ready(function() {
            $('#mobile').keyup(function(){

                var mob = $('#mobile').val();
                var n = mob.length;
                //alert(usernam);
if(n==10)
                $.post("patient_mob_check.php",{ rrr: mob },function(data){
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

        });*/

    </script>
  </body>
</html>
<?php

//Age
    function select_age($value)
    {
    if($_SESSION['values']['age']==$value)
    {
     echo "Selected";
    }
    }

unset($_SESSION['require']);
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['values']['username']);
unset($_SESSION['values']['fname']);
unset($_SESSION['values']['lname']);
unset($_SESSION['values']['sex']);
unset($_SESSION['values']['age']);
unset($_SESSION['values']['email']);
unset($_SESSION['values']['skype']);
unset($_SESSION['values']['facetime']);
unset($_SESSION['values']['mobile']);
unset($_SESSION['values']['address1']);
unset($_SESSION['values']['address2']);
unset($_SESSION['values']['state']);
unset($_SESSION['values']['city']);
unset($_SESSION['values']['zipcode']);
unset($_SESSION['values']['country']);



?>
<?php
}
else
{
header('Location:login.php');
}
?>
<?php
session_start();
function valid_check($key)
{
    if(isset($_SESSION['require'][$key]))
    {
        echo 'style="border:1px solid red;"';
    }

}




include('config.php');



include('header.php');
?>

 <div class="container">
 
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <!--div class="span12"-->
          <div class="row-fluid">
          <div style="width:500px; margin:auto;">
<div class="slate">
					<!--<div class="page-header">
                    <div class="alert alert-error">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>Oh snap!</strong> Change a few things up and try submitting again.
      </div>
      <div class="alert alert-success">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>Well done!</strong> You successfully read this important alert message.
      </div>
					</div>-->


<?php
if(isset($_SESSION['error']) && count($_SESSION['error'])>0)
{
	echo '<div class="alert alert-error">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>Oh snap!</strong> Change a few things up and try submitting again.';
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


<div id="global" class="tab-pane fade active in">
        				<form class="form-horizontal" action="signin.php" method="POST">
<!-- 			<form class="form-horizontal" action="Service/loginresponce.php?service=login" method="POST"> -->
              			<fieldset>
	          			<legend>Admin Login</legend>
                		<div class="control-group">
                  		<label class="control-label" for="input01">User Name</label>
                  		<div class="controls">
                            <?php
                            if(isset($_COOKIE['remember']['username']))
                            {
                               ?>
                                <input type="text" class="input-medium" name="username" value="<?php echo $_COOKIE['remember']['username'];?>" id="input01">
                                <?php

                            }
                            else
                            {
                            ?>
                    	<input type="text" class="input-medium" <?php valid_check("username")?> name="username" value="" id="input01">
                                <?php
                            }
                                ?>

                    	</div>
                		</div>
                		<div class="control-group">
                  		<label class="control-label" for="input01">Password</label>
                  		<div class="controls">
                            <?php
                            if(isset($_COOKIE['remember']['password']))
                            {
                                ?>
                                <input type="password" class="input-medium" name="pswd" value="<?php echo $_COOKIE['remember']['pswd'];?>" id="input02">
                            <?php

                            }
                            else
                            {
                                ?>
                                <input type="password" class="input-medium" <?php valid_check("pswd")?> name="pswd" value="" id="input02">
                            <?php
                            }
                            ?>


                    	</div>
                		</div>
                        <div class="control-group">
            <label for="optionsCheckbox" class="control-label">&nbsp;</label>
            <div class="controls">
              <label class="checkbox">
                <input type="checkbox" value="remember" name="remember" id="optionsCheckbox">
                Remember
              </label>
              <br/>
              <a href="forgetpswd.php" class="btn btn-mini">Forgot Your Password?</a>
            </div>
          </div>
      					<div class="form-actions">
		                  <button type="submit" class="btn btn-primary">Submit</button>
		                  
		                </div>
		              	</fieldset>
		            	</form>
						</div>                    <!-- End of Payment Tabs -->	

					
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
</script>
  </body>
</html>
<?php
unset($_SESSION['require']);
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['values']['username']);
unset($_SESSION['values']['pswd']);
unset($_SESSION['values']['userlogin']);
?>
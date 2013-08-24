<?php
session_start();

include('header.php');
?>
<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>



 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Forget Password</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
<div class="slate">


			<div id="global" class="tab-pane fade active in">
         		<form class="form-horizontal" action="updatenewpswd.php" method="POST" name="dd1" id="dd1">
              		<fieldset>
              		<legend>Forget Password</legend>
<!--               			<p align="right"><span style=" color : red;">*</span>Required Field Can't be blank</p> -->
			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
                    	<div class="alert alert-success" style="width : 500px;">
        
       			 <strong><h4>Your New Password Send successfully!!!</h4><br />
			<h4>Please check Your Mail!!!</h4></strong>
     			 </div>
			<a href="login.php"><i class="btn btn-success">Click here to login...</i></a>

                    	</div>
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
?>

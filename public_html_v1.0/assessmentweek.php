<?php
session_start();

if($_SESSION['userid'] != '')
{


include('header.php');
?>

<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
//     $('#q2').hide();
    $('#q2').hide();
    $('#q3').hide();
    $('#q4').hide();
    $('#q5').hide();
    $('#q6').hide();
//     $('#q4').hide();
$('#q1yes').click(function(){
// alert("dfgdfz");
    $('#q3').show();
    $('#q2').hide();
    $('#q4').hide();
    $('#q5').hide();
    $('#q6').hide();
   });
$('#q1no').click(function(){
//  alert("dfgdfz");
    $('#q3').hide();
    $('#q2').show();
    $('#q4').hide();
    $('#q5').hide();
    $('#q6').hide();

   });


$('#q3yes').click(function(){
// alert("dfgdfz");
    $('#q4').hide();
    $('#q5').show();

    $('#q6').hide();

   });
$('#q3no').click(function(){
// alert("dfgdfz");
    $('#q5').hide();
    $('#q4').show();

    $('#q6').hide();
   });

$('#q5yes').click(function(){
// alert("dfgdfz");

    $('#q6').show();

   });
$('#q5no').click(function(){
// alert("dfgdfz");
    $('#q6').hide();
   });


});


</script>


 <div class="container">
 <ul class="breadcrumb">
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Assessment<span class="divider">/</span></li>
	<li class="active">Weekly Questionnaire</li>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
          
          <div class="slate">
				
					<div class="page-header">
						<h2>Weekly Questionnaire</h2>
					</div>
					<form name="assessmentweek" action="updateassessmentweek.php" method="POST">
					<table class="orders-table table">
					<tbody>

						<TR>
						<TD width="500">1. In general, would you say your health is
						</td>
						<TD>
						<input type="radio" name="q1" value="Excellent" >  Excellent <br>
						<input type="radio" name="q1" value="Very Good" >  Very Good <br>
						<input type="radio" name="q1" value="Good" >  Good <br>
						<input type="radio" name="q1" value="Fair" >  Fair <br>
						<input type="radio" name="q1" value="Poor" >  Poor 
						</TD>
						</TR>

						<TR>
						<TD >2. Moderate activities, such as moving a table, pushing a vacuum cleaner, bowling, or playing golf?
						</td>
						<TD>
						<input type="radio" name="q1" value="Yes, limited a lot" >  Yes, limited a lot <br>
						<input type="radio" name="q1" value="Yes, limited a little" >  Yes, limited a little <br>
						<input type="radio" name="q1" value="Not limited at all" >  Not limited at all 
						</TD>
						</TR>

						<TR>
						<TD >3. Climbing several flights of stairs
						</td>
						<TD>
						<input type="radio" name="q1" value="Yes, limited a lot" >  Yes, limited a lot <br>
						<input type="radio" name="q1" value="Yes, limited a little" >  Yes, limited a little <br>
						<input type="radio" name="q1" value="Not limited at all" >  Not limited at all 
			
						</TD>
						</TR>
						

					</tbody>
					</table>

					<div class="form-actions">
		                  	<button type="submit" class="btn btn-primary">Submit</button>
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
}
else
{
header('Location:login.php');
}
?>
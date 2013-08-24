<?php
session_start();

if($_SESSION['adminid'] != '')
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
        <li class="active">Assessment</li><span class="divider">/</span></li>
	<li class="active">Monthly Questionnaire</li>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
          
          <div class="slate">
				
					<div class="page-header">
						<h2>Monthly Questionnaire</h2>
					</div>
					<form name="assessmentmon" action="updateassessmentmon.php" method="POST">
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
						<input type="radio" name="q2" value="Yes, limited a lot" >  Yes, limited a lot <br>
						<input type="radio" name="q2" value="Yes, limited a little" >  Yes, limited a little <br>
						<input type="radio" name="q2" value="Not limited at all" >  Not limited at all 
						</TD>
						</TR>

						<TR>
						<TD >3. Climbing several flights of stairs
						</td>
						<TD>
						<input type="radio" name="q3" value="Yes, limited a lot" >  Yes, limited a lot <br>
						<input type="radio" name="q3" value="Yes, limited a little" >  Yes, limited a little <br>
						<input type="radio" name="q3" value="Not limited at all" >  Not limited at all 
			
						</TD>
						</TR>

						<TR>
						<TD >4. Accomplished less than you would like
						</td>
						<TD>
						<input type="radio" name="q4" value="Yes" >  Yes <br>
						<input type="radio" name="q4" value="No" >  No 
						</TD>
						</TR>

						<TR>
						<TD >5. Were limited in the kind of work or other activities
						</td>
						<TD>
						<input type="radio" name="q5" value="Yes" >  Yes <br>
						<input type="radio" name="q5" value="No" >  No 
						</TD>
						</TR>

						<TR>
						<TD >6. Accomplished less than you would like
						</td>
						<TD>
						<input type="radio" name="q6" value="Yes" >  Yes <br>
						<input type="radio" name="q6" value="No" >  No 
						</TD>
						</TR>

						<TR>
						<TD >7. Didn’t do work or other activities as carefully as usual
						</td>
						<TD>
						<input type="radio" name="q7" value="Yes" >  Yes <br>
						<input type="radio" name="q7" value="No" >  No 
						</TD>
						</TR>

						<TR>
						<TD>8. During the past 4 weeks, how much did pain interfere with your normal work (including both outside the home and housework)?
						</td>
						<TD>
						<input type="radio" name="q8" value="Not at all" >  Not at all <br>
						<input type="radio" name="q8" value="A little bit" > A little bit  <br>
						<input type="radio" name="q8" value="Moderately" >  Moderately <br>
						<input type="radio" name="q8" value="Quite a bit" >  Quite a bit <br>
						<input type="radio" name="q8" value="Extremely" >   Extremely
						</TD>
						</TR>

						<TR>
						<TD>9. Have you felt calm and peaceful?
						</td>
						<TD>
						<input type="radio" name="q9" value="All of the time" >  All of the time <br>
						<input type="radio" name="q9" value="Most of the time" >  Most of the time <br>
						<input type="radio" name="q9" value="A good bit of the time" >  A good bit of the time <br>
						<input type="radio" name="q9" value="Some of the time" >  Some of the time <br>
						<input type="radio" name="q9" value="A little of the time" >   A little of the time <br>
						<input type="radio" name="q9" value="None of the time" >   None of the time
						</TD>
						</TR>

						<TR>
						<TD>10. Did you have a lot of energy?
						</td>
						<TD>
						<input type="radio" name="q10" value="All of the time" >  All of the time <br>
						<input type="radio" name="q10" value="Most of the time" >  Most of the time <br>
						<input type="radio" name="q10" value="A good bit of the time" >  A good bit of the time <br>
						<input type="radio" name="q10" value="Some of the time" >  Some of the time <br>
						<input type="radio" name="q10" value="A little of the time" >   A little of the time <br>
						<input type="radio" name="q10" value="None of the time" >   None of the time
						</TD>
						</TR>

						<TR>
						<TD>11. Have you felt downhearted and blue?
						</td>
						<TD>
						<input type="radio" name="q11" value="All of the time" >  All of the time <br>
						<input type="radio" name="q11" value="Most of the time" >  Most of the time <br>
						<input type="radio" name="q11" value="A good bit of the time" >  A good bit of the time <br>
						<input type="radio" name="q11" value="Some of the time" >  Some of the time <br>
						<input type="radio" name="q11" value="A little of the time" >   A little of the time <br>
						<input type="radio" name="q11" value="None of the time" >   None of the time
						</TD>
						</TR>

						<TR>
						<TD>12. During the past 4 weeks, how much of the time has your physical health or emotional problems interfered with your social activities (like visiting with friends, relatives, etc.)?
						</td>
						<TD>
						<input type="radio" name="q12" value="All of the time" >  All of the time <br>
						<input type="radio" name="q12" value="Most of the time" >  Most of the time <br>
						<input type="radio" name="q12" value="A good bit of the time" >  A good bit of the time <br>
						<input type="radio" name="q12" value="Some of the time" >  Some of the time <br>
						<input type="radio" name="q12" value="A little of the time" >   A little of the time <br>
						<input type="radio" name="q12" value="None of the time" >   None of the time
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
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
	<li class="active">Daily Questionnaire</li>
      </ul>
    <div class="container-fluid">
    
      <div class="row-fluid">
        <!--/span-->
        <div class="span12">
          <div class="row-fluid">
          
          <div class="slate">
				
					<div class="page-header">
						<h2>Daily Questionnaire</h2>
					</div>
					<form name="assessment" action="updateassessment.php" method="POST">
					<table class="orders-table table">
					<tbody>

						<TR id="q1" >
						<TD width="500">1: Have you filled your new prescription yet?
						</td>
						<TD>
						<input type="radio" name="q1" id="q1yes" value="yes" >Yes 
						<input type="radio" name="q1" id="q1no" value="no" >No 
						</TD>
						</TR>
						
						<TR id="q2">
						<TD>2: What is the reason for not filling your new prescription? Check all that apply.</TD>
						<TD>
						<input type="checkbox" name="q2option1" value="I haven’t had time" >  I haven’t had time <br>
						<input type="checkbox" name="q2option2" value="I forgot" >  I forgot <br>
						<input type="checkbox" name="q2option3" value="I don’t think I need it" >  I don’t think I need it <br>
						<input type="checkbox" name="q2option4" value="I can’t afford it" >  I can’t afford it <br>
						<input type="checkbox" name="q2option5" value="I can’t get it because I don’t have transportation" >  I can’t get it because I don’t have transportation <br>
						<input type="checkbox" name="q2option6" value="Other reason" >  Other reason 
						</TD>
						</TR>
						
						<TR id="q3">
						<TD>3: Did you take your new medicine today as prescribed?</TD>
						<TD>
						<input type="radio" name="q3"  id="q3yes" value="yes" >Yes 
						<input type="radio" name="q3"  id="q3no" value="no" >No </TD>
						</TR>
						
						<TR id="q4">
						<TD>4: What is the reason for not taking your medicine as prescribed today? Check all that apply.</TD>
						<TD>
						<input type="checkbox" name="q4option1" value="I forgot" >  I forgot <br>
						<input type="checkbox" name="q4option2" value="I chose not to" >  I chose not to <br>
						<input type="checkbox" name="q4option3" value="Because of side effects" >  Because of side effects <br>
						<input type="checkbox" name="q4option4" value="I don’t understand how to take it" >  I don’t understand how to take it <br>
						<input type="checkbox" name="q4option5" value="Other reason" >  Other reason 
						</TD>
						</TR>
						
						<TR id="q5">
						<TD>5: Do you have any other thoughts you would like to share about your new prescription?</TD>
						<TD>
						<input type="radio" name="q5"  id="q5yes" value="yes" >Yes 
						<input type="radio" name="q5"  id="q5no" value="no" >No </TD>
						</TR>
						
						<TR id="q6">
						<TD>6: Please take a moment to record your thoughts you would like to share with us.</TD>
						<TD>
						<textarea placeholder=" short recorded description of reason" rows="3" id="textarea" name="q6" class="input-xlarge"></textarea>
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
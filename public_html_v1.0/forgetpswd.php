<?php
session_start();

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
        <li><a href="index.php">Home</a> <span class="divider">/</span></li>
        <li class="active">Forget Password</li><a href="javascript:history.go(-1);"><i class="icon-chevron-left pull-right"></i></a>
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
	foreach($_SESSION['error'] as 
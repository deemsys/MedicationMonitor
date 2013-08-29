<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>:: Medication Monitor ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/responsive.css" rel="stylesheet">
        <link href="assets/css/docs.css" rel="stylesheet">
        <link href="assets/css/drop-down-menu.css" rel="stylesheet">
        <link href="assets/css/admin.css" rel="stylesheet">

    <style type="text/css">
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>


  </head>

  <body>
  <div class="navbar navbar-fixed-top">
  <div class="logo_div"> <div class="container">
<img src="assets/img/logo.png" width="332" height="47" alt="logo">
  </div></div>

      <div class="navbar-inner">
      <div class="container">
        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="nav-collapse">
<?php

require("config.php");



if(isset($_SESSION['adminid']))
{

$sql = "select * from tbl_admin_details where md_admin_id =".$_SESSION['adminid'];
$query = mysql_query($sql);

$records = mysql_fetch_array($query);
$username = $records['md_username'];

 $sql11 = "SELECT * FROM tbl_relationship_details WHERE rs_relation_status = '0' ";

	$query11 = mysql_query($sql11);
	$count11 = mysql_num_rows($query11);



?>
          <ul class="nav">
              <?php
              if(substr($_SERVER['SCRIPT_NAME'],-9)!="index.php")
              {
                  ?>
                  <li><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
              <?php
              }
              ?>
		<li><a href="Medicinelist.php"><i class="icon-plus-sign icon-white"></i> Medication</a></li>

	<li class="dropdown">
		<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user icon-white"></i>Patients <?php if($count11 !=0){ ?><span class="badge badge-important"><?php echo $count11; ?></span><?php } ?><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="Patientregister.php">Add Patient</a></li>
			<li><a href="patientlist.php">List of Patients</a></li>
                        <li<?php if ($count11) { ?> style="background-color:#B94A48; font-size:15px;font-weight:bold;"><?php } ?><a href="requestpatient.php">Request Pending</a></li>
<!-- 			<li><a href="mypatientlist.php">My Patients</a></li> -->
	</li>
		</ul>


            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user icon-white"></i>Providers <b class="caret"></b></a>
              <ul class="dropdown-menu">
		<li><a href="register.php">Add Provider</a></li>
              <li><a href="providerlist.php">List of Providers</a></li>
              </li>
              </ul>
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user icon-white"></i>Reminders<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="reminders.php">Add Reminder</a></li>
            <li><a href="viewreminder.php">View Reminders</a></li>
        </ul>
    </li>

		
                <li><a href="viewassessment.php"><i class="icon-ok-circle icon-white"></i> Assessments </a></li>

		<li><a href="viewappionment.php"><i class="icon-time icon-white"></i> Appointments</a></li>

<!--            <li><a href="assessment.php">Daily Questionnaire</a></li>
                <li><a href="assessmentweek.php">Weekly Questionnaire</a></li>
                <li><a href="assessmentmon.php">Monthly Questionnaire</a></li>-->

            </li>
          </ul>

<?php
}

if(!isset($_SESSION['adminid']))
{

?>
	<ul class="nav pull-right">
		<li class="divider-vertical"></li>
		<li><a href="login.php"><i class="icon-user icon-white"></i> Sign in</a></li>
	</ul>


<?php
}
else
{

?>

	<ul class="nav pull-right">
		<li class="divider-vertical"></li>
		<li class="dropdown">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user icon-white"></i> <?php echo $username; ?><b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="myaccount.php"><i class="icon-user"></i>  Your Profile </a></li>
				<li><a href="changepswd.php"><i class="icon-cog"></i>  Change Password </a></li>
				<li><a href="logout.php"><i class="icon-lock"></i>  Logout </a></li>
			</ul>
		</li>
	</ul>

<?php
}
?>



        </div><!-- /.nav-collapse -->
      </div>
    </div>
    </div>
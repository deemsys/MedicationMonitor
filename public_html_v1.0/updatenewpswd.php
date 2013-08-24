<?php
// echo "<pre>";
// print_r($_POST); exit;

session_start();


require("config.php");

require('Mail.php');

$username = $_POST['uname'];

	$sql = "SELECT * FROM tbl_user_details WHERE ud_username = '".$username."'"; 
	$query = mysql_query($sql);

	$countuser = mysql_num_rows($query);

	$records = mysql_fetch_array($query);


			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= 7) 
			{
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}

// echo	$pass; exit;

foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['uname']) || trim($_POST['uname'])=='')
	$_SESSION['error']['uname'] = "User Name - Required Field Can't be blank";

else if($countuser <= 0)
	
	$_SESSION['error']['uname'] = "Invalid Username";
	

if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}

	$sql11 = "UPDATE tbl_user_details SET ud_password = '".md5($pass)."' WHERE ud_user_id = ".$records['ud_user_id'];

	$query11 = mysql_query($sql11); 
			

	$sql12 = "SELECT * FROM tbl_admin_details";
	$query12 = mysql_query($sql12);
	$records12 = mysql_fetch_array($query12);

	
	$from = "Medication Monitor";

	$tomail = $records['ud_email_id'];

	$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From: ". $from."\n";	



	$m= new Lib_Mail; 
	$m->From($from);
	$m->To($tomail);
	$m->Subject("Forget Password");	


 $message='<body>
<table width="650" border="0" cellspacing="0" cellpadding="0" align="center" style="padding:10px; border: rgb(241, 250, 252) 1px solid;">
  <tr>
    <td align="left" valign="top" style="background-color: rgb(4, 63, 87); padding:10px; border-bottom: rgb(153, 153, 153) 5px solid; "><img src="http://bephit.com/medicationmonitor/assets/mail_images/logo.jpg"  alt="Medication Monitor" /></td>
  </tr>
  <tr valign="top"><td align="left" style="background-color: rgb(241, 250, 252); padding:20px;"><h1 style="color: rgb(68, 68, 68); font-size:20px; font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; margin:0; padding:0; font-weight:normal;">Welcomes You!</h1>
  <p style="color: rgb(126, 149, 1); font-size:18px; font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; margin:0; padding:0; font-weight:bold;">Your Password reset successfully...</p>
  <h5 style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:20px 0 5px 0; padding:0;">Dear '.$username.',</h5>
  <p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;">This is to confirm that your Password has reset successfully.</p>
  </td></tr>
  
  <tr><td align="left" valign="top" style="background-color: rgb(241, 250, 252); padding:5px 20px 15px 20px;">
  <table width="500" border="0" cellspacing="0" cellpadding="0" style="background-color: rgb(255, 255, 255); margin:auto; border: rgb(214, 230, 234) 1px solid; padding:10px;">

  <tr>
    <td style="padding:10px; font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; font-size:12px; color: rgb(85, 85, 85);"><p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;">User Name : <span style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)">'.$username.'</span></p></td>
  </tr>
  <tr>
    <td style="padding:10px; font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; font-size:12px; color: rgb(85, 85, 85);"><p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;">Password : <span style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; font-size:12px; font-weight:bold; color:rgb(11, 152, 198)">'.$pass.'</span></p></td>
  </tr>
  <tr>
    <td style="padding:10px; font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; font-size:12px; color: rgb(85, 85, 85);"><p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0;"><a href="http://bephit.com/medicationmonitor/admin/" style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; font-size:12px; color: rgb(228, 32, 33)">Click Here</a> to active your account</p></td>
  </tr>
</table>
</td></tr>
<tr><td style="background-color: rgb(241, 250, 252); padding:5px 20px;"><p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(85, 85, 85); font-size:12px; margin:0; padding:0; font-style:italic;">Thanks & Regards,</p>
<p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(49, 148, 204); font-size:12px; margin:5px 0 10px 0; padding:0; font-style:italic; font-weight:bold;">Medication Monitor <span style="color: rgb(222, 72, 69);">Team</span></p>
</td></tr>
<tr><td align="center" valign="top" style="background-color: rgb(75, 161, 207); padding:5px 20px;"><p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(255, 255, 255); font-size:11px; margin:5px 0; padding:0;">If you have any queries, please feel free to contact us at support@medicationmonitor.com or </p>
<p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(255, 255, 255); font-size:11px; margin:5px 0; padding:0;">by phone at (0452) xxxx - xx - xxxx.</p>
<p style="font-family:Arial, Helvetica, sans-serif, "Myriad Pro", Calibri; color: rgb(255, 255, 255); font-size:11px; margin:0 0 5px 0; padding:0; text-align:center;">© 2012. All rights reserved.</p>
</td></tr>

</table>

</body>';

	$m->Body($message);	
	
	$m->Send();
	



		header("Location:forgetmessage.php");
		exit;
}
else
{

header("Location:forgetpswd.php");
exit;
}



?>
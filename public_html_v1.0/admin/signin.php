<?php

session_start();


require("config.php");


$username = $_POST['username'];
$password = md5( $_POST['pswd']);


	$query = mysql_query("select * from tbl_admin_details where md_username ='".$username."' AND md_password = '".$password."';");

	$records = mysql_fetch_array($query);

	$_SESSION['adminid'] = $records['md_admin_id'];
 
	$countuser = mysql_num_rows($query);




foreach($_POST as $key=>$value)
{
	$_SESSION['values'][$key] = $value;
}

if(!isset($_POST['username']) || trim($_POST['username'])=='')
	$_SESSION['error']['username'] = "User Name - Required Field Can't be blank";

if(!isset($_POST['pswd']) || trim($_POST['pswd'])=='')
	$_SESSION['error']['pswd'] = "Password - Required Field Can't be blank";

if($countuser <= 0)
	
	$_SESSION['error']['userlogin'] = "Invalid Username/Password";
	
$aa = count($_SESSION['error']);


if(!isset($_SESSION['error']) && count($_SESSION['error'])<=0)
{

	foreach( $_POST as $key => $value )
	{
	
		$_SESSION['values'][$key] = '';
		
	}

	if(isset($_POST['remember']))
	{
            /* Set cookie to last 1 year */
            setcookie('remember[username]', $_POST['username'], time()+60*24);
            setcookie('remember[pswd]', $_POST['pswd'], time()+60*24);
        }
	else
	{
            /* Cookie expires when browser closes */
		$time = time()-(60*24);
            setcookie('remember[username]', $_POST['username'], $time);
            setcookie('remember[pswd]', $_POST['pswd'], $time);
        }


		header("Location:index.php");
		exit;
}
else
{

header("Location:login.php");
exit;
}



?>
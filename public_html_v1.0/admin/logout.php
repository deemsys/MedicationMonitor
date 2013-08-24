<?php
session_start();
unset($_SESSION['adminid']);

header('Location:index.php');



?>
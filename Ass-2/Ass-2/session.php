<?php
session_start();
if($_SESSION['admin_email']=='')
{
    header("location:Que1.php");
}
?>
<?php
session_start();
include("connection.php");
if ($_SESSION['admin_email']=='')
{
    header('location:Que1.php');
}
include("header.php");
include("sidebar.php");
?>

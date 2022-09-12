<?php
include("connection.php");
session_start();

unset($_SESSION['admin_email']);
header("location:Que1.php");
?>
<?php 
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    <input type="name" name="txtnm" placeholder="Enter name"><br>
    <input type="password" name="txtpwd" placeholder="Enter password"><br>
    <input type="password" name="txtcpwd" placeholder="Enter confirm password"><br>
    <input type="email" name="txtemail" placeholder="Enter email"><br>
    <input type="number" name="txtcno" placeholder="Enter contact no"><br>
    <input type="submit" name="btnsubmit" value="Register"><br>
</form>
</body>
</html>
<?php
if(isset($_REQUEST['btnsubmit'])){
$nm=$_REQUEST['txtnm'];
$pwd=$_REQUEST['txtpwd'];
$cpwd=$_REQUEST['txtcpwd'];
$email=$_REQUEST['txtemail'];
$cno=$_REQUEST['txtcno'];
if($pwd==$cpwd){
$q="insert into register values(null,'$nm','$pwd','$cno','$email','user')";
$res=mysqli_query($con,$q);
echo "<script>alert('register successfully') </script>";
}
else{
    echo "<script>alert('password and confirm passwrod must be same') </script>";
}



}
?>
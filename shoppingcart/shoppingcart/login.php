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
   
    <input type="submit" name="btnsubmit" value="Login"><br>
</form>
</body>
</html>
<?php
if(isset($_REQUEST['btnsubmit'])){
$nm=$_REQUEST['txtnm'];
$pwd=$_REQUEST['txtpwd'];

$q="select * from register where name='$nm' and password='$pwd'";
$res=mysqli_query($con,$q);
$row=mysqli_fetch_row($res);
$cnt=mysqli_num_rows($res);
if($cnt>0){
    if($row[5]=="admin"){
        echo "<script>alert('register successfully') </script>";
        header("location:Admin/AdminHome.php");

    }
    else if($row[5]=="user"){
        header("location:User/UserHome.php");

    }

}
else{
    header("location:register.php");
}



}
?>
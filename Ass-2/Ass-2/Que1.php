<?php
include('connection.php');
session_start();

if(isset($_SESSION['admin_email']))
{
    if($_SESSION['admin_email']!='')
    {
        header("location:home.php");
    }
}  
if(isset($_REQUEST['login']))
{
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if(empty($email) || empty($password))
    {
        $error="Email Id And Password Are Empty";
    }
    else
    {
        $query = "select * from admin where admin_email='$email' and admin_password='$password'";
        $login=mysqli_query($con,$query);
        $row=mysqli_num_rows($login);

        if($row==1)
        {
            $_SESSION['admin_email']=$email;
            header('location:home.php');
        }
        else{
            echo " Email id and Password wrong";
        }
    }

}  

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="style.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
        <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100"  id="icon" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
    </div>
    
    <!-- Login Form -->
    <form method="POST">
      <input type="email" id="login" class="fadeIn second" name="email" placeholder="Email">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" name="login" class="fadeIn fourth" value="Log In">
    </form>
    
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>
    <span>
        <!-- <?php
            //echo $error;
        ?> -->
    </span>
  </div>
</div>
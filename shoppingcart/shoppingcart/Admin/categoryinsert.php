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
    <input type="name" name="txtcnm" required placeholder="Enter Category name"><br>
   
    <input type="submit" name="btnsubmit" value="Insert"><br>
</form>
</body>
</html>
<?php
if(isset($_REQUEST['btnsubmit'])){
$cnm=$_REQUEST['txtcnm'];
$q="insert into category values(null,'$cnm')";
$res=mysqli_query($con,$q);
}
?>
<table border="1">
    <tr>
        <td>Category Name</td>
        <td>Edit</td>
        <td>Delete</td>
        </tr>
        <?php
        $q="select * from category ";
        $res=mysqli_query($con,$q);
      
        $cnt=mysqli_num_rows($res);
        if($cnt>0){
           while(  $row=mysqli_fetch_row($res))
           {?>
           <tr>
            <td><?php echo $row[1];?></td>
            <td><a href="categoryedit.php">Edit</a></td>
            <td><a href="categorydelete.php">Delete</a></td>
           </tr>
         <?php  
         }
        
        }
        else{
            echo "<script>alert('No data found') </script>";

        }
        
        
        ?>
</table>
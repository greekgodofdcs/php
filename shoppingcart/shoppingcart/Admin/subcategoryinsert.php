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
    <input type="name" name="txtsnm" required placeholder="Enter sub category name"><br>
    <?php 
      $qc="select * from category";
      $resc=mysqli_query($con,$qc);
    ?>
   <select name="category">
       <option>----Select Category----</option>
       <?php 
       while($rowc=mysqli_fetch_row($resc)){?>
       <option value=<?php echo $rowc[0];?>><?php echo $rowc[1];?></option>
       <?php }?>
   </select>
    <input type="submit" name="btnsubmit" value="Insert"><br>
</form>
</body>
</html>
<?php
if(isset($_REQUEST['btnsubmit'])){
$snm=$_REQUEST['txtsnm'];
$cnm=$_REQUEST['category'];
$q="insert into subcategory values(null,'$snm','$cnm')";
$res=mysqli_query($con,$q);
}
?>








<table border="1">
    <tr>
        <td>Sub Category</td>
        <td>Category </td>
        <td>Edit</td>
        <td>Delete</td>
        </tr>
        <?php
        $q="select * from subcategory ";
        $res=mysqli_query($con,$q);
      
        $cnt=mysqli_num_rows($res);
        if($cnt>0){
           while(  $row=mysqli_fetch_row($res))
           {
            $q1="select * from category c,subcategory s where s.categoryid=c.categoryid and s.subcategoryid='$row[0]'";
            $res1=mysqli_query($con,$q1);
            $row1=mysqli_fetch_row($res1)
               ?>
           <tr>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row1[1];?></td>
            <td><a href="subcategoryedit.php">Edit</a></td>
            <td><a href="subcategorydelete.php">Delete</a></td>
           </tr>
         <?php  
         }
        
        }
        else{
            echo "No data found";

        }
        
        
        ?>
</table>
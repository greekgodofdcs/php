<?php 
include("connection.php");
include("session.php");

if(isset($_REQUEST['btnsave']))
{
    $name = $_REQUEST['sname'];
    $pass = $_REQUEST['spass'];
    $age  = $_REQUEST['age'];
    $number = $_REQUEST['contact'];    
    $p = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $path = "file/".$p;
    move_uploaded_file($tmp,$path);
    $query = "insert into service (name,password,age,contact_number,photo) values('$name','$pass','$age','$number','$path')";
    mysqli_query($con,$query);
    echo"insert Service Provider Data Successfully";
    header("service_provider.php");

}
$Queryd = "select * from service";
$data=mysqli_query($con, $Queryd);

if(isset($_REQUEST['remove']))
{
    $did = $_REQUEST['remove'];
    $queryd = "delete from service where reg_id='$did'";
    mysqli_query($con, $queryd);
    echo " Delete Service deatils successfull";
    header("location:service_provider.php");
}
if(isset($_REQUEST['sid']) and isset($_REQUEST['ca']))
{
    $id = $_REQUEST['sid'];
    $ca = $_REQUEST['ca'];
    if($ca = 'New')
    {
        $complain = "update service set complain_Allocation='Pending' where reg_id='$id'";
        mysqli_query($con, $complain);
    }
    else
    {
        $complain = "update service set complain_Allocation='Completed' where reg_id='$id'";
        mysqli_query($con, $complain);
    }
}
if(isset($_REQUEST['edit']))
{
    $eid = $_REQUEST['edit'];
    $querye= "select * from service where reg_id = '$eid'";
    $edit=mysqli_query($con, $querye);
    $edit1=mysqli_fetch_array($edit);
}
if(isset($_REQUEST['btnupdate']))
{
    $uid = $_REQUEST['edit'];
    $name = $_REQUEST['sname'];
    $pass = $_REQUEST['spass'];
    $age  = $_REQUEST['age'];
    $number = $_REQUEST['contact'];    
    $p = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $path = "file/".$p;
    move_uploaded_file($tmp,$path);
    $queryu = "update service set name='$name',password='$pass',age='$age',contact_number='$number',photo='$path' where reg_id='$uid'";
    mysqli_query($con,$queryu);
    echo "Service Data Updated Successfull";
    header("location:service_provider.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include("header.php")?>
    <h4> <a href="home.php">Back</a></h4>
    <div class="container">
        <h4> <center> Service Provider </center></h4><hr><hr>
        <div class="col" style="border: 3px solid ; padding: 10px;">
            <form class="row" method="POST" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Name</span>
                    <input type="text" name="sname" class="form-control" placeholder="Service Provider name" value="<?php if(isset($_REQUEST['edit'])){echo $edit1['name'];} ?>" aria-label="Product Name" title="Service Provider name" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" name="spass" class="form-control" placeholder="Password" value="<?php if(isset($_REQUEST['edit'])){echo $edit1['password'];} ?>" title="Password" aria-label="Product Description" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Age</span>
                    <input type="text" name="age" class="form-control" placeholder="Age" value="<?php if(isset($_REQUEST['edit'])){echo $edit1['age'];} ?>" title="Age" aria-label="Product Description" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Contact Number</span>
                    <input type="number" name="contact" class="form-control" placeholder="Contact Number" value="<?php if(isset($_REQUEST['edit'])){echo $edit1['contact_number'];} ?>" title="Contact Number" aria-label="Product Description" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Photo</span>
                    <input type="file" name="photo" class="form-control" placeholder="Photo" value="<?php if(isset($_REQUEST['edit'])){echo $edit1['photo'];} ?>" title="Photo" aria-label="Product Description" aria-describedby="basic-addon1">
                </div>
                <div class="col-6">
                <?php    
                if($edit)
                {
                ?>
                    <input type="submit" name="btnupdate" value="Update" class="btn btn-primary">
                <?php
                }
                else
                {
                ?>
                    <input type="submit" name="btnsave" value="Save" class="btn btn-primary">
                <?php
                }
                ?>
                </div>
            </form>
        </div>
    </div>    
    <br>
    <br>    
    <div class="container">
        <form action="" >
            <table class="table table-success table-striped"  style="border:3px solid;">
                <thead style="border:3px solid;">
                    <tr>
                        <th colspan="13"></th>
                        <select name="cn">
                            <option value="pro_id">id</option>
                            <option value="pro_id">id</option>
                            <option value="pro_id">id</option>
                        </select>

                    </tr>
                    
                    <th>Action |&nbsp;</th>
                    <th>Reg-id |&nbsp;</th>
                    <th>Name |&nbsp;</th>
                    <th>Password |&nbsp;</th>
                    <th>Age |&nbsp;</th>
                    <th>Contact Number |&nbsp;</th>
                    <th>Photo |&nbsp;</th>
                    <th>Complaine Allocation &nbsp;</th>
                </thead>
                <tbody style="border:3px solid;">
                    <?php    
                        while($data1=mysqli_fetch_array($data))
                        {
                    ?>
                    <tr>
                            <td> <a href="service_provider.php?remove=<?php echo $data1['reg_id']; ?>" onclick=" return confirm('Are you sure to delete Service prodvider')"><i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                <a href="service_provider.php?edit=<?php echo $data1['reg_id']; ?>" onclick=" return confirm('Are you sure update details')"><i class="fa fa-pencil"></i></a> 
                            </td>
                            <td><?php  echo $data1['reg_id']; ?></td>
                            <td><?php  echo $data1['name']; ?> &nbsp;</td>
                            <td><?php  echo $data1['password']; ?> &nbsp;</td>
                            <td><?php  echo $data1['age']; ?></td>
                            <td><?php  echo $data1['contact_number']; ?></td>
                            <td> <img src="<?php  echo $data1['photo']; ?>" height="100" width="100" alt=""> </td>
                            <td> <a href="service_provider.php?sid=<?php echo $data1['reg_id'];?>&&ca=<?php echo $data1['complain_Allocation'];?>"><?php  echo $data1['complain_Allocation']; ?></a></td>
                    </tr>
                    <?php
                        }
                    ?>   
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
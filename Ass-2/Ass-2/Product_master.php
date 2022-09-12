<?php
include("session.php");
include("connection.php");
if (isset($_REQUEST['btnsave']))
{
    $pn = $_REQUEST['pname'];
    $pd = $_REQUEST['pdesc'];

    $query = "insert into product_master(pro_name,pro_description) Values('$pn','$pd')";
    $row=mysqli_query($con,$query);
    header("location:Product_master.php");
    if($row > 0)
    {
        echo "Product Details Insert SuucessFully";
    }
    else{
        echo "Product Details Insert Fail";
    }
}
$queryd = "select * from product_master";
$data=mysqli_query($con,$queryd);

if(isset($_REQUEST['remove']))
{
    $id = $_REQUEST['remove'];
    $querye="delete from product_master where pro_id='$id'";
    mysqli_query($con, $querye);
    header("location:Product_master.php");
    echo " Product Delete Successfully";
}
if(isset($_REQUEST['btnsearch']))
{
    $a = $_REQUEST['search'];
    $cn = $_REQUEST['cn'];
    $querys= "select * from product_master where $cn like '$a%'";
    $data=mysqli_query($con, $querys);
}
elseif(isset($_REQUEST['ord']) and isset($_REQUEST['cn'] ))
{
    $a = $_REQUEST['ord'];
    $cn = $_REQUEST['cn'];
    $data=$queryr="select * from product_master ord $cn $a";
}
if(isset($_REQUEST['update']))
{
    $uid = $_REQUEST['update'];
    $queryu="select * from product_master where pro_id='$uid'";
    $edit=mysqli_query($con,$queryu);
    $edit1=mysqli_fetch_array($edit);
}
if(isset($_REQUEST['btnupdate']))
{
    $uid = $_REQUEST['update'];
    $pn = $_REQUEST['pname'];
    $pd = $_REQUEST['pdesc'];
    $queryp = "update product_master set pro_name='$pn', pro_description='$pd' where pro_id='$uid'";
    mysqli_query($con, $queryp);
    header("location:Product_master.php");
    echo"Your date Update Successfull";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>   
    <?php include("header.php") ?>
    <h4><a href="home.php">Back</a></h4>
    <div class="container">   
        <div class="col" style="border: 3px solid ;">
            <h1><center> Product Details From </center></h1><hr><hr>
            <form class="row" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Product Name</span>
                    <input type="text" name="pname" class="form-control" placeholder="Product name" value="<?php if(isset($_REQUEST['update'])){echo $edit1['pro_name'];} ?>" aria-label="Product Name" title="Product Name" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Product Description</span>
                    <input type="text" name="pdesc" class="form-control" placeholder="Product Description" value="<?php if(isset($_REQUEST['update'])){echo $edit1['pro_description'];} ?>" title="Product Description" aria-label="Product Description" aria-describedby="basic-addon1">
                </div>
                <div class="col-6">
                    <?php
                    if($queryu)
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
        <br>
        <br>
        <div class="col">
            <form action="" method="post">        
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th colspan="13">
                            <select name="cn">
                                <option value="pro_id">Id</option>
                                <option value="pro_name">Name</option>
                            </select>
                            <input type="text" name="search"><input type="submit" value="Search" name="btnsearch"></th>
                        </tr>
                        <tr>
                            <th>Action</th>
                            <th>Sr.No
                                <a href="Product_master.php?ord = asc&&cn = pro_id">A</a>
                                <a href="Product_master.php?ord = desc&&cn = pro_id">D</a>
                            </th>
                            <th>Product Name
                                <a href="Product_master.php?ord = asc&&cn = pro_name">A</a>
                                <a href="Product_master.php?ord = desc&&cn = pro_name">D</a>
                            </th>
                            <th>Product Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while ($pro=mysqli_fetch_array($data)) 
                            {
                        ?>        
                                <tr>
                                    <td> <a href="Product_master.php?remove=<?php echo $pro['pro_id'];?>" onclick="return confirm('Are you sure to delete no <?php echo $i ?>');"><i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;|
                                    &nbsp;&nbsp;<a href="Product_master.php?update=<?php echo $pro['pro_id'];?>" onclick="return confirm('Are you sure to update no <?php echo $i ?>');"><i class="fa fa-pencil"></i></a></td>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $pro['pro_name']; ?></td>
                                    <td><?php echo $pro['pro_description']; ?></td>
                                </tr>
                        <?php        
                            }
                        ?>
                    </tbody>
                </table>
            </form>

        </div>
    </div>    
</body>
</html>
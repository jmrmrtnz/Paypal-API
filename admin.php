<?php
    include 'dbcon.php';
    //INSERT Product to DATABASE
    if(isset($_POST['AddProduct'])){
        $ProductName = $_POST['ProductName'];
        $ProductPrice = $_POST['ProductPrice'];
    
        $sql="INSERT INTO tbl_product (ProductName, ProductPrice) VALUES (?,?)";
        $stmt=$con->prepare($sql);
        $stmt->bind_param("ss", $ProductName, $ProductPrice);
        if($stmt->execute()){
            echo "
                    <script>
                        alert('Product Added');
                    </script>
                ";
        }
    }
    //DELETE Product in DATABASE
    if(isset($_POST['DeleteProduct'])){
        $ProductID = $_POST['ProductID'];
    
        $sql="DELETE FROM tbl_product WHERE ProductID=?";
        $stmt=$con->prepare($sql);
        $stmt->bind_param("s", $ProductID);
        if($stmt->execute()){
            echo "
                    <script>
                        alert('Product Deleted');
                    </script>
                ";
        }
    }
    //UPDATE product in DATABASE
    if(isset($_POST['UpdateProduct'])){
        $ProductName = $_POST['ProductName'];
        $ProductPrice = $_POST['ProductPrice'];
        $ProductID = $_POST['ProductID'];
    
        $sql="UPDATE tbl_product SET ProductName=?, ProductPrice=? WHERE ProductID=?";
        $stmt=$con->prepare($sql);
        $stmt->bind_param("sss", $ProductName, $ProductPrice, $ProductID);
        if($stmt->execute()){
            echo "
                    <script>
                        alert('Product Updated');
                    </script>
                ";
        }
    }
    //MARK AS COMPLETE
    if(isset($_POST['markascomplete'])){
        $orderid=$_POST['orderid'];
        $orderstate='Complete';
    
        $sql="UPDATE tbl_order SET orderstate=? WHERE orderid=?";
        $stmt=$con->prepare($sql);
        $stmt->bind_param("ss", $orderstate, $orderid);
        if($stmt->execute()){
            echo "
                    <script>
                        alert('Product Order Complete');
                    </script>
                ";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin Page</title>
  </head>
  <body>

<div class="container">
    <form action="admin.php" method="POST">
        <!--PRODUCT NAME--> <br> <hr> 
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="ProductName"  placeholder="Enter Product Name">
        </div>
        <!--PRODUCT PRICE-->
        <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" name="ProductPrice"  placeholder="Enter Product Price">
        </div>
        <!--Submit Button-->
        <div class="form-group">
            <button type="submit" name="AddProduct" class="btn btn-primary">Add Product</button>
        </div>
    </form>
    <hr><br>
    <!--POST ADD PRODCUTS TO END USER-->
    <table class="table">
        <thead>
            <tr>
            <th scope="col">ProductID</th>
            <th scope="col">ProductName</th>
            <th scope="col">Product Price</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql="SELECT * FROM tbl_product ORDER BY ProductID DESC";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            while($row=$result->fetch_assoc()){
        ?>
            <tr>
            <th scope="row"><?php echo $row['ProductID']; ?></th>
            <td><?php echo $row['ProductName']; ?></td>
            <td><?php echo $row['ProductPrice']; ?></td>
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['ProductID']; ?>">
                    Update
                </button>
            </td>
            <td>
                <form action="admin.php" method="POST">
                    <input type="hidden" name="ProductID" value="<?php echo $row['ProductID']; ?>">
                    <button type="submit" name="DeleteProduct" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
        <!--POST ORDERS TO END USER-->
        <hr>
        <h4 style="text-align: center;">Pending Order</h4>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Payer ID</th>
            <th scope="col">Address</th>
            <th scope="col">Value</th>
            <th scope="col">Currency</th>
            <th scope="col">PayPal Status</th>
            <th scope="col">Product Name</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Mark as complete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql="SELECT * FROM tbl_order WHERE orderstate='Pending' ORDER BY orderid DESC";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            while($row=$result->fetch_assoc()){
        ?>
            <tr>
            <th scope="row"><?php echo $row['orderid']; ?></th>
            <td><?php echo $row['ordername']; ?></td>
            <td><?php echo $row['orderemail']; ?></td>
            <td><?php echo $row['orderpayerid']; ?></td>
            <td><?php echo $row['orderfn']; ?></td>
            <td><?php echo $row['ordervalue']; ?></td>
            <td><?php echo $row['ordercurrency']; ?></td>
            <td><?php echo $row['orderstatus']; ?></td>
            <td><?php echo $row['ordertitle']; ?></td>
            <td><?php echo $row['orderstate']; ?></td>
            <td><?php echo $row['orderdate']; ?></td>
            <td><?php echo $row['ordertime']; ?></td>
            <td>
                <form action="admin.php" method="POST" onsubmit="return confirm('Mark this order Complete?');">
                    <input type="hidden" name="orderid" value="<?php echo $row['orderid']; ?>">
                    <button type="submit" name="markascomplete" class="btn btn-primary">Complete</button>
                </form>
            </td>
            </tr>
        <?php } ?>
        </tbody>
        </table>

        <hr>
    <!--POST ORDERS COMPLETED-->
            <h4 style="text-align: center;">Completed Status</h4>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Payer ID</th>
            <th scope="col">Address</th>
            <th scope="col">Value</th>
            <th scope="col">Currency</th>
            <th scope="col">PayPal Status</th>
            <th scope="col">Product Name</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql="SELECT * FROM tbl_order WHERE orderstate='Complete' ORDER BY orderid DESC";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            while($row=$result->fetch_assoc()){
        ?>
            <tr>
            <th scope="row"><?php echo $row['orderid']; ?></th>
            <td><?php echo $row['ordername']; ?></td>
            <td><?php echo $row['orderemail']; ?></td>
            <td><?php echo $row['orderpayerid']; ?></td>
            <td><?php echo $row['orderfn']; ?></td>
            <td><?php echo $row['ordervalue']; ?></td>
            <td><?php echo $row['ordercurrency']; ?></td>
            <td><?php echo $row['orderstatus']; ?></td>
            <td><?php echo $row['ordertitle']; ?></td>
            <td><?php echo $row['orderstate']; ?></td>
            <td><?php echo $row['orderdate']; ?></td>
            <td><?php echo $row['ordertime']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
        </table>



        <!-- UPDATE DATA -->
        <?php
            $sql="SELECT * FROM tbl_product ORDER BY ProductID DESC";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt->get_result();
            while($row=$result->fetch_assoc()){
        ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter<?php echo $row['ProductID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="admin.php" method="POST">
                <div class="form-group">
                    <label>Product Name</label>
                        <input type="text" class="form-control" name="ProductName" value="<?php echo $row['ProductName']; ?>">
                </div>
                <div class="form-group">
                    <label>Product Price</label>
                        <input type="text" class="form-control" name="ProductPrice" value="<?php echo $row['ProductPrice']; ?>">
                </div>
                <input type="hidden" name="ProductID" value="<?php echo $row['ProductID']; ?>">
            </div>
            <div class="modal-footer">
                <button type="submit" name="UpdateProduct" class="btn btn-primary">Save changes</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <?php } ?>
        
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
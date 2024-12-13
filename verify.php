<?php
date_default_timezone_set('Asia/Manila');
include 'dbcon.php';

$ordername = $_GET['name'];
$orderemail = $_GET['email'];
$orderpayerid = $_GET['payerid'];
$orderfn = $_GET['fn'];
$ordervalue = $_GET['value'];
$ordercurrency = $_GET['currency'];
$orderstatus = $_GET['status'];
$ordertitle = $_GET['ordertitle'];
$orderstate = 'Pending';
$orderdate = date('F j, Y');
$ordertime = date(' g:i:a');

$sql="INSERT INTO tbl_order (ordername,orderemail,orderpayerid,orderfn,ordervalue,ordercurrency,orderstatus,ordertitle,orderstate,orderdate,ordertime) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$stmt=$con->prepare($sql);
$stmt->bind_param("sssssssssss", $ordername,$orderemail,$orderpayerid,$orderfn,$ordervalue,$ordercurrency,$orderstatus,$ordertitle,$orderstate,$orderdate,$ordertime);
if($stmt->execute()){
    echo "
                <script>
                    alert('Product Purchased Okay');
                    window.location.href='index.php';
                </script>
            ";
}
?>


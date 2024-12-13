<?php
    include 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Products</title>
  </head>
  <body>
    <div class="container">
        <!--POST ADD PRODCUTS TO END USER-->
        <br>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">ProductID</th>
            <th scope="col">ProductName</th>
            <th scope="col">Product Price</th>
            <th scope="col">Buy</th>
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
                <div id="paypal-button<?php echo $row['ProductID']; ?>"></div>
            </td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
<!--COPY FROM THE FILE-- sandbox.paypal.com-->
<script src="https://www.paypal.com/sdk/js?client-id=AUoTz-UbGS5KxHE2AONsikQgWaFs3nM0j3bN9_6pHPjKh30eqeE-00n6OF916a3WaaqLljXLIQbs3gIa"></script>

<?php
    $sql="SELECT * FROM tbl_product ORDER BY ProductID DESC";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc()){
  ?>
<script>
  paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: '<?php echo $row['ProductPrice']; ?>'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            var name = details.payer.name.given_name +" "+details.payer.name.surname;
            var email = details.payer.email_address;
            var payerid = details.payer.payer_id;
            var fn = details.purchase_units[0].shipping.address.address_line_1 + " "+ details.purchase_units[0].shipping.address.admin_area_2+ " "+ details.purchase_units[0].shipping.address.admin_area_1 + " "+ details.purchase_units[0].shipping.address.postal_code+ " "+ details.purchase_units[0].shipping.address.country_code;

            var value = "$"+details.purchase_units[0].payments.captures[0].amount.value;
            var currency = details.purchase_units[0].payments.captures[0].amount.currency_code;
            var status = details.status;
            
            var ordertitle = '<?php echo $row['ProductName']; ?>';


            window.location.replace("http://localhost/payment/verify.php?name="+name+"&email="+email+"&payerid="+payerid+"&fn="+fn+"&value="+value+"&currency="+currency+"&status="+status+"&ordertitle="+ordertitle)
        })
    },
    onCancel: function (data) {
        window.location.replace("http://localhost/payment/Oncancel.php")
    }
}).render('#paypal-button<?php echo $row['ProductID']; ?>');

</script>
<?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
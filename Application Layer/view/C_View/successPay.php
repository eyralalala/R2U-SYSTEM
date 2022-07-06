<?php
session_start();

//require_once '../../../Business Services Layer/controller/C_Controller/C_AccountController.php';
require_once '../../../Business Services Layer/controller/C_Controller/cartController.php';
require_once '../../../Business Services Layer/controller/C_Controller/PaymentController.php';
require_once '../../../Business Services Layer/controller/C_Controller/C_trackingController.php';
date_default_timezone_set('Asia/Kuala_Lumpur');

$cart = new cartController();
//$customer = new customerController();
$payment = new paymentController();
$tracking = new C_TrackingController();
$data = $cart->viewCart();
//$cust_data = $customer->viewCustomer();
//$custFullAddress = $customer->viewCustomerFullAddress();
// $data = $cart->viewAll();
$total_quantity = 0;
$total_price = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<title>Thanks For your Purchase!</title>
</head>
<body>
	<div class="wrapper" id="wrapper">
		<h2>Payment Received with thanks!</h2>
	</div>
	<?php
	         $i = 1;
	         foreach ($cust_data as $row) {

	         	$name = $row2['cust_name'];
	         	$email = $row2['cust_email'];
	         	$phone = $row2['cust_phone'];
	         	$address = $row2['cust_address'];
	         } ?>

	         <form action="" method="POST">
	         	<?php
	         	echo "<tr>"
	         	."<br><b>Date:<b>". "<td>".date("Y-m-d") . "</td>"
	         	."<br><b>Name:<b>". "<td>".$row2['cust_name']."</td>"
	         	."<br><b>Email:<b>". "<td>".$row2['cust_email']."</td>"
	         	."<br><b>Address:<b>". "<td>".$custFullAddress . "</td>"
	         	."<br><b>Phone Number:</b>"."<td>".$row['cust_phone']."</td>"
	         	?>
	         </td>
	         <?php
	         $i++;
	         echo "</tr>";
	         ?>
	         	
	         </form>
	         <?php
	         ?>

	         <br><br>
	         <center>
	         	<form action="" method="POST">
	         		<table>
	         			<thead>
	         				<th>Name</th>
	         				<th>Order Details</th>
	         				<th>Price</th>
	         				<th>Quantity</th>
	         				<th>Total</th>
	         			</thead>
	         			<?php
	         			$i = 1;
	         			if (is_array($data) || is_object($data)) {
	         				foreach ($data as $row) {
	         					$quantity = $row["order_quantity"];
	         					$price = $row["product_price"];
	         					$total_quantity += $quantity;
	         					$total_price += $price; ?>
	         					<form action="" method="POST">
	         					<?php
	         					echo "<tr>"
	         					."<td>".$row['order_detail']."</td>"
	         					."<td>".$row['order_price']."</td>"
	         					."<td>".$row['order_price'] * $row['order_quantity']."</td>";   ?>
	         					</td>
	         					<?php
	         					$i++;
	         					echo"<tr>";
	         					?>
	         				</table>
	         			</form>
	         			<?php

	         				}
	         			}
	         			?>
	         		</table>
	         		
	         	</form>

	         </center>

</body>
</html>

<?php
require_once '../../../Business Services Layer/controller/C_Controller/CartController.php';
require_once '../../../Business Services Layer/controller/C_Controller/PaymentController.php';

$payment = new PaymentController();
$cart = new CartController();


session_start();
$cAccountID = $_SESSION['account_id'];
$data = $cart->viewCart();
$total = $cart->calculateTotalPrice();

if(isset($_POST['confirm_btn'])){
  $payment->checkout();
}

?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>

<body>
  <fieldset class="spf-fs-name">
      <h2> Payment</h2>
    
    <!--<div id="orderlist">
      <table width="100%" border="1" cellpadding="2" cellspacing="2">
        <tr>
          <td></td>
          <td width="125"><div align="center"><strong>Order Detail</strong></div></td>
          <td width="125"><div align="center"><strong>Quantity</strong></div></td>
          <td width="150"><div align="left"><strong>Price</strong></div></td>
          <td width="25"><div align="center"><strong>Total Price</strong></div></td>
        </tr> -->

        <form action="" method="POST">

            <td colspan="5"> </td>
          </tr>
          <table border="1px" align="center" style="width:100%">
  <tr>
    <th style="width: 180px; padding-left:8px;">No</th>
    <th style="width: 199px;padding-left:8px; border-right: 0:">Order Detail</th>
    <form action="" method="POST">
      <th style="border-right: 0; width: 155px;padding-left:8px;">price per unit</th>
   <th  style="width: 155px; padding-left:8px;">Quantity</th>

   
       <th style="border-right: 0; width: 100px;padding-left:8px;">Sub Total</th>
   
    <th  style="width: 90px; padding-left:8px;">Delivery amount</th>    
  </tr>


          <?php
          $i = 0;
          foreach($data as $row){
            $i++;
          ?>
<center>
          <tr>
       <td><?=$row['item_id']?></td>
            <td><?=$row['item_name']?></td>

            <td><?=$row['item_price']?></td>
<td><?=$row['quantity']?></td>

            <form action="" method="POST">

      

              <td><?=$row['subtotal']?></td>
         <td></td>
              <input type="hidden" name="itemID" value="<?=$row['item_id']?>">

            
</center>
            </form>
          </tr>

          <?php
          }
          if($i==0)
            $btn_status = "disabled";
          else $btn_status = "NULL";
          ?>

        
<td>
              <p><td></td></p>
            <p><td></td></p>
        <p><td></td></p>
          <p><td></td></p>
          <p><td>RM 10.00</td></p>
    

         
      
           
          </td>

          
          <tr>
            <td colspan="4" style="text-align: right"><th>Total Price</th></td>
      
            <td>RM <?=$total?> + RM10</td>
          </tr>

<!--<h4>
Cart Summary <span class="price" style="color:black"><b></b></span>
</h4> -->
<p>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      </table>
              <div class="card-body">
                <center>
                  <form action="" method="POST">
                    
  <script
    src="https://www.paypal.com/sdk/js?client-id=ARpSge3-fXwfVnzqgEu4SfxHeClMk9MR1c2CbxJ0IHtKDvEnOLMKdf8SZbOI6bPr_-adwfIb6m8lrQRI-_j&currency=MYR"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
  </script>
</body>
<!-- Add the PayPal JavaScript SDK with both buttons and marks components -->
<script src="https://www.paypal.com/sdk/js?client-id=test&components=buttons,marks"></script>

<!-- Use radio buttons for choosing between PayPal and a different payment method -->
<label>
  <input type="radio" name="payment-option" value="paypal" checked>
  Pay with PayPal
  <div id="paypal-marks-container"></div>
</label>
<label>
  <input type="radio" name="payment-option" value="alternate">
  Cash On Delivery
</label>

<div id="paypal-buttons-container"></div>
<div id="alternate-button-container">
  <input type="submit" name="confirm_btn" value="Confirm Payment">
                    </form>
  <!--<button>Cash On Delivery</button>-->
</div>

<script>
  // Render the PayPal marks
  paypal.Marks().render('#paypal-marks-container');

  // Render the PayPal buttons
  paypal.Buttons().render('#paypal-buttons-container');

  // Listen for changes to the radio buttons
  document.querySelectorAll('input[name=payment-option]')
    .forEach(function (el) {
      el.addEventListener('change', function (event) {

        // If PayPal is selected, show the PayPal button
        if (event.target.value === 'paypal') {
          document.body.querySelector('#alternate-button-container')
            .style.display = 'none';
          document.body.querySelector('#paypal-buttons-container')
            .style.display = 'block';
        }

        // If alternate funding is selected, show a different button
        if (event.target.value === 'alternate') {
          document.body.querySelector('#alternate-button-container')
            .style.display = 'block';
          document.body.querySelector('#paypal-buttons-container')
            .style.display = 'none';
        }
      });
    });

  // Hide non-PayPal button by default
  document.body.querySelector('#alternate-button-container')
    .style.display = 'none';
</script>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        payer:{
          email_address: '<?= $email ?>',
          name: {
            given_name: '<?= $name ?>'
          },
          address: {
            address_line_1: '<?= $address1 ?>',
            address_line_2: '<?= $address2 ?>',
            admin_area_1: '<?= $state ?>',
            admin_area_2: '<?= $city ?>',
            postal_code: '<?= $zipcode ?>',
            country_code: "MY"
          }
        },
        purchase_units: [{
          amount: {
            currency_code: 'MYR'
            value: '<?= $total ?>'
          }
        }]
      });
    },
    onError: function(error) {
                  console.log(error);                      
                },
    onApprove: function(data, actions) {
    // This function captures the funds from the transaction.
    return actions.order.capture().then(function(details) {
    // This function shows a transaction success message to your buyer.
    alert('Transaction completed by ' + details.payer.name.given_name);
        window.location.href = "../../Application Layer/view/C_View/successPay.php?cust_id=<?=$_SESSION['userid']?>"                  
          });
        }
        

  }).render('#paypal-button-container');
</script>


</form>
</center>
</div>
</table>
</div>
</fieldset>
</body>
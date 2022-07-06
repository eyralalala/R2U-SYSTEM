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

<html>
  <head>
    <title>Checkout</title>
     <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/fonts/roboto/Roboto-Regular.woff'>


 <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    .box{
      border-radius: 50px;
      width: 600px;
      border: 1px solid black;
      padding: 30px;
      margin: 70px;
    }
  </style>
    
  </head>
  <body>
    <center><h2>Checkout</h2>
       <div class="box">
    <form action="" method="POST">
    <table>

      <form action="" method="POST">

        <table>
    </div>
        <div class="row">
      <div class="col s12 m13">
        <div class="card" id="step-2" v-cloak>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><b>Customer Information</b></span>

            <div class="row m-top-15">
              <form class="col s15">
                <div class="row">
                  <div class="input-field col s12 l6 m-top-15">
                    <input id="first_name" @blur="$v.name.$touch()" :class="{'invalid': $v.name.$error}" v-model="name" type="text" autocomplete="name">
                    <label for="first_name">Full name</label>
                    <span v-if="$v.name.$error" class="helper-text" data-error="Please fill out full name"></span>

                  </div>
                  <div class="input-field col s15 l6 m-top-15">
                    <input id="company" v-on:blur="setCompanyShipping" v-model="company" type="text" class="validate">
                   <label for="company">Company (optional)</label>
                  </div>
                </div>
                <div class="row m-top-15">
                  <div class="input-field col s12 autocomplete-container">
                    <form action="" method="POST">
                      <input type="hidden" name="total" value="<?=$total?>">
                      <input class="js-autocomplete-input" name="dropoff_location" id="dawa-autocomplete-input" @blur="$v.address.$touch()" :class="{'invalid': $v.address.$error}" v-model="addressInput" type="text" class="validate" autocomplete="false">
                   <label for="dawa-autocomplete-input">Full address</label>
                      <input type="submit" name="confirm_btn" value="Confirm Payment">
                    </form>
                    
                    
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 l6 m-top-15">
                    <input @blur="$v.email.$touch()" :class="{'invalid': $v.email.$error}" id="email" v-model="email" type="text" class="validate" autocomplete="email">
                    <label for="email">Email</label>
                    <span v-if="$v.email.$error" class="helper-text" data-error="Please fill out email"></span>
                  </div>
                  <div class="input-field col s12 l6 m-top-15">
                    <input @blur="$v.phone.$touch()" :class="{'invalid': $v.phone.$error}" id="phone" v-model="phone" type="text" class="validate" autocomplete="tel">
                    <label for="phone">Phone
                    </label>
                    <span v-if="$v.phone.$error" class="helper-text" data-error="Please fill out phone"></span>
                  </div>
                </div>
                
        <div class="card" id="step-2" v-cloak>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"><b>Shipping</b></span>
            <p>Shipped by R2U delivery partners.</p>
         
        </table>
              <div class="panel-body">
    <h2 class="title">R2U Payment</h2>

 </div>
        <label>
         
            <span class="card-title activator grey-text text-darken-4 m-top-15"><b>Your order</b></span>
             <input type="hidden" name="account_id" value="<?=$account_id?>">

        <table>
</form>
          <div class="formContainer">
             <input type="hidden" name="cAccountID" value="<?=$cAccountID?>">
        <table>

          <tr>
            <td><a style="text-decoration: none;" href="C_Home.php?page=cart">Edit Cart</a></td>
<p>
<a style="text-decoration: none;" href="C_Home.php?page=cart">Payment Details</a>
</p>
</div>
   
    <p>total price: RM <?php echo $cart->calculateTotalPrice()?> + Delivery Fee: RM10</p>
          
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label></tr>
          <tr>


      <form action="" method="POST">

            <td colspan="5"> </td>
          </tr>
          <table border="1px" align="center" style="width:100%">
  <tr>
    <th style="width: 180px; padding-left:8px;">No</th>
    <th style="width: 199px;padding-left:8px; border-right: 0:">item Name</th>
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

<h4>
Cart Summary <span class="price" style="color:black"><b></b></span>
</h4>
<p>




      
          
</p></form>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XWZPXGGBRZL7L">
<table>
<tr><td><input type="hidden" name="on0" value="payment option">payment mode</td></tr><tr><td><select name="os0">
  <option value="item 1">item 1 RM0.01 MYR</option>
  <option value="item 2">item 2 RM0.01 MYR</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="MYR">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" target="_blank" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
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
  <button>Cash On Delivery</button>
</div>

          <tr>
            <td colspan="2">
              <a href="cod.php?page=cart">back</a> 
              
            </td>
          </tr>
</table>
          
        </table>
      </form>
      <div class="checkout-panel">
        <!-- partial -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vuex/3.0.1/vuex.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js'></script>
<script src='https://dawa.aws.dk/js/autocomplete/dawa-autocomplete2.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/vue-awesome-swiper@3.1.2/dist/vue-awesome-swiper.js'></script>
<script src='https://unpkg.com/vuelidate@0.6.2/dist/vuelidate.min.js'></script>
<script src='https://unpkg.com/vuelidate@0.6.2/dist/validators.min.js'></script><script  src="./script.js"></script>

    </center>
  </body>
</html>
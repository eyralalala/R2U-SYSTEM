<?php
require_once '../../../Business Services Layer/controller/C_Controller/C_ItemController.php';
require_once '../../../Business Services Layer/controller/C_Controller/CartController.php';

session_start();
$cAccountID = $_SESSION['account_id'];
$cName = $_SESSION['name'];

$customer = new C_ItemController();
$cart = new CartController();

$cAccountID = $_SESSION['account_id'];
$itemID = $_GET['itemID'];

$data = $customer->viewSpecific($itemID);

if(isset($_POST['add_btn'])){
  $cart->addCart();
}

if(isset($_POST['update_btn'])){
  $cart->modifyQuantity();
}

?>

<html>
  <head>
    <title>Item Detail</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Online Notice Board User Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>View Item</title>
    <style>
      table, td, tr{
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <!-- navigation bar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">
        <li><a href="C_Home.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>
        <li><a href=""><span class="glyphicon glyphicon-map-marker"></span> Track Delivery</a></li>
        <li><a href=""><span class="glyphicon glyphicon-list-alt"></span> Purchase History</a></li>
        <li><a href="paymentpage.php"><span class="glyphicon glyphicon-credit-card"></span> Payment Method</a></li>
        <li><a href="C_Home.php?page=cart"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$cName?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="C_Login.php" onclick="alertMsg()">Logout</a></li>
          </ul>
        </li>
      </ul>

      <script>
        function alertMsg(){
          alert("Logout Successful");
        }
      </script>

    </div>
  </nav>
  <br><br><br><br>
  <!-- end of navigation bar -->
  <div class="container-fluid">
     <div class="row">
	   <div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
            <li class="active"><a>Type of Service</a></li>
            <li><a href="C_Home.php?page=fsp">Food</a></li>
            <li><a href="C_Home.php?page=gsp">Good</a></li>
            <li><a href="C_Home.php?page=msp">Medical</a></li>
            <li><a href="C_Home.php?page=psp">Pet Assist</a></li> 
            <li><a href="C_Home.php?page=asp">All</a></li>  			
	</ul>
	</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <?php //include page based on selected navigation bar
    @$page=$_GET['page'];
    
    if($page!=NULL){

      if($page=="cart"){
        include('ViewCart.php');
      }else if($page=="fsp"){
        $type="Food";
        include('ViewType.php');
      }else if($page=="gsp"){
        $type="Good";
        include('ViewType.php');
      }else if($page=="msp"){
        $type="Medical";
        include('ViewType.php');
      }else if($page=="psp"){
        $type="Pet Assist";
        include('ViewType.php');
      }else if($page=="asp"){
        include('ViewAllType.php');
      }else{
        include('ViewItem.php?');
      }
    }
    else{
    ?>




    <?php
    }
    ?>
	</div>
	</div>
	</div>
	    
    <center>

        <table>

          <tr>
            <td colspan="2">View Item</td>
          </tr>
          <?php
          foreach($data as $row){

          echo
          "<tr>
            <td>Item ID</td>
            <td>".$row['item_id']."</td>
          </tr>

          <tr>
            <td>Item Name</td>
            <td>".$row['item_name']."</td>
          </tr>

          <tr>
            <td>Item Type</td>
            <td>".$row['item_type']."</td>
          </tr>

          <tr>
            <td>Item Detail</td>
            <td>".$row['item_detail']."</td>
          </tr>

          <tr>
            <td>Item Price (RM)</td>
            <td>".$row['item_price']."</td>
          </tr>

          <tr>
            <td>Item Status</td>
            <td>".$row['item_status']."</td>
          </tr>";

          }
          
          ?>
        </table>
        <br>
        <form action="" method="POST">
        <input type="hidden" name="cAccountID" value="<?=$cAccountID?>">
        <input type="hidden" name="itemID" value="<?=$itemID?>">
        <table>

          <?php
          $amount = $cart->checkCart($itemID);

          echo "<tr>
            <td>Item Quantity</td>
            <td>
              <input type=\"number\" name=\"quantity\" value=".$amount.">
            </td>
          </tr>";

          if($amount>0){

          echo "<tr>
            <td colspan=\"3\"><center><input type=\"submit\" name=\"update_btn\" value=\"Update Quantity\"></center></td>
          </tr>";

          }else{

          echo "<tr>
            <td colspan=\"3\"><center><input type=\"submit\" name=\"add_btn\" value=\"Add Item\"></center></td>
          </tr>";

          }
          ?>
        </form>
        </table>

        <br><button onclick="window.close()">Close</button>
          


    </center>
  </body>
</html>

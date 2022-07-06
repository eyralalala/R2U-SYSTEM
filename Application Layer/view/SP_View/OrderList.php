<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_MenuController.php';

$provider = new SP_MenuController();

session_start();
$spAccountID = $_SESSION['account_id'];
$status = $_SESSION['status'];
if($status=="Pending"||$status=="Rejected")
  echo "<script>window.location = 'Notice.php';</script>";

$orderData = $provider->viewOrder();

?>

<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    th, td{
      padding: 10px;
    }
    input, select{
      width:260px;
    }
  </style>
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">
        <li><a href="SP_Home.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>
        <li><a href="Add.php"><span class="glyphicon glyphicon-plus"></span> Add New Product</a></li>
        <li><a href="OrderList.php"><span class="glyphicon glyphicon-list-alt"></span> Check Order</a></li>
        <li><a href=""><span class="glyphicon glyphicon-list-alt"></span> Record</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$spAccountID?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="SP_Login.php" onclick="alertMsg()">Logout</a></li>
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
  <br><br><br>
  <!-- end of navigation bar -->

    <center><h2>Order List</h2><br>
      <br>

        <table border="1px solid black">
          <tr>
            <td>Order ID</td>
            <td>Product ID</td>
            <td>Item Name</td>
            <td>Quantity</td>
          </tr>
          <?php
          foreach ($orderData as $row){
            echo "<tr>
            <td>".$row['order_id']."</td>
            <td>".$row['item_id']."</td>
            <td>".$row['item_name']."</td>
            <td>".$row['quantity']."</td>
          </tr>";
          }
          
          ?>
          </tr>
        </table>
    </center>
    <!-- footer -->
  <nav class="navbar navbar-default navbar-fixed-bottom" style="background:black">
    <ul class="nav navbar-nav navbar-left">
      <li><a> Developed by ASPIRE Sdn Bhd</a></li>
    </ul>
  </nav>
  <!-- end of footer -->
  </body>
</html>

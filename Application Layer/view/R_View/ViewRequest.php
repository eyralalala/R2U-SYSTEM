<?php
require_once '../../../Business Services Layer/controller/R_Controller/RequestController.php';

$request = new RequestController();

session_start();
$rAccountID = $_SESSION['account_id'];

$order_id = $_GET['orderID'];
$spID = $_GET['spID'];
$info = $request->orderInfo($order_id);
$items = $request->orderedItem($order_id, $spID);

if(isset($_POST['accept_btn'])){
  $request->confirmDelivery();
}

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

    input, button{
      width: 80px;
    }
  </style>
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">
        <li><a href="R_Home.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>
        <li><a href="R_Home.php"><span class="glyphicon glyphicon-list-alt"></span> Request List</a></li>
        <li><a href="R_Report.php"><span class="glyphicon glyphicon-list-alt"></span> Record</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$rAccountID?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="R_Login.php" onclick="alertMsg()">Logout</a></li>
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
    <center><h2>Request Info</h2><br>

        <table>
          <?php
          foreach($info as $row){
          ?>

        <tr>
          <td>Order ID</td>
          <td><?=$row['order_id']?></td>
        </tr>

        <tr>
          <td>Service Provider</td>
          <td><?=$row['name']?></td>
        </tr>

        <tr>
          <td>Pickup Location</td>
          <td><?=$row['address']?></td>
        </tr>

        <tr>
          <td>Drop-off Location</td>
          <td><?=$row['dropoff_location']?></td>
        </tr>

         <tr>
            <td>Requested Item</td>
            <td>

              <table border="1px solid black">

            <?php
            }
            foreach ($items as $row){
            ?>
            
            <tr>
              <td><?=$row['item_name']?></td>
              <td><?=$row['quantity']?></td>
            </tr>
     
            <?php
            }
            ?>
              </table>
            </td>
          </tr>

        </table>

        <br>

        <form action="" method="POST">
          <input type="hidden" name="order_id" value="<?=$order_id?>">
          <button type="button" onclick="location.href='R_Home.php'">Back</button>&nbsp
          <input type="submit" name="accept_btn" value="Accept">
        </form>
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

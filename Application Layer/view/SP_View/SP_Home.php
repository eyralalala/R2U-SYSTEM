<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_MenuController.php';

$provider = new SP_MenuController();

session_start();
$spAccountID = $_SESSION['account_id'];
$status = $_SESSION['status'];
if($status=="Pending"||$status=="Rejected")
  echo "<script>window.location = 'Notice.php';</script>";

$data = $provider->viewAll();

$orderData = $provider->viewOrder();

if(isset($_POST['delete_btn'])){
  $provider->delete();
}

?>

<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    th, td {
      padding: 8px;
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

  <center><h2>Product List</h2><br>

      <table width="90%" border="1px solid black">
        <tr>
          <th>No.</th>
          <th>Item Name</th>
          <th>Price (RM)</th>
          <th>Action</th>
        </tr>

      <?php
        $i=0;
        foreach ($data as $row){
          $i++;
          echo "<tr>
          <td width=\"60px\">".$i."</td>

          <td>".$row['item_name']."</td>
          <td width=\"150px\">".$row['item_price']."</td>
            <td width=\"185px\">
              <form action=\"\" method=\"POST\">
                <input type=\"hidden\" name=\"itemID\" value=\"".$row['item_id']."\">
                <button type=\"button\" onclick=\"location.href='View.php?itemID=".$row['item_id']."'\">View</button>
                <button type=\"button\" onclick=\"location.href='Edit.php?itemID=".$row['item_id']."'\">Edit</button>
                <button type=\"submit\" name=\"delete_btn\" onclick=\"return confirmDelete()\">Delete</button>
              </form>
              <script>
                function confirmDelete(){
                  if(confirm(\"Confirm Delete?\"))
                    return true;
    
                  return false;
                }
              </script>
            </td>
          </tr>";
          }
          
          ?>

        
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

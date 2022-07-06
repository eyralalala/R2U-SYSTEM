<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_MenuController.php';

$provider = new SP_MenuController();

if(isset($_POST['add_btn'])){
  $provider->viewSpecific();
}

if(isset($_POST['delete_btn'])){
  $provider->delete();
}

session_start();
$spAccountID = $_SESSION['account_id'];
$itemID = $_GET['itemID'];
$filepath = "../../../Application Layer/view/Upload/SP_Item/".$itemID.".jpg";
$data = $provider->viewSpecific($itemID);

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
    <center><h2>View Product Detail</h2><br>

      <form action="" method="POST">
        <input type="hidden" name="spAccountID" value="<?=$spAccountID?>">
        <table>

          <?php
          foreach($data as $row){
          ?>
          
          <tr>
            <td>Item ID</td>
            <td><?=$row['item_id']?></td>
          </tr>

          <tr>
            <td>Item Name</td>
            <td><?=$row['item_name']?></td>
          </tr>

          <tr>
          <td>Item Image</td>
          <td><img src="<?php echo $filepath; ?>" height=100 width=100 style="object-fit: cover;"></td>
          </tr>

          <tr>
            <td>Item Type</td>
            <td><?=$row['item_type']?></td>
          </tr>

          <tr>
            <td>Item Detail</td>
            <td><?=$row['item_detail']?></td>
          </tr>

          <tr>
            <td>Item Price (RM)</td>
            <td><?=$row['item_price']?></td>
          </tr>

          <tr>
            <td>Item Status</td>
            <td><?=$row['item_status']?></td>
          </tr>

          <?php
          }
          ?>
        </table>
        </form><br>

        
        <form action="" method="POST">
          <input type="hidden" name="itemID" value="<?=$itemID?>">
          <button type="button" style="width:100px" onclick="location.href='SP_Home.php'">Home</button>
          <button type="button" style="width:100px" onclick="location.href='Edit.php?itemID=<?=$itemID?>'">Edit</button>
          <button style="width:100px" type="submit" name="delete_btn" onclick="return confirmDelete()">Delete</button>
        </form>
        <script>
          function confirmDelete(){
            if(confirm("Confirm Delete?"))
              return true;
    
              return false;
          }
              </script>
    </center>
    <nav class="navbar navbar-default navbar-fixed-bottom" style="background:black">
    <ul class="nav navbar-nav navbar-left">
      <li><a> Developed by ASPIRE Sdn Bhd</a></li>
  </body>
</html>

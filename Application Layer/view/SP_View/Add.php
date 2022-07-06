<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_MenuController.php';

$provider = new SP_MenuController();

if(isset($_POST['add_btn'])){
  $provider->addItem();
}

session_start();
$spAccountID = $_SESSION['account_id'];

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

    <center><h2>Add New Product</h2>

      <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="spAccountID" value="<?=$spAccountID?>">
        <table>

          <tr>
            <td>Item Name</td>
            <td><input type="text" name="itemName"></td>
          </tr>

          <tr>
            <td>Item Image</td>
            <td>
              <img id="uploadPreview" style="width: 100px; height: 100px; object-fit: cover;"><br><br>

              <input id="uploadImage" type="file" name="file" onchange="PreviewImage();" required>

              <script>
                function PreviewImage() {
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                  oFReader.onload = function (oFREvent) {
                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                  };
                };
              </script>
            </td>
          </tr>

          <tr>
            <td>Item Type</td>
            <td>
              <select name="itemType" required>
                <option value="" hidden>- Choose Type -</option>
                <option value="Food">Food</option>
                <option value="Good">Good</option>
                <option value="Pet Assist">Pet Assist</option>
                <option value="Medical">Medical</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>Item Detail</td>
            <td><textarea name="itemDetail" rows="5" cols="30"></textarea></td>
          </tr>

          <tr>
            <td>Item Price (RM)</td>
            <td>
              <input type="number" name="itemPrice"><!--remember to change to float-->
            </td>
          </tr>

          <tr>
            <td>Item Status</td>
            <td>
              <select name="itemStatus" required>
                <option value="Available">Available</option>
                <option value="Coming Soon">Coming Soon</option>
                <option value="Out of Stock">Out of Stock</option>
              </select>
            </td>
          </tr>
        </table><br>

        <input style="width: 100px" type="submit" name="add_btn" value="Add Item">
       
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

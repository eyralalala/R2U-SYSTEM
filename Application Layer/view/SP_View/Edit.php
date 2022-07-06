<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_MenuController.php';

$provider = new SP_MenuController();

if(isset($_POST['update_btn'])){
  $provider->modifyItem();
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
  <br><br>
  <!-- end of navigation bar -->

    <center><h2>Edit Product</h2>

      <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="spAccountID" value="<?=$spAccountID?>">
        <input type="hidden" name="itemID" value="<?=$itemID?>">
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
            <td><input type="text" name="itemName" value="<?=$row['item_name']?>"></td>
          </tr>

          <tr>
            <td>Item Image</td>
            <td>
              <img id="uploadPreview" src="<?php echo $filepath; ?>" height=100 width=100 style="object-fit: cover;">
              <input id="uploadImage" type="file" name="file" onchange="PreviewImage();" />

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
                <option value="Food" <?php if($row['item_type']=='Food') echo "selected";?>>Food</option>
                <option value="Good" <?php if($row['item_type']=='Good') echo "selected";?>>Good</option>
                <option value="Pet Assist" <?php if($row['item_type']=='Pet Assist') echo "selected";?>>Pet Assist</option>
                <option value="Medical" <?php if($row['item_type']=='Medical') echo "selected";?>>Medical</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>Item Detail</td>
            <td><textarea name="itemDetail" rows="5" cols="30" id="itemDetail"></textarea></td>
            <script>
              document.getElementById("itemDetail").value = "<?=$row['item_detail']?>";
            </script>
          </tr>

          <tr>
            <td>Item Price (RM)</td>
            <td>
              <input type="number" name="itemPrice" value="<?=$row['item_price']?>">
            </td>
          </tr>

          <tr>
            <td>Item Status</td>
            <td>
              <select name="itemStatus" required>
                <option value="Available" <?php if($row['item_status']=='Available') echo "selected";?>>Available</option>
                <option value="Coming Soon" <?php if($row['item_status']=='Coming Soon') echo "selected";?>>Coming Soon</option>
                <option value="Out of Stock" <?php if($row['item_status']=='Out of Stock') echo "selected";?>>Out of Stock</option>
              </select>
            </td>
          </tr>

          <?php
          }
          ?>

          </form>
        </table><br>
        <input style="width: 100px" type="submit" name="update_btn" value="Update">
    </center>
    <nav class="navbar navbar-default navbar-fixed-bottom" style="background:black">
    <ul class="nav navbar-nav navbar-left">
      <li><a> Developed by ASPIRE Sdn Bhd</a></li>
    </ul>
  </nav>
  </body>
</html>
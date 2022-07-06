<?php

session_start();
$cAccountID = $_SESSION['account_id'];
$cName = $_SESSION['name'];

if($cAccountID==NULL){
  $message = "INVALID!!";
  echo "<script type='text/javascript'>alert('$message');
  window.location = 'C_Login.php';</script>";
}
?>

<html>
  <head>
    <title>Successfully place order!</title>
    <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>

</head>



  <body>
     <!-- navigation bar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">
        <li><a href="C_Home.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>
        <li><a href="C_Home.php?=report"><span class="glyphicon glyphicon-map-marker"></span> Track Delivery</a></li>
        <li><a href="C_Home.php?=track"><span class="glyphicon glyphicon-list-alt"></span> Purchase History</a></li>
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
  	
    <!--<center><br>
      <span class="iconify" data-icon="emojione-v1:smiling-face-with-heart-eyes" data-height="75"data-inline="false"></span>
      <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script><span class="iconify" data-icon="emojione-v1:raising-hands" data-height="50" data-inline="false"></span>

    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <br><br><br>
    	<h2>Thank you for ordering with us, we'll contact you by email with your order details. </h2><br>
    		<h2>Kindly wait for our delivery partner to deliver your parcel  </h2><br>
     
    </center> -->

    <!--new code-->

    <!DOCTYPE html>

<html>
<head>
  <title></title>

  <h1>Cash On Delivery Form</h1>
<p>Note: This note is for COD purpose<br>
</p>

<p><label>First Name
<span class="small">Add your first name</span>
</label>
<input type="text" name="fname" id="name" /><br></p>

<p><label>Last Name
<span class="small">Add your last name</span>
</label>
<input type="text" name="lname" id="name" /><br></p>

<p><label>Contact No.
<span class="small">Add your Contact number</span>
</label>
<input type="text" name="cnum" id="name" /><br></p>

<p><label>Email
<span class="small">Add a valid address</span>
</label>
<input type="text" name="email" id="email" /><br></p>

<p><label>Address
<span class="small">permanent address</span>
</label>
<input type="text" name="paddress" id="name" /><br></p>
<p><label>City
<input type="text" name="city" id="name" /></label><br></p>

<p><label for="Delivery">Delivery address is same as billing</label><br><br>
  <input type="submit" value="Submit"><br></p>

<!--<input type="submit" value="Confirm" style="margin-left: 150px;">
<div class="spacer"></div>-->

</form>
</div>
</head>
<body>

</body>
</html>

    <!--end of new code-->
    <!-- footer -->
  <nav class="navbar navbar-default navbar-fixed-bottom" style="background:black">
    <ul class="nav navbar-nav navbar-left">
      <li><a> Developed by ASPIRE Sdn Bhd</a></li>
    </ul>
  </nav>
  <!-- end of footer -->
  </body>
</html>
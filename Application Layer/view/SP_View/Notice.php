<?php
session_start();
$spAccountID = $_SESSION['account_id'];
$status = $_SESSION['status'];

?>

<html>
  <head>
    <title>Application Status</title>
  </head>
  <body>
    <center><br><br>
    <h3>
      <?php if($status=="Pending") echo "Your application is being processed. Please check back later."; ?>
      <?php if($status=="Rejected") echo "Your application is rejected. This account will be deleted after 14 days.<br>Please try to register again after that"; ?>
    <h3>
    <br><br>
     <input type="button" value="Logout" onclick="alertMsg()">
      <script>
        function alertMsg(){
          alert("Logout Successful");
          location.href='SP_Login.php';
        }
      </script>
    </center>
  </body>
</html>

<?php
$setting=NULL;
require_once '../../../Business Services Layer/controller/A_Controller/A_AccountController.php';

$admin = new A_AccountController();

if(isset($_POST['login_btn'])){
  $admin->A_AccountLogin();
}

?>
<html>

<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    .box{
      border-radius: 25px;
      width: 400px;
      border: 1px solid black;
      padding: 30px;
      margin: 70px;
    }
  </style>
</head>

<body>

<!-- navigation bar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">

        <li><a href="../../../index.php"><strong>RUNNER 2 YOU</strong></a></li>

      </ul>

    </div>
  </nav>
  <br><br><br>
  <!-- end of navigation bar -->

    <center>
      <div class="box">
      <h2>Login as Admin</h2><br>

      <form action="" method="POST">
        
        <table>
          <tr>
            <td width="80px">Email<br><br></td>
            <td><input type="text" name="adminEmail" required><br><br></td>
          </tr>

          <tr>
            <td>Password <br><br></td>
            <td><input type="password" name="adminPassword" required minlength="8" maxlength="15"><br><br></td>
          </tr>

          <tr>
            <td colspan="2" style="text-align: center"><br><input type="submit" name="login_btn" value="Login"></td>
          </tr>

        </table>

      </form>

      </div>
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

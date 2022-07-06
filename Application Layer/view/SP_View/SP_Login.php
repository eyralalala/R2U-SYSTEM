<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_AccountController.php';

$provider = new SP_AccountController();

if(isset($_POST['login_btn'])){
  $provider->SP_AccountLogin();
}

?>
<html>

<head>
  <title>Service Provider Login</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    .box{
      border-radius: 25px;
      width: 420px;
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
        <li><a href="../../../index.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="SP_Registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li class="active"><a href="SP_Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>

    </div>
  </nav>
  <br><br><br>
  <!-- end of navigation bar -->

  <center>

    <div class="box">

      <h2>Service Provider Login</h2><br>

      <form action="" method="POST">

      <table>
            
        <tr>
          <td width="80px">Email<br><br></td>
          <td><input type="text" name="provEmail" required><br><br></td>
        </tr>

        <tr>
          <td>Password<br><br></td>
          <td><input type="password" name="provPassword" required><br><br></td>
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

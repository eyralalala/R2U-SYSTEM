<?php
require_once '../../../Business Services Layer/controller/C_Controller/C_AccountController.php';

$customer = new C_AccountController();

if(isset($_POST['register_btn'])){
  $exist = $customer->C_Registration();
}

?>
<html>
<head>
  <title>Customer Registration</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    .box{
      border-radius: 25px;
      width: 450px;
      border: 1px solid black;
      padding: 20px;
      margin: 30px;
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
        <li class="active"><a href="C_Registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li><a href="C_Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>

    </div>
  </nav>
  <br><br><br>
  <!-- end of navigation bar -->

  <center>

    <div class="box">

      <h2>Customer Registration</h2><br>

      <form action="" method="POST" onsubmit="return verifyPassword()">
        <script>
          function verifyPassword(){
            $password1 = document.getElementById("pw1").value;
            $password2 = document.getElementById("pw2").value;

            if($password1 == $password2)
              return true;
            else {
              document.getElementById("ifDiff").innerHTML = "password not match!";
              return false;
            }
          }
        </script>

        <table>

          <tr>
            <td width="150px">Full Name<br><br></td>
            <td width="185px"><input type="text" name="custName" value="<?php echo isset($_POST['custName']) ? htmlspecialchars($_POST['custName'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>
            
          <tr>
            <td>Phone No.<br><br></td>
            <td><input type="text" name="custPhone" value="<?php echo isset($_POST['custPhone']) ? htmlspecialchars($_POST['custPhone'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td>Email<br></td>
            <td><input type="email" name="custEmail" value="<?php echo isset($_POST['custEmail']) ? htmlspecialchars($_POST['custEmail'], ENT_QUOTES) : ''; ?>" required><br></td>
          </tr>

          <tr>
            <td></td>
            <td><font color='red'><p id="msg"><br></p></font></td>
          </tr>

          <script>
            if(<?=$exist?>==true){
              document.getElementById("msg").innerHTML = "This email has been used";
            }
          </script>

          <tr>
            <td>Set Password<br><br></td>
            <td><input type="password" id = "pw1" name="accPassword" placeholder="8 to 15 characters" minlength="8" maxlength="15" value="<?php echo isset($_POST['accPassword']) ? htmlspecialchars($_POST['accPassword'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td>Reenter Password<br><br></td>
            <td><input type="password" id = "pw2" name="verify" minlength="8" maxlength="15" value="<?php echo isset($_POST['accPassword']) ? htmlspecialchars($_POST['accPassword'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td></td>
            <td><font color='red'><p id="ifDiff"><br></p></font></td>
          </tr>

          <tr>
            <td colspan="2" style="text-align: center"><br><input type="submit" name="register_btn" value="Register"></td>
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
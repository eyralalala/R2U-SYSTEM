<?php
require_once '../../../Business Services Layer/controller/SP_Controller/SP_AccountController.php';

$provider = new SP_AccountController();

if(isset($_POST['register_btn'])){
  $exist = $provider->SP_Registration();
}

?>
<html>
<head>
  <title>Service Provider Registration</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <style>
    
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
        <li class="active"><a href="SP_Registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li><a href="SP_Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>

    </div>
  </nav>
  <br><br><br>
  <!-- end of navigation bar -->

  <center>
      
    <div class="box">

      <h2>Service Provider Registration</h2><br><br>

      <form action="" method="POST" onsubmit="return verifyPassword()" enctype="multipart/form-data">

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

        <table >

          <tr>
            <td style="padding-left: 10px">Logo:<br><br></td>
            <td width="150px">Company Name<br><br></td>
            <td width="185px"><input type="text" name="provName" value="<?php echo isset($_POST['provName']) ? htmlspecialchars($_POST['provName'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td style="padding-left: 10px" rowspan="4"><!--image preview and upload-->
              <img id="uploadPreview" style="width: 100px; height: 100px; object-fit: cover;"><br><br>

              <input id="uploadImage" type="file" name="logo" onchange="PreviewImage();" required>

              <script>
                function PreviewImage() {
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                  oFReader.onload = function (oFREvent) {
                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                  };
                };
              </script>
            </td><!--end image preview and uplaod-->

            <td>SSM No.<br><br></td>
            <td><input type="text" name="ssm" value="<?php echo isset($_POST['ssm']) ? htmlspecialchars($_POST['ssm'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td>Address<br><br></td>
            <td><input type="text" name="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td>Contact<br><br></td>
            <td><input type="text" name="provContact" value="<?php echo isset($_POST['provContact']) ? htmlspecialchars($_POST['provContact'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td>Company Email<br></td>
            <td>
              <input type="email" name="provEmail" value="<?php echo isset($_POST['provEmail']) ? htmlspecialchars($_POST['provEmail'], ENT_QUOTES) : ''; ?>" required><br>
            </td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td><font color='red'><p id="msg"><br></p></font></td>
          </tr>

          <script>
            if(<?=$exist?>==true){
              document.getElementById("msg").innerHTML = "This email has been used";
            }
          </script>

          <tr>
            <td></td>
            <td>Set Password<br><br></td>
            <td><input type="password" id = "pw1" name="accPassword" placeholder="8 to 15 characters" minlength="8" maxlength="15" value="<?php echo isset($_POST['accPassword']) ? htmlspecialchars($_POST['accPassword'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td></td>
            <td>Reenter Password<br><br></td>
            <td><input type="password" id = "pw2" name="verify" minlength="8" maxlength="15" value="<?php echo isset($_POST['accPassword']) ? htmlspecialchars($_POST['accPassword'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td><font color='red'><p id="ifDiff"><br></p></font></td>
          </tr>

          <tr>
            <td colspan="3" style="text-align: center"><br><input type="submit" name="register_btn" value="Register"></td>
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
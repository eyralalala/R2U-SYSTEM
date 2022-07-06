<?php
require_once '../../../Business Services Layer/controller/A_Controller/A_AccountController.php';

$admin = new A_AccountController();

if(isset($_POST['add_btn'])){
  $exist = $admin->addAdmin();
}

?>
<html>
<head>
  <title>Add Admin</title>
  <style>
    .box{
      border-radius: 25px;
      width: 480px;
      border: 1px solid black;
      padding: 20px;
      margin: 30px;
    }
  </style>
</head>
<body>

  <center>

    <div class="box">

      <h2>Add New Sub Admin</h2><br><br>

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
            <td width="150px">Phone No.<br><br></td>
            <td width="185"><input type="text" name="adminPhone" value="<?php echo isset($_POST['adminPhone']) ? htmlspecialchars($_POST['adminPhone'], ENT_QUOTES) : ''; ?>" required><br><br></td>
          </tr>

          <tr>
            <td>Email<br></td>
            <td><input type="email" name="adminEmail" value="<?php echo isset($_POST['adminEmail']) ? htmlspecialchars($_POST['adminEmail'], ENT_QUOTES) : ''; ?>" required><br></td>
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
            <td colspan="2" style="text-align: center"><br><input type="submit" name="add_btn" value="Add Account"></td>
          </tr>

        </table>

      </form>
    </div>
  </center>
</body>
</html>
<?php
require_once '../../../Business Services Layer/controller/A_Controller/UserController.php';

$admin = new UserController();

$data = $admin->viewApplication($id, $type);

$currentpage = $_GET['currentpage'];

if(isset($_POST['reject_btn'])){
  $admin->changeStatus("Rejected");
}

if(isset($_POST['accept_btn'])){
  $admin->changeStatus("Active");
}

?>

<html>
<head>
  <title>Application</title>
  <style>
    th, td {
      padding: 8px;
    }
  </style>
</head>
<body>
  <center>
    <h2><?=$type?> Applicant Info</h2><br><br>
    <table border="1px solid black">
    <?php
      foreach($data as $row){
        //image folder and name
        if($type=="Runner"){
          $y="r";
          $folder="R_Profile";
          $img = $row['profile_pic'];
        } else {
          $y="sp";
          $folder="SP_Logo";
          $img = $row['logo'];
        }


//end image part
        $imageURL="../Upload/".$folder."/".$img;
    ?>
      <tr>
        <td rowspan="5" width="140px" style="text-align: center">
          <img src="<?= $imageURL; ?>" style="width:100; height:100;  object-fit: cover;">
        </td>
        <td>ID</td>
        <td>: <?=$row['account_id']?></td>
      </tr>

      <tr>
        <td>Name</td>
        <td>: <?=$row['name']?></td>
      </tr>

      <tr>
        <td>Contact No.</td>
        <td>: <?=$row['contact_no']?></td>
      </tr>

      <tr>
        <td>Email</td>
        <td>: <?=$row['email']?></td>
      </tr>

      <?php
      if($type=="Service Provider"){
        echo "<tr>
          <td>SSM</td>
          <td>: ".$row['ssmNo']."</td>
        </tr>
        </table>";
      }else {
        echo "<tr>
          <td>IC</td>
          <td>: ".$row['ic']."</td>
        </tr>
        
        <tr style=\"text-align: center\">
          <td colspan=\"3\"><img src=\"../Upload/R_License/".$row['license']."\" style=\"width:200; height:200;  object-fit: cover;\"></td>
        </tr>
        </table>";
      }
      ?>
    <br>

    <table>
      <tr>
        <td style="text-align: center">
        <input type="button" onclick="location.href='A_Home.php?page=<?=$y?>Application&currentpage=<?=$currentpage?>'" value="Back" >

        <form action="" method="POST">
          <input type="hidden" name="account_id" value="<?=$row['account_id']?>">
          <input type="hidden" name="type" value="<?=$type?>">
          <input type="hidden" name="y" value="<?=$y?>">
          <input type="hidden" name="currentpage" value="<?=$currentpage?>">
          <td><input type="submit" name="reject_btn" value="Reject"></td>
          <td><input type="submit" name="accept_btn" value="Accept"></td>
        </form>
        </td>
      </tr>
    <?php
      }
    ?>
    </table>
  </center>
</body>
</html>

<?php
$setting="add";
require_once '../../../Business Services Layer/controller/A_Controller/UserController.php';

$admin = new UserController();
$data = $admin->getTotalUser();
foreach($data as $row){
  $a=$row['a'];
  $b=$row['b'];
  $c=$row['c'];
  $d=$row['d'];
}

session_start();
$AdminAccountID = $_SESSION['account_id'];

?>

<html>

<head>
  <title>Homepage</title>
  <link rel="stylesheet" href="../../../css/bootstrap.css">
  <script src="../../../js/jquery_library.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
</head>

<body>
  <!-- navigation bar -->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">
        <li><a href="A_Home.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-list-alt"></span> Runner
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="A_Home.php?page=rList&currentpage=1">View Runner List</a></li>
            <li><a href="A_Home.php?page=rApplication&currentpage=1">View Runner Application</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-list-alt"></span> Service Provider
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="A_Home.php?page=spList&currentpage=1">View Service Provider List</a></li>
            <li><a href="A_Home.php?page=spApplication&currentpage=1">View Service Provider Application</a></li>
          </ul>
        </li>
        
        <li><a href="A_Home.php?page=report"><span class="glyphicon glyphicon-list-alt"></span> Report</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$AdminAccountID?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
            if($AdminAccountID=="ADMIN000") 
              echo "<li ><a href=\"A_Home.php?page=addAdmin\">Add Admin Account</a></li>"; 
            ?>
            <li><a href="A_Login.php" onclick="alertMsg()">Logout</a></li>
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

  <?php //include page based on selected navigation bar
    @$page=$_GET['page'];
    
    if($page!=NULL){

      if($page=="rList"){
        $type = "Runner";
        include('UserList.php');

      }else if($page=="rApplication"){
        $type = "Runner";
        include('ApplicationList.php');

      }else if($page=="spList"){
        $type = "Service Provider";
        include('UserList.php');

      }else if($page=="spApplication"){
        $type = "Service Provider";
        include('ApplicationList.php');

      }else if($page=="sp_a_info"){
        $id = $_GET['id'];
        $type = "Service Provider";
        include('ViewApplicant.php');

      }else if($page=="r_a_info"){
        $id = $_GET['id'];
        $type = "Runner";
        include('ViewApplicant.php');

      }else if($page=="sp_info"){
        $id = $_GET['id'];
        $type = "Service Provider";
        include('ViewUser.php');
        
      }else if($page=="r_info"){
        $id = $_GET['id'];
        $type = "Runner";
        include('ViewUser.php');
        
      }else if($page=="addAdmin"){
        include('AddAdminAcc.php');

      }else if($page=="report"){
        include('A_Report.php');
      }

    }
    else{
    ?>

    <center>
      <h2>Welcome <?=$AdminAccountID?></h2><br><br><br>

      <b>There are currently <?=$a?> Runner and <?=$b?> Service Provider registered in R2U.</b><br><br><br>

      <button style="width: 300px" onclick="location.href='A_Home.php?page=rList&currentpage=1'">
        <b>Check Active Runner List</b>
      </button><br><br><br>

      <button style="width: 300px" onclick="location.href='A_Home.php?page=spList&currentpage=1'">
        <b>Check Active Service Provider List</b>
      </button><br><br>

      <?php if($c>0) echo "<font color='red'>".$c." new application from Runner</font><br>"; else echo"<br>"?>
      <button style="width: 300px" onclick="location.href='A_Home.php?page=rApplication&currentpage=1'">
        <b>Check Runner Application Now</b>
      </button>

      <br><br>

      <?php if($d>0) echo "<font color='red'><?=$d?> new application from Service Provider</font><br>"; else echo"<br>"?>
      <button style="width: 300px" onclick="location.href='A_Home.php?page=spApplication&currentpage=1'">
        <b>Check Service Provider Application Now</b>
      </button>

    </center>

    <?php
    }
    ?>

    <!-- footer -->
  <nav class="navbar navbar-default navbar-fixed-bottom" style="background:black">
    <ul class="nav navbar-nav navbar-left">
      <li><a> Developed by ASPIRE Sdn Bhd</a></li>
    </ul>
  </nav>
  <!-- end of footer -->
</body>
</html>
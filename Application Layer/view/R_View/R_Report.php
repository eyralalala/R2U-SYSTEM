<?php
require_once '../../../Business Services Layer/controller/R_Controller/R_TrackingController.php';

$report = new R_TrackingController();

session_start();
$rAccountID = $_SESSION['account_id'];
$data = $report->viewAllReport($rAccountID);

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
    input{
      width:100;
    }
  </style>
</head>
<body>
  <!--navbar-->
  <nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
    <div class="container">

      <ul class="nav navbar-nav navbar-left">
        <li><a href="R_Home.php" style="width:200px"><strong>RUNNER 2 YOU</strong></a></li>
        <li><a href="R_Home.php"><span class="glyphicon glyphicon-list-alt"></span> Request List</a></li>
        <li><a href="R_Report.php"><span class="glyphicon glyphicon-list-alt"></span> Record</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$rAccountID?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="R_Login.php" onclick="alertMsg()">Logout</a></li>
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

    <center><h2>Record</h2><br>

        <table id="table1" border="1px solid black">

          <tr>
            <th>No.</th>
            <th>Service Provider</th>
            <th>Pickup Location</th>
            <th>Dropoff Location</th>
            <th>Date Completed</th>
          </tr>

          <?php
          $i=0;
          foreach ($data as $row){
            $i++;
            echo "<tr>
            <td>".$i."</td>
            <td>".$row['name']."</td>
            <td>".$row['address']."</td>
            <td>".$row['dropoff_location']."</td>
            <td>".$row['date']."</td>
          </tr>";
          }
          
          ?>
        </table>
    </center>
    <!-- footer -->
  <nav class="navbar navbar-default navbar-fixed-bottom" style="background:black">
    <ul class="nav navbar-nav navbar-left">
      <li><a> Developed by ASPIRE Sdn Bhd</a></li>
    </ul>
  </nav>
  <!-- end of footer -->
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

<?php
require_once '../../../Business Services Layer/controller/A_Controller/A_TrackingController.php';

$report = new A_TrackingController();


$aAccountID = $_SESSION['account_id'];
$data = $report->viewAllReport();

?>

<html>
<head>
  <title>Report</title>
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

    <center><h2>Record</h2><br>

        <table id="table1" border="1px solid black">

          <tr>
            <th>No.</th>
            <th>Runner</th>
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
            <td>".$report->runnerName($row['r_account_id'])."</td>
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

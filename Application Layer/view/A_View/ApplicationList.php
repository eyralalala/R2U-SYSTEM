<?php
require_once '../../../Business Services Layer/controller/A_Controller/UserController.php';

$admin = new UserController();

//page number setting
$rowlimit = 5;
$rows = $admin->getRows($type, "apply");
$totalpages = ceil($rows / $rowlimit);

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   $currentpage = (int) $_GET['currentpage'];
} else {
   $currentpage = 1;
}

if ($currentpage > $totalpages) {
   $currentpage = $totalpages;
}
if ($currentpage < 1) {
   $currentpage = 1;
}

$offset = ($currentpage - 1) * $rowlimit;
//end page number setting

$data = $admin->viewAllApplication($type, $offset, $rowlimit);

if($type=="Runner")
  $y = "r";
else $y = "sp";

?>

<html>
<head>
<title>Application List</title>
<style>

th, td {
  padding: 8px;
}

th{
  text-align: center;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 6px 10px;
  text-decoration: none;
  border: 1px solid #ddd;
  font-size: 13px;
}
.pagination a.active {
  background-color: #008CBA;
  color: white;
  border: 1px solid #008CBA;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:enabled_a {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  width: 40px;
  text-align: center;
}

.pagination a:enabled_b {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  width: 40px;
  text-align: center;
}

.pagination a.disabled {
  cursor: not-allowed;
  pointer-events: none;
  .opacity(.65);
  .box-shadow(none);
  color:#ddd;
}

.bottom{
  position: absolute;
  bottom:40px;
  width: 100%;
}
</style>
</head>
  <body>
    <center>
      <h2><?=$type?> Application List</h2>

      <table width="90%">
        <tr>
          <td>
            <input type="button" onclick="location.href='A_Home.php'" value="Back">
          </td>
        </tr>
      </table>

      <br>

      <table width="90%" border="1px solid black">

        <tr>
          <th width="25px">No.</th>
          <th>Name</th>
          <th width="200px">Date Applied</th>
          <th width="100px">Action</th>
        </tr>

      <?php
        $i=0;
        foreach($data as $row){
          $i++;
          echo "<tr>
          <td>".$i."</td>
          <td>".$row['name']."</td>
          <td></td>";
      ?>
          <td style="text-align: center;">
            <input type="button" onclick="location.href='A_Home.php?page=<?=$y?>_a_info&currentpage=<?=$currentpage?>&id=<?=$row['account_id']?>'" value="View">
          </td>

      <?php
        }
      ?>

      </table>

    <div class="bottom">
    <table width="90%">
      <tr>
        <td>

    <?php
    //page number
      if ($rows == 0) {

        echo "No Result Found<br><br>";

      } else {

        echo "Showing ".($offset+1)." to ";

        if (($offset+$rowlimit) <= $rows) {
          echo $offset+$rowlimit;
        } else echo $offset+$rows%$rowlimit;

        echo " from ".$rows;
        echo "</td>";
        
        echo "<td style=\"text-align: right\">
        <div class=\"pagination\">";
        $page_status_a="disabled";
        $prevpage=0;

        if ($currentpage > 1) {
            $page_status_a="enabled_a";
            $prevpage = $currentpage - 1;
        }
        echo " <a class=\"$page_status_a\" href='{$_SERVER['PHP_SELF']}?page=".$y."Application&currentpage=1'>First</a> ";
        echo " <a class=\"$page_status_a\" class=\"disabled\" href='{$_SERVER['PHP_SELF']}?page=".$y."Application&currentpage=$prevpage'>Prev</a> ";

        $range = 3;
        $total_range = $range*2+1;

        if ($totalpages <= $total_range) {
          for ($x=1; $x <= $totalpages; $x++) {
            if ($x == $currentpage) {
                echo " <a class=\"active\">$x</a> ";
              } else echo " <a href='{$_SERVER['PHP_SELF']}?page=".$y."Application&currentpage=$x'>$x</a> ";
            }
        }else {
          if ($currentpage < $range+1) {
            $x = 1;
            $i = $total_range;
          } else if ($currentpage > $totalpages-$range) {
            $x = $totalpages  - $total_range +1;
            $i = $x + $total_range - 1;
          } else {
            $x = $currentpage - $range;
            $i = $currentpage + $range;
          }

          for ($x; $x <= $i; $x++) {
            if (($x > 0) && ($x <= $totalpages)) {
                if ($x == $currentpage) {
                      echo " <a class=\"active\">$x</a> ";
                  } else echo " <a href='{$_SERVER['PHP_SELF']}?page=".$y."Application&currentpage=$x'>$x</a> ";
              }
          }
        }

          $page_status_b="disabled";
          $nextpage=0;

        if ($currentpage != $totalpages) {
          $page_status_b="enabled_b";
            $nextpage = $currentpage + 1;
        }
        echo " <a class=\"$page_status_b\" href='{$_SERVER['PHP_SELF']}?page=".$y."Application&currentpage=$nextpage'>Next</a> ";
        echo " <a class=\"$page_status_b\" href='{$_SERVER['PHP_SELF']}?page=".$y."Application&currentpage=$totalpages'>Last</a>
        </div>";
      }//end page number
    ?>
      </td>
      </tr>
    </table>
  </div>
    </center>
  </body>
</html>

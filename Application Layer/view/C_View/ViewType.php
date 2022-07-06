<?php
require_once '../../../Business Services Layer/controller/C_Controller/C_ItemController.php';

$customer = new C_ItemController();

$data = $customer->viewAllType($type);

?>

<html>
  <head>
    <title>List All Base on type</title>
    <style>

      table, td, tr, th{
        border: 1px solid black;
      }

      a.button {
        background-color: grey;
        border: none;
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <center></h2><br>
      <form action="" method="POST">

                <table>


          <tr>
            <td>Product No</td>
            <td>Product Name</td>
            <td>Price (RM)</td>
            <td>Action</td>
          </tr>
          <?php
          $i=0;
          foreach ($data as $row){
            $i++;
            echo "<tr>
            <td>".$i."</td>
            <td>".$row['item_name']."</td>
            <td>".$row['item_price']."</td>
            <td>
              <a href=\"ViewItem.php?itemID=".$row['item_id']."\" target=\"_blank\">View</a>
            </td>
          </tr>";
          }
          
          ?>
          

        </table>
         
       </form>

    </center>
  </body>
</html>

<?php 
include ("headfile.php"); 
?>
  <title>Update/Delete an Item</title>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h2 class="header center orange-text">Update/Delete an Item</h2>
        <div class="row center">
        </div>
    </div>
  </div>

  <div class="container">
    <script language="javascript" src="js/products.js" type="text/javascript"></script>
    <br>
    <div class="row">
      <div class="col s12 m12 l12">
        <div class="row">
          <?php
            //include a db.php file to connect to database
            include ("db.php");
            //create a new variable containing a SQL statement retrieving names of products from the product table
            $SQL1="SELECT * from ItemShop where shopName='".$_SESSION['shopName']."'";
            //Create a new variable containing the execution of the SQL query i.e. select the records or get out
            $result1=sqlsrv_query($conn,$SQL1) or die( print_r( sqlsrv_errors(), true));

            if($result1){
              echo "<form name='productForm' method='post' action=''>";
              echo "<table>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Select Product</th>";
              echo "<th>Product Name</th>";
              echo "<th>Tag 1</th>";
              echo "<th>Tag 2</th>";
              echo "<th>Tag 3</th>";
              echo "<th>Tag 4</th>";
              echo "<th>Tag 5</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              $i=0;
              while($row1 = sqlsrv_fetch_array($result1,SQLSRV_FETCH_ASSOC)) {
                $SQL2="select * from Item where ItemName='".$row1['itemName']."'";

                $result2=sqlsrv_query($conn,$SQL2) or die( print_r( sqlsrv_errors(), true));

                
                  $row2 = sqlsrv_fetch_array($result2,SQLSRV_FETCH_ASSOC) or die( print_r( sqlsrv_errors(), true));
                  if(!($row2==null)){
                    echo "<tr>";
                    echo "<td><input type='checkbox' id=".$i." name='items[]' value='".$row2["itemName"]."'>";
                    echo "<label for=".$i.">".($i+1)."</label></td>";
                    //echo "<td><input type='checkbox' name='items[]'' value=".$row2["itemName"]."></td>";
                    echo "<td>".$row2['itemName']."</td>";
                    echo "<td>".$row2['tag1']."</td>";
                    echo "<td>".$row2['tag2']."</td>";
                    echo "<td>".$row2['tag3']."</td>";
                    echo "<td>".$row2['tag4']."</td>";
                    echo "<td>".$row2['tag5']."</td>";
                    echo "</tr>";
                    $i++;
                }
              }
              echo "<thead>";
              echo "<tr>";
              echo "<td colspan='6'>";
                        
              echo "<button class='btn waves-effect waves-light' type='submit' name='update' value='Update' onClick='setUpdateAction();'>";
              echo "<i class='material-icons right'>send</i>Edit";
              echo "</button>&nbsp&nbsp";
              echo "<button class='btn waves-effect waves-light' type='submit' name='update' value='Update' onClick='setDeleteAction();'>";
              echo "<i class='material-icons right'>send</i>Delete";
              echo "</button>";
                        
                        /*
                        echo "<input type='button' name='update' value='Update' onClick='setUpdateAction();'/>";
                        echo "<input type='button' name='delete' value='Delete'  onClick='setDeleteAction();' />"; */
              echo "</td>";
              echo "</tr>";
              echo "</thead>";
              echo "</tbody>";
              echo "</table>";
              echo "</form>";
            }else{
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php include("footfile.html"); ?>
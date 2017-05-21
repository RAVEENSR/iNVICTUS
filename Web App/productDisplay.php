<script language="javascript" src="js/products.js" type="text/javascript"></script>
<div class="section">

        	<ul id="tabs-swipe-demo" class="tabs center">
    			<li class="tab col s4"><a class="active" href="#insert">Insert a Product</a></li>
    			<li class="tab col s4"><a href="#update">Update/Delete a Product</a></li>
  			</ul>
			<br>
  			<div id="insert" class="col s12">
  				<div class="row">
                <div class="col s12 m2 l2"></div>
                <div class="col s12 m8 l8">
                    <div class="row"> 
                        <form class="col s12" action="insertProduct.php" method="post">

                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="name" type="text" class="validate" name="name" required> 
                              <label for="name">Product Name</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="image" type="text" class="validate" name="image" required> 
                              <label for="image">Image URL</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="tag1" type="text" class="validate" name="tag1" required> 
                              <label for="tag1">Tag Name 1</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="tag2" type="text" class="validate" name="tag2" required> 
                              <label for="tag2">Tag Name 2</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="tag3" type="text" class="validate" name="tag3" required> 
                              <label for="tag3">Tag Name 3</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="tag4" type="text" class="validate" name="tag4" required> 
                              <label for="tag4">Tag Name  4</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="tag5" type="text" class="validate" name="tag5" required> 
                              <label for="tag5">Tag Name 5</label>
                            </div>
                          </div>
                            <div class="row">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Insert Product
                                    <i class="material-icons right">send</i>
                                </button>
                                <button class="btn waves-effect waves-light" type="reset" name="reset">Reset
                                    <i class="material-icons right">clear_all</i>
                                </button>
                            </div>
        
                        </form>
                      </div>
                </div>
                <div class="col s12 m2 l2"></div>
            </div>
          </div>
          <div id="food" class="col s12">
          </div>
  			<div id="update" class="col s12">
  			<div class="row">
                <div class="col s12 m2 l2"></div>
                <div class="col s12 m8 l8">
                    <div class="row">
                    <?php
                      //include a db.php file to connect to database
                      include ("db.php");
                      //create a new variable containing a SQL statement retrieving names of products from the product table
                      $SQL1="SEELCT * from ItemShop where shopName='".$_SESSION['shopName']."'";

                      //Create a new variable containing the execution of the SQL query i.e. select the records or get out
                      $result1=sqlsrv_query($conn,$SQL1) or die (sqlsrv_error($conn));

                      if($result1){
                        // write message to the log file
                        $log->lwrite("Select Query Successfull : SEELCT * from ItemShop where shopName='".$_SESSION['shopName']."'");
                        
                        echo "<form name='productForm' method='post' action=''>";
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Select</th>";
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
                        /*
                        * Displaying items details which are relavent to the shop
                        */
                        while($row1 = sqlsrv_fetch_array($result1)) {

                          $SQL2="select * from Item where ItemName='" . $row1['itemName']. "'";

                          $result2=sqlsrv_query($conn,$SQL2) or die (sqlsrv_error($conn));

                          if($result2){
                            // write message to the log file
                            $log->lwrite("Select Query Successfull : select * from Item where ItemName='" . $row1['itemName']. "'");
                        
                            
                            $row2 = sqlsrv_fetch_array($result2);
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='items[]'' value=".$row2["itemName"]."></td>";
                            echo "<td>".$row['itemName']."</td>";
                            echo "<td>".$row['tag1']."</td>";
                            echo "<td>".$row['tag2']."</td>";
                            echo "<td>".$row['tag3']."</td>";
                            echo "<td>".$row['tag4']."</td>";
                            echo "<td>".$row['tag5']."</td>";
                            echo "</tr>";
                            $i++;
                          }
                        }
                        echo "<thead>";
                        echo "<tr>";
                        echo "<td colspan='6'>";
                        
                        echo "<button class='btn waves-effect waves-light' type='submit' name='update' value='Update' onClick='setUpdateAction();'>";
                        echo "<i class='material-icons right'>send</i>";
                        echo "</button>";
                        echo "<button class='btn waves-effect waves-light' type='submit' name='update' value='Update' onClick='setDeleteAction();'>";
                        echo "<i class='material-icons right'>send</i>";
                        echo "</button>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "</tbody>";
                        echo "</table>";
                        echo "</form>";
                      }else{

                      }
                       // close log file
                    $log->lclose();
                    ?>
                      </div>
                </div>
                <div class="col s12 m2 l2"></div>
            </div>
  			</div><!--   Icon Section   -->
        </div>
        <div class="section"></div>
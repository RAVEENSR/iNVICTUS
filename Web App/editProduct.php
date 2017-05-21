<?php
include ("headfile.php"); 
include("db.php");
?>

    <title>Edit Product Details</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h2 class="header center orange-text">Edit Product Details</h2>
            <div class="row center">
            </div>
        </div>
    </div>

    <div class="container">
    <form class="col s12" action="editSuccess.php" method="post">
        <table>
            <tr>
                <td><h2>Edit User</h2></td>
            </tr>
            <?php  
                echo "<title>Edit Product Details</title>";              
                $rowCount = count($_POST["items"]);
                /*
                * previousely selected items are sent through an array via post method 
                * selecting the all related data from the database for a given item
                * then the result is fetched into an array and retrieved through the array 
                */
                for($i=0;$i<$rowCount;$i++) {
                    $result1 = sqlsrv_query($conn,"SELECT * FROM Item WHERE itemName='".$_POST["items"][$i]."'") or die( print_r( sqlsrv_errors(), true));;
                    $row[$i]= sqlsrv_fetch_array($result1,SQLSRV_FETCH_ASSOC) or die( print_r( sqlsrv_errors(), true));
                    // write message to the log file
                    $log->lwrite("Select query successfull : SELECT * FROM Item WHERE itemName='".$_POST["items"][$i]."'");
            ?>
                    <tr>
                        <td>
                            <table><!--Opening the table -->
                                <tr>
                                    <td><label>Product Name</label></td>
                                    <td>
                                        <input type="hidden" name="productId[]" class="txtField" value="<?php echo $row[$i]['itemName']; ?>">
                                        <input type="text" disabled name="productName[]" class="txtField" value="<?php echo $row[$i]['itemName']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Image URL</label></td>
                                    <td>
                                        <input type="text" name="imageurl[]" class="txtField" value="<?php echo $row[$i]['imageurl']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Tag 1</label></td>
                                    <td>
                                        <input type="text" name="tag1[]" class="txtField" value="<?php echo $row[$i]['tag1']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Tag 2</label></td>
                                    <td><input type="text" name="tag2[]" class="txtField" value="<?php echo $row[$i]['tag2']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label>Tag 3</label></td>
                                    <td><input type="text" name="tag3[]" class="txtField" value="<?php echo $row[$i]['tag3']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label>Tag 4</label></td>
                                    <td><input type="text" name="tag4[]" class="txtField" value="<?php echo $row[$i]['tag4']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label>Tag 5</label></td>
                                    <td><input type="text" name="tag5[]" class="txtField" value="<?php echo $row[$i]['tag5']; ?>"></td>
                                </tr>
                            </table><!--Closing the table -->
                        </td>
                    </tr>
            <?php
                // close log file
                $log->lclose();
                }
            ?>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
            </tr>
        </table>
    </form>
    </div>
    <?php include("footfile.html"); ?>





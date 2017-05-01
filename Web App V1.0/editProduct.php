<?php
include("db.php");

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
    $usersCount = count($_POST["productName"]);
    for($i=0;$i<$usersCount;$i++) {
        mysql_query("UPDATE users set userName='" . $_POST["productName"][$i] . "', password='" . $_POST["tag1"][$i] . "', firstName='" . $_POST["tag2"][$i] . "', lastName='" . $_POST["tag3"][$i] . "',firstName='" . $_POST["tag4"][$i] . "',firstName='" . $_POST["tag5"][$i] . "' WHERE userId='" . $_POST["productId"][$i] . "'");
    }
    header("Location:products.php");
    echo"deleteSuccessMessage()"
    echo"<script>";
    echo"function deleteSuccessMessage() {";
    echo"alert('Products have been successfully Deleted!');"; 
    echo"}";
    echo"</script>";
}
?>
<?php 
include ("headfile.php"); 
include ("detectlogin.php");
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
    <form class="col s12" action="" method="post">
        <table>
            <tr>
                <td>Edit User</td>
            </tr>
            <?php
                $rowCount = count($_POST["items"]);
                for($i=0;$i<$rowCount;$i++) {
                    $result = mysql_query("SELECT * FROM users WHERE userId='" . $_POST["items"][$i] . "'");
                    $row[$i]= mysql_fetch_array($result);
            ?>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td><label>Product Name</label></td>
                                    <td>
                                        <input type="hidden" name="productId[]" class="txtField" value="<?php echo $row[$i]['productId']; ?>">
                                        <input type="text" name="productName[]" class="txtField" value="<?php echo $row[$i]['productName']; ?>">
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
                            </table>
                        </td>
                    </tr>
            <?php
                }
            ?>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
            </tr>
        </table>
    </form>
    </div>
    <?php include("footfile.html"); ?>





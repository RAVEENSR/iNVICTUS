<?php
include("db.php");
$rowCount = count($_POST["items"]);
for($i=0;$i<$rowCount;$i++) {
mysql_query("DELETE FROM users WHERE userId='" . $_POST["users"][$i] . "'");
}
header("Location:products.php");
echo"deleteSuccessMessage()";
echo"<script>";
echo"function deleteSuccessMessage() {";
echo"alert('Products have been successfully Deleted!');"; 
echo"}";
echo"</script>";
?>
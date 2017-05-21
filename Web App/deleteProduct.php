<?php 
include ("headfile.php"); 
include("db.php");
$rowCount = count($_POST["items"]);
foreach($_POST['items'] as $value){
//Execute SQL Querry
	$result=sqlsrv_query($conn,"DELETE FROM ItemShop WHERE itemName='".$value."' AND shopName='".$_SESSION['shopName']."'") or die( print_r( sqlsrv_errors(), true));
    // write message to the log file
    $log->lwrite("Delete query successfull : DELETE FROM ItemShop WHERE itemName='".$value."' AND shopName='".$_SESSION['shopName']."'");
}
if($rowCount>0){
    // write message to the log file
    $log->lwrite("Product/s have successfully deleted");
	echo "<h5 class='center header col s12 light'>You have successfully deleted the product!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}else{
    // write message to the log file
    $log->lwrite("Error occured while deleting the product/s");
    echo "<h5 class='center header col s12 light'>!!! Error while deleting the product. !!!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}
// close log file
$log->lclose();
include("footfile.html");
?>

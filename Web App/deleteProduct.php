<?php 
include ("headfile.php"); 
include("db.php");
$rowCount = count($_POST["items"]);
foreach($_POST['items'] as $value){
//Execute SQL Querry
	$result=sqlsrv_query($conn,"DELETE FROM ItemShop WHERE itemName='".$value."' AND shopName='".$_SESSION['shopName']."'") or die( print_r( sqlsrv_errors(), true));
}
if($rowCount>0){
	echo "<h5 class='center header col s12 light'>You have successfully deleted the product!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}else{
    echo "<h5 class='center header col s12 light'>!!! Error while deleting the product. !!!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}
include("footfile.html");
?>

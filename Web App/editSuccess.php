<?php
include ("headfile.php"); 
include("db.php");

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
    $usersCount = count($_POST["productId"]);
    echo $usersCount;
    for($i=0;$i<$usersCount;$i++) {
        $result=sqlsrv_query($conn,"UPDATE Item set imageurl='".$_POST["imageurl"][$i]."',tag1='".$_POST["tag1"][$i]."',tag2='".$_POST["tag2"][$i]."',tag3='".$_POST["tag3"][$i]."',tag4='".$_POST["tag4"][$i]."',tag5='".$_POST["tag5"][$i]."'WHERE itemName='".$_POST["productId"][$i]."'") or die( print_r( sqlsrv_errors(),true));
    }
    echo "<h5 class='center header col s12 light'>You have successfully edited the product!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}else{
    echo "<h5 class='center header col s12 light'>!!! Error while editing the product. !!!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}
include("footfile.html");
?>
<?php
include ("headfile.php"); 
include("db.php");

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
    $usersCount = count($_POST["productId"]);
    echo $usersCount;
    /*
    * Editing the items which were selected to edit
    * Selected items are determined by sending the productId of through an array via post method
    */
    for($i=0;$i<$usersCount;$i++) {
        //executing the update query
        $result=sqlsrv_query($conn,"UPDATE Item set imageurl='".$_POST["imageurl"][$i]."',tag1='".$_POST["tag1"][$i]."',tag2='".$_POST["tag2"][$i]."',tag3='".$_POST["tag3"][$i]."',tag4='".$_POST["tag4"][$i]."',tag5='".$_POST["tag5"][$i]."'WHERE itemName='".$_POST["productId"][$i]."'") or die( print_r( sqlsrv_errors(),true));
        // write message to the log file
        $log->lwrite("Update query: UPDATE Item set imageurl='".$_POST["imageurl"][$i]."',tag1='".$_POST["tag1"][$i]."',tag2='".$_POST["tag2"][$i]."',tag3='".$_POST["tag3"][$i]."',tag4='".$_POST["tag4"][$i]."',tag5='".$_POST["tag5"][$i]."'WHERE itemName='".$_POST["productId"][$i]."'  ");
    }
    // write message to the log file
    $log->lwrite("Updating the items finished successfully");
    echo "<h5 class='center header col s12 light'>You have successfully edited the product!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}else{
    // write message to the log file
    $log->lwrite("Error occured while Updating the items");
    echo "<h5 class='center header col s12 light'>!!! Error while editing the product. !!!<br/></h5>";
    echo "<center>";
    echo "<h1>Redirecting to Edit/Delete Page...</h1>";
    echo "</center>";
    echo '<meta http-equiv="refresh" content="3; url=update_delete.php" />';	
}
// close log file
$log->lclose();
include("footfile.html");
?>
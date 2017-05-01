<?php
#create connection to MySQL server
$conn=mysqli_connect("localhost","root","");

#select target database
mysqli_select_db($conn,"dms");

#check connection status
if(!$conn){
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
#end of file
?>
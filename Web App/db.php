<?php
$serverName = "phatman.database.windows.net";
$connectionOptions = array(
    "Database" => "UDB",
    "Uid" => "umen",
    "PWD" => "Fat123Man"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

?>

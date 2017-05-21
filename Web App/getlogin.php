<?php  
include ("headfile.php"); 
?>
    <title>Login Confirmation</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h1 class="header center orange-text">Sign In Confirmation</h1>
            <div class="row center">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m2 l2"></div>
                <div class="col s12 m8 l8">
                    <?php 
                    include("db.php");
                    
                    // write message to the log file
                    $log->lwrite('Successfully Connected to the Database');

                    @$shopName=$_POST['shopName'];
                    @$password=$_POST['password'];

                    if($shopName===null or $password===null){
                        echo "<h5 class='center header col s12 light'>!!! Your form is incomplete!!! <br/>Please fill in all the required fields<br/></h5>";
                        echo "<b>Go back to <a href='admin.php'>Admin Login</a></b>";
                    }else{
                        //write sql querry
                        $select= "select * from Shop where shopName='".$shopName."'";
                        
                        //Execute SQL Querry
                        $result= sqlsrv_query($conn,$select);
                        if ($result == FALSE){
                            echo (sqlsrv_errors());
                            // write message to the log file
                            $log->lwrite("Select query failed: select * from Shop where shopName='".$shopName."'");
                        }else{
                            // write message to the log file
                            $log->lwrite("Select query succeded: select * from Shop where shopName='".$shopName."'");
                        }
                        
                        //read sigle row of result set
                        $row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                        
                        if(!($row['shopName']==$shopName and $row['shopPW']==$password)){
                            echo "<h5 class='center header col s12 light'>!!! Incorrect Username or Password !!!</h5><br/>";
                            echo "<b>Go back to <a href='admin.php'>Admin Login</a></b>";
                            // write message to the log file
                            $log->lwrite("Incorrect username or password");

                        }else{
                            $_SESSION["shopName"]=$row['shopName']; 
                            // write message to the log file
                            $log->lwrite("'".$shopName."' user successfully logged in");
                            echo "<h5 class='center header col s12 light'>You have successfully logged into the system</h5><br/>";
                            echo "<center>";
                            echo "<h1>Redirecting to Home Page...</h1>";
                            echo "</center>";
                            echo '<meta http-equiv="refresh" content="3; url=index.php" />';
                        } 
                        sqlsrv_free_stmt($result);    
                    }
                    
                    // close log file
                    $log->lclose();
                    ?>

                </div>
                <div class="col s12 m2 l2"></div>
            </div>

        </div>
        <div class="section">
        </div>
    </div>
<?php include("footfile.html"); ?>
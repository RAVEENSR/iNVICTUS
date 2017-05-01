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

                    @$shopName=$_POST['shopName'];
                    @$password=$_POST['password'];

                    if($shopName===null or $password===null){
                        echo "<h5 class='center header col s12 light'>!!! Your form is incomplete!!! <br/>Please fill in all the required fields<br/></h5>";
                        echo "<b>Go back to <a href='admin.php'>Admin Login</a></b>";
                    }else{

                        //write sql querry
                        $select="select * from admin where username='$email' ";
                    
                        //Execute SQL Querry
                        $result=mysqli_query($conn,$select);
                        //read sigle row of result set
                        $row=mysqli_fetch_array($result);

                        if(!($row['username']==$shopName and $row['password']==$password )){
                            echo "<h5 class='center header col s12 light'>!!! Incorrect Username or Password !!!</h5><br/>";
                            echo "<b>Go back to <a href='admin.php'>Admin Login</a></b>";

                        }else{

                            $_SESSION['shopName']=$row['userId']; 
                            $_SESSION['c_userFName']=$row['userFName']; 
                            $_SESSION['c_userSName']=$row['userSName']; 

                            echo "<h5 class='center header col s12 light'>You have successfully logged into the system</h5><br/>";
                            echo "<center>";
                            echo "<h1>Redirecting to Home Page...</h1>";
                            echo "</center>";
                            echo '<meta http-equiv="refresh" content="3; url=index.php" />';
                        }    
                    }
                    ?>

                </div>
                <div class="col s12 m2 l2"></div>
            </div>

        </div>
        <div class="section">
        </div>
    </div>
<?php include("footfile.html"); ?>
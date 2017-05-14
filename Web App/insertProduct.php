<?php 
include ("headfile.php"); 
?>
    <title>Product Insertion Confirmation</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h1 class="header center orange-text">Product Insertion Confirmation</h1>
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
                    @$shopName= $_SESSION['shopName'];
                    @$name=$_POST['name'];
                    @$image=$_POST['image'];
                    @$tag1=$_POST['tag1'];
                    @$tag2=$_POST['tag2'];
                    @$tag3=$_POST['tag3'];
                    @$tag4=$_POST['tag4'];
                    @$tag5=$_POST['tag5'];
                    
                    $SQL0="select * from Item where itemName ='".$name."'";
                    $result0=sqlsrv_query($conn,$SQL0) or die( print_r( sqlsrv_errors(), true));
                    $row = sqlsrv_fetch_array($result0, SQLSRV_FETCH_ASSOC);

                    if(!($row==null)){
                        $SQL1="insert into ItemShop (itemName,shopName) values ('".$name."','".$shopName."')";
                        //Execute SQL Querry
                        $result1=sqlsrv_query($conn,$SQL1) or die( print_r( sqlsrv_errors(), true));; 
                        if(!$result1){
                            echo "<center>";
                            echo "<h1>!Error while inserting the product.! Redirecting to Products Page...</h1>";
                            echo "</center>";
                            echo '<meta http-equiv="refresh" content="3; url=products.php" />';

                        }else{
                            echo "<h5 class='center header col s12 light'>You have successfully inserted the product into the system!<br/></h5>";
                            echo "<center>";
                            echo "<h1>Redirecting to Products Page...</h1>";
                            echo "</center>";
                            echo '<meta http-equiv="refresh" content="3; url=products.php" />';
                        } 

                    }else{
                        //write sql querry
                        $SQL1="insert into Item(itemName,tag1,tag2,tag3,tag4,tag5,imageurl) values ('".$name."','".$tag1."','".$tag2."','".$tag3."','".$tag4."','".$tag5."','".$imageurl."')";
                        $SQL2="insert into ItemShop (itemName,shopName) values ('".$name."','".$shopName."')";
                        //Execute SQL Querry
                        $result1=sqlsrv_query($conn,$SQL1) or die( print_r( sqlsrv_errors(), true)); 
                        $result2=sqlsrv_query($conn,$SQL2) or die( print_r( sqlsrv_errors(), true)); 
                        if(!$result1 or !$result2 ){ //or 
                            echo die(sqlsrv_error($conn));
                            echo "<center>";
                            echo "<h1>!Error while inserting the product.! Redirecting to Products Page...</h1>";
                            echo "</center>";
                            echo '<meta http-equiv="refresh" content="3; url=products.php" />';

                        }else{
                            echo "<h5 class='center header col s12 light'>You have successfully inserted the product into the system!<br/></h5>";
                            echo "<center>";
                            echo "<h1>Redirecting to Products Page...</h1>";
                            echo "</center>";
                            echo '<meta http-equiv="refresh" content="3; url=products.php" />';
                        }
                    }    
                    ?>
          
                </div>
                <div class="col s12 m2 l2"></div>
            </div>

        </div>
    </div>
<?php include("footfile.html"); ?>
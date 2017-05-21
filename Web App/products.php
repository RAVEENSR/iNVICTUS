<?php 
include ("headfile.php"); 
?>
    <title>Product Details</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h2 class="header center orange-text">Product Details</h2>
            <div class="row center">
            </div>
        </div>
    </div>

    <div class="container">
        <?php 
            // if the session varialbe is set then 'Edit/Delete a Product' button is displayed
          if (isset($_SESSION['shopName'])) { 
            echo "<div class='row center'>";
            echo "<h3 class='center header col s12 light'>Choose an Option</h3><br/><br/>";
            echo "<a class='waves-effect waves-light btn center' href='insert.php'>Insert a Product</a>&nbsp&nbsp";
            echo "<a class='waves-effect waves-light btn center' href='update_delete.php'>Edit/Delete a Product</a>";
            echo "</div>";
          }else{
              // if the session varialbe is not set then 'Admin Login' button is displayed
            echo "<div class='row center'>";
            echo "<h3 class='center header col s12 light'>Please Login First</h3><br/>";
            echo "<a class='waves-effect waves-light btn center' href='admin.php'>Admin Login</a>";
            echo "</div>";
          }
    ?>
    </div>
    <?php include("footfile.html"); ?>
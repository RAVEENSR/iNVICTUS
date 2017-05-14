<?php 
include ("headfile.php"); 
?>
    <title>Log out</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">Log Out</h1>
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
                        unset($_SESSION['shopName']);
                        session_unset();
                        session_destroy();
                        echo "<h5>You have successfully logged out!</h5>";
                        echo "<center>";
                        echo "<h1>Redirecting to Log In Page...</h1>";
                        echo "</center>";
                        echo '<meta http-equiv="refresh" content="3; url=admin.php" />';

                    ?>

                </div>
                <div class="col s12 m2 l2"></div>
            </div>

        </div>
        <div class="section">
        </div>
    </div>
<?php include("footfile.html"); ?>
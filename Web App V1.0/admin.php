<?php 
include ("headfile.php"); 
?>
    <title>Admin Login</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h1 class="header center orange-text">Admin Login</h1>
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
                    ?>
                    <div class="row">
                        <form class="col s12" action="getlogin.php" method="post">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="shopName" type="text" class="validate" name="shopName" required>
                                    <label for="shopName">Shop Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" class="validate" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                                <button class="btn waves-effect waves-light" type="reset" name="reset">Reset
                                    <i class="material-icons right">clear_all</i>
                                </button>
                            </div>
        
                        </form>
                      </div>
                </div>
                <div class="col s12 m2 l2"></div>
            </div>

        </div>
        <div class="section">
        </div>
    </div>
<?php include("footfile.html"); ?>
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 m12 l12">
                <?php 
                    //checks whether the session variable 'shopName' is setted or not. if setted display it
                if (isset($_SESSION['shopName'])) {
                    echo "<h5 class='right black-text'>Name: ".$_SESSION['shopName']." is logged in</h5>";
                } 
                ?>
            </div>
        </div>
    </div>
</div>
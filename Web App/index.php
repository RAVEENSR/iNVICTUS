<?php 
include ("headfile.php"); 
?>
<title>Home</title>
<div id="header"></div><br />
<div class="section no-pad-bot" id="index-banner">
	<div class="container">
		<?php 
			if (isset($_SESSION['shopName'])) { 
				echo "<h3 class='header center orange-text'>Welcome To Intelligent Advertising System</h3>";
				echo "<div class='row center'>";
			    echo "<h6 class='header col s12 light'>Let's get Started</h6>";
                echo "<br><br>";
                echo "<a class='waves-effect waves-light btn center' href='products.php'>Product Details</a>";
		        echo "</div>";
		    }else{
		    	echo "<div class='row center'>";
		    	echo "<h3 class='center header col s12 light'>Please Login First</h3><br/>";
                echo "<a class='waves-effect waves-light btn center' href='admin.php'>Admin Login</a>";
                echo "</div>";
			}
		?>
		
	</div>
</div>

<?php include("footfile.html"); ?>
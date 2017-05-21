<?php 
session_start();

/** 
 * Logging class:
 * - contains lfile, lwrite and lclose public methods
 * - lfile sets path and name of log file
 * - lwrite writes message to the log file (and implicitly opens log file)
 * - lclose closes log file
 * - first call of lwrite method will open log file implicitly
 * - message is written with the following format: [d/M/Y:H:i:s] (script name) message
 */
class Logging {
    // declare log file and file pointer as private properties
    private $log_file, $fp;
    // set log file (path and name)
    public function lfile($path) {
        $this->log_file = $path;
    }
    // write message to the log file
    public function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        // define script name
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[d/M/Y:H:i:s]');
        // write current time, script name and message to the log file
        fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'tmp/logfile.log';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = 'tmp/logfile.log';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}

// Logging class initialization
$log = new Logging();
 
// set path and name of log file (optional)
$log->lfile('tmp/logfile.log');

?>
<!--HTML document to define the layout of the head and the navigation bar-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <!--<title>Starter Template - Materialize</title> -->

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="index.php" class="brand-logo"><img width="70" height="65" src=images/workedup_logo.png></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
            <?php 
                if (isset($_SESSION['shopName'])) {
                    echo "<li><a href='products.php'>Products</a></li>";
                    echo "<li><a href='logout.php'>Log Out</a></li>";
                }else{
                    echo "<li><a href='admin.php'>Log In</a></li>";
                }
            ?>       
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="index.php">Home</a></li>
            <?php 
                if (isset($_SESSION['shopName'])) {
                    echo "<li><a href='products.php'>Products</a></li>";
                    echo "<li><a href='logout.php'>Log Out</a></li>";
                }else{
                    echo "<li><a href='admin.php'>Log In</a></li>";
                }
            ?>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<h5 class="center"><a><?php date_default_timezone_set('Asia/Colombo'); echo date('d F Y ');?></a></h5>


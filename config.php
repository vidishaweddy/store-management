<?php
$mysql = mysqli_connect("localhost","root","admin", "test_store");
error_reporting(E_ALL);


//define some constant
define ( "DB_HOST", "localhost");
define ( "DB_USER", "root");
define( "CLS_PATH", "class" );

//include the classes
include_once( CLS_PATH . "/user.php" );
include_once( CLS_PATH . "/product.php" );
include_once( CLS_PATH . "/sale.php" );
?>

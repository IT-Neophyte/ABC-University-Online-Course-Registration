<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = 'Pa$$word';
$mysql_database = "courseregistration";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");
?>
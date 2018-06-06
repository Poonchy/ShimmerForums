<?php
$servername = getenv("herokuServer");
$username = getenv("herokuUser");
$password = getenv("herokuPass");
$dbName = getenv("herokuDB");

$conn = new mysqli($servername, $username, $password, $dbName);
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] != "https") {
    Header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
}
session_start();
?>
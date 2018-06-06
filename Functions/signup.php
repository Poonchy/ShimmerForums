<?php
include '../Segments/connection.php';
$userusername = mysqli_real_escape_string($conn, strtolower($_POST['Username']));
$userpassword = mysqli_real_escape_string($conn, $_POST['Password']);
$query = "CREATE TABLE $userusername (
    username TEXT,
    nickname TEXT,
    password TEXT,
    access TEXT
);";
if($conn->query($query)) {
} else {
    echo "$conn->error";
    if ("$conn->error" == "Table '$userusername' already exists") {
        echo "<h1>Account name taken!</h1>";
        $_SESSION['error'] = "exists";
        header("Location:../account.php");
    }
    die;
}
$userpassword = hash('sha512',$userpassword);
$forumUserName = ucfirst(strtolower($userusername));
$addValues = "INSERT INTO $userusername (username, nickname, password, access) VALUES ('$userusername', '$forumUserName', '$userpassword', 'user');";
if($conn->query($addValues)) {
    $_SESSION['error'] = "none";
    $_SESSION['access'] = "admin";
    $_SESSION['username'] = $userusername;
    $_SESSION['alias'] = $forumUserName;
    header("Location:../index.php");
}
?>
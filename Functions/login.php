<?php
include '../Segments/connection.php';
$userusername = mysqli_real_escape_string($conn, strtolower($_POST['Username']));
$userpassword = mysqli_real_escape_string($conn, $_POST['Password']);
$checkLogin = "SELECT * FROM $userusername;";
$userpassword = hash('sha512',$userpassword);
if ($conn->query($checkLogin)) {
    $checkPass = "";
    while($row = $conn->query($checkLogin)->fetch_assoc()) {
        $checkPass = $row['password'];
        break;
    }
    if ($userpassword == $checkPass) {
        $nickName = "SELECT * FROM $userusername;";
        $offNickName = "";
        while($row = $conn->query($nickName)->fetch_assoc()) {
            $offNickName = $row['nickname'];
            $accountstatus = $row['access'];
            break;
        }
        $_SESSION['access'] = "$accountstatus";
        $_SESSION['alias'] = "$offNickName";
        $_SESSION['username'] = "$userusername";
        header("Location:../index.php");
    } else {
        $_SESSION['error'] = "wrongpass";
        header("Location:../account.php");
    }
} else {
    $_SESSION['error'] = "noaccount";
    header("Location:../account.php");
}
?>
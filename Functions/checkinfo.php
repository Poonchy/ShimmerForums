<?php 
if (isset($_SESSION['username'])) {
    $checkedAccount = $_SESSION['username'];
    $check = "SELECT * FROM $checkedAccount";
    $checkQuery = $conn -> query($check);

    if (mysqli_num_rows($checkQuery)==0) {
        session_start();
        session_unset();
        session_destroy();
        header("Location:account.php");
    } else {
        while ($row = $checkQuery->fetch_assoc()) {
            $updatedAccess = $row['access'];
            $updatedUsername = $row['username'];
            $updatedNickname = $row['nickname'];
            $_SESSION['access'] = "$updatedAccess";
            $_SESSION['alias'] = "$updatedNickname";
            $_SESSION['username'] = "$updatedUsername";
        }
    }
}

?>
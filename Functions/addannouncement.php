<?php
include '../Segments/connection.php';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    die;
}
$nickname = $_SESSION['alias'];
$title = mysqli_real_escape_string($conn, $_POST['Title']);
$content = mysqli_real_escape_string($conn, $_POST['Content']);
date_default_timezone_set("America/New_York");
$time = date("Y-m-d h:i:sa");
$username = $_SESSION['username'];
$newforumpost = "INSERT INTO announcementpost (usersforum, forumtitle,forumcontent, forumcreatedtime) VALUES ('$nickname','$title','$content','$time');";
$forumpostquery = $conn->query($newforumpost);
if($forumpostquery) {
    $getID = "SELECT * FROM announcementpost WHERE forumcreatedtime = '$time' AND usersforum = '$username';";
    $IDQuery = $conn->query($getID);
    if ($IDQuery){
        while ($row = $IDQuery->fetch_assoc()) {
            $forumpost = $row['ID'];
            header("Location:../post.php?forumtype=announcements&forumpost=$forumpost");
        }
    }
}

echo $conn->error;

?>
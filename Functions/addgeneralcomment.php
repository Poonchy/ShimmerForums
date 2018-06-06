<?php
include '../Segments/connection.php';
if (!isset($_SESSION['alias'])) {
    header("Location: ../index.php");
    die;
}

$postID = mysqli_real_escape_string($conn, $_POST['id']);
$userscomment = mysqli_real_escape_string($conn, $_POST['userscomment']);
$commentcontent = mysqli_real_escape_string($conn, $_POST['commentcontent']);
date_default_timezone_set("America/New_York");
$time = date("Y-m-d h:i:sa");

$addComment = "INSERT INTO generalcomment (forumid, userscomment, comment, time) VALUES ('$postID', '$userscomment', '$commentcontent', '$time');";
$addQuery = $conn->query($addComment);
if ($addComment) {
    header("Location: ../post.php?forumtype=general&forumpost=$postID");
}

?>
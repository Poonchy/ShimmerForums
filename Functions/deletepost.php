<?php
include '../Segments/connection.php';
$nickname = $_SESSION['alias'];
$username = $_SESSION['username'];
$postID = $_GET['forumpost'];
$postType = $_GET['forumtype'];
if ($_GET['forumtype'] == "announcements") {
    $getPostCreator = "SELECT * FROM announcementpost WHERE ID = '$postID';";
} else if ($_GET['forumtype'] == "general") {
    $getPostCreator = "SELECT * FROM generalpost WHERE ID = '$postID';";
}
$creatorQuery = $conn->query($getPostCreator);
if ($_SESSION['access'] != "admin" || $_SESSION['access'] != "moderator") {
} else {
    while ($rowp = $creatorQuery->fetch_assoc()) {
        if ($rowp['usersforum'] != $_SESSION['alias']) {
            echo "Not your forum post!";
            header("Location:../index.php");
            die;
        }
    }
}
if ($_GET['forumtype'] == "announcements") {
    $deleteForum = "DELETE FROM announcementpost WHERE ID = '$postID';";
} else if ($_GET['forumtype'] == "general") {
    $deleteForum = "DELETE FROM generalpost WHERE ID = '$postID';";
}
$deleteQuery = $conn->query($deleteForum);
if($deleteQuery) {
    header("Location:../index.php");
}
?>
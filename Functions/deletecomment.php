<?php
include '../Segments/connection.php';
$nickname = $_SESSION['alias'];
$username = $_SESSION['username'];
$forumID = $_GET['forumid'];
$postID = $_GET['ID'];
$postType = $_GET['forumtype'];
if ($_GET['forumtype'] == "announcements") {
    $getPostCreator = "SELECT * FROM announcementcomment WHERE ID = '$postID';";
} else if ($_GET['forumtype'] == "general") {
    $getPostCreator = "SELECT * FROM generalcomment WHERE ID = '$postID';";
}
$creatorQuery = $conn->query($getPostCreator);
if ($_SESSION['access'] != "admin" || $_SESSION['access'] != "moderator") {
} else {
    while ($rowp = $creatorQuery->fetch_assoc()) {
        if ($rowp['userscomment'] != $_SESSION['alias']) {
            echo "Not your comment!";
            die;
        }
    }
}
if ($_GET['forumtype'] == "announcements") {
    $deleteForum = "DELETE FROM announcementcomment WHERE ID = '$postID';";
} else if ($_GET['forumtype'] == "general") {
    $deleteForum = "DELETE FROM generalcomment WHERE ID = '$postID';";
}
$deleteQuery = $conn->query($deleteForum);
if($deleteQuery) {
    if ($_GET['forumtype'] == "announcements") {
        header("Location:../post.php?forumtype=announcements&forumpost=$forumID");
    } else if ($_GET['forumtype'] == "general") {
        header("Location:../post.php?forumtype=general&forumpost=$forumID");
    }
}
?>
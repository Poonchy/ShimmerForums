<?php

include 'Segments/header.php';

$postID = $_GET['forumpost'];
if ($_GET['forumtype'] == "announcements") {
    $getPost = "SELECT * FROM announcementpost WHERE ID = '$postID';";
    $getComment = "SELECT * FROM announcementcomment WHERE ID = '$postID';";
} else if ($_GET['forumtype'] == "general") {
    $getPost = "SELECT * FROM generalpost WHERE ID = '$postID';";
    $getComment = "SELECT * FROM generalcomment WHERE ID = '$postID';";
}

$whosForum = "";

$results = $conn->query($getPost);
if (mysqli_num_rows($results)==0) { 
    echo "Nothing found ;(";
    die;
}

while($rowp = $results->fetch_assoc()) { ?>
    <div class = "container-fluid container-custom">
        <div class = "row justify-content-between">
            <h1> <?php echo $rowp["forumtitle"]; ?> </h1>
            <h1> <?php echo $rowp["usersforum"]; ?> </h1>
        </div>
    </div>
    <div class = "container">
        <div class = "row justify-content-end">
            <h4> <?php echo $rowp["forumcreatedtime"]; ?> </h4>
        </div>
    </div>
    <div class = "container">
        <div class = "row">
            <h3> <?php echo $rowp["forumcontent"]; ?> </h3>
        </div>
    </div>
<?php $whosForum = $rowp["usersforum"];
} ?>

<?php
if ($_GET['forumtype'] == "announcements") {
    $findComments = "SELECT * FROM announcementcomment WHERE forumid = '$postID';";
} else if ($_GET['forumtype'] == "general") {
    $findComments = "SELECT * FROM generalcomment WHERE forumid = '$postID';";
}
$commentQuery = $conn->query($findComments);
while ($comment = $commentQuery -> fetch_assoc()){ ?>
    <br>
    <div class = "container commentborder">
        <div class = "row justify-content-between">
            <h1> <?php echo $comment['userscomment']; ?> </h1>
            <h1> <?php echo $comment['time']; ?> </h1>
        </div>
        <div class = "row justify-content-center">
            <h2> <?php echo $comment['comment']; ?>
        </div>
        <?php if ($whosForum == $_SESSION['alias'] || $_SESSION['access'] == "admin" || $_SESSION['access'] == "moderator") { ?>
            <a class = "button deletebtn" href = "Functions/deletecomment.php?forumtype=<?php echo $_GET['forumtype'] ?>&ID=<?php echo $comment['ID'] ?>&forumid=<?php echo $postID ?>">Delete Comment</a>
    </div>
<?php } }
if (isset($_SESSION['alias'])) { ?>
    <div class = "container">
        <div class = "row">
            <?php if ($_GET['forumtype'] == "announcements") { ?>
                <form method="post" action="Functions/addannouncementcomment.php">
            <?php } else if ($_GET['forumtype'] == "general") { ?>
                <form method="post" action="Functions/addgeneralcomment.php">
            <?php } ?>
                <input type = "hidden" value = "<?php echo $postID; ?>" name = "id">
                <input type = "hidden" value = "<?php echo $_SESSION['alias']; ?>" name = "userscomment">
                <input type = "text" name = "commentcontent">
                <input type = "submit" value = "Comment">
            </form>
        </div>
    </div>
<?php
    if ($whosForum == $_SESSION['alias'] || $_SESSION['access'] == "admin" || $_SESSION['access'] == "moderator") { ?>
    <div class = "container">
        <a class = "button deletebtn" href = "Functions/deletepost.php?forumtype=<?php echo $_GET['forumtype'] ?>&forumpost=<?php echo $postID ?>">Delete Post</a>
    </div>
    <?php }
}

include 'Segments/footer.php';

?>
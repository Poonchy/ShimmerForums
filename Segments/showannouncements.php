<?php 
    $mainForumPage = "SELECT * FROM announcementpost;";
    $queue = $conn->query($mainForumPage);?>
    <h1 class = "forumtypelabels">Announcements</h1>
    <form class = "forumSpaces" method="get" action="post.php">
    <input type = "hidden" name = "forumtype" value = "announcements">
    <?php
    if ($conn->query($mainForumPage)) {
        while($row = $queue->fetch_assoc()) { ?>
        <div class = "container">
            <button class = "singleForum" name = "forumpost" type = 'submit' value = '<?php echo $row['ID']; ?>'>
                <div class = "row justify-content-between">
                    <h2> <?php echo $row["forumtitle"]; ?> </h2>
                    <h2> <?php echo $row["usersforum"]; ?> </h2>
                </div>
            </button>
        </div>
        <?php }
    }
    if (isset($_SESSION['access'])){
    if ($_SESSION['access'] == "admin" || $_SESSION['access'] == "moderator") {
?>
<div class = "container">
    <div class = "row justify-content-center">
        <a class = "button" href = "posting.php?posttype=announcement">Create announcement</a>
    </div>
</div>
<?php } } ?>
</form>
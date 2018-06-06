<?php 
    $mainForumPage = "SELECT * FROM generalpost;";
    $queue = $conn->query($mainForumPage);?>
    <h1 class = "forumtypelabels">General</h1>
    <form id = "generalforum" class = "forumSpaces" method="get" action="post.php">
        <input type = "hidden" name = "forumtype" value = "general">
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
    ?>
    <div class = "container">
        <div class = "row justify-content-center">
            <a class = "button" href = "posting.php?posttype=general">Create General Post</a>
        </div>
    </div>
    </form>

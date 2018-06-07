<?php 

include 'Segments/header.php';
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "notsignedin";
    header("Location:account.php");
} ?>

<form method="post" action="Functions/addpost.php">

<?php 
if ($_GET['posttype'] == "general") {
?>
    <h1>New General Post</h1>
    <input type = "hidden" name = "whereto" value = "generalpost">
<?php } else if ($_GET['posttype'] == "announcement") { ?>
    <h1>New Announcement</h1>
    <input type = "hidden" name = "whereto" value = "announcementpost">
<?php } else {
    header("Location: index.php");
    die;
} ?>

    <input placeholder = "Title" required name = "Title" type = "text">
    <input placeholder = "Message" required name = "Content" type = "text">
    <input type = "submit" value = "Create">
</form>

<?php

include 'Segments/footer.php';

?>
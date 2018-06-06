<?php 

include 'Segments/header.php';
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "notsignedin";
    header("Location:account.php");
}

if ($_GET['posttype'] == "general") {
?>
<form method="post" action="Functions/addgeneralpost.php">
    <h1>New General Post</h1>
<?php } else if ($_GET['posttype'] == "announcement") { ?>
<form method="post" action="Functions/addannouncement.php">
    <h1>New Announcement</h1>
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
<?php
include 'Segments/header.php';
?>
<div class = "center-form">
        <form method="post" action="Functions/email.php">
            <h1>Please enter your email.</h1>
            <div class = "container">
                <div class = "row justify-content-center">
                    <input style = "width: 300px;" required type = "email" name = "email">
                </div>
                <br>
                    <input type = "submit" value = "Submit">
                </div>
            </div>
        </form>
    </div>

<?php 
include 'Segments/footer.php';
?>
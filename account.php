<?php 

include 'Segments/header.php';

if(!isset($_SESSION['username'])) { 
    if (isset($_SESSION['error'])){
        if ($_SESSION['error'] == "noaccount") {?>
            <h1>That account doesn't exist.</h1>
        <?php } else if ($_SESSION['error'] == "wrongpass") { ?>
            <h1>You've entered the wrong password.</h1>
        <?php }else if ($_SESSION['error'] == "exists") { ?>
            <h1>Account already exists!</h1>
        <?php }else if ($_SESSION['error'] == "notsignedin") { ?>
            <h1>Must sign in before posting.</h1>
        <?php }}$_SESSION['error'] = ""; ?>
    <div class = "center-form">
        <form method="post" action="Functions/login.php">
            <h1>Log in</h1>
            <div class = "container">
                <div class = "row justify-content-center">
                    <input required pattern="^[a-zA-Z0-9]+$" placeholder="Username"
                    oninvalid="this.setCustomValidity('Must be filled without special characters.')"
                    oninput="this.setCustomValidity('')" type = "text" name = "Username">
                </div>
                <div class = "row justify-content-center">
                    <input required type = "password" name = "Password">
                </div>
                <br>
                    <input type = "submit" value = "Submit">
                </div>
            </div>
        </form>
    </div>
    <div class = "center-form">
        <form method="post" action="Functions/signup.php">
            <h1>Sign up</h1>
            <div class = "container">
                <div class = "row justify-content-center">
                    <input type = "hidden" name = "function" value = "signup">
                    <input required pattern="^[a-zA-Z0-9]+$" placeholder="Username"
                    oninvalid="this.setCustomValidity('Must be filled without special characters.')"
                    oninput="this.setCustomValidity('')" type = "text" name = "Username">
                </div>
                <div class = "row justify-content-center">
                    <input required type = "password" name = "Password">
                </div>
                <br>
                <input type = "submit" value = "Submit">
            </div>
        </form>
    </div>
<?php } else { ?>
<a class = "button" href = "Functions/logout.php">Log out</a>
<?php } ?>
<?php

include 'Segments/footer.php';

?>
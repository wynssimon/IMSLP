<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../styles/reset.css" />
        <link rel="stylesheet" href="../styles/headers.css" />
        <link rel="stylesheet" href="../styles/main.css" />
        <link rel="stylesheet" href="../styles/myaccount.css" />
        <link rel="stylesheet" href="../styles/footer.css" />
        <title>
            <?php echo 'Profile ' . $_SESSION['users_name']; ?>
        </title>
    </head> 
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main">
        <?php if (isset($_SESSION['users_username'])) { ?>
        <div id="contentAccount">
            <h2>My Account</h2>
            <p>Here you can change your password and email.</p>
            <p>Username: <?php echo $_SESSION['users_username']; ?></p>
            <p>Name: <?php echo $_SESSION['users_name']; ?></p> 
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="action" value="update">
                <p>Password:
                    <input id="password-field" name="password" type="password" value="<?php echo $_SESSION[
                        'users_password'
                    ]; ?>">                
                    <img id="showpasswordbtn" onclick="showPassword()" src='../img/view.png'/>
                </p>
                <script>
                function showPassword() {
                    var passwordField = document.getElementById("password-field");

                    if (passwordField.type === "password") {
                    passwordField.type = "text";
                    document.getElementById('showpasswordbtn').src = '../img/invisible.png';
                    } else {
                    passwordField.type = "password";
                    document.getElementById('showpasswordbtn').src = '../img/view.png';
                    }
                }
                </script>
                <p>Email:
                    <input name="email" type="email" value="<?php echo $_SESSION[
                        'users_email'
                    ]; ?>">
                </p>
                <input type="submit" name="submit" value="save">
            </form>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'update') {
                    $thisPassword = $_POST['password'];
                    $thisEmail = $_POST['email'];
                    $uppercase = preg_match('@[A-Z]@', $thisPassword);
                    $lowercase = preg_match('@[a-z]@', $thisPassword);
                    $number = preg_match('@[0-9]@', $thisPassword);
                    $specialChars = preg_match('@[^\w]@', $thisPassword);

                    if (
                        !$uppercase ||
                        !$lowercase ||
                        !$number ||
                        !$specialChars ||
                        strlen($thisPassword) < 8
                    ) {
                        echo 'Password should have: <br> 
                                - 8 characters <br>
                                - one upper case letter <br>
                                - one number <br>
                                - one special character.';
                    } else {
                        $query = "UPDATE `imslp_users` SET users_password='$thisPassword', users_email='$thisEmail' WHERE users_ID = '{$_SESSION['users_ID']}'";
                        $result = $conn->query($query);
                        echo '<br> <p>Succesfully updated your profile. To check your new data log back in.</p>';
                    }
                }
            } ?>
        </div>
        <?php } else {echo "<p>You're not logged in!</p>";} ?>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

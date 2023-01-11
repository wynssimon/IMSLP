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
        <link rel="stylesheet" href="../styles/text.css" />
        <link rel="stylesheet" href="../styles/myaccount.css" />
        <link rel="stylesheet" href="../styles/footer.css" />
        <title>
            <?php echo $_SESSION['users_name']; ?>
        </title>
    </head> 
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main">
        <?php if (isset($_SESSION['users_username'])) { ?>
        <div id="contentAccount"> 
                    <form method="post" action="<?php echo $_SERVER[
                        'PHP_SELF'
                    ]; ?>" enctype = 'multipart/form-data'>
                        <input type="hidden" name="action" value="update">
                        <div class="deze">
                            <p>Username: </p>
                            <p><?php echo $_SESSION['users_username']; ?></p>
                        </div>
                        <div id='iets'><p>.</p></div>
                        <div class="deze">
                            <p>Name: </p> 
                            <p><?php echo $_SESSION['users_name']; ?></p>
                        </div>
                        <div id='iets'><p>.</p></div>
                        <div class="deze">
                            <p>Password:</p>
                            <div>
                            <img id="showpasswordbtn" onclick="showPassword()" src='../img/view.png'/>
                            <input id="password-field" name="password" type="password" value="<?php echo isset(
                                $_POST['password']
                            )
                                ? $_POST['password']
                                : $_SESSION[
                                    'users_password'
                                ]; ?>">                
                            </div>
                        </div>
                        <div class="deze"><p id='passwordShould'>Password should have at least: 8 characters, one upper case letter, one number, one special character!</p></div>
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
                        <div class="deze">
                            <p>Email:</p>
                            <input name="email" type="email" value="<?php echo isset(
                                $_POST['email']
                            )
                                ? $_POST['email']
                                : $_SESSION['users_email']; ?>">
                        </div>
                        <div id="iets2"><p>.</p></div>
                        <div class="deze"><p id='emailExists'>User with this email already exists!</p><p id='emailEmpty'>Email can not be empty!</p></div>
                        <div class="deze">
                            <input type="submit" id="save" name="submit" value="save">
                        </div>
                        <div id='iets'><p>.</p></div>
                        </form>
                        <form method="post" action="<?php echo $_SERVER[
                            'PHP_SELF'
                        ]; ?>" enctype = 'multipart/form-data'>
                            <input type="hidden" name="action" value="remove">
                            <div class="deze">
                                <input id="remove" type="submit" Value="remove account">
                            </div>
                        </form>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'update') {
                    $thisPassword = $_POST['password'];
                    $thisEmail = $_POST['email'];
                    $uppercase = preg_match('@[A-Z]@', $thisPassword);
                    $lowercase = preg_match('@[a-z]@', $thisPassword);
                    $number = preg_match('@[0-9]@', $thisPassword);
                    $specialChars = preg_match('@[^\w]@', $thisPassword);
                    $check_email = mysqli_query(
                        $conn,
                        "SELECT users_email FROM imslp_users where users_email = '$thisEmail' "
                    );

                    if (
                        !$uppercase ||
                        !$lowercase ||
                        !$number ||
                        !$specialChars ||
                        strlen($thisPassword) < 8
                    ) {
                        echo '<script>document.getElementById("passwordShould").style.visibility = "visible";</script>';
                    } elseif (mysqli_num_rows($check_email) > 1) {
                        echo '<script>document.getElementById("emailExists").style.visibility = "visible";</script>';
                        echo '<script>document.getElementById("emailExists").style.display = "flex";</script>';
                        echo '<script>document.getElementById("iets2").style.display = "none";</script>';
                    } elseif (empty($thisEmail)) {
                        echo '<script>document.getElementById("emailEmpty").style.visibility = "visible";</script>';
                        echo '<script>document.getElementById("emailEmpty").style.display = "flex";</script>';
                        echo '<script>document.getElementById("iets2").style.display = "none";</script>';
                    } else {
                        $query = "UPDATE `imslp_users` SET users_password='$thisPassword', users_email='$thisEmail' WHERE users_ID = '{$_SESSION['users_ID']}'";
                        $result = $conn->query($query);
                        echo '<br> <div class="deze"><p>Succesfully updated your profile.</p></div>';
                        $_SESSION['users_password'] = $thisPassword;
                        $_SESSION['users_email'] = $thisEmail;
                    }
                } elseif ($_POST['action'] == 'remove') {
                    $query = "DELETE FROM imslp_users WHERE users_ID = {$_SESSION['users_ID']}";
                    $result = $conn->query($query);
                    session_unset();
                    session_destroy();
                    header('Location: ../index.php');
                }
            } ?>
        <?php } else {echo "<p>You're not logged in!</p>";} ?>
        </div>                     
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

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
                <div id='grid1'>
                    <p>Username: <?php echo $_SESSION['users_username']; ?></p>
                    <p>Name: <?php echo $_SESSION['users_name']; ?></p> 
                    <form method="post" action="<?php echo $_SERVER[
                        'PHP_SELF'
                    ]; ?>" enctype = 'multipart/form-data'>
                        <input type="hidden" name="action" value="update">
                        <p>Password:
                            <input id="password-field" name="password" type="password" value="<?php echo isset(
                                $_POST['password']
                            )
                                ? $_POST['password']
                                : $_SESSION[
                                    'users_password'
                                ]; ?>">                
                            <img id="showpasswordbtn" onclick="showPassword()" src='../img/view.png'/>
                        </p>
                        <div id='passwordShould'>Password should have at least: 8 characters, one upper case letter, one number, one special character!</div>
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
                            <input name="email" type="email" value="<?php echo isset(
                                $_POST['email']
                            )
                                ? $_POST['email']
                                : $_SESSION['users_email']; ?>">
                        </p>
                        <div id='emailExists'>User with this email already exists!</div>
                        <input type="submit" name="submit" value="save">
                </div>
                <div id="grid2">
                    <img class="profilePic"src='../img/<?php echo isset(
                        $_POST['profileImg']
                    )
                        ? $_POST['profileImg']
                        : $_SESSION['users_img']; ?>'>
                    <input type="file" name="profileImg" accept="image/*">
                </div>
            </form> 
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['action'] == 'update') {
                    $thisPassword = $_POST['password'];
                    $thisEmail = $_POST['email'];
                    $getImg = $_FILES['profileImg']['name'];
                    $location = '../img/' . $getImg;
                    $uppercase = preg_match('@[A-Z]@', $thisPassword);
                    $lowercase = preg_match('@[a-z]@', $thisPassword);
                    $number = preg_match('@[0-9]@', $thisPassword);
                    $specialChars = preg_match('@[^\w]@', $thisPassword);
                    $check_email = mysqli_query(
                        $conn,
                        "SELECT users_email FROM imslp_users where users_email = '$thisEmail' "
                    );
                    $check_img = mysqli_query(
                        $conn,
                        "SELECT users_img FROM imslp_users where users_img = '$getImg' "
                    );

                    if (
                        !$uppercase ||
                        !$lowercase ||
                        !$number ||
                        !$specialChars ||
                        strlen($thisPassword) < 8
                    ) {
                        echo '<script>document.getElementById("passwordShould").style.display = "block";</script>';
                    } elseif (mysqli_num_rows($check_email) > 1) {
                        echo '<script>document.getElementById("emailExists").style.display = "block";</script>';
                    } elseif (mysqli_num_rows($check_img) > 1) {
                        echo 'foto met deze naam ebstaat al';
                    } else {
                        $query = "UPDATE `imslp_users` SET users_password='$thisPassword', users_email='$thisEmail', users_img='$getImg' WHERE users_ID = '{$_SESSION['users_ID']}'";
                        $result = $conn->query($query);
                        echo '<br> <p>Succesfully updated your profile.</p>';
                        move_uploaded_file(
                            $_FILES['profileImg']['tmp_name'],
                            $location
                        );
                        $_SESSION['users_password'] = $thisPassword;
                        $_SESSION['users_email'] = $thisEmail;
                        $_SESSION['users_img'] = $getImg;
                    }
                }
            } ?>
        </div>
        <?php } else {echo "<p>You're not logged in!</p>";} ?>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

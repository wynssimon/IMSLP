<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/text.css" />
    <link rel="stylesheet" href="../styles/form.css" />
    <title>Sheetly</title>
</head>
<body>
<?php include '../includes/header.php'; ?>
 <main class="main">
    <?php
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['action'] == 'register') {
            $getUsername = $_POST['users_username'];
            $getPassword = $_POST['users_password'];
            $getName = $_POST['users_name'];
            $getName = ucwords($getName);
            $getEmail = $_POST['users_email'];

            $check_email = mysqli_query(
                $conn,
                "SELECT users_email FROM imslp_users where users_email = '$getEmail' "
            );
            $check_username = mysqli_query(
                $conn,
                "SELECT users_username FROM imslp_users where users_username = '$getUsername' "
            );
            $uppercase = preg_match('@[A-Z]@', $getPassword);
            $lowercase = preg_match('@[a-z]@', $getPassword);
            $number = preg_match('@[0-9]@', $getPassword);
            $specialChars = preg_match('@[^\w]@', $getPassword);

            if (
                !$uppercase ||
                !$lowercase ||
                !$number ||
                !$specialChars ||
                strlen($getPassword) < 8
            ) {
                echo 'Password should have: <br> 
                - 8 characters <br>
                - one upper case letter <br>
                - one number <br>
                - one special character.';
            } elseif (
                mysqli_num_rows($check_email) > 0
            ) { ?><script>alert("User with this email already exists")</script><?php } elseif (
                mysqli_num_rows($check_username) > 0
            ) { ?><script>alert("User with this username already exists")</script><?php } else {$query = "INSERT INTO `imslp_users` (`users_ID`, `users_username`, `users_password`, `users_name`, `users_email`,`users_permissions`) VALUES (NULL, '$getUsername', '$getPassword', '$getName','$getEmail',0)";
                $result = $conn->query($query);
                echo '<p>account made, log in now</p>';
                header('location: login.php');}
        }
    }
    ?>
    <form class="registreer" action="register.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="register">
        <h2>REGISTER</h2>
        <div>
            <label>User Name</label>
            <input type="text" name="users_username" placeholder="User Name" required><br>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="users_password" placeholder="Password" required><br>
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="users_name" placeholder="Name" required><br>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="users_email" placeholder="Email" required><br>
        </div>
        <button type="submit">Register</button>
    </form>
</main>
</body>
</html>

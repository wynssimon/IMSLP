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
    <title>Sheetly</title>
</head>
<body>
<?php include '../includes/header.php'; ?>
 <main>
    <?php
    include 'config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['action'] == 'register') {
            $getUsername = $_POST['users_username'];
            $getPassword = $_POST['users_password'];
            $getName = $_POST['users_name'];
            $getEmail = $_POST['users_email'];

            $query = "INSERT INTO `imslp_users` (`users_ID`, `users_username`, `users_password`, `users_name`, `users_email`,`users_permissions`) VALUES (NULL, '$getUsername', '$getPassword', '$getName','$getEmail',0)";
            $result = $conn->query($query);
            echo '<p>account made, log in now</p>';
        }
    }
    ?>
    <form class="registreer" action="../index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="register">
        <h2>REGISTER</h2>
        <label>User Name</label>
        <input type="text" name="users_username" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="users_password" placeholder="Password"><br>
        <label>Name</label>
        <input type="text" name="users_name" placeholder="Name"><br>
        <label>Email</label>
        <input type="email" name="users_email" placeholder="Email"><br>
        <button type="submit">Register</button>
    </form>
</main>
</body>
</html>

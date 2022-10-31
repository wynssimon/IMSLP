<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/reset.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/main.css" />
</head>
<body>
    <header>
        <h1>IMSLP</h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="subscription.php">Subscription</a>
            <a href="login.php">Login</a>
            <a href="about.php">About</a>
        </nav>
    </header>
    <main>
    <?php
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['action'] == 'register') {
            $getUsername = $_POST['users_username'];
            $getPassword = $_POST['users_password'];
            $getName = $_POST['users_name'];
            $getEmail = $_POST['users_email'];

            $query = "INSERT INTO `imslp_users` (`users_ID`, `users_username`, `users_password`, `users_name`, `users_email`,           `users_permissions`) VALUES (1, '$getUsername', '$getPassword', '$getName','$getEmail',0)";
            $result = $conn->query($query);
            header('Location:../index.php');
        }
    }
    ?>
<form class="registreer" action="register.php" method="post" enctype="multipart/form-data">
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
<hr />
<?php  ?>

    </main>
</body>
</html>

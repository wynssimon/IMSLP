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
        <link rel="stylesheet" href="../styles/header.css" />
        <link rel="stylesheet" href="../styles/main.css" />
        <link rel="stylesheet" href="../styles/text.css" />
        <link rel="stylesheet" href="../styles/myaccount.css" />
        <title>
            <?php echo 'Profile ' . $_SESSION['users_name']; ?>
        </title>
    </head>
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main">
        <div>
            <h1>
                <?php echo 'Hey ' . $_SESSION['users_name']; ?>
            </h1>
            <p>Here you can change your profile.</p>
            <p>Username:
                <input type="text" value="<?php echo $_SESSION[
                    'users_username'
                ]; ?>">
            </p>
            <p>Name:
                <input type="text" value="<?php echo $_SESSION[
                    'users_name'
                ]; ?>">
            </p>
            <p>Password:
                <input type="text" value="<?php echo $_SESSION[
                    'users_password'
                ]; ?>">
            </p>
            <p>Email:
                <input type="text" value="<?php echo $_SESSION[
                    'users_email'
                ]; ?>">
            </p>
        </div>
    </main>
</body>

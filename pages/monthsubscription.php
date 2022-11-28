<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
        <title>1 Month Subscription</title>
    </head>
<body>
    <?php
    include '../includes/header.php';
    include 'config.php';
    $_SESSION['users_ID'];
    ?>
    <main class="main">
        <p>Confirm your subscription for one month</p>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['action'] == 'update') {
                $thisPermissions = $_POST['permissie'];
                $thisUsersID = $_SESSION['users_ID'];
                echo '<strong>updated your permissions. Now you can download as many sheets as you want for one month long. </strong><br>';
                $query = "UPDATE `imslp_users`SET users_permissions='$thisPermissions' where users_ID = $thisUsersID ";
                $result = $conn->query($query);
            }
        } ?>
        <form method="post" action="monthsubscription.php">
            <input type="hidden" name="action" value="update">
            <input type="hidden" value="1" name="permissie">
            <input type="submit" name="submit" value="confirm">
        </form>
    </main>
</body>

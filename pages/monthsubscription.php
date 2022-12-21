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
        <link rel="stylesheet" href="../styles/headers.css" />
        <link rel="stylesheet" href="../styles/main.css" />
        <link rel="stylesheet" href="../styles/text.css" />
        <link rel="stylesheet" href="../styles/footer.css" />
        <title>1 Month Subscription</title>
    </head>
<body>
    <?php
    include '../includes/header.php';
    include 'config.php';
    ?>
    <main class="main">
        <?php if (isset($_SESSION['users_permissions'])) {
            if (
                (isset($_SESSION['users_permissions']) &&
                    $_SESSION['users_permissions'] == 1) ||
                (isset($_SESSION['users_permissions']) &&
                    $_SESSION['users_permissions'] == 2)
            ) {
                echo '<p>You already have a subscription, Come back when it expires.</p>';
            } else {
                 ?>
        
        <p>Confirm your subscription for one month. After that logout and log back in to activate your subscription.</p>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['action'] == 'update') {
                $thisPermissions = $_POST['permissie'];
                $thisUsersID = $_SESSION['users_ID'];
                $currentDate = date('Y-m-d');
                header('location:./confirmed.php');

                $query = "UPDATE `imslp_users`SET users_permissions='$thisPermissions', users_permissions_start='$currentDate' WHERE users_ID = $thisUsersID ";
                $result = $conn->query($query);
            }
        } ?>
        <form method="post" action="monthsubscription.php">
            <input type="hidden" name="action" value="update">
            <input type="hidden" value="1" name="permissie">
            <input type="submit" name="submit" value="confirm">
        </form>
        <?php
            }
        } else {
            echo '<p>You have nothing to search here!</p>';
        } ?>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

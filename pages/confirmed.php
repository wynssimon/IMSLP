<?php
session_start();
session_unset();
session_destroy();
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
        <title>1 Month Subscription</title>
    </head>
    <body>
        <?php
        include '../includes/header.php';
        include 'config.php';
        ?>
        <main class="main">
            <p>Updated your permissions. Log back in and enjoy your premium profile!</p>
        </main>
    </body>
    <?php include '../includes/footer.php'; ?>
</html>
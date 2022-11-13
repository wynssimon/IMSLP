<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include './config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheet</title>
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
            <?php if (
                isset($_SESSION['users_ID']) &&
                isset($_SESSION['users_username'])
            ) { ?>
            <a href='./logout.php?action=logout'>Logout</a>
            <a href='./upload.php?action=add'>Insert</a>
            <?php } else { ?>
            <a href="./login.php">Login</a>
            <?php } ?>            <a href="about.php">About</a>
        </nav>
    </header>
    <main>
        <script src="../scripts/opensheetmusicdisplay.min.js"></script>
        <div id="osmdCanvas"></div>
        <script src="../scripts/loadMusicXML.js"></script>
    </main>
</body>

</html>
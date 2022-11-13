<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include './config.php';
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
    <link rel="stylesheet" href="../styles/subscription.css" />
    <title>IMSLP</title>
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
            <?php } ?>
          <a href="about.php">About</a>
      </nav>
    </header>
    <main>
      <h2>Subscribe!</h2>
      <p>Wanna be able to download as many sheets as you want? For only €2,99/month or €30/year you can use as much music sheets as you want</p>
      <div class="subscribe">
        <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=W77KRHZ4HH84J"><button>Subscribe for one month</button></a>    
        <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=QNSK2WU8X7V9A"><button>Subscribe for one year</button></a>    
      </div>
    </main>
  </body>
</html>

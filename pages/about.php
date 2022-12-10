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
    <link rel="stylesheet" href="../styles/about.css" />
    <link rel="stylesheet" href="../styles/text.css" />
    <title>Sheetly</title>
  </head>
  <body>
  <?php include '../includes/header.php'; ?>
    <main class="main">
      <h2>About</h2>
      <p>Welcome to Sheetly! Here, you can find a wide variety of music sheets for all levels of musicians. Our collection includes popular songs as well as classical pieces, so there's something for everyone. Whether you're a beginner just starting out or an experienced musician, you'll be sure to find something that suits your needs. Our website is easy to navigate and user-friendly, so finding the perfect piece of music is a breeze. Thank you for visiting our site, and happy music-making!
      </p>
    </main>
  </body>
</html>

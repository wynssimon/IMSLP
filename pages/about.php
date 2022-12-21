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
    <link rel="stylesheet" href="../styles/headers.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/about.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <title>Sheetly</title>
  </head>
  <body>
  <?php include '../includes/header.php'; ?>
    <main class="main">
      <div id="contentAbout">
        <h2>About</h2> 
        <p>Welcome to Sheetly! Here, you can find a wide variety of music sheets for all levels of musicians. Our collection includes popular songs as well as classical pieces, so there's something for everyone. Whether you're a beginner just starting out or an experienced musician, you'll be sure to find something that suits your needs. Our website is easy to navigate and user-friendly, so finding the perfect piece of music is a breeze. Thank you for visiting our site, and happy music-making!
        </p>
        <h2>Contact</h2> 
        <div id="contact">
          <ul>
            <li><span>Mail: </span><a href="mailto:info@sheetly.com">info@sheetly.com</a></li>
            <li><span>Adress:<br></span><a>Antwerpsesteenweg 5 <br>2840 Rumst <br>België
            </a></li>
          </ul>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2506.2001005101893!2d4.4495030513193194!3d51.08631454912394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3e5573b3d2d77%3A0xba2e6cdb2b1141cf!2sAntwerpsesteenweg%205%2C%202840%20Rumst!5e0!3m2!1sen!2sbe!4v1670864560096!5m2!1sen!2sbe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
        </div>
      </div>
    </main>
    <?php include '../includes/footer.php'; ?>
  </body>
</html>

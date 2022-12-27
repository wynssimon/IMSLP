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
        <p>If you want to contact Sheetly, please fill out the form below with your name, email address, and message, and we will get back to you as soon as possible. Thank you for reaching out to us. We look forward to assist you. You can also call us on our number: <a href="tel:03/552.01.25">03/552.01.25</a></p>
        <div id="contactForm">
            <form method="post" action="about.php">
              <div>
                <h3>Get in touch</h3>
              </div>
              <div>
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="NAME" required>
              </div>
              <div>
                <label for="Email">Email</label>
                <input type="email" name="Email" placeholder="EMAIL" required>
              </div>
              <div>
                <label for="Subject">Subject</label>
                <input type="text" name="Subject" placeholder="SUBJECT" required>
              </div>
              <div>
                <label for="Text">Your message</label>
                <textarea type="text" name="Text" placeholder="WRITE SOMETHING" required></textarea>
              </div>
              <div>
                <input type="submit" value="send">
              </div>
            </form> 
            <?php if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['Email'];
                $subject = $_POST['Subject'];
                $message = $_POST['Text'];

                $to = 'wynssimonw@gmail.com';
                $subject = 'Contact Form Submission';
                $message =
                    'Name: ' .
                    $name .
                    "\n" .
                    'Email: ' .
                    $email .
                    "\n" .
                    'Subject: ' .
                    $subject .
                    "\n" .
                    'Message: ' .
                    $message;
                $headers = 'From: ' . $email;

                if (mail($to, $subject, $message, $headers)) {
                    echo '<p>Your message has been sent! We will contact you as soon as possible.</p>';
                } else {
                    echo '<p>There was an error sending your message. Please try again.</p>';
                }
            } ?>

        </div>
</main>
    <?php include '../includes/footer.php'; ?>
  </body>
</html>

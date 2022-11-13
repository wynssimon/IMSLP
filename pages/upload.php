<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'config.php';
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
            <?php } ?>          <a href="about.php">About</a>
      </nav>
    </header>
    <main>
     <?php
     if (isset($_GET['action']) and $_GET['action'] == 'add') {
         if (
             isset($_SESSION['users_ID']) &&
             isset($_SESSION['users_username'])
         ) {
             echo ' Hey ' . $_SESSION['users_username'];
         } ?>    
      <div>
         <form method='post' action='upload.php?action=add'>
          <input type="hidden" name="action" value="insert">  
         <?php
         $query =
             'SELECT `sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`, `sheets_instrument2` FROM `imslp_sheets` WHERE 1';
         $result = $conn->query($query);
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $thisTitle = $row['sheets_title'];
                 $thisComposer = $row['sheets_composer'];
                 $thisGenre = $row['sheets_genre'];
                 $thisInstrument1 = $row['sheets_instrument1'];
                 $thisInstrument2 = $row['sheets_instrument2'];
                 echo "
                <div>
                    <p>$thisComposer - $thisTitle - $thisGenre - $thisInstrument1, $thisInstrument2</p>
                </div>
              ";
             }
         }
         ?>  
          <input type='text' name='title' class='textInput' placeholder='song title'>
          <input type='text' name='composer' class='textInput' placeholder='composer'>
          <input type='text' name='genre' class='textInput' placeholder='genre'>
          <input type='text' name='instrument1' class='textInput' placeholder='instrument1'>
          <input type='text' name='instrument2' class='textInput' placeholder='instrument2'>
          <input type='submit' name='submit' value='Add'>
        </form>
      </div>

    <?php
     }
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         if ($_POST['action'] == 'insert') {
             $getTitle = $_POST['title'];
             $getComposer = $_POST['composer'];
             $getGenre = $_POST['genre'];
             $getInstrument1 = $_POST['instrument1'];
             $getInstrument2 = $_POST['instrument2'];
             $query = "INSERT INTO `imslp_sheets`(`sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`, `sheets_instrument2`) VALUES ('$getTitle', '$getComposer', '$getGenre', '$getInstrument1', '$getInstrument2')";
             $result = $conn->query($query);
         }
     }
     ?>    
    </main>
  </body>
</html>

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
          <a href="login.php">Login</a>
          <a href="about.php">About</a>
      </nav>
    </header>
    <main>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include './config.php';
    ?>
     <?php
     $query = 'SELECT * FROM `imslp_sheets` WHERE 1';
     $result = $conn->query($query);
     if ($result->num_rows > 0) {
         // output data of each row
         while ($row = $result->fetch_assoc()) {
             $thisTitle = $row['sheets_title'];
             $thisComposer = $row['sheets_composer'];
             $thisGenre = $row['sheets_genre'];
             $thisInstrument = $row['sheets_instrument'];
             $thisInstrument2 = $row['sheets_instrument2'];
             echo "
                <div class='filterDiv'>
                    <p>$thisComposer - $thisTitle</p>
                </div>
              ";
         }
     }
     ?>
         <?php
         if (isset($_GET['action']) and $_GET['action'] == 'add') { ?>

    <div>
        <form action="post" action="add">
            <input type='text' name='title' class='textInput' placeholder='song title'>
            <input type='text' name='composer' class='textInput' placeholder='composer'>
            <input type='submit' name='submit' value='Add'>
        </form>
    </div>
  
    <?php }
         //check if posted and Insert
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             if ($_POST['action'] == 'insert') {
                 $getTitle = $_POST['title']; //as defined in form
                 $getComposer = $_POST['composer']; //as defined in form

                 $query = "INSERT INTO `imslp_sheets`(`sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument`, `sheets_instrument2`, `sheets_instrument3`, `sheets_difficulty`, `sheets_file`, `sheets_pdf`) VALUES ($getTitle, $getComposer)";
                 $result = $conn->query($query);
             }
         }
         ?>    
    </main>
  </body>
</html>

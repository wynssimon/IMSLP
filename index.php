<?php
session_start();

if (isset($_GET['success'])) {
    echo 'You are now logged in';
} elseif (isset($_GET['logout'])) {
    session_destroy();
} elseif (isset($_GET['invalid'])) {
    echo 'Invalid username or password';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/reset.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/sheetsresults.css" />
    <title>IMSLP</title>
  </head>
  <body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include './pages/config.php';
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'logout') {
            include './pages/logout.php';
        }
    }
    session_start();
    ?>
    <main>
    <header>
        <h1>IMSLP</h1>
        <nav>        
            <a href="index.php">Home</a>
            <a href="pages/subscription.php">Subscription</a>
            <?php if (
                isset($_SESSION['users_ID']) &&
                isset($_SESSION['users_username'])
            ) { ?>
            <a href='./pages/logout.php?action=logout'>Logout</a>
            <a href='./pages/upload.php?action=add'>Insert</a>
            <?php } else { ?>
            <a href="pages/login.php">Login</a>
            <?php } ?>
            <a href="pages/about.php">About</a>
            <input type="text" id="myInput" placeholder="Search for music..." title="Type in a name" />
        </nav>
      </header>
      <?php if (
          isset($_SESSION['users_ID']) &&
          isset($_SESSION['users_username'])
      ) {
          echo 'Hey ' . $_SESSION['users_username'];
      } else {
          echo 'hoi je bent niet ingelogd';
      } ?>
      <div id="filters">
        <div id="myBtnContainer">
          <p class="titeltje">Genre</p>
          <?php
          $query = 'SELECT * FROM `imslp_genre` WHERE 1';
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $thisGenre = $row['imslp_genre'];
                  echo "<input type='button' class='btn' id='btn' value='$thisGenre'/>";
              }
          }
          ?>
        </div>
        <div id="myBtnContainer">
          <p class="titeltje">Genre</p>
          <?php
          $query = 'SELECT * FROM `imslp_composers` WHERE 1';
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $thisComposer = $row['imslp_composers'];
                  echo "<input type='button' class='btn' id='btn' value='$thisComposer'/>";
              }
          }
          ?>
        </div>
        <div>
          <p class="titeltje">Instruments</p>
          <label class="checkbox">
            <input class="check" data-filter="piano" type="checkbox" name="checkbox" />
            Piano
          </label>
          <label class="checkbox">
            <input class="check" data-filter="accordion" type="checkbox" name="checkbox" />
            Accordion
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Violin
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Cello
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Trumpet
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Flute
          </label>
        </div>
      </div>
      <div class="container" id="myUL">
      <?php
      $query = 'SELECT * FROM `imslp_sheets`';
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {

              $thisTitle = $row['sheets_title'];
              $thisComposer = $row['sheets_composer'];
              $thisGenre = $row['sheets_genre'];
              $thisInstrument1 = $row['sheets_instrument1'];
              $thisInstrument2 = $row['sheets_instrument2'];
              $thisInstrument3 = $row['sheets_instrument3'];
              $thisInstrument4 = $row['sheets_instrument4'];
              $thisInstrument5 = $row['sheets_instrument5'];
              $thisArrangement = $row['sheets_arrangement'];
              $thisDifficulty = $row['sheets_difficulty'];
              isset($_SESSION['sheet_img']);
              ?>
                <div class='filterDiv'>
                  <div class='titel'>
                    <h2><?php echo "$thisComposer - $thisTitle"; ?></h2>
                  </div>
                  <div class='genre'>
                    <h3>Genre</h3>
                    <p><?php echo "$thisGenre"; ?></p>
                  </div>
                  <div class='instruments'>
                    <h3>Instruments</h3>
                    <p><?php echo "$thisInstrument1"; ?></p>
                    <p><?php echo "$thisInstrument2"; ?></p>
                  </div>
                  <div class='arrangement'>
                    <h3>Arrangement</h3>
                    <p><?php echo "$thisArrangement"; ?></p>
                  </div>
                  <div class='difficulty'>
                    <h3>Difficulty</h3>
                    <p><?php echo "$thisDifficulty"; ?></p>
                  </div>
                  <div class='naarsheet'>
                    <a href='./pages/sheet.php'><button>Naar sheet</button></a>
                  </div>
                  <div class='sheet'>
                    <img src="images/ <?php.
                  $_SESSION['sheets_img'] . ?>"></img>
                  </div>
                </div><?php
          }
      }
      ?>
      </div>
    </main>    
  <script src="scripts/script.js"></script>
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'pages/config.php';
session_start();
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
    <title>Sheetly</title>
  </head>
  <body>
    <input type="text" id="myInput" placeholder="Search for music..." title="Type in a name" />  
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn">Genre</button>
      <div id="myDropdown" class="dropdown-content">
        <?php
        $query = 'SELECT * FROM `imslp_genre` WHERE 1';
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thisGenre = $row['imslp_genre'];
                echo "<input type='button' id='btn' value='$thisGenre'/>";
            }
        }
        ?>
      </div>
    </div>
    <div class="dropdown">
      <button onclick="myFunction2()" class="dropbtn">Composer</button>
      <div id="myDropdown1" class="dropdown-content">
        <?php
        $query = 'SELECT * FROM `imslp_composers` WHERE 1';
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thisComposer = $row['imslp_composers'];
                echo "<input type='button' id='btn' value='$thisComposer'/>";
            }
        }
        ?>
      </div>
    </div>   
    <main>
      <?php
      include 'includes/headerHome.php';
      if (isset($_SESSION['users_username'])) {
          echo 'Hey ' . $_SESSION['users_username'];
      } else {
          echo 'hoi je bent niet ingelogd';
      }
      ?>
      <div class='products-container'>
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
              $thisSheet = $row['sheets_img'];
              ?>
              <div class='shop-card'>
                <div class="title">
                  <?php echo "$thisComposer $thisTitle"; ?>    
                </div>
                <div class="desc">
                  <?php echo "$thisGenre"; ?> |
                  <?php echo "$thisInstrument1"; ?>
                  <?php echo "$thisInstrument2"; ?> |
                  <?php echo "$thisArrangement"; ?> |
                  <?php echo "$thisDifficulty"; ?>
                </div>
                <div class="product">
                  <img src="img/<?php echo "$thisSheet"; ?>"></img>
                </div>
              </div>
      <?php
          }
      }
      ?>
    </div>
    </main>    
  <script src="scripts/script.js"></script>
  </body>
</html>

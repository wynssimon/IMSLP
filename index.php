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
    <link rel="stylesheet" href="styles/sheetsresults.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <title>Sheetly</title>
  </head>
  <body>
    <?php include 'includes/headerHome.php'; ?>
    <main class="main">
    <div id="filters">
      <input type="text" id="myInput" placeholder="Search for music..." title="Type in a name" />  
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Genre</button>
        <div id="myDropdown" class="dropdown-content">
          <input type="button" id='all' value='All'>
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
          <input type="button" id='all' value='All'>
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
      <div class="dropdown">
        <button onclick="myFunction4()" class="dropbtn">Instruments</button>
        <div id="myDropdown2" class="dropdown-content">
          <input type="button" id='all' value='All'>
          <?php
          $query = 'SELECT * FROM `imslp_instruments` WHERE 1';
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $thisInstrument = $row['imslp_instruments'];
                  echo "<input type='button' id='btn' value='$thisInstrument'/>";
              }
          }
          ?>
        </div>
      </div>  
    </div>
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
              $thisSheetXml = $row['sheets_xml'];
              ?>
              <div onclick="window.location='./pages/sheet.php?sheet=<?php echo $thisSheetXml; ?>'" class='shop-card'>
                <div class="title">
                  <?php echo "$thisTitle"; ?> <br> 
                  <div class="ondertitel"><?php echo "$thisComposer"; ?></div>      
                </div>
                <div class="product">
                  <img src="img/<?php echo "$thisSheet"; ?>"></img>
                </div>
                <div class="desc">
                  <div>
                    <?php echo "$thisGenre"; ?>
                  </div>
                  <div>
                    <?php if ($thisInstrument1 == 'Accordion') {
                        echo "<img class='instrument' src='img/accordeon.png'>";
                    } elseif ($thisInstrument1 == 'Violin') {
                        echo "<img class='instrument' src='img/violin.png'>";
                    } elseif ($thisInstrument1 == 'Piano') {
                        echo "<img class='instrument' src='img/piano.png'>";
                    } elseif ($thisInstrument1 == 'Saxophone') {
                        echo "<img class='instrument' src='img/saxophone.png'>";
                    } elseif ($thisInstrument1 == 'Trumpet') {
                        echo "<img class='instrument' src='img/trumpet.png'>";
                    } ?>
                    <?php
                    if ($thisInstrument2 == 'Accordion') {
                        echo "<img class='instrument' src='img/accordeon.png'>";
                    } elseif ($thisInstrument2 == 'Violin') {
                        echo "<img class='instrument' src='img/violin.png'>";
                    } elseif ($thisInstrument2 == 'Piano') {
                        echo "<img class='instrument' src='img/piano.png'>";
                    } elseif ($thisInstrument2 == 'Saxophone') {
                        echo "<img class='instrument' src='img/saxophone.png'>";
                    } elseif ($thisInstrument2 == 'Trumpet') {
                        echo "<img class='instrument' src='img/trumpet.png'>";
                    }
                    echo "<p class='onzichtbaar'>$thisInstrument1$thisInstrument2</p>";
                    ?>
                    
                  </div>
                  <div>
                    <?php echo "$thisArrangement"; ?>
                  </div>
                  <div>
                    <?php if ($thisDifficulty == '1') {
                        echo "<img class='solsleutel' src='img/solsleutel.png'>";
                    } elseif ($thisDifficulty == '2') {
                        echo "
                        <img class='solsleutel' src='img/solsleutel.png'>
                        <img class='solsleutel' src='img/solsleutel.png'>
                        ";
                    } elseif ($thisDifficulty == '3') {
                        echo "
                        <img class='solsleutel' src='img/solsleutel.png'>
                        <img class='solsleutel' src='img/solsleutel.png'>
                        <img class='solsleutel' src='img/solsleutel.png'>";
                    } elseif ($thisDifficulty == '4') {
                        echo "
                        <img class='solsleutel' src='img/solsleutel.png'>
                        <img class='solsleutel' src='img/solsleutel.png'>
                        <img class='solsleutel' src='img/solsleutel.png'>
                        <img class='solsleutel' src='img/solsleutel.png'>";
                    } ?>
                  </div>
                </div>

              </div>
      <?php
          }
      }
      ?>
    </div>
    <script src="scripts/script.js"></script>
    </main>    
  </body>
</html>

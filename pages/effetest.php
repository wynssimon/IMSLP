<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'config.php';
session_start();
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
    <link rel="stylesheet" href="../styles/text.css" />
    <title>Sheetly</title>
  </head>
  <body>  
  <form method="post">
    <select name="genre">
        <option value="">Genre</option>
        <?php
        $query = 'SELECT * FROM `imslp_genre` WHERE 1';
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thisGenre = $row['genre'];
                echo "<option value='$thisGenre'>$thisGenre</option>";
            }
        }
        ?>
    </select>
    <select name="instrument">
        <option value="">Instrument</option>
        <?php
        $query = 'SELECT * FROM `imslp_instruments` WHERE 1';
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thisInstrument = $row['instruments'];
                echo "<option value='$thisInstrument'>$thisInstrument</option>";
            }
        }
        ?>
    </select>
    <select name="composer">
        <option value="">Composer</option>
        <?php
        $query = 'SELECT * FROM `imslp_composers` WHERE 1';
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thisComposer = $row['composers'];
                echo "<option value='$thisComposer'>$thisComposer</option>";
            }
        }
        ?>
    </select>
    <button type="submit">Filter</button>
</form>
  <?php
  $query =
      'SELECT `sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`, `sheets_arrangement` FROM `imslp_sheets`,`imslp_genre` WHERE `sheets_genre_ID`=`genre_ID`';
  $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);
  $instrument = filter_input(
      INPUT_POST,
      'instrument',
      FILTER_SANITIZE_SPECIAL_CHARS
  );
  $composer = filter_input(
      INPUT_POST,
      'composer',
      FILTER_SANITIZE_SPECIAL_CHARS
  );

  if (!empty($genre)) {
      $query .= " AND `sheets_genre` = '$genre'";
  }

  if (!empty($instrument)) {
      $query .= " AND `sheets_instrument1` = '$instrument'";
  }
  if (!empty($composer)) {
      $query .= " AND `sheets_composer` = '$composer'";
  }
  $result = $conn->query($query);
  if (!empty($genre || $instrument || $composer)) {
      echo "Filter<br>$genre<br>$instrument<br>$composer";
  }
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $thisTitle = $row['sheets_title'];
          $thisComposer = $row['sheets_composer'];
          $thisGenre = $row['sheets_genre'];
          $thisInstrument = $row['sheets_instrument1'];
          $thisArrangement = $row['sheets_arrangement'];

          if (strlen($thisComposer) > 23) {
              $thisComposer = substr($thisComposer, 0, 23) . '...';
          }

          echo "<h2>$thisComposer</h2>";
          echo "<p>$thisTitle - $thisGenre - $thisInstrument</p>";
      }
  }
  ?>
  </body>
</html>

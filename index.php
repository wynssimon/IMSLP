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
        <?php if (isset($_SESSION['users_permissions'])) {
            if ($_SESSION['users_permissions'] == 1) {
                $current_date_timestamp = strtotime(date('Y-m-d'));
                $permissions_start_timestamp = strtotime(
                    $_SESSION['users_permissions_start']
                );
                $diff = $current_date_timestamp - $permissions_start_timestamp;

                if ($diff > 2592000) {
                    $query = "UPDATE imslp_users SET users_permissions = 0, users_permissions_start = DEFAULT WHERE users_ID = {$_SESSION['users_ID']}";
                    $result = mysqli_query($conn, $query);
                } else {
                }
            } elseif ($_SESSION['users_permissions'] == 2) {
                $current_date_timestamp = strtotime(date('Y-m-d'));
                $permissions_start_timestamp = strtotime(
                    $_SESSION['users_permissions_start']
                );
                $diff2 = $current_date_timestamp - $permissions_start_timestamp;
                if ($diff2 > 31536000) {
                    $query = "UPDATE imslp_users SET users_permissions = 0, users_permissions_start = DEFAULT WHERE users_ID = {$_SESSION['users_ID']}";
                    $result = mysqli_query($conn, $query);
                } else {
                }
            }
        } ?>
        <form id="filters" method="post">
            <input type="text" id="myInput" placeholder="Search for music..." title="Type in a name" />  
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
            <select name="arrangement">
                <option value="">Arrangement</option>
                <?php
                $query = 'SELECT * FROM `imslp_arrangements` WHERE 1';
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $thisArrangement = $row['arrangement'];
                        echo "<option value='$thisArrangement'>$thisArrangement</option>";
                    }
                }
                ?>
            </select>
            <select name="difficulty">
                <option value="">Difficulty</option>
                <?php
                $query = 'SELECT * FROM `imslp_difficulty` WHERE 1';
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $thisDifficulty = $row['difficulty'];
                        $thisDifficultyId = $row['difficulty_ID'];
                        echo "<option value='$thisDifficultyId'>$thisDifficulty</option>";
                    }
                }
                ?>
            </select>
            <button type="submit">Filter</button>
        </form>
        <?php
        $query =
            'SELECT `sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`,`sheets_instrument2`, `sheets_arrangement`, `sheets_difficulty`, `sheets_img`, `sheets_xml`, `sheets_id` FROM `imslp_sheets`,`imslp_genre` WHERE `sheets_genre_ID`=`genre_ID`';
        $genre = filter_input(
            INPUT_POST,
            'genre',
            FILTER_SANITIZE_SPECIAL_CHARS
        );
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
        $arrangement = filter_input(
            INPUT_POST,
            'arrangement',
            FILTER_SANITIZE_SPECIAL_CHARS
        );
        $difficulty = filter_input(
            INPUT_POST,
            'difficulty',
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
        if (!empty($arrangement)) {
            $query .= " AND `sheets_arrangement` = '$arrangement'";
        }
        if (!empty($difficulty)) {
            $query .= " AND `sheets_difficulty` = '$difficulty'";
        }
        $result = $conn->query($query);
        if (!empty($genre || $instrument || $composer)) {
            echo 'Filters:<br>';
            if (!empty($genre)) {
                echo "$genre<br>";
            }
            if (!empty($instrument)) {
                echo "$instrument<br>";
            }
            if (!empty($composer)) {
                echo "$composer";
            }
            if (!empty($arrangement)) {
                echo "$arrangement";
            }
            if (!empty($difficulty)) {
                echo "$difficulty";
            }
        }
        ?>
        <div class='products-container grid' id="alles">
        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $thisTitle = $row['sheets_title'];
                $thisComposer = $row['sheets_composer'];
                $thisGenre = $row['sheets_genre'];
                $thisInstrument1 = $row['sheets_instrument1'];
                $thisInstrument2 = $row['sheets_instrument2'];
                /*$thisInstrument3 = $row['sheets_instrument3'];
                $thisInstrument4 = $row['sheets_instrument4'];
                $thisInstrument5 = $row['sheets_instrument5'];*/
                $thisArrangement = $row['sheets_arrangement'];
                $thisDifficulty = $row['sheets_difficulty'];
                $thisSheet = $row['sheets_img'];
                $thisSheetXml = $row['sheets_xml'];
                $thisSheetID = $row['sheets_id'];

                if (strlen($thisTitle) > 19) {
                    $thisTitle = substr($thisTitle, 0, 19) . '...';
                }
                ?>  <div onclick="window.location='./pages/sheet.php?id=<?php echo $thisSheetID; ?>'" class='shop-card'>
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
                            } elseif ($thisInstrument1 == 'Flute') {
                                echo "<img class='instrument' src='img/flute.png'>";
                            } elseif ($thisInstrument1 == 'Guitar') {
                                echo "<img class='instrument' src='img/guitar.png'>";
                            } elseif ($thisInstrument1 == 'Horn') {
                                echo "<img class='instrument' src='img/french-horn.png'>";
                            } elseif ($thisInstrument1 == 'Clarinet') {
                                echo "<img class='instrument' src='img/clarinet.png'>";
                            } ?>
                            <?php if ($thisInstrument2 == 'Accordion') {
                                echo "<img class='instrument' src='img/accordeon.png'>";
                            } elseif ($thisInstrument2 == 'Violin') {
                                echo "<img class='instrument' src='img/violin.png'>";
                            } elseif ($thisInstrument2 == 'Piano') {
                                echo "<img class='instrument' src='img/piano.png'>";
                            } elseif ($thisInstrument2 == 'Saxophone') {
                                echo "<img class='instrument' src='img/saxophone.png'>";
                            } elseif ($thisInstrument2 == 'Trumpet') {
                                echo "<img class='instrument' src='img/trumpet.png'>";
                            } elseif ($thisInstrument2 == 'Flute') {
                                echo "<img class='instrument' src='img/flute.png'>";
                            } elseif ($thisInstrument2 == 'Guitar') {
                                echo "<img class='instrument' src='img/guitar.png'>";
                            } elseif ($thisInstrument2 == 'Horn') {
                                echo "<img class='instrument' src='img/french-horn.png'>";
                            } elseif ($thisInstrument2 == 'Clarinet') {
                                echo "<img class='instrument' src='img/clarinet.png'>";
                            } ?>       
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
        } ?>
        </div>
  </main>
  </body>
  <script src="scripts/script.js"></script>
</html>

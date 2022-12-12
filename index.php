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
            'SELECT `sheets_title`,`sheets_genre_ID`, `sheets_instrument1`,`sheets_instrument2`, `sheets_difficulty`, `sheets_img`, `sheets_xml`, `sheets_id`, `difficulty`, `genre`, `arrangement`, `composers`, `instruments`, `instruments2`, `instruments3`, `instruments4`, `instruments5` FROM `imslp_sheets`,`imslp_genre`, `imslp_difficulty`, `imslp_arrangements`, `imslp_composers`, `imslp_instruments`, `imslp_instruments2`, `imslp_instruments3`, `imslp_instruments4`, `imslp_instruments5` WHERE `sheets_genre_ID`=`genre_ID` AND `sheets_difficulty`=`difficulty_ID` AND `sheets_arrangement_ID`=`arrangement_ID` AND`sheets_composer_ID`=`composers_ID` AND `sheets_instrument1`=`instruments_ID` AND `sheets_instrument2`=`instruments2_ID` AND `sheets_instrument3`=`instruments3_ID`AND `sheets_instrument4`=`instruments4_ID`AND `sheets_instrument5`=`instruments5_ID`';
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
            $query .= " AND `genre` = '$genre'";
        }

        if (!empty($instrument)) {
            $query .= " AND `instruments` = '$instrument'";
        }
        if (!empty($composer)) {
            $query .= " AND `composers` = '$composer'";
        }
        if (!empty($arrangement)) {
            $query .= " AND `arrangement` = '$arrangement'";
        }
        if (!empty($difficulty)) {
            $query .= " AND `difficulty_ID` = '$difficulty'";
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
        <button id="changeDisplay">Change display</button>    
        <div class='products-container grid' id="alles">
        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $thisTitle = $row['sheets_title'];
                $thisComposer = $row['composers'];
                $thisGenre = $row['genre'];
                $thisInstrument = $row['instruments'];
                $thisInstrument2 = $row['instruments2'];
                $thisInstrument3 = $row['instruments3'];
                $thisInstrument4 = $row['instruments4'];
                $thisInstrument5 = $row['instruments5'];
                $thisArrangement = $row['arrangement'];
                $thisDifficulty = $row['difficulty'];
                $thisSheet = $row['sheets_img'];
                $thisSheetXml = $row['sheets_xml'];
                $thisSheetID = $row['sheets_id'];

                if (strlen($thisTitle) > 17) {
                    $thisTitle = substr($thisTitle, 0, 17) . '...';
                }
                ?>  <div onclick="window.location='./pages/sheet.php?id=<?php echo $thisSheetID; ?>'" class='shop-card'>
                        <div class="title">
                            <?php echo "$thisTitle"; ?> <br> 
                            <div class="ondertitel"><?php
                            echo "$thisComposer";
                            if (strlen($thisComposer) < 1) {
                                echo '<br>';
                            }
                            ?></div>      
                        </div>
                        <div class="product">
                            <img src="img/<?php echo "$thisSheet"; ?>"></img>
                        </div>
                        <div class="desc">
                            <div>
                            <?php echo "$thisGenre"; ?>
                            </div>
                            <div>
                            <?php if ($thisInstrument == 'Accordion') {
                                echo "<img class='instrument' src='img/accordeon.png'>";
                            } elseif ($thisInstrument == 'Violin') {
                                echo "<img class='instrument' src='img/violin.png'>";
                            } elseif ($thisInstrument == 'Piano') {
                                echo "<img class='instrument' src='img/piano.png'>";
                            } elseif ($thisInstrument == 'Saxophone') {
                                echo "<img class='instrument' src='img/saxophone.png'>";
                            } elseif ($thisInstrument == 'Trumpet') {
                                echo "<img class='instrument' src='img/trumpet.png'>";
                            } elseif ($thisInstrument == 'Flute') {
                                echo "<img class='instrument' src='img/flute.png'>";
                            } elseif ($thisInstrument == 'Guitar') {
                                echo "<img class='instrument' src='img/guitar.png'>";
                            } elseif ($thisInstrument == 'Horn') {
                                echo "<img class='instrument' src='img/french-horn.png'>";
                            } elseif ($thisInstrument == 'Clarinet') {
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
                            <?php if ($thisInstrument3 == 'Accordion') {
                                echo "<img class='instrument' src='img/accordeon.png'>";
                            } elseif ($thisInstrument3 == 'Violin') {
                                echo "<img class='instrument' src='img/violin.png'>";
                            } elseif ($thisInstrument3 == 'Piano') {
                                echo "<img class='instrument' src='img/piano.png'>";
                            } elseif ($thisInstrument3 == 'Saxophone') {
                                echo "<img class='instrument' src='img/saxophone.png'>";
                            } elseif ($thisInstrument3 == 'Trumpet') {
                                echo "<img class='instrument' src='img/trumpet.png'>";
                            } elseif ($thisInstrument3 == 'Flute') {
                                echo "<img class='instrument' src='img/flute.png'>";
                            } elseif ($thisInstrument3 == 'Guitar') {
                                echo "<img class='instrument' src='img/guitar.png'>";
                            } elseif ($thisInstrument3 == 'Horn') {
                                echo "<img class='instrument' src='img/french-horn.png'>";
                            } elseif ($thisInstrument3 == 'Clarinet') {
                                echo "<img class='instrument' src='img/clarinet.png'>";
                            } ?>       
                            <?php if ($thisInstrument4 == 'Accordion') {
                                echo "<img class='instrument' src='img/accordeon.png'>";
                            } elseif ($thisInstrument4 == 'Violin') {
                                echo "<img class='instrument' src='img/violin.png'>";
                            } elseif ($thisInstrument4 == 'Piano') {
                                echo "<img class='instrument' src='img/piano.png'>";
                            } elseif ($thisInstrument4 == 'Saxophone') {
                                echo "<img class='instrument' src='img/saxophone.png'>";
                            } elseif ($thisInstrument4 == 'Trumpet') {
                                echo "<img class='instrument' src='img/trumpet.png'>";
                            } elseif ($thisInstrument4 == 'Flute') {
                                echo "<img class='instrument' src='img/flute.png'>";
                            } elseif ($thisInstrument4 == 'Guitar') {
                                echo "<img class='instrument' src='img/guitar.png'>";
                            } elseif ($thisInstrument4 == 'Horn') {
                                echo "<img class='instrument' src='img/french-horn.png'>";
                            } elseif ($thisInstrument4 == 'Clarinet') {
                                echo "<img class='instrument' src='img/clarinet.png'>";
                            } ?>       
                            <?php if ($thisInstrument5 == 'Accordion') {
                                echo "<img class='instrument' src='img/accordeon.png'>";
                            } elseif ($thisInstrument5 == 'Violin') {
                                echo "<img class='instrument' src='img/violin.png'>";
                            } elseif ($thisInstrument5 == 'Piano') {
                                echo "<img class='instrument' src='img/piano.png'>";
                            } elseif ($thisInstrument5 == 'Saxophone') {
                                echo "<img class='instrument' src='img/saxophone.png'>";
                            } elseif ($thisInstrument5 == 'Trumpet') {
                                echo "<img class='instrument' src='img/trumpet.png'>";
                            } elseif ($thisInstrument5 == 'Flute') {
                                echo "<img class='instrument' src='img/flute.png'>";
                            } elseif ($thisInstrument5 == 'Guitar') {
                                echo "<img class='instrument' src='img/guitar.png'>";
                            } elseif ($thisInstrument5 == 'Horn') {
                                echo "<img class='instrument' src='img/french-horn.png'>";
                            } elseif ($thisInstrument5 == 'Clarinet') {
                                echo "<img class='instrument' src='img/clarinet.png'>";
                            } ?>       
                            </div>
                            <div>
                            <?php echo "$thisArrangement"; ?>
                            </div>
                            <div>
                            <?php if ($thisDifficulty == 'Beginner') {
                                echo "<img class='solsleutel' src='img/solsleutel.png'>";
                            } elseif ($thisDifficulty == 'Amateur') {
                                echo "
                                <img class='solsleutel' src='img/solsleutel.png'>
                                <img class='solsleutel' src='img/solsleutel.png'>
                                ";
                            } elseif ($thisDifficulty == 'Intermediate') {
                                echo "
                                <img class='solsleutel' src='img/solsleutel.png'>
                                <img class='solsleutel' src='img/solsleutel.png'>
                                <img class='solsleutel' src='img/solsleutel.png'>";
                            } elseif ($thisDifficulty == 'Advanced') {
                                echo "
                                <img class='solsleutel' src='img/solsleutel.png'>
                                <img class='solsleutel' src='img/solsleutel.png'>
                                <img class='solsleutel' src='img/solsleutel.png'>
                                <img class='solsleutel' src='img/solsleutel.png'>";
                            } elseif ($thisDifficulty == 'Expert') {
                                echo "
                                <img class='solsleutel' src='img/solsleutel.png'>
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
  <script>
            let changeDisplay = document.getElementById('changeDisplay');
            let alles = document.getElementById('alles');

            changeDisplay.addEventListener("click", () => {

                if (alles.classList.contains("grid")) {
                    alles.classList.add("list");
                    alles.classList.remove("grid");
                }
                else if (alles.classList.contains("list")) {
                    alles.classList.add("grid");
                    alles.classList.remove("list");
                }      
            });
        </script>
  <script src="scripts/script.js"></script>
</html>

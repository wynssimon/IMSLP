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
    <link rel="stylesheet" href="styles/headers.css" />
    <link rel="stylesheet" href="styles/sheetsresults.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <title>Sheetly</title>
  </head>
  <body>
    <?php include 'includes/header.php'; ?>
    <main class="main">
        <?php
        if (isset($_SESSION['users_permissions'])) {
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
        }

        // checken of vorige keer al een bepaalde filter is toegepast en deze onthouden
        if (isset($_POST['genre']) && !empty($_POST['genre'])) {
            $_SESSION['genre'] = $_POST['genre'];
        }
        if (isset($_POST['instrument']) && !empty($_POST['instrument'])) {
            $_SESSION['instrument'] = $_POST['instrument'];
        }
        if (isset($_POST['amount']) && !empty($_POST['amount'])) {
            $_SESSION['amount'] = $_POST['amount'];
        }
        if (isset($_POST['difficulty']) && !empty($_POST['difficulty'])) {
            $_SESSION['difficulty'] = $_POST['difficulty'];
        }
        if (isset($_POST['composer']) && !empty($_POST['composer'])) {
            $_SESSION['composer'] = $_POST['composer'];
        }
        if (isset($_POST['arrangement']) && !empty($_POST['arrangement'])) {
            $_SESSION['arrangement'] = $_POST['arrangement'];
        }
        if (isset($_POST['reset'])) {
            unset($_SESSION['genre']);
            unset($_SESSION['instrument']);
            unset($_SESSION['amount']);
            unset($_SESSION['difficulty']);
            unset($_SESSION['composer']);
            unset($_SESSION['arrangement']);
        }
        if (isset($_POST['resetgenre'])) {
            unset($_SESSION['genre']);
        }
        if (isset($_POST['resetinstrument'])) {
            unset($_SESSION['instrument']);
        }
        if (isset($_POST['resetamount'])) {
            unset($_SESSION['amount']);
        }
        if (isset($_POST['resetdifficulty'])) {
            unset($_SESSION['difficulty']);
        }
        if (isset($_POST['resetcomposer'])) {
            unset($_SESSION['composer']);
        }
        if (isset($_POST['resetarrangement'])) {
            unset($_SESSION['arrangement']);
        }
        ?>
        <div id="inputenbuttons">    
            <button id='showfilters'><img src='./img/filter.png'></button>
            <input type="text" id="myInput" placeholder="Search for music with a specific title, composer, genre, instrument,..." />  
            <button id="changeDisplay"><img id='row' src='./img/row.png'></button>    
        </div>
        <script>
         window.onload = function() {
            const filtersDiv = document.getElementById("filters");
            const showfilters = document.getElementById("showfilters");

            showfilters.addEventListener("click", function() {
                if (filtersDiv.style.left === "0%") {
                filtersDiv.style.left = "-20%";
                filtersDiv.style.transition = "left 0.5s ease-in-out";
                } else {
                filtersDiv.style.left = "0%";
                filtersDiv.style.transition = "left 0.5s ease-in-out";
                }
            });
            };
        </script>
        <form id="filters" method="post">
            <div id="allefilters">
               <button id="resetfilters" type="submit" name="reset" value="Reset">Reset</button> 
                <!-- genre filters -->
                <div class="checkboxen" >
                    <p onclick="toggleInstruments(event, '.checkbox-items-genre')">Genre ▼</p>                  
                    <div class="checkbox-items checkbox-items-genre">
                        <?php
                        $query = 'SELECT * FROM `imslp_genre` WHERE 1 ';
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $thisGenre = $row['genre']; ?>
                            <div><input onchange='this.form.submit()' name='genre' type='checkbox' value='<?php echo $thisGenre; ?>'<?php if (
    isset($_SESSION['genre']) &&
    $_SESSION['genre'] == $thisGenre
) {
    echo 'checked';
} ?>>
                            <p><?php echo $thisGenre; ?></p>
                            </div>
                            <?php
                            }
                        }
                        ?>
                    
                    </div>
                </div>
                 <!-- einde genre filters -->
                 <!-- instrument filters -->
                <div class="checkboxen">
                    <p onclick="toggleInstruments(event, '.checkbox-items-instruments')">Instruments ▼</p>
                    <div class="checkbox-items checkbox-items-instruments">
                        <?php
                        $query = 'SELECT * FROM `imslp_instruments` WHERE 1 ';
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $thisInstrument = $row['instruments']; ?>
                            <div><input onchange='this.form.submit()' name='instrument' type='checkbox' value='<?php echo $thisInstrument; ?>'<?php if (
    isset($_SESSION['instrument']) &&
    $_SESSION['instrument'] == $thisInstrument
) {
    echo 'checked';
} ?>>
                            <p><?php echo $thisInstrument; ?></p></div>
                            <?php
                            }
                        }
                        ?>
                    </div>  
                </div>
                <!-- einde instrument filters -->
                <!-- composers filters -->
                <div class="checkboxen">
                    <p onclick="toggleInstruments(event, '.checkbox-items-composers')">Composers ▼</p>
                    <div class="checkbox-items checkbox-items-composers">
                        <?php
                        $query =
                            'SELECT * FROM `imslp_composers` WHERE `composers` IS NOT NULL ';
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $thisComposer = $row['composers']; ?>
                            <div><input onchange='this.form.submit()' name='composer' type='checkbox' value='<?php echo $thisComposer; ?>'<?php if (
    isset($_SESSION['composer']) &&
    $_SESSION['composer'] == $thisComposer
) {
    echo 'checked';
} ?>>
                            <p><?php echo $thisComposer; ?></p></div>
                            <?php
                            }
                        }
                        ?>
                    </div>  
                </div>
                <!-- einde composers filters -->
                <!-- arrangement filters -->
                <div class="checkboxen">
                    <p onclick="toggleInstruments(event, '.checkbox-items-arrangement')">Arrangement ▼</p>
                    <div class="checkbox-items checkbox-items-arrangement">
                        <?php
                        $query = 'SELECT * FROM `imslp_arrangements` WHERE 1 ';
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $thisArrangement = $row['arrangement']; ?>
                            <div><input onchange='this.form.submit()' name='arrangement' type='checkbox' value='<?php echo $thisArrangement; ?>'<?php if (
    isset($_SESSION['arrangement']) &&
    $_SESSION['arrangement'] == $thisArrangement
) {
    echo 'checked';
} ?>>
                            <p><?php echo $thisArrangement; ?></p></div>
                            <?php
                            }
                        }
                        ?>
                    </div>  
                </div>
                <!-- einde arrangement filters -->
                <!-- difficulty filters -->
                <div class="checkboxen">
                    <p onclick="toggleInstruments(event, '.checkbox-items-difficulty')">Difficulty ▼</p>
                    <div class="checkbox-items checkbox-items-difficulty">
                        <?php
                        $query = 'SELECT * FROM `imslp_difficulty` WHERE 1 ';
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $thisDifficulty = $row['difficulty'];
                                $thisDifficultyId = $row['difficulty_ID'];
                                ?>
                            <div><input onchange='this.form.submit()' name='difficulty' type='checkbox' value='<?php echo $thisDifficultyId; ?>'<?php if (
    isset($_SESSION['difficulty']) &&
    $_SESSION['difficulty'] == $thisDifficultyId
) {
    echo 'checked';
} ?>>
                            <p><?php echo $thisDifficulty; ?></p></div>
                            <?php
                            }
                        }
                        ?>
                    </div>  
                </div>
                <!-- einde difficulty filters -->
                <!-- amount filters -->
                <div class="checkboxen">
                    <p onclick="toggleInstruments(event, '.checkbox-items-amount')">Amount ▼</p>
                    <div class="checkbox-items checkbox-items-amount">
                        <div><input onchange='this.form.submit()' name="amount" type="checkbox" value="1" <?php if (
                            isset($_SESSION['amount']) &&
                            $_SESSION['amount'] == 1
                        ) {
                            echo 'checked';
                        } ?>>Solo</input></div>
                            <div><input onchange='this.form.submit()' name="amount" type="checkbox" value="2"<?php if (
                                isset($_SESSION['amount']) &&
                                $_SESSION['amount'] == 2
                            ) {
                                echo 'checked';
                            } ?>>Duo</input></div>
                        <div><input onchange='this.form.submit()' name="amount" type="checkbox" value="3" <?php if (
                            isset($_SESSION['amount']) &&
                            $_SESSION['amount'] == 3
                        ) {
                            echo 'checked';
                        } ?>>Trio</input></div>
                        <div><input onchange='this.form.submit()' name="amount" type="checkbox" value="4" <?php if (
                            isset($_SESSION['amount']) &&
                            $_SESSION['amount'] == 4
                        ) {
                            echo 'checked';
                        } ?>>Quatro</input></div>
                    </div>
                </div>      
                <!-- einde amount filters -->
            </div>
        </form>
        <script>

                         function toggleInstruments(event, elementClass) {
                        // voorkomen dat de form al gesubmit wordt
                        event.preventDefault();

                        var instruments = document.querySelectorAll(elementClass);
                        for (var i = 0; i < instruments.length; i++) {
                            instruments[i].style.display = instruments[i].style.display === 'flex' ? 'none' : 'flex';
                        }
                        
                        var button = event.target;
                            if (button.textContent.includes('▼')) {
                                button.textContent = button.textContent.replace('▼', '▲');

                            } else {
                                button.textContent = button.textContent.replace('▲', '▼');
                            }
                            }

                        </script>
        <?php
        $query =
            'SELECT `sheets_title`,`sheets_genre_ID`, `sheets_instrument1`,`sheets_instrument2`, `sheets_difficulty`, `sheets_img`, `sheets_xml`, `sheets_id`, `sheets_amount`,`difficulty`, `genre`, `arrangement`, `composers`, `instruments`, `instruments2`, `instruments3`, `instruments4`, `instruments5` FROM `imslp_sheets`,`imslp_genre`, `imslp_difficulty`, `imslp_arrangements`, `imslp_composers`, `imslp_instruments`, `imslp_instruments2`, `imslp_instruments3`, `imslp_instruments4`, `imslp_instruments5` WHERE `sheets_genre_ID`=`genre_ID` AND `sheets_difficulty`=`difficulty_ID` AND `sheets_arrangement_ID`=`arrangement_ID` AND`sheets_composer_ID`=`composers_ID` AND `sheets_instrument1`=`instruments_ID` AND `sheets_instrument2`=`instruments2_ID` AND `sheets_instrument3`=`instruments3_ID`AND `sheets_instrument4`=`instruments4_ID`AND `sheets_instrument5`=`instruments5_ID`';
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
        $amount = filter_input(
            INPUT_POST,
            'amount',
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        if (isset($_SESSION['genre']) && !empty($_SESSION['genre'])) {
            $genre = $_SESSION['genre'];
            $query .= " AND `genre` = '$genre'";
        }
        // controleren of instrument sessie is gestrart geweest
        if (isset($_SESSION['instrument']) && !empty($_SESSION['instrument'])) {
            $instrument = $_SESSION['instrument'];
            $query .= " AND (`instruments` = '$instrument' OR `instruments2` = '$instrument' OR `instruments3` = '$instrument' OR `instruments4` = '$instrument' OR `instruments5` = '$instrument')";
        }

        // controleren of aantal instrumenten sessie is gestrart geweest
        if (isset($_SESSION['amount']) && !empty($_SESSION['amount'])) {
            $amount = $_SESSION['amount'];
            $query .= " AND `sheets_amount` = '$amount'";
        }
        // controleren of moeilijkheid sessie is gestrart geweest
        if (isset($_SESSION['difficulty']) && !empty($_SESSION['difficulty'])) {
            $difficulty = $_SESSION['difficulty'];
            $query .= " AND `difficulty_id` = '$difficulty'";
        }

        // controleren of componist sessie is gestrart geweest
        if (isset($_SESSION['composer']) && !empty($_SESSION['composer'])) {
            $composer = $_SESSION['composer'];
            $query .= " AND `composers` = '$composer'";
        }
        if (
            isset($_SESSION['arrangement']) &&
            !empty($_SESSION['arrangement'])
        ) {
            $arrangement = $_SESSION['arrangement'];
            $query .= " AND `arrangement` = '$arrangement'";
        }
        $query .= 'ORDER BY RAND()';
        $result = $conn->query($query);

        if (
            !empty(
                $genre ||
                    $instrument ||
                    $composer ||
                    $arrangement ||
                    $difficulty ||
                    $amount
            )
        ) {
            if (
                isset($_SESSION['genre']) ||
                isset($_SESSION['instrument']) ||
                isset($_SESSION['composer']) ||
                isset($_SESSION['arrangement']) ||
                isset($_SESSION['difficulty']) ||
                isset($_SESSION['amount'])
            ) {
                echo '<div id="toegepasteFilters">';
                if (!empty($genre)) {
                    echo "<div>
                <form method='post'>
                    <div>    
                        <p>$genre </p>
                    </div>
                    <button type='submit' name='resetgenre' value='Reset Genre'>x</button>
                </form></div>
                ";
                }
                if (!empty($instrument)) {
                    echo "<div>
                <form method='post'>
                     <div>
                        <p>$instrument </p>    
                    </div>    
                    <button type='submit' name='resetinstrument' value='Reset Instrument'>x</button>
                </form></div>
            ";
                }
                if (!empty($composer)) {
                    echo "<div>
                <form method='post'>
                    <p>$composer</p>
                    <button type='submit' name='resetcomposer' value='Reset composer'>x</button>
                </form></div>";
                }
                if (!empty($arrangement)) {
                    echo "<div>
                <form method='post'>
                    <p>$arrangement</p>
                    <button type='submit' name='resetarrangement' value='Reset Arrangement'>x</button>
                </form></div>";
                }
                if (!empty($amount)) {
                    echo "<div>
                <form method='post'>
                    <p>$amount</p>
                    <button type='submit' name='resetamount' value='Reset Amount'>x</button>
                </form></div>";
                }
                if (!empty($difficulty)) {
                    if ($difficulty == 1) {
                        echo "
                        <form method='post'>
                            <p>Beginner</p>
                            <button type='submit' name='resetdifficulty' value='Reset Difficulty'>x</button>
                        </form>";
                    } elseif ($difficulty == 2) {
                        echo "             
                        <form method='post'>
                            <p>Amateur</p>
                            <button type='submit' name='resetdifficulty' value='Reset Difficulty'>x</button>
                        </form>";
                    } elseif ($difficulty == 3) {
                        echo "
                        <form method='post'>
                            <p>Intermediate</p>
                            <button type='submit' name='resetdifficulty' value='Reset Difficulty'>x</button>
                        </form>";
                    } elseif ($difficulty == 4) {
                        echo " 
                        <form method='post'>
                            <p>Advanced</p>
                            <button type='submit' name='resetdifficulty' value='Reset Difficulty'>x</button>
                        </form>";
                    } elseif ($difficulty == 5) {
                        echo "   
                        <form method='post'>
                            <p>Expert</p>
                            <button type='submit' name='resetdifficulty' value='Reset Difficulty'>x</button>
                        </form>";
                    }
                }
                echo '</div>';
            }
        }
        ?>
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
                //als de titel langer is dan 17 tekens en de composer niet leeg is dan wordt deze ingekort
                if (strlen($thisTitle) > 17 && !empty($thisComposer)) {
                    $thisTitle = substr($thisTitle, 0, 17) . '...';
                }
                ?>  <div onclick="window.location='./pages/sheet.php?id=<?php echo $thisSheetID; ?>'" class='shop-card'>
                        <div class="title">
                            <?php echo "$thisTitle"; ?> <br> 
                            <div class="ondertitel">
                                <!--Als de composer niet leeg is wordt deze gewoon getoond, als deze wel leeg is en de title is langer dan of exact 18 tekens dan gebeurt er niets maar wordt de titel gewoon op twee lijnen weergegeven dankzij de substr een paar lijnen hiervoor. En wanneer de composer leeg is en de title is korte dan 18 dan komt er een linebreak -->
                                <?php if (!empty($thisComposer)) {
                                    echo "$thisComposer";
                                } elseif (
                                    empty($thisComposer) &&
                                    strlen($thisTitle) >= 18
                                ) {
                                } else {
                                    echo '<br>';
                                } ?>
                            </div>      
                        </div>
                        <div class="product">
                            <img src="img/<?php echo "$thisSheet"; ?>"></img>
                        </div>
                        <div class="desc">
                            <div>
                            <?php echo "$thisGenre"; ?>
                            <?php echo "<div id='verberg'>$thisDifficulty</div>"; ?>
                            <?php echo "<div id='verberg'>$thisInstrument</div>"; ?>
                            <?php echo "<div id='verberg'>$thisInstrument2</div>"; ?>
                            <?php echo "<div id='verberg'>$thisInstrument3</div>"; ?>
                            <?php echo "<div id='verberg'>$thisInstrument4</div>"; ?>
                            <?php echo "<div id='verberg'>$thisInstrument5</div>"; ?>
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
                            <?php echo "<p class='arrangement'>$thisArrangement</p>"; ?>
                            </div>
                            <div>
                            <?php if ($thisDifficulty == 'Beginner') {
                                echo "<p class='difficulty beginner'>Beginner</p>";
                            } elseif ($thisDifficulty == 'Amateur') {
                                echo "
                                <p class='difficulty amateur'>Amateur</p>
                                ";
                            } elseif ($thisDifficulty == 'Intermediate') {
                                echo "
                                <p class='difficulty intermediate'>Intermediate</p>";
                            } elseif ($thisDifficulty == 'Advanced') {
                                echo "
                                <p class='difficulty advanced'>Advanced</p>";
                            } elseif ($thisDifficulty == 'Expert') {
                                echo "
                                <p class='difficulty expert'>Expert</p>";
                            } ?>
                            </div>
                        </div>
                    </div>
        <?php
            }
        } else {
            echo '<p>No results for your criteria</p>';
        } ?>
        </div>
  </main>
  </body>
  <script>
        let changeDisplay = document.getElementById('changeDisplay');
        let alles = document.getElementById('alles');
        let row = document.getElementById('row');

        if (sessionStorage.getItem('displayMode') === 'list') {
            alles.classList.add('list');
            alles.classList.remove('grid');
            row.src = "./img/menu.png";
        } else {
            alles.classList.add('grid');
            alles.classList.remove('list');
            row.src = './img/row.png';
        }

        changeDisplay.addEventListener("click", () => {
            if (alles.classList.contains("grid")) {
                alles.classList.add("list");
                alles.classList.remove("grid");
                row.src = "./img/menu.png";
                sessionStorage.setItem('displayMode', 'list');
            } else if (alles.classList.contains("list")) {
                alles.classList.add("grid");
                alles.classList.remove("list");
                row.src = './img/row.png';
                sessionStorage.setItem('displayMode', 'grid');
            }      
        });
    </script>

        <?php include './includes/footer.php'; ?>
  <script src="scripts/livesearch.js"></script>
</html>

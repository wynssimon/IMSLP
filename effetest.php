<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include './pages/config.php';
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
    <link rel="stylesheet" href="effetest.css" />
    <title>Sheetly</title>
  </head>
  <body>   
  <script src="effetest.js"></script>
  <div id="header">Header</div>

    <main class="main">
        <form action="#" method="post">
            <input type="checkbox" name="check_list[]" value="Piano"><label>Piano</label><br/>
            <input type="checkbox" name="check_list[]" value="Accordion"><label>Accordion</label><br/>
            <input type="checkbox" name="check_list[]" value="Violin"><label>Violin</label><br/>
            <input type="submit" name="submit" value="Submit"/>
        </form>
        <?php if (isset($_POST['submit'])) {
            if ($_POST['check_list']) {
                foreach ($_POST['check_list'] as $selected) {
                    echo $selected . '</br>';
                }
            }
            if ($selected == 'Accordion') {
                echo 'hoooooi';

                if (!empty($genre)) {
                    $query .= " AND `sheets_genre` = '$genre'";
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
                        $thisArrangement = $row['composers'];
                        echo "<option value='$thisArrangement'>$thisArrangement</option>";
                    }
                }
                ?>
            </select>
            <button type="submit">Filter</button>
        </form>
        <?php
        $query =
            'SELECT `sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`,`sheets_instrument2`, `sheets_arrangement`, `sheets_difficulty`, `sheets_img`, `sheets_xml` FROM `imslp_sheets`,`imslp_genre` WHERE `sheets_genre_ID`=`genre_ID`';
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
        if (!empty($genre)) {
            $query .= " AND `sheets_genre` = '$genre'";
        }

        if (!empty($instrument)) {
            $query .= " AND `sheets_instrument1` = '$instrument'";
        }
        if (!empty($composer)) {
            $query .= " AND `sheets_composer` = '$composer'";
        }
        echo "$query";
        $result = $conn->query($query);
        ?>
        <div class='products-container'>
        <?php
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
        }
        if ($result->num_rows > 0) {
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

                if (strlen($thisComposer) > 23) {
                    $thisComposer = substr($thisComposer, 0, 23) . '...';
                }
                ?>  <div onclick="window.location='./pages/sheet.php?sheet=<?php echo $thisSheetXml; ?>'" class='shop-card'>
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
        }
        ?>
        </div>
  </main>
  </body>
  <script src="scripts/script.js"></script>
</html>

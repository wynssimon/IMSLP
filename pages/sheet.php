<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include './config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheetly</title>
    <link rel="stylesheet" href="../styles/reset.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/sheet.css" />
</head>
<body>
    <?php include '../includes/headerSheet.php'; ?>
    <main>
        
        <?php if ($_SESSION['users_permissions'] == 0) {
            /* $id = $_SESSION['users_ID'];
            $query = "SELECT * FROM imslp_users WHERE users_ID = '$id'";
            $result = mysqli_query($conn, $query);

            $sql = "UPDATE SET users_watched = users_watched+1 WHERE users_ID = $id";*/
            $_SESSION['users_watched'] = $_SESSION['users_watched']
                ? $_SESSION['users_watched'] + 1
                : 1; ?>
            <!--<h3>Watched: <?php
            /*echo $_SESSION['users_watched']++; */
            ?></h3>-->
   <?php
        } ?>
        <?php if ($_SESSION['users_watched'] >= 6) {
            echo '<div class="tekst"><p></p>sorry you watched already 5 sheets today, come back tomorrow or take a subscription to watch as many sheets as you want</p></div>';
        } elseif (
            $_SESSION['users_watched'] < 6 ||
            $_SESSION['users_watched'] == null
        ) { ?>
            <script src="../scripts/opensheetmusicdisplay.min.js"></script>
            <div class="details">
            <?php
            $url = $_SERVER['REQUEST_URI'];
            $url_components = parse_url($url);
            parse_str($url_components['query'], $params);
            $id = $params['id'];
            //echo $id;

            $query =
                'SELECT * FROM `imslp_sheets`, `imslp_difficulty` WHERE `sheets_difficulty`=`difficulty_id`';
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $thisXmlSheet = $row['sheets_xml'];
                    $thisGenre = $row['sheets_genre'];
                    $thisTitle = $row['sheets_title'];
                    $thisComposer = $row['sheets_composer'];
                    $thisDifficulty = $row['difficulty'];
                    $thisId = $row['sheets_ID'];
                    if ($thisId === $id) {

                        echo 'Genre: ' . $thisGenre . '</br>';
                        echo 'Title: ' . $thisTitle . '</br>';
                        echo 'Composer: ' . $thisComposer . '</br>';
                        echo 'Difficulty: ' . $thisDifficulty . '</br>';
                        echo 'Genre: ' . $thisGenre . '</br>';
                        echo '<button href=' .
                            $thisXmlSheet .
                            '>' .
                            $thisXmlSheet .
                            '</button></br>';
                        ?>
                        <script> 
                            var xml='<?php echo $thisXmlSheet; ?>';
                        </script>
                        <?php
                    }
                }
            }
            ?>
            </div>
            <div id="osmdCanvas"></div>
            <script >    
                    var url_string = window.location.href; 
                    var url = new URL(url_string);
                    var sheet = url.searchParams.get("sheet");
                    var osmd = new opensheetmusicdisplay.OpenSheetMusicDisplay('osmdCanvas');
                    osmd.setOptions({
                    backend: 'svg',
                    drawTitle: true,
                    });
    
                    osmd.load('../xml/' + xml).then(function () {
                    osmd.render();
                    });       
            </script>
      <?php } ?>
     
    </main>
</body>
<script src="../scripts/fullscreen.js"></script>
</html>
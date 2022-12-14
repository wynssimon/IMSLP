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
    <link rel="stylesheet" href="../styles/headers.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/sheet.css" />
</head>
<body>
    <?php include '../includes/headerSheet.php'; ?>
    <main>
        
        <?php if (isset($_SESSION['users_ID'])) {

            //echo $_SESSION['users_ID'];

            $query = "INSERT INTO imslp_watched (id, watched_ID, watched) VALUES (NULL, {$_SESSION['users_ID']}, NOW() )";
            $result = mysqli_query($conn, $query);
            $currentDate = date('Y-m-d');
            $query4 = "DELETE FROM imslp_watched WHERE watched != '$currentDate'";
            $result4 = mysqli_query($conn, $query4);
            ?>

        <?php
        $currentDate = date('Y-m-d');
        $query2 = "SELECT `watched_ID`, `watched` FROM imslp_watched WHERE watched_ID = {$_SESSION['users_ID']} && watched = '$currentDate'";
        $result2 = mysqli_query($conn, $query2);
        $row = mysqli_fetch_assoc($result2);
        $watched = $row['watched'];

        $query3 = "SELECT COUNT(*) FROM imslp_watched WHERE watched_ID = {$_SESSION['users_ID']} && watched = '$currentDate'";
        $result3 = mysqli_query($conn, $query3);
        $count = mysqli_fetch_row($result3)[0];
        $users_permissions = $_SESSION['users_permissions'];

        if (($count >= 6) & ($users_permissions == 0)) {
            echo '<div class="tekst"><p>sorry you watched already 5 sheets today, come back tomorrow or take a subscription to watch as many sheets as you want</p></div>';
        } elseif (
            $count < 6 ||
            $count == null ||
            $users_permissions == 1 ||
            $users_permissions == 2 ||
            $users_permissions == 3
        ) { ?>
            <script src="../scripts/opensheetmusicdisplay.min.js"></script>
            <div class="details">
            <?php
            $url = $_SERVER['REQUEST_URI'];
            $url_components = parse_url($url);
            parse_str($url_components['query'], $params);
            $id = $params['id'];

            $query =
                'SELECT * FROM `imslp_sheets`, `imslp_difficulty`, `imslp_genre`, `imslp_composers` WHERE `sheets_difficulty`=`difficulty_id` AND `sheets_genre_ID`=`genre_ID` AND `sheets_composer_ID`=`composers_ID`';
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $thisXmlSheet = $row['sheets_xml'];
                    $thisGenre = $row['genre'];
                    $thisTitle = $row['sheets_title'];
                    $thisComposer = $row['composers'];
                    $thisDifficulty = $row['difficulty'];
                    $thisId = $row['sheets_ID'];
                    $thisPdfSheet = $str = str_replace(
                        'musicxml',
                        'pdf',
                        $thisXmlSheet
                    );
                    if ($thisId === $id) {
                        /*echo '<p>Title: ' .
                            $thisTitle .
                            '</br>
                        Composer: ' .
                            $thisComposer .
                            '</br>
                        Difficulty: ' .
                            $thisDifficulty .
                            '</br>
                        Genre: ' .
                            $thisGenre .
                            '</p></br>  */
                        echo '
                            <div class="beide">
                            <div class="wrapper">
                                <a href="../xml/' .
                            $thisXmlSheet .
                            '" download><span>Download XML</span></a>
                             </div>
                            <div class="wrapper">
                                <a href="../pdf/' .
                            $thisPdfSheet .
                            '" download><span>Download PDF</span></a>
                            </div>
                            </div>
                         '; ?>
                        <script> 
                            var xml='<?php echo $thisXmlSheet; ?>';
                        </script>
                        <script src="../scripts/fullscreen.js"></script>
                        <?php
                    }
                }
            }
            }

        } else {
            echo '<div class="tekst"><p>Make an account or log in to watch the sheets</p></div>';
        } ?>
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
      <?php  ?>
    </main>
</body>
</html>
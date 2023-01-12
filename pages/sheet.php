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
    <link rel="stylesheet" href="../styles/footer.css" />
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main" id="main">
        <?php if (isset($_SESSION['users_ID'])) {

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
            echo '<p>sorry you watched already 5 sheets today, come back tomorrow or take a subscription to watch as many sheets as you want</p>';
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
            ?>
          <?php
          $query2 = "SELECT SUM(rating_value) as total_rating, COUNT(*) as total_count FROM imslp_ratings WHERE `sheets_rating_ID`='$id'";
          $result2 = $conn->query($query2);
          $total_rating = 0;
          $total_count = 0;
          $userId = $_SESSION['users_ID'];
          $queryOwnchoice = "SELECT `rating_value` FROM imslp_ratings WHERE `rating_user_ID`='$userId' AND `sheets_rating_ID`='$id'";
          $resultOwnchoice = $conn->query($queryOwnchoice);
          if ($resultOwnchoice->num_rows > 0) {
              while ($rowChoice = $resultOwnchoice->fetch_assoc()) {
                  $ownChoiceRating = $rowChoice['rating_value'];
                  echo '<script> var ownChoiceRating = ' .
                      $ownChoiceRating .
                      '; </script>';
              }
          }
          if ($result2->num_rows > 0) {
              while ($row2 = $result2->fetch_assoc()) {
                  $total_rating = $row2['total_rating'];
                  $total_count = $row2['total_count'];
              }
          }
          if ($total_count > 0) {
              $average_rating = $total_rating / $total_count; ?> 
              <div id="total">           
              <form action=sheet.php method=post>
                <input type="hidden" name="action" value="vote">
                <input type="hidden" name="sheetId" value="<?php echo $id; ?>">
                <input id="eerste" class="star" type="submit" value="1" name="rating" title="Give 1 stars">
                <input class="star" type="submit" value="2" name="rating" title="Give 2 stars">
                <input class="star" type="submit" value="3" name="rating" title="Give 3 stars">
                <input class="star" type="submit" value="4" name="rating" title="Give 4 stars">
                <input class="star" type="submit" value="5" name="rating" title="Give 5 star">
              </form>
              <div id="averageAndAmount">
                <div id="stars">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <img class="average" src="<?php echo $i <=
                    round($average_rating)
                        ? '../img/star.svg'
                        : '../img/star2.svg'; ?>" alt="Star">
                <?php } ?>
                </div>
                <p><?php echo $total_count; ?> votes</p>
              </div>
              </div>
              <?php
          } else {
               ?><div id="total">           
               <form action=sheet.php method=post>
                 <input type="hidden" name="action" value="vote">
                 <input type="hidden" name="sheetId" value="<?php echo $id; ?>">
                 <input id="eerste" type="submit" value="1" name="rating" title="Give 1 stars">
                 <input type="submit" value="2" name="rating" title="Give 2 stars">
                 <input type="submit" value="3" name="rating" title="Give 3 stars">
                 <input type="submit" value="4" name="rating" title="Give 4 stars">
                 <input type="submit" value="5" name="rating" title="Give 5 star">
               </form>
               <div id="averageAndAmount">
                 <div id="stars">
                 <?php for ($i = 1; $i <= 5; $i++) { ?>
                     <img class="average" src="../img/star2.svg" alt="Star">
                 <?php } ?>
                 </div>
                 <p><?php echo $total_count; ?> votes</p>
               </div>
               </div>
               <?php
          }

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $userId = $_SESSION['users_ID'];
              $rating = $_POST['rating'];
              $sheetId = $_POST['sheetId'];
              $query3 = "SELECT * FROM `imslp_ratings` WHERE `sheets_rating_ID`='$sheetId' AND `rating_user_ID`='$userId'";
              $result3 = $conn->query($query3);
              if ($result3->num_rows == 0) {
                  $query4 = "INSERT INTO `imslp_ratings` SET `id`=NULL, `sheets_rating_ID`='$sheetId', `rating_value`='$rating', `rating_user_ID`='$userId'";
                  $result4 = $conn->query($query4);
                  header("location: sheet.php?id=$sheetId");
              } else {
                  $query5 = "UPDATE `imslp_ratings` SET `rating_value`='$rating' WHERE`sheets_rating_ID`='$sheetId' AND `rating_user_ID`='$userId' ";
                  $result5 = $conn->query($query5);
                  header("location: sheet.php?id=$sheetId");
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
                    });  
                    osmd.load('../xml/' + xml)
                        .then(function () {
                            document.getElementById("loading-spinner").style.display = "none";
                            osmd.render();
                        })
                        .catch(function(){
                            document.getElementById("loading-spinner").style.display = "none";
                        });
            </script>
                 <div class="showbox">
                    <div id="loading-spinner">
                        <svg class="circular" viewBox="25 25 50 50">
                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                       </svg>
                    </div>
            </div>
            
            <?php }

        } else {
            echo '<p>Make an account or log in to watch the sheets!</p>';
        } ?>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="../scripts/stars.js"></script>
</body>
</html>
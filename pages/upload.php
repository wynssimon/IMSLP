<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/reset.css" />
    <link rel="stylesheet" href="../styles/headers.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/text.css" />
    <link rel="stylesheet" href="../styles/upload.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <title>Sheetly</title>
  </head>
  <body>
  <?php include '../includes/header.php'; ?>
    <main class="main">
     <?php
     if (isset($_GET['action']) and $_GET['action'] == 'add') { ?>    
      <div>
         <form method='post' action='upload.php?action=add' enctype="multipart/form-data">
          <h2>Add new songs</h2>
          <input type="hidden" name="action" value="insert">  
          <input required type='text' name='title' class='textInput' placeholder='song title'>
          <input required type='number' name='composer' class='textInput' placeholder='composer_ID'>
          <input required type='number' name='genre' class='textInput' placeholder='genre_ID'>
          <input required type='number' name='arrangement' class='textInput' placeholder='arrangement_ID'>
          <input required type='text' name='instrument1' class='textInput' placeholder='instrument1'>
          <input required type='text' value="10" name='instrument2' class='textInput' placeholder='instrument2'>
          <input requiredtype='text' value="10" name='instrument3' class='textInput' placeholder='instrument3'>
          <input required type='text' value="10" name='instrument4' class='textInput' placeholder='instrument4'>
          <input required type='text' value="10" name='instrument5' class='textInput' placeholder='instrument5'>
          <input required type='text' name='difficulty' class='textInput' placeholder='difficulty'>
          <div>
            <label for="pngSheet">Image PNG file</label>
            <input required type="file" name='pngSheet' accept='.png'>
          </div>
          <div>
            <label for="xmlSheet">Music XML file</label>
            <input required type="file" name='xmlSheet' accept='.musicxml'>
          </div>
          <div>
            <label for="pdfSheet">PDF file</label>
            <input required type="file" name='pdfSheet' accept='.pdf'>
          </div>
          <input type='submit' name='submit' value='Add' class="submit">
        </form>
      </div>
      <div class='inhoud'>
                    <h3>Composer</h3>
                    <h3>Title</h3>
                    <h3>Genre</h3>
                    <h3>Difficulty</h3>
                    <h3>Instruments</h3>
                    <h3>Arrangement</h3>
                    <h3>png</h3>
         <?php
         $query =
             'SELECT `sheets_title`,`sheets_genre_ID`, `sheets_instrument1`,`sheets_instrument2`, `sheets_difficulty`, `sheets_img`, `sheets_xml`, `sheets_id`, `difficulty`, `genre`, `arrangement`, `composers`, `instruments`, `instruments2`, `instruments3`, `instruments4`, `instruments5` FROM `imslp_sheets`,`imslp_genre`, `imslp_difficulty`, `imslp_arrangements`, `imslp_composers`, `imslp_instruments`, `imslp_instruments2`, `imslp_instruments3`, `imslp_instruments4`, `imslp_instruments5` WHERE `sheets_genre_ID`=`genre_ID` AND `sheets_difficulty`=`difficulty_ID` AND `sheets_arrangement_ID`=`arrangement_ID` AND`sheets_composer_ID`=`composers_ID` AND `sheets_instrument1`=`instruments_ID` AND `sheets_instrument2`=`instruments2_ID` AND `sheets_instrument3`=`instruments3_ID`AND `sheets_instrument4`=`instruments4_ID`AND `sheets_instrument5`=`instruments5_ID`';
         $result = $conn->query($query);
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $thisTitle = $row['sheets_title'];
                 $thisComposer = $row['composers'];
                 $thisGenre = $row['genre'];
                 $thisInstrument1 = $row['instruments'];
                 $thisInstrument2 = $row['instruments2'];
                 $thisInstrument3 = $row['instruments3'];
                 $thisInstrument4 = $row['instruments4'];
                 $thisInstrument5 = $row['instruments5'];
                 $thisArrangement = $row['arrangement'];
                 $thisDifficulty = $row['difficulty'];
                 $thisSheet = $row['sheets_img'];
                 echo "
                
                    <p>$thisComposer </p>
                    <p>$thisTitle</p>
                    <p>$thisGenre</p>
                    <p>$thisDifficulty</p>
                    <p>$thisInstrument1 $thisInstrument2 $thisInstrument3 $thisInstrument4 $thisInstrument5</p>
                    <p>$thisArrangement</p>
                    <img class='sheetImg' src='../img/$thisSheet'></img>
                
              ";
             }
         }
         ?>  
</div>
    <?php }
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         if ($_POST['action'] == 'insert') {
             $getTitle = $_POST['title'];
             $getComposer = $_POST['composer'];
             $getGenre = $_POST['genre'];
             $getInstrument1 = $_POST['instrument1'];
             $getInstrument2 = $_POST['instrument2'];
             $getInstrument3 = $_POST['instrument3'];
             $getInstrument4 = $_POST['instrument4'];
             $getInstrument5 = $_POST['instrument5'];
             $getDifficulty = $_POST['difficulty'];
             $getArrangement = $_POST['arrangement'];
             $getImgSheet = $_FILES['pngSheet']['name'];
             $location = '../img/' . $getImgSheet;
             $getSheet = $_FILES['xmlSheet']['name'];
             $location2 = '../xml/' . $getSheet;
             $getPdfSheet = $_FILES['pdfSheet']['name'];
             $location3 = '../pdf/' . $getPdfSheet;

             $check_xml = mysqli_query(
                 $conn,
                 "SELECT * FROM imslp_sheets where sheets_xml = '$getSheet' "
             );
             $check_img = mysqli_query(
                 $conn,
                 "SELECT * FROM imslp_sheets where sheets_img = '$getImgSheet' "
             );
             $check_pdf = mysqli_query(
                 $conn,
                 "SELECT * FROM imslp_sheets where sheets_pdf = '$getPdfSheet' "
             );

             if (
                 mysqli_num_rows($check_xml) > 0
             ) { ?><script>alert("File with this name already exists, change the name")</script><?php } elseif (
                 mysqli_num_rows($check_img) > 0
             ) { ?><script>alert("Image with this name already exists, change the name")</script><?php } elseif (
                 mysqli_num_rows($check_pdf) > 0
             ) { ?><script>alert("Pdf with this name already exists, change the name")</script><?php } elseif (
                 move_uploaded_file(
                     $_FILES['pngSheet']['tmp_name'],
                     $location
                 ) and
                 move_uploaded_file($_FILES['xmlSheet']['tmp_name'], $location2)
             ) {
                 $query = "INSERT INTO `imslp_sheets`(`sheets_title`, `sheets_composer_ID`, `sheets_genre_ID`, `sheets_instrument1`, `sheets_instrument2`,`sheets_instrument3`,`sheets_instrument4`,`sheets_instrument5`,`sheets_arrangement_ID`,`sheets_difficulty`, `sheets_img`,`sheets_xml`, `sheets_pdf`) VALUES ('$getTitle', '$getComposer', '$getGenre', '$getInstrument1', '$getInstrument2', '$getInstrument3', '$getInstrument4', '$getInstrument5','$getArrangement','$getDifficulty', '$getImgSheet','$getSheet', '$getPdfSheet')";
                 $result = $conn->query($query);
                 echo 'gelukt';
             } else {
                 echo "Error uploading file<br>\n";
                 echo 'Error : ' . $_FILES['pngSheet']['error'] . '<br>';
             }
         }
     }
     ?>    
    </main>
    <?php include '../includes/footer.php'; ?>
  </body>
</html>

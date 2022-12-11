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
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/text.css" />
    <link rel="stylesheet" href="../styles/upload.css" />
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
          <input type='text' name='title' class='textInput' placeholder='song title'>
          <input type='text' name='composer' class='textInput' placeholder='composer'>
          <input type='text' name='genre' class='textInput' placeholder='genre'>
          <input type='text' name='arrangement' class='textInput' placeholder='arrangement'>
          <input type='text' name='instrument1' class='textInput' placeholder='instrument1'>
          <input type='text' name='instrument2' class='textInput' placeholder='instrument2'>
          <input type='text' name='difficulty' class='textInput' placeholder='difficulty'>
          <div>
            <label for="pngSheet">Image PNG file</label>
            <input type="file" name='pngSheet' accept='.png'>
          </div>
          <div>
            <label for="xmlSheet">Music XML file</label>
            <input type="file" name='xmlSheet' accept='.musicxml'>
          </div>
          <div>
            <label for="pdfSheet">PDF file</label>
            <input type="file" name='pdfSheet' accept='.pdf'>
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
             'SELECT `sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`, `sheets_instrument2`,`sheets_arrangement`,`sheets_difficulty`, `sheets_img` FROM `imslp_sheets` WHERE 1';
         $result = $conn->query($query);
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $thisTitle = $row['sheets_title'];
                 $thisComposer = $row['sheets_composer'];
                 $thisGenre = $row['sheets_genre'];
                 $thisInstrument1 = $row['sheets_instrument1'];
                 $thisInstrument2 = $row['sheets_instrument2'];
                 $thisArrangement = $row['sheets_arrangement'];
                 $thisDifficulty = $row['sheets_difficulty'];
                 $thisSheet = $row['sheets_img'];
                 echo "
                
                    <p>$thisComposer </p>
                    <p>$thisTitle</p>
                    <p>$thisGenre</p>
                    <p>$thisDifficulty</p>
                    <p>$thisInstrument1 $thisInstrument2</p>
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
                 $query = "INSERT INTO `imslp_sheets`(`sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument1`, `sheets_instrument2`,`sheets_arrangement`,`sheets_difficulty`, `sheets_img`,`sheets_xml`, `sheets_pdf`) VALUES ('$getTitle', '$getComposer', '$getGenre', '$getInstrument1', '$getInstrument2','$getArrangement','$getDifficulty', '$getImgSheet','$getSheet', '$getPdfSheet')";
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
  </body>
</html>

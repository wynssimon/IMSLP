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
        <?php
        $query = 'SELECT `sheets_xml` FROM `imslp_sheets`';
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thisXmlSheet = $row['sheets_xml'];
            }
        }
        ?>
        <script src="../scripts/opensheetmusicdisplay.min.js"></script>
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

                osmd.load('../xml/' + sheet).then(function () {
                osmd.render();
                });       
        </script>
    </main>
</body>

</html>
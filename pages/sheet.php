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
    <title>Sheet</title>
    <link rel="stylesheet" href="../styles/reset.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/main.css" />
</head>

<body>
    <header>
        <h1>IMSLP</h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="subscription.php">Subscription</a>
            <?php if (
                isset($_SESSION['users_ID']) &&
                isset($_SESSION['users_username'])
            ) { ?>
            <a href='./logout.php?action=logout'>Logout</a>
            <a href='./upload.php?action=add'>Insert</a>
            <?php } else { ?>
            <a href="./login.php">Login</a>
            <?php } ?>            <a href="about.php">About</a>
        </nav>
    </header>
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
                var osmd = new opensheetmusicdisplay.OpenSheetMusicDisplay('osmdCanvas');
                    osmd.setOptions({
                    backend: 'svg',
                    drawTitle: true,
                    });

                osmd.load('../xml/<?php echo $thisXmlSheet; ?>').then(function () {
                osmd.render();
                });
            </script>
    </main>
</body>

</html>
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
            <a href="login.php">Login</a>
            <a href="about.php">About</a>
        </nav>
    </header>
    <main>
    <script src="../scripts/opensheetmusicdisplay.min.js"></script>
    <div id="osmdCanvas" />
    <input type="file" id="files" />
    <output id="list"></output>
    <script src="../scripts/fileSelectAndLoadOSMD.js"></script>
</main>
</body>
</html>

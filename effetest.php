<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'pages/config.php';
session_start();

$query =
    'SELECT * FROM imslp_sheets JOIN imslp_instruments ON imslp_sheets.sheets_instrument = imslp_instruments.instruments_ID';
$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $title = $row['sheets_title'];
        $composer = $row['sheets_composer'];
        $instrument = $row['instruments'];
        echo $title . ' - ' . $composer . ' - ' . $instrument . '<br>';
    }
}
?>

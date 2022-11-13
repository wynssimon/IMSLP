<?php
session_start();
session_unset();
session_destroy();

//header = redirect and reloads the page
//!IMPORTANT: needs to be called BEFORE any echo/print or it will fail
header('Location: ../index.php');
?>

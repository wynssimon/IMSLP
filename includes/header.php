<header>
        <h1>Sheetly</h1>
        <?php if (isset($_SESSION['users_username'])) { ?>
            <a class='myaccount' href='../pages/myaccount.php'>My account</a>
            <?php } ?>
        <nav>        
            <a href="../index.php">Home</a>
            <a href="../pages/subscription.php">Subscription</a>
            <a href="../pages/about.php">About</a>
            <?php if (isset($_SESSION['users_username'])) { ?>
            <a href='../pages/logout.php?action=logout'>Logout</a>
            <?php } else { ?>
            <a href="../pages/login.php">Login</a>
            <?php } ?>
            <?php if ($_SESSION['users_permissions'] == '3') { ?>
                <a href='../pages/upload.php?action=add'>Insert</a>
            <?php } ?>

        </nav>
</header>


<header>
    <div class="logo">
    <img src="https://see.fontimg.com/api/renderfont4/BWpx/eyJyIjoiZnMiLCJoIjo5OCwidyI6MTUwMCwiZnMiOjY1LCJmZ2MiOiIjMDAwMDAwIiwiYmdjIjoiI0ZGRkZGRiIsInQiOjF9/c2hlZXRseQ/the-score-normal.png" />
    </div>
    <div class="nav">
        <ul>
            <?php
            $server = $_SERVER['PHP_SELF'];
            $server = str_replace('/Website/', '', $server);
            $server2 = str_replace('pages/', '', $server);
            if ($server == 'index.php') {
                echo '<li><a class="underline" href="index.php">Sheets</a></li>';
            } else {
                echo '<li><a href="index.php">Sheets</a></li>';
            }
            if ($server == 'pages/subscription.php') {
                echo '<li><a class="underline" href="./pages/subscription.php">Subscription</a></li>';
            } else {
                echo '<li><a href="./pages/subscription.php">Subscription</a></li>';
            }
            if ($server == 'pages/about.php') {
                echo '<li><a class="underline" href="./pages/about.php">About</a></li>';
            } else {
                echo '<li><a href="./pages/about.php">About</a></li>';
            }
            ?>           
            <?php if (isset($_SESSION['users_username'])) {
                if ($server == 'pages/myaccount.php') {
                    echo '<li><a class="underline" href="./pages/myaccount.php">My Account</a></li>
                    <li><a href="./pages/logout.php?action=logout">Logout</a></li>
                    ';
                } else {
                    echo '<li><a href="./pages/myaccount.php">My Account</a></li>
                    <li><a href="./pages/logout.php?action=logout">Logout</a></li>
                    ';
                } ?>
            <?php
            } else {
                if ($server == 'pages/login.php') {
                    echo '<li><a class="underline" href="./pages/login.php">Login</a></li>';
                } else {
                    echo '<li><a href="./pages/login.php">Login</a></li>';
                } ?>

            <?php
            } ?>
            <?php if (isset($_SESSION['users_permissions'])) {
                if ($_SESSION['users_permissions'] == '3') { ?>
                <li><a href='./pages/upload.php?action=add'>Insert</a></li>
            <?php } else {}
            } ?>
        </ul>
    </div>
</header>
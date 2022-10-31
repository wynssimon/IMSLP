<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<?php
include 'config.php';

if (isset($_POST['users_username']) && isset($_POST['users_password'])) {
    $users_username = $_POST['users_username'];
    $users_password = $_POST['users_password'];

    if (empty($users_username)) {
        $error = 'Incorect User name or password';
    } elseif (empty($users_password)) {
        $error = 'Incorect User name or password';
    } else {
        $query = "SELECT * FROM imslp_users WHERE users_username='$users_username' AND users_password='$users_password'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (
                $row['users_username'] === $users_username &&
                $row['users_password'] === $users_password
            ) {
                echo 'Logged in!';

                $_SESSION['users_username'] = $row['users_username'];

                $_SESSION['users_name'] = $row['users_name'];

                $_SESSION['users_ID'] = $row['users_ID'];

                //header('Location: index.php');

                exit();
            } else {
                $error = 'Incorect User name or password';
            }
        } else {
            $error = 'Incorect User name or password';
        }
    }
} else {
}
?>
<form action="index.php" method="post">
        <h2>LOGIN</h2>

        <?php if (isset($error)) { ?>

            <p class="error"><?php echo $error; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="users_username" placeholder="User Name"><br>

        <label>Password</label>

        <input type="password" name="users_password" placeholder="Password"><br>

        <button type="submit">Login</button>
        <a href="register.php">Registreren</a>

     </form>
<hr />
<?php  ?>

</main>
</body>
</html>
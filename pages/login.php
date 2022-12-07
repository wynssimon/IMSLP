<?php
session_start(); ?>
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
    <link rel="stylesheet" href="../styles/text.css" />
    <link rel="stylesheet" href="../styles/form.css" />
</head>
<body>
<?php include '../includes/header.php'; ?>
<main class="main">
<?php
include './config.php';
if (isset($_POST['users_username']) && isset($_POST['users_password'])) {
    $users_username = $_POST['users_username'];
    $users_password = $_POST['users_password'];
    if (empty($users_username)) {
        $error = 'Incorect User name or password';
    } elseif (empty($users_password)) {
        $error = 'Incorect User name or password';
    } else {
        $query = "SELECT `users_username`, `users_password`, `users_permissions`, `users_name`, `users_email`, `users_ID` FROM imslp_users WHERE users_username='$users_username' AND users_password='$users_password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (
                $row['users_username'] === $users_username &&
                $row['users_password'] === $users_password
            ) {
                $_SESSION['users_username'] = $row['users_username'];
                $_SESSION['users_permissions'] = $row['users_permissions'];
                $_SESSION['users_name'] = $row['users_name'];
                $_SESSION['users_password'] = $row['users_password'];
                $_SESSION['users_email'] = $row['users_email'];
                $_SESSION['users_ID'] = $row['users_ID'];
                echo $_SESSION['users_username'] . ' Logged in!';
                header('Location: ../index.php?' . $row['users_username']);
            } else {
                $error = 'Incorect User name or password';
            }
        } else {
            $error = 'Incorect User name or password';
        }
    }
}
?>
<form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <div>
            <label>User Name</label>
            <input type="text" name="users_username" placeholder="User Name"><br>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="users_password" placeholder="Password"><br>
        </div>
        <div class="logreg">
            <button type="submit">Login</button>
            <a href="register.php">Registreren</a>
        </div>
</form>
</main>
</body>
</html>
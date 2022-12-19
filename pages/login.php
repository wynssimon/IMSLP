<?php session_start(); ?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href="../styles/loginRegister.css">
<body>
   <div class="container">
      <section id="formHolder">

         <div class="row">

            <div class="col-sm-6 brand">
               <a href="../index.php" class="logo">Home</a>

               <div class="heading">
                  <h2>Sheetly</h2>
                  <p>Your number one music sheets library</p>
               </div>
            </div>

            <div class="col-sm-6 form">
               <div class="login form-peice ">
                  <form class="login-form" action="login.php" method="post">
                     <div id="newUser">Welcome to Sheetly! You can now log in and start browsing trough the sheets</div>
                     <div class="form-group">
                        <label for="loginusername">Username/email</label>
                        <input type="text" name="users_username" id="loginusername" required>
                     </div>
                     <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" name="users_password" id="loginPassword" required>
                     </div>
                     <div id="wrongUsernamePassword">Incorrect username or password!</div>

                     <div class="CTA">
                        <input type="submit" value="Login">
                        <a href="register.php" class="switch">I'm New</a>
                     </div>
                  </form>
               </div>

               <div class="signup form-peice switched">
               </div>
            </div>
         </div>
      </section>
   </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script  src="../scripts/formAnimation.js"></script>

<?php
include './config.php';
if (
    isset($_SESSION['just_registered']) &&
    $_SESSION['just_registered'] == true
) {
    echo '<script>document.getElementById("newUser").style.display = "block";</script>';
    $_SESSION['just_registered'] = false;
}
if (isset($_POST['users_username']) && isset($_POST['users_password'])) {
    $users_username = $_POST['users_username'];
    $users_password = $_POST['users_password'];
    if (empty($users_username)) {
        echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
    } elseif (empty($users_password)) {
        echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
    } else {
        $query = "SELECT `users_username`, `users_password`, `users_permissions`, `users_name`, `users_email`, `users_ID`, `users_permissions_start` FROM imslp_users WHERE (users_username='$users_username' OR users_email='$users_username') AND users_password='$users_password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (
                ($row['users_username'] === $users_username &&
                    $row['users_password'] === $users_password) ||
                ($row['users_email'] === $users_username &&
                    $row['users_password'] === $users_password)
            ) {
                $_SESSION['users_username'] = $row['users_username'];
                $_SESSION['users_permissions'] = $row['users_permissions'];
                $_SESSION['users_name'] = $row['users_name'];
                $_SESSION['users_password'] = $row['users_password'];
                $_SESSION['users_email'] = $row['users_email'];
                $_SESSION['users_ID'] = $row['users_ID'];
                $_SESSION['users_permissions_start'] =
                    $row['users_permissions_start'];
                header('Location: ../index.php?' . $row['users_username']);
            } else {
                echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
            }
        } else {
            echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
        }
    }
}


?>

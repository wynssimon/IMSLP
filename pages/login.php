<?php session_start(); ?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href="../styles/loginRegister.css">
<div class="container">
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
            <a href="../index.php" class="logo">Home</a>

            <div class="heading">
               <h2>Sheetly</h2>
               <p>Your number one music sheets library</p>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">
            <!-- Login Form -->
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
                  <div id="wrongUsernamePassword">!Incorrect username or password!</div>

                  <div class="CTA">
                     <input type="submit" value="Login">
                     <a href="register.php" class="switch">I'm New</a>
                  </div>
               </form>
            </div><!-- End Login Form -->

            <!-- Signup Form -->
            <div class="signup form-peice switched">
               <form class="signup-form" action="register.php" method="post">
                    <input type="hidden" name="action" value="register">
                  <div class="form-group">
                     <label for="users_name">Full Name</label>
                     <input type="text" name="users_name" id="name" class="name">
                     <span class="error"></span>
                  </div>
                  <div class="form-group">
                     <label for="users_username">Username</label>
                     <input type="text" name="users_username" id="name" class="name">
                     <span class="error"></span>
                  </div>   
                  <div class="form-group">
                     <label for="users_email">Email </label>
                     <input type="email" name="users_email" id="email" class="email">
                     <span class="error"></span>
                  </div>
                  <div class="form-group">
                     <label for="users_password">Password</label>
                     <input type="password" name="users_password" id="password" class="pass">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="users_passwordCon">Confirm Password</label>
                     <input type="password" name="users_passwordCon" id="passwordCon" class="passConfirm">
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" value="Signup Now" id="submit">
                     <a href="login.php" class="switch">I have an account</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script  src="../scripts/formAnimation.js"></script>

<?php
include './config.php';
if (
    isset($_SESSION['just_registered']) &&
    $_SESSION['just_registered'] == true
) {
    // Display the pop-up message
    echo '<script>document.getElementById("newUser").style.display = "block";</script>';

    // Reset the session variable
    $_SESSION['just_registered'] = false;
}
if (isset($_POST['users_username']) && isset($_POST['users_password'])) {
    $users_username = $_POST['users_username'];
    $users_password = $_POST['users_password'];
    if (empty($users_username)) {
        //$error = 'Incorrect User name or password';
        echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
    } elseif (empty($users_password)) {
        //$error = 'Incorrect User name or password';
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
                echo $_SESSION['users_username'] . ' Logged in!';
                header('Location: ../index.php?' . $row['users_username']);
            } else {
                //$error = 'Incorrect User name or password';
                echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
            }
        } else {
            //$error = 'Incorrect User name or password';
            echo '<script>document.getElementById("wrongUsernamePassword").style.display = "block";</script>';
        }
    }
}


?>

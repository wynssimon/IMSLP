<?php
session_start(); ?>

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
        $query = "SELECT `users_username`, `users_password`, `users_permissions`, `users_name`, `users_email`, `users_ID`, `users_permissions_start` FROM imslp_users WHERE users_username='$users_username' AND users_password='$users_password'";
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
                $_SESSION['users_permissions_start'] =
                    $row['users_permissions_start'];
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

            <div class="success-msg">
               <p>Great! You are one of our members now</p>
               <a href="#" class="profile">Your Profile</a>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">
            <!-- Login Form -->
            <div class="login form-peice ">
               <form class="login-form" action="login.php" method="post">
                  <div class="form-group">
                     <label for="loginemail">Email</label>
                     <input type="text" name="users_username" id="loginemail" required>
                  </div>
                  <div class="form-group">
                     <label for="loginPassword">Password</label>
                     <input type="password" name="users_password" id="loginPassword" required>
                  </div>

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


<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
ob_start();
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href="../styles/loginRegister.css">
<body>
   <div class='container'>
      <section id='formHolder'>

         <div class='row'>

            <div class='col-sm-6 brand'>
               <a href='../index.php' class='logo'>Back</a>

               <div class='heading'>
                  <h2>Sheetly</h2>
                  <p>Your number one music sheets library</p>
               </div>
            </div>

            <div class='col-sm-6 form'>
               <div class='login form-peice switched'>    
               </div>

               <div class='signup form-peice'>
                  <form class='signup-form' action='register.php' method='post' enctype='multipart/form-data'>
                     <input type='hidden' name='action' value='register'>
                     <div class='form-group'>
                        <label for='users_name'>Full Name</label>
                        <input type='text' name='users_name' id='name' class='name'required>
                        <span class='error'></span>
                     </div>
                     <div id='userExists'>User with this username already exists!</div>
                     <div class='form-group'>
                        <label for='users_username'>Username</label>
                        <input type='text' name='users_username' id='name' class='name'onkeypress="return geenSpatie(event)" required>
                        <script>
                           function geenSpatie(e) {
                              var key = e.which || e.keyCode;
                              return key !== 32;
                           }
                        </script>
                        <span class='error'></span>
                     </div>   
                     <div class='form-group'>
                        <label for='users_email'>Email </label>
                        <input type='email' name='users_email' id='email' class='email' required>
                        <span class='error'></span>
                     </div>
                     <div id='emailExists'>User with this email already exists!</div>
                     <div class='form-group'>
                        <label for='users_password'>Password</label>
                        <input type='password' name='users_password' id='password' class='pass' required>
                        <span class='error'></span>
                     </div>

                     <div class='form-group'>
                        <label for='users_passwordCon'>Confirm Password</label>
                        <input type='password' name='users_passwordCon' id='passwordCon' class='passConfirm'>
                        <span class='error'></span>
                     </div>
                     <div id='passwordMatch'>Passwords do not match!</div>
                     <div id='passwordShould'>Password should have at least :8 characters, one upper case letter, one number, one special character!</div>
                     <div class='CTA'>
                        <input type='submit' value='Signup Now' id='submit'>
                        <a href='login.php' class='switch'>I have an account</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script  src='../scripts/formAnimation.js'></script>

    <?php
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['action'] == 'register') {
            $getUsername = $_POST['users_username'];
            $getPassword = $_POST['users_password'];
            $getPasswordCon = $_POST['users_passwordCon'];

            $getName = $_POST['users_name'];
            $getName = ucwords($getName);
            $getEmail = $_POST['users_email'];

            $check_email = mysqli_query(
                $conn,
                "SELECT users_email FROM imslp_users where users_email = '$getEmail' "
            );
            $check_username = mysqli_query(
                $conn,
                "SELECT users_username FROM imslp_users where users_username = '$getUsername' "
            );
            $uppercase = preg_match('@[A-Z]@', $getPassword);
            $lowercase = preg_match('@[a-z]@', $getPassword);
            $number = preg_match('@[0-9]@', $getPassword);
            $specialChars = preg_match('@[^\w]@', $getPassword);

            if (
                !$uppercase ||
                !$lowercase ||
                !$number ||
                !$specialChars ||
                strlen($getPassword) < 8
            ) {
                echo '<script>document.getElementById("passwordShould").style.display = "block";</script>';
            } elseif ($getPassword != $getPasswordCon) {
                echo '<script>document.getElementById("passwordMatch").style.display = "block";</script>';
            } elseif (mysqli_num_rows($check_email) > 0) {
                echo '<script>document.getElementById("emailExists").style.display = "block";</script>';
            } elseif (mysqli_num_rows($check_username) > 0) {
                echo '<script>document.getElementById("userExists").style.display = "block";</script>';
            } else {
                $query = "INSERT INTO `imslp_users` (`users_ID`, `users_username`, `users_password`, `users_name`, `users_email`,`users_permissions`) VALUES (NULL, '$getUsername', '$getPassword', '$getName','$getEmail',0)";
                $result = $conn->query($query);
                $_SESSION['just_registered'] = true;

                header('location: login.php');
            }
        }
    }
    ob_end_flush();


?>

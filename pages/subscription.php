<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/reset.css" />
    <link rel="stylesheet" href="../styles/header.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/subscription.css" />
    <link rel="stylesheet" href="../styles/text.css" />
    <title>Sheetly</title>
  </head>
  <body>
  <?php include '../includes/header.php'; ?>
    <main class="main">   
    <?php if (isset($_SESSION['users_username'])) {
        if ($_SESSION['users_permissions'] == '1') { ?>
        <?php
        $permissionsStart = $_SESSION['users_permissions_start'];
        $einddatum = date('Y-m-d', strtotime($permissionsStart . ' + 30 days'));
        $new_date = date('d-m-Y', strtotime($einddatum));

        $new_dateee = DateTime::createFromFormat('d-m-Y', $new_date);
        $new_dateee_str = $new_dateee->format('d-m-Y');
        $current_date = new DateTime();
        $difference = $current_date->diff($new_dateee);
        ?>
        <p>Your subscription expires on <?php echo $new_date; ?>. Enjoy your last <?php echo $difference->days; ?> premium Sheetly days!</p>
        
        <?php } elseif ($_SESSION['users_permissions'] == '2') { ?>
          <?php
          $permissionsStart = $_SESSION['users_permissions_start'];
          $einddatum = date(
              'Y-m-d',
              strtotime($permissionsStart . ' + 365 days')
          );
          $new_date = date('d-m-Y', strtotime($einddatum));

          $new_dateee = DateTime::createFromFormat('d-m-Y', $new_date);
          $new_dateee_str = $new_dateee->format('d-m-Y');
          $current_date = new DateTime();
          $difference = $current_date->diff($new_dateee);
          ?>
        <p>Your subscription expires on <?php echo $einddatum; ?>. Enjoy your last <?php echo $difference->days; ?> premium Sheetly days!</p>
      <?php } elseif ($_SESSION['users_permissions'] == '3') { ?>
        <p>You are an admin!!! You can download as many sheets as you want</p>
      <?php } elseif ($_SESSION['users_permissions'] == '0') { ?>
        <p>Wanna be able to download as many sheets as you want? For only €2,99/month or €30/year you can use as much music sheets as you want.</p>
      <div class="subscribe">
        <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=W77KRHZ4HH84J"><button>Subscribe for one month</button></a>    
        <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=QNSK2WU8X7V9A"><button>Subscribe for one year</button></a>
      </div>
    <?php } ?>  
<?php
    } else {
         ?>
        <p>Wanna be able to download as many sheets as you want? For only €2,99/month or €30/year you can use as much music sheets as you want. <br>Log in or register so that you can take your subscription right now.</p>
        <a class="links" href="./login.php">Log in</a>
        <a class="links" href="./register.php">Register</a>
        <p>Sheetly is a free accessible platform for everyone. To continue to exist we need the money from the subscriptions to reimburse our expenses.</p>
        <?php
    } ?>

    </main>
  </body>
</html>

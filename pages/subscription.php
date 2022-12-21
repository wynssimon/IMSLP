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
    <link rel="stylesheet" href="../styles/headers.css" />
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/subscription.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
    <title>Sheetly</title>
  </head>
  <body>
  <?php include '../includes/header.php'; ?>
    <main class="main">   
      <div id="contentSubscription">    
        <?php if (isset($_SESSION['users_username'])) {
            if ($_SESSION['users_permissions'] == '1') { ?>
            <?php
            $permissionsStart = $_SESSION['users_permissions_start'];
            $einddatum = date(
                'Y-m-d',
                strtotime($permissionsStart . ' + 30 days')
            );
            $enddate = date(
                'd-m-Y',
                strtotime($permissionsStart . ' + 30 days')
            );
            $new_date = date('d-m-Y', strtotime($einddatum));

            $new_dateee = DateTime::createFromFormat('d-m-Y', $new_date);
            $new_dateee_str = $new_dateee->format('d-m-Y');
            $current_date = new DateTime();
            $difference = $current_date->diff($new_dateee);
            ?>
            <p>We hope you've enjoyed your premium Sheetly experience so far! Your subscription is set to expire on <?php echo $new_date; ?>, which is just <?php echo $difference->days; ?> days away. While we'll be sad to see you go, we want to encourage you to renew your subscription once it is finished. If not, take advantage of your remaining days of premium use of Sheetly.
            And who knows, maybe once you'll buy a new subscription.
            Right now we want to thank you for your support!</p>
            
            <?php } elseif ($_SESSION['users_permissions'] == '2') { ?>
              <?php
              $permissionsStart = $_SESSION['users_permissions_start'];
              $einddatum = date(
                  'Y-m-d',
                  strtotime($permissionsStart . ' + 365 days')
              );
              $enddate = date(
                  'd-m-Y',
                  strtotime($permissionsStart . ' + 365 days')
              );
              $new_date = date('d-m-Y', strtotime($einddatum));

              $new_dateee = DateTime::createFromFormat('d-m-Y', $new_date);
              $new_dateee_str = $new_dateee->format('d-m-Y');
              $current_date = new DateTime();
              $difference = $current_date->diff($new_dateee);
              ?>
            <p>Your subscription is set to expire on <?php echo $new_date; ?>, which is <?php echo $difference->days; ?> days away. premium Sheetly days! We thank you for your big support with a subscription for one! year.</p>
          <?php } elseif ($_SESSION['users_permissions'] == '3') { ?>
            <p>You are an admin!!! You can download as many sheets as you want. We value your help to expand Sheelty with new sheets so that we can continue at delivering the best for our customers.</p>
          <?php } elseif ($_SESSION['users_permissions'] == '0') { ?>
            <p>Want be able to download and view as many sheets as you want? For only €2,99/month or €30/year you can use as much music sheets as you want.</p>
          <div id="wrapperAlign">
            <div class="wrapper">
              <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=W77KRHZ4HH84J"><span>One month</span></a>   
            </div>
            <div class="wrapper"> 
              <a target="_blank" href="https://www.paypal.com/donate/?hosted_button_id=QNSK2WU8X7V9A"><span>One year</span></a>
            </div>
          </div>
          <p>Sheetly is dedicated to providing a platform that is accessible to everyone, regardless of their financial situation. We believe that everyone should have the opportunity to use music sheets, and that's why we offer Sheetly for free. However, running a platform like Sheetly requires a lot of resources and expenses, and we rely on the revenue from subscriptions to cover those costs. Without the support of our subscribers, we wouldn't be able to continue offering Sheetly as a free platform. By subscribing to Sheetly, you're not only getting access to infinite music sheets, you're also helping to keep the platform running and accessible to everyone. So if you find value in Sheetly and want to help us continue to provide this service to the community, we encourage you to consider subscribing. Your support is greatly appreciated!</p>
        <?php } ?>  
        <?php
        } else {
             ?>
            <p>Want be able to download and view as many sheets as you want? For only €2,99/month or €30/year you can use as much music sheets as you want. <br>Log in or register so that you can take your subscription right now.</p>
            <div id="wrapperAlign">
              <div class="wrapper">
                <a href="./login.php"><span>Log in</span></a>
              </div>
              <div class="wrapper">
                <a href="./register.php"><span>Register</span></a>
              </div>
            </div>
            <p>Sheetly is dedicated to providing a platform that is accessible to everyone, regardless of their financial situation. We believe that everyone should have the opportunity to use music sheets, and that's why we offer Sheetly for free. However, running a platform like Sheetly requires a lot of resources and expenses, and we rely on the revenue from subscriptions to cover those costs. Without the support of our subscribers, we wouldn't be able to continue offering Sheetly as a free platform. By subscribing to Sheetly, you're not only getting access to infinite music sheets, you're also helping to keep the platform running and accessible to everyone. So if you find value in Sheetly and want to help us continue to provide this service to the community, we encourage you to consider subscribing. Your support is greatly appreciated!</p>
            <?php
        } ?>
      </div>
    </main>
    <?php include '../includes/footer.php'; ?>
  </body>
</html>
